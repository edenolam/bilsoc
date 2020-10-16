<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Controller;

use Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\MessagePassword;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\MessagePasswordByAdmin;
use Bilan_Social\Bundle\CollectiviteBundle\Form\CdgType;
use Bilan_Social\Bundle\CollectiviteBundle\Form\MessagePasswordType;
use Bilan_Social\Bundle\CollectiviteBundle\Form\MessagePasswordByAdminType;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CdgController extends AbstractBSController
{
    public function ficheAction(Request $request)
    {
        $chemin = 'LOGO';
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        foreach ($user->getUtilisateurCdgs() as $k => $v) {
            $cdg = $v->getCdg();
        }

        $originalCdgContacts = new ArrayCollection();
        foreach ($cdg->getContacts() as $tag) {
            $originalCdgContacts->add($tag);
        }
        $form = $this->createForm(CdgType::class, $cdg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $logo = $request->files->get('bilan_social_bundle_collectivitebundle_cdg')['image']['image'];

            if (isset($logo)) {

                $fileManager = $this->getBSFileManager();
                $response_upload = $fileManager->uploadFileInPublicFolder($chemin, $fileManager->prepareFileToAdd($logo, false));

                if ($response_upload['isOk']) {
                    $cdg->setFileKey($response_upload['fichier']->getFileKey());
                } else {
                    $this->addFlash('error', $response_upload['errMsg']);
                    return $this->render('@Collectivite/Cdg/fiche.html.twig',
                        array('form' => $form->createView(),
                            'email' => $user->getEmail(),
                            'username' => $user->getUsername()
                        ));
                }
            }

            $email = $_POST['email'];
            foreach ($originalCdgContacts as $contact) {
                if (false === $cdg->getContacts()->contains($contact)) {
                    $em->remove($contact);
                }
            }
            foreach ($cdg->getContacts() as $key => $contact) {
                $contact->setCdg($cdg);
            }

            $cdg->setDtModi(new \DateTime());
            $cdg->setCdUtilmodi($user->getUsername());
            $user->setEmail($email);

            try {
                $em->persist($cdg);
                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', $this->get('translator')->trans('editfiche.cdg.flash'));
            } catch (Exception $ex) {
                $this->addFlash('error', $this->get('translator')->trans('erreur.cdg.flash'));
            }
        }
        if(!$form->isValid()){
            $this->displayErrorFlash($form);
        }

        return $this->render('@Collectivite/Cdg/fiche.html.twig',
            array('form' => $form->createView(), 'email' => $user->getEmail(), 'username' => $user->getUsername()));
    }

    public function indexDepartementsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cdgs = $em->getRepository('CollectiviteBundle:Cdg')->findAll();
        $departements = $em->getRepository('CollectiviteBundle:Departement')->findAll();
        return $this->render('@Collectivite/Cdg/departements.html.twig', array('cdgs' => $cdgs, 'departements' => $departements));
    }

    public function infosDepartementAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idCdg = $request->get('idCdg');
        $this->saveAndUnlockSession($request);
        $departements = [];
        $infos = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByCdg($idCdg);
        foreach ($infos as $dept) {
            $departements[] = $dept->getDepartement()->getIdDepa();
        }
        $jsonContent = json_encode($departements);

        $response = new Response();
        $response->setContent($jsonContent);

        return $response;
    }

    public function enregistrerDepartementAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idCdg = $request->get('idCdg');
        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->find($idCdg);
        $departements = $request->get('departements');
        $cdgDepts = $em->getRepository('CollectiviteBundle:CdgDepartement')->findBy(array('cdg' => $cdg, 'fgType' => 0));
        $jsonContent = '';
        if (!empty($departements)) {
            foreach ($departements as $dept) {
                if (null != $cdgDepts) {
                    foreach ($cdgDepts as $cdgDept) {
                        if (!in_array($cdgDept->getDepartement()->getIdDepa(), $departements)) {
                            $em->remove($cdgDept);
                            $em->flush();
                        }
                    }
                }
                $verifCdgDept = $em->getRepository('CollectiviteBundle:CdgDepartement')->findBy(array('cdg' => $cdg, 'departement' => $dept, 'fgType' => 0));
                if (empty($verifCdgDept)) {
                    $departement = $em->getRepository('CollectiviteBundle:Departement')->find($dept);
                    $newCdgDept = new CdgDepartement();
                    $newCdgDept->setCdg($cdg);
                    $newCdgDept->setDepartement($departement);
                    $newCdgDept->setFgType(0);

                    try {
                        $em->persist($newCdgDept);
                        $em->flush();
                        $jsonContent = 'ok';
                        $flashBag = $this->get('session')->getFlashBag();
                        $flashBag->set('notice', $this->get('translator')->trans('enregistrementdepartement.cdg.flash'));
                    } catch (Exception $ex) {
                        $jsonContent = 'nok';
                        $this->addFlash('error', $this->get('translator')->trans('erreur.cdg.flash'));
                    }
                }
            }
        } else {
            if (null != $cdgDepts) {
                foreach ($cdgDepts as $cdgDept) {
                    $em->remove($cdgDept);
                }
            }
            $em->flush();
            $jsonContent = 'ok';
            $flashBag = $this->get('session')->getFlashBag();
            $flashBag->set('notice', $this->get('translator')->trans('enregistrementdepartement.cdg.flash'));
        }
        $response = new Response();
        $response->setContent($jsonContent);

        return $response;
    }

    public function messageResetPasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        foreach ($user->getUtilisateurCdgs() as $k => $v) {
            $cdg = $v->getCdg();
        }
        $message = $em->getRepository('CollectiviteBundle:MessagePassword')->findOneByCdg($cdg);

        $admin = $em->getRepository('UserBundle:User')->findByRoles('ROLE_ADMIN');
        $messageByAdmin = $em->getRepository('CollectiviteBundle:MessagePasswordByAdmin')->findOneByAdmin($admin[0]);

        if ($message == null) {
            $message = new MessagePassword();
        }

        $form = $this->createForm(MessagePasswordType::class, $message, array('messageByAdmin' => $messageByAdmin));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setCdg($cdg);

            $em->getConnection()->beginTransaction();
            try {
                $em->persist($message);
                $em->flush();

                $em->getConnection()->commit();
                $this->addFlash('notice', 'Le message a bien été enregistré.');
            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('error', 'Une erreur est survenue, veuillez recommencer.');
            }
        }

        return $this->render('@Collectivite/Cdg/messageResetPassword.html.twig', array('form' => $form->createView(), 'messageByAdmin' => $messageByAdmin));

    }

    public function messageResetPasswordByAdminAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($user->hasRole('ROLE_ADMIN')) {
            $message = $em->getRepository('CollectiviteBundle:MessagePasswordByAdmin')->findOneByAdmin($user);

            if ($message == null) {
                $message = new MessagePasswordByAdmin();
            }
            $form = $this->createForm(MessagePasswordByAdminType::class, $message);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $message->setAdmin($user);

                $em->getConnection()->beginTransaction();
                try {
                    $em->persist($message);
                    $em->flush();

                    $em->getConnection()->commit();
                    $this->addFlash('notice', 'Le message a bien été enregistré.');
                }
                catch (Exception $ex) {
                    $em->getConnection()->rollBack();
                    $this->addFlash('error', 'Une erreur est survenue, veuillez recommencer.');
                }
            }

            return $this->render('@Collectivite/Cdg/messageResetPasswordByAdmin.html.twig', array('form' => $form->createView()));
        }
    }

}

