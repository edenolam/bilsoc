<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Controller;

use Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueEchange;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\ParametrageAffichageCollectivite;
use Bilan_Social\Bundle\CollectiviteBundle\Form\CdgType;
use Bilan_Social\Bundle\CollectiviteBundle\Form\CollectiviteType;
use Bilan_Social\Bundle\CollectiviteBundle\Form\HistoriqueCollectiviteType;
use Bilan_Social\Bundle\CollectiviteBundle\Form\HistoriqueEchangeType;
use Bilan_Social\Bundle\EnqueteBundle\Form\ParametrageEnqueteForm;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Exporter\Handler;
use Bilan_Social\Bundle\EnqueteBundle\Entity\EnqueteCollectivite;
use Exporter\Source\DoctrineDBALConnectionSourceIterator;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Bilan_Social\Bundle\CollectiviteBundle\Exporter\Writer\XlsxWriter;

//use Exporter\Writer\XlsWriter;

class CollectiviteController extends AbstractBSController {

    public function indexAction() {

        $formCol = $this->createForm(ParametrageEnqueteForm::class);

        return $this->render('@Collectivite/Collectivite/index.html.twig', array(
            'formCol' => $formCol->createView(),
            'params' => null,
        ));
    }

    public function editCollectiviteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $relance = null;
        $blEnvoi = false;
        $current_user = $this->getUser();
        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_COLLECTIVITY')) {

            $idColl = $current_user->getCollectivite()->getIdColl();
            if ($idColl != $id) {
                return $this->render('@Collectivite/Collectivite/edit.html.twig', array('authorized' => false));
            }
        }
        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($id);
        $nmSire = $collectivite->getNmSire();
        $lbColl = $collectivite->getLbColl();
        $refTypeCollectivite = $collectivite->getRefTypeCollectivite();
        $departement = $collectivite->getDepartement();
        $lbVill = $collectivite->getLbVill();
        $cdPost = $collectivite->getCdPost();
        $blAffiColl = $collectivite->getBlAffiColl();
        $blCtCdg = $collectivite->getBlCtCdg();
        $blCollDgcl = $collectivite->getBlCollDgcl();
        $blChsct = $collectivite->getBlChsct();


        $infoSireRatt = $this->get('translator')->trans('informations.champs.siret.rattachement');
        $infoDgcl = $this->get('translator')->trans('informations.champs.dgcl');

        $collectiviteDraft = $em->getRepository('CollectiviteBundle:CollectiviteDraft')->findByCollectivite($collectivite);
        if (!empty($collectiviteDraft)){
            $blEnvoi = true;
        }

        $cdg = $collectivite->getCdgDepartement()->getCdg();

        $originalCdgContacts = new ArrayCollection();
        foreach ($cdg->getContacts() as $tag) {
            $originalCdgContacts->add($tag);
        }

        $originalCollectiviteContacts = new ArrayCollection();
        foreach ($collectivite->getContacts() as $tag) {
            $originalCollectiviteContacts->add($tag);
        }


        $formContacts = $this->createForm(CdgType::class, $cdg);
        $showSiretForm = null;
        if($current_user->hasRole('ROLE_ADMIN')){
            $showSiretForm = false;
        }else{
             $showSiretForm = true;
        }

        $form = $this->createForm(CollectiviteType::class, $collectivite, array('nmSire' => $showSiretForm));
        if($currentCampagne!=null){
            $enqu = $em->getRepository('EnqueteBundle:Enquete')->getEnqueteActive($id, $currentCampagne->getIdCamp());
            if (null != $enqu) {
                $idEnqu = $enqu->getIdEnqu();
                $params = ['collectivite' => $id, 'enquete' => $idEnqu];
                $resRelance = $em->getRepository('CampagneBundle:Relance')->getLastRelance($params);

                if (!empty($resRelance) && null != $resRelance){
                    $relance = $resRelance[0];
                }
            }
        }

        $form->remove('creer');

        $form->handleRequest($request);
        $errors = null;
        if ($form->isSubmitted()){


            $validator = $this->get('validator');
            if($form->get('soumettreValidation')->isClicked()){
                $errors = $validator->validate($collectivite, null, array('notNull'));
            }



            if($form->isValid() && !$errors){
                if ($form->getClickedButton()->getName() == 'soumettreValidation') {
                    $formData = $form->getData();
                    $getCdg = $em->getRepository('CollectiviteBundle:Cdg')->findCdgByCollectivite($current_user);
                    $options = [];
                    if ($lbColl == $formData->getLbColl() && $refTypeCollectivite == $formData->getRefTypeCollectivite() &&
                            $departement == $formData->getDepartement() && $lbVill == $formData->getLbVill() && $cdPost == $formData->getCdPost()) {
                        $this->addFlash('error', $this->get('translator')->trans('erreur.modification.collectivite'));
                        return $this->redirectToRoute('collectivite_edit', array('id' => $id));
                    }

                    $collectivite->setCdUtilmodi($current_user->getUsername());
                    $collectivite->setDtModi(new \DateTime());
                    $collectivite->setChangeRequest(true);
                    try {
                        $em->persist($current_user);
                        $em->persist($collectivite);
                        $em->flush();

                        $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
                        try{
                            $options['silence'] = true;
                            $contactService->sendEmailInterneAppli('SOUMVALIDCOLL', null, true, $getCdg, null, $options);
                        }
                        catch (\Exception $ex) {
                            //$this->addFlash('error',  $this->get('translator')->trans('erreur.collectivite.flash'));
                        }
                        return $this->redirectToRoute('collectivite_edit', array('id' => $id));
                    } catch (\Exception $ex) {
                        $this->addFlash('error',  $this->get('translator')->trans('erreur.collectivite.flash'));
                        return $this->redirectToRoute('collectivite_edit', array('id' => $id));
                    }
                }elseif($form->getClickedButton()->getName() == 'modifier'){
                    foreach ($originalCollectiviteContacts as $contact) {
                        $teleTmp = $contact->getLbTele();
                        $tele = str_pad($teleTmp, 10, "0", STR_PAD_LEFT);
                        $contact->setLbTele($tele);
                        if (false === $collectivite->getContacts()->contains($contact)) {
                            $em->remove($contact);
                        }
                    }
                    foreach ($collectivite->getContacts() as $key => $contact) {
                        $contact->setCollectivite($collectivite);
                    }
                    $collectivite->setCdUtilmodi($current_user->getUsername());
                    $collectivite->setDtModi(new \DateTime());
                    $collectivite->setChangeRequest(false);
                    $collectivite->setNmSire($nmSire);
                    $collectivite->setLbColl($lbColl);
                    $collectivite->setRefTypeCollectivite($refTypeCollectivite);
                    $collectivite->setDepartement($departement);
                    $collectivite->setCdPost($cdPost);
                    $collectivite->setLbVill($lbVill);
                    $collectivite->setBlAffiColl($blAffiColl);
                    $collectivite->setBlCtCdg($blCtCdg);
                    $collectivite->setBlCollDgcl($blCollDgcl);
                    $collectivite->setBlChsct($blChsct);

                    try {
                        $em->persist($current_user);
                        $em->persist($collectivite);
                        $em->flush();
                        
                        $session = $this->get('session');
                        $session->set('hasBeenModified', true);

                        $this->addFlash('notice', $this->get('translator')->trans('edit.collectivite.flash'));
                        return $this->redirectToRoute('collectivite_edit', array('id' => $id));
                    } catch (\Exception $ex) {
//                        $this->addFlash('error',  $this->get('translator')->trans('erreur.collectivite.flash'));
                        $this->addFlash('error',  $ex->getMessage());
                        return $this->redirectToRoute('collectivite_edit', array('id' => $id));
                    }
                }
            }
            if(!$form->isValid()){
                $this->displayErrorFlash($form);
            }


        }


        return $this->render('@Collectivite/Collectivite/edit.html.twig', array('collectivite' => $collectivite, 'errors' => $errors ,'authorized' => true, 'form' => $form->createView(), 'relance' => $relance, 'blEnvoi' => $blEnvoi, 'formCdg' => $formContacts->createView(), 'infoSireRatt' => $infoSireRatt, 'infoDgcl' => $infoDgcl));
    }

    public function getCollectiviteHistorisationAction($params){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $admin = 0;
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $admin = 1;
        }

        if($params == 1){
            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationPossibleFusion($user,$admin);
        }else if($params == 0){
            //$collectivite = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->getNewColl($this->getUser(), $params);
            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($user, 1, 'vide', $admin);

        }elseif ($params == 2){
            //$collectivite = $em->getRepository('CollectiviteBundle:HistoriqueCollectivite')->getCollUnchanged($this->getUser(), $params);
            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationAbsorption($user, $admin);
        }

        $response = new JsonResponse(array('data' => $collectivite));
        return $response;
    }

    public function CollectiviteModificationsCreationHistorisationAction(Request $request,$siret){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $collectivite_import = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findOneByNmSire($siret);
        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByNmSire($siret);
        //dump($collectivite);
        $historiqueColl = new HistoriqueCollectivite();

        $admin = 0;
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $admin = 1;
        }

        $arrayCrea =   array('blCrea' => 0);
        if($admin) {
            if($collectivite_import->getBlArchi() == "1" && $collectivite_import->getMotif() == "vide") {
                $arrayCrea =   array('blCrea' => 1);
            }
        }

        $form = $this->createForm(HistoriqueCollectiviteType::class, $historiqueColl, $arrayCrea);

        $form->handleRequest($request);
        $errors = null;
        if ($form->isSubmitted() && $form->isValid()){
            $nmSiretArray =  explode(',', $form['listColl']->getData());

            $em->getConnection()->beginTransaction();
            try{
                if($historiqueColl->getRefNatureMAJ() == null) {
                    $this->addFlash('error', 'Nature mise à jour obligatoire');
                    return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
                        'form' => $form->createView(),
                        'infoCollectivite' => $collectivite_import,
                    ));
                }

                $cdStat = $historiqueColl->getRefNatureMAJ()->getCdStat();
                $lbTypeArch = $historiqueColl->getRefNatureMAJ()->getLbNatureMaj();
                //dump($cdStat);
                //dump($collectivite_import);
                //dump($historiqueColl);
                //dump($nmSiretArray);

                //exit;

                $search = array("]", "[", " ", "\"");

                if($cdStat == 'cr') {
                    // Création
                    $histoCollNew = new HistoriqueCollectivite();
                    $histoCollNew->setLbTypeArch($lbTypeArch);
                    $histoCollNew->setDtCrea(new \DateTime());
                    $histoCollNew->setCdUtilcrea($user->getUsername());
                    $histoCollNew->setRefNatureMAJ($historiqueColl->getRefNatureMAJ());
                    $histoCollNew->setDtArch($historiqueColl->getDtArch());
                    //$histoCollNew->setNmAnciSire($siret);
                    $histoCollNew->setNmAnciSire("null");
                    $histoCollNew->setNmNouvSire($siret);

                    //dump($histoCollNew);
                    //exit;

                    $em->persist($histoCollNew);
                    $collectivite->setBlActi(true);
                }
                else if($cdStat == 'fs' || $cdStat == 'ca') {

                    if(count($nmSiretArray)==0) {
                        $this->addFlash('notice', 'Collectivité obligatoire');
                        return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
                            'form' => $form->createView(),
                            'infoCollectivite' => $collectivite_import,
                        ));
                    }

                    foreach ($nmSiretArray as $key => $siretSelectNoClean){
                        $siretSelect = str_replace($search, "", $siretSelectNoClean);

                        if($siretSelect == "") {
                            $this->addFlash('error', 'Collectivité obligatoire');
                            return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
                                'form' => $form->createView(),
                                'infoCollectivite' => $collectivite_import,
                            ));
                        }

                        //dump($siretSelect);

                        $collectivite_importSelect = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findOneByNmSire($siretSelect);
                        $collectiviteSelect = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByNmSire($siretSelect);

                        //dump($collectivite_importSelect);

                        $histoCollNew = new HistoriqueCollectivite();
                        $histoCollNew->setLbTypeArch($lbTypeArch);
                        $histoCollNew->setDtCrea(new \DateTime());
                        $histoCollNew->setCdUtilcrea($user->getUsername());
                        $histoCollNew->setRefNatureMAJ($historiqueColl->getRefNatureMAJ());
                        $histoCollNew->setDtArch($historiqueColl->getDtArch());
                        $histoCollNew->setNmAnciSire($siretSelect);
                        $histoCollNew->setNmNouvSire($siret);

                        //dump($histoCollNew);
                        //exit;

                        $em->persist($histoCollNew);
                        if($collectivite_importSelect!=null) $em->remove($collectivite_importSelect);
                        $collectiviteSelect->setBlActi(false);
                    }

                    $collectivite->setBlActi(true);
                }
                else if($cdStat == 'ds') {
                    // Dissolution EN ADMIN => modif à faire aussi en CDG
                    $histoCollNew = new HistoriqueCollectivite();
                    $histoCollNew->setLbTypeArch($lbTypeArch);
                    $histoCollNew->setDtCrea(new \DateTime());
                    $histoCollNew->setCdUtilcrea($user->getUsername());
                    $histoCollNew->setRefNatureMAJ($historiqueColl->getRefNatureMAJ());
                    $histoCollNew->setDtArch($historiqueColl->getDtArch());
                    $histoCollNew->setNmAnciSire($siret);
                    $histoCollNew->setNmNouvSire("null");

                    //dump($histoCollNew);
                    //exit;

                    $em->persist($histoCollNew);
                    $collectivite->setBlActi(false);
                }
                else if($cdStat == 'ab' ) {
                    // Dissolution EN ADMIN => modif à faire aussi en CDG
                    //dump(count($nmSiretArray));
                    if(count($nmSiretArray) == 0) {
                        $this->addFlash('notice', 'Collectivité obligatoire');
                        return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
                            'form' => $form->createView(),
                            'infoCollectivite' => $collectivite_import,
                        ));
                    }

                    foreach ($nmSiretArray as $key => $siretSelectNoClean){
                        $siretSelect = str_replace($search, "", $siretSelectNoClean);

                        if($siretSelect == "") {
                            $this->addFlash('error', 'Collectivité obligatoire');
                            return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
                                'form' => $form->createView(),
                                'infoCollectivite' => $collectivite_import,
                            ));
                        }


                        $histoCollNew = new HistoriqueCollectivite();
                        $histoCollNew->setLbTypeArch($lbTypeArch);
                        $histoCollNew->setDtCrea(new \DateTime());
                        $histoCollNew->setCdUtilcrea($user->getUsername());
                        $histoCollNew->setRefNatureMAJ($historiqueColl->getRefNatureMAJ());
                        $histoCollNew->setDtArch($historiqueColl->getDtArch());
                        $histoCollNew->setNmAnciSire($siret);
                        $histoCollNew->setNmNouvSire($siretSelect);

                        //dump($histoCollNew);
                        //exit;

                        $em->persist($histoCollNew);
                        break;
                    }
                    $collectivite->setBlActi(false);
                }

                $em->remove($collectivite_import);

                $em->flush();

                $em->getConnection()->commit();
                $this->addFlash('notice',$this->get('translator')->trans('fiche.collectivite.archive.flash'));

                // Redirect
                $formCol = $this->createForm(ParametrageEnqueteForm::class);
                $admin = 0;
                if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                    $admin = 1;
                }
                $collectivitesCreation_presentes = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($user, 0, 'Création', $admin);
                if(!empty($collectivitesCreation_presentes)){
                    return $this->render('@Collectivite/Cdg/indexHistorisationSiretCreation.html.twig', array(
                        'formCol' => $formCol->createView(),
                        'params' => null,
                    ));
                }else{
                    return $this->render('@Collectivite/Cdg/indexHistorisationSiretSuppression.html.twig', array(
                        'formCol' => $formCol->createView(),
                        'params' => null,
                    ));
                }

            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('notice',$this->get('translator')->trans('erreur.collectivite.flash'));
            }
        }

        return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
            'form' => $form->createView(),
            'infoCollectivite' => $collectivite_import,
        ));

    }


    public function CollectiviteModificationsSuppressionHistorisationAction(Request $request,$siret){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $collectivite_import = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findOneByNmSire($siret);
        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByNmSire($siret);

        //dump($collectivite);
        $historiqueColl = new HistoriqueCollectivite();

        $form = $this->createForm(HistoriqueCollectiviteType::class, $historiqueColl, array('blCrea' => 1));

        $form->handleRequest($request);
        $errors = null;
        if ($form->isSubmitted() && $form->isValid()){
            $nmSiretArray =  explode(',', $form['listColl']->getData());

            $em->getConnection()->beginTransaction();
            try{

                if($historiqueColl->getRefNatureMAJ() == null) {
                    $this->addFlash('error', 'Nature mise à jour obligatoire');
                    return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
                        'form' => $form->createView(),
                        'infoCollectivite' => $collectivite_import,
                    ));
                }

                $cdStat = $historiqueColl->getRefNatureMAJ()->getCdStat();
                $lbTypeArch = $historiqueColl->getRefNatureMAJ()->getLbNatureMaj();
                //dump($cdStat);
                //dump($collectivite_import);
                //dump($historiqueColl);
                //dump($nmSiretArray);

                //exit;

                $search = array("]", "[", " ", "\"");

                if($cdStat == 'ds') {
                    // Dissolution => modif à faire aussi en ADMIN
                    $histoCollNew = new HistoriqueCollectivite();
                    $histoCollNew->setLbTypeArch($lbTypeArch);
                    $histoCollNew->setDtCrea(new \DateTime());
                    $histoCollNew->setCdUtilcrea($user->getUsername());
                    $histoCollNew->setRefNatureMAJ($historiqueColl->getRefNatureMAJ());
                    $histoCollNew->setDtArch($historiqueColl->getDtArch());
                    $histoCollNew->setNmAnciSire($siret);
                    $histoCollNew->setNmNouvSire("null");

                    //dump($histoCollNew);
                    //exit;

                    $em->persist($histoCollNew);
                    $collectivite->setBlActi(false);
                }
                else if($cdStat == 'ab' ) {
                    // Absorption => modif à faire aussi en ADMIN
                    //dump(count($nmSiretArray));
                    if(count($nmSiretArray) == 0) {
                        $this->addFlash('notice', 'Collectivité obligatoire');
                        return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
                            'form' => $form->createView(),
                            'infoCollectivite' => $collectivite_import,
                        ));
                    }

                    foreach ($nmSiretArray as $key => $siretSelectNoClean){
                        $siretSelect = str_replace($search, "", $siretSelectNoClean);

                        if($siretSelect == "") {
                            $this->addFlash('error', 'Collectivité obligatoire');
                            return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
                                'form' => $form->createView(),
                                'infoCollectivite' => $collectivite_import,
                            ));
                        }

                        $histoCollNew = new HistoriqueCollectivite();
                        $histoCollNew->setLbTypeArch($lbTypeArch);
                        $histoCollNew->setDtCrea(new \DateTime());
                        $histoCollNew->setCdUtilcrea($user->getUsername());
                        $histoCollNew->setRefNatureMAJ($historiqueColl->getRefNatureMAJ());
                        $histoCollNew->setDtArch($historiqueColl->getDtArch());
                        $histoCollNew->setNmAnciSire($siret);
                        $histoCollNew->setNmNouvSire($siretSelect);

                        //dump($histoCollNew);
                        //exit;

                        $em->persist($histoCollNew);
                        break;
                    }
                    $collectivite->setBlActi(false);
                }

                //exit;

                $em->remove($collectivite_import);

                $em->flush();
                $em->getConnection()->commit();
                $this->addFlash('notice',$this->get('translator')->trans('fiche.collectivite.archive.flash'));

                // Redirect
                $formCol = $this->createForm(ParametrageEnqueteForm::class);
                $admin = 0;
                if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                    $admin = 1;
                }
                $collectivitesCreation_presentes = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($user, 0, 'Création', $admin);
                if(!empty($collectivitesCreation_presentes)){
                    return $this->render('@Collectivite/Cdg/indexHistorisationSiretCreation.html.twig', array(
                        'formCol' => $formCol->createView(),
                        'params' => null,
                    ));
                }else{
                    return $this->render('@Collectivite/Cdg/indexHistorisationSiretSuppression.html.twig', array(
                        'formCol' => $formCol->createView(),
                        'params' => null,
                    ));
                }

            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('notice',$this->get('translator')->trans('erreur.collectivite.flash'));
            }
        }

        return $this->render('@Collectivite/Cdg/update_siret.html.twig', array(
            'form' => $form->createView(),
            'infoCollectivite' => $collectivite_import,
        ));

    }

    public function modificationsCollectiviteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $change = [];
        $droitsCdg = null;
        $current_user = $this->getUser();
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneBy(array('utilisateur' => $current_user->getIdUtil()));
        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($id);
        $resCollDraft = $em->getRepository('CollectiviteBundle:CollectiviteDraft')->findByCollectivite($collectivite);
        if($this->get('security.authorization_checker')->isGranted('ROLE_CDG')){
            $droitsColl = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectivite($id,$utilCdg->getIdUtilisateurCdg());
            if(($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_COLLECTIVITE)){
                $droitsCdg = 'read';
            }
            if(($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)){
                $droitsCdg = 'write';
            }
        }elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $droitsCdg = 'write';
        }

        if (null == $resCollDraft || empty($resCollDraft)){
            return $this->render('@Collectivite/Collectivite/modification.html.twig', array('collectivite' => $collectivite, 'draft' => null, 'droitsCdg' => $droitsCdg));
        }

        $collectiviteDraft = $resCollDraft[0];

        $collDraftFields = $em->getClassMetadata('CollectiviteBundle:CollectiviteDraft')->getFieldNames();
        $collDraftAsso = $em->getClassMetadata('CollectiviteBundle:CollectiviteDraft')->getAssociationNames();
        $fields = array_merge($collDraftFields, $collDraftAsso);

        foreach ($fields as $key => $value) {
            $method = 'get' . ucfirst($value);
            if (method_exists($collectiviteDraft, $method) && method_exists($collectivite, $method)) {
                $coll = $collectivite->{$method}();
                $collDraft = $collectiviteDraft->{$method}();
                if (null !== $collDraft and $coll !== $collDraft) {
                    $change[$value]['old'] = $coll;
                    $change[$value]['new'] = $collDraft;
                }
            } elseif ($value == 'cdg_is_authorized_by_collectivity') {
                $coll = $collectivite->getCdgIsAuthorizedByCollectivity();
                $collDraft = $collectiviteDraft->getCdgIsAuthorizedByCollectivity();
                if (null !== $collDraft and $coll !== $collDraft) {
                    $change[$value]['old'] = $coll;
                    $change[$value]['new'] = $collDraft;
                }
            }
        }

        return $this->render('@Collectivite/Collectivite/modification.html.twig', array('collectivite' => $collectivite, 'draft' => $collectiviteDraft, 'change' => $change, 'droitsCdg' => $droitsCdg));
    }

    public function validerCollectiviteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        $idColl = $request->get('collectivite');
        $Service_contact = $this->get('Bilan_Social.ContactBundle.Services.Contact');
        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);
        $user = $em->getRepository('UserBundle:User')->findOneByCollectivite($collectivite);
        $resCollDraft = $em->getRepository('CollectiviteBundle:CollectiviteDraft')->findByCollectivite($collectivite);

        if (null != $resCollDraft || !empty($resCollDraft)) {
            $collectiviteDraft = $resCollDraft[0];
            // mettre infos collDraft dans collectivite
            $collDraftFields = $em->getClassMetadata('CollectiviteBundle:CollectiviteDraft')->getFieldNames();
            $collDraftAsso = $em->getClassMetadata('CollectiviteBundle:CollectiviteDraft')->getAssociationNames();
            $fields = array_merge($collDraftFields, $collDraftAsso);

            foreach ($fields as $key => $value) {
                $methodGet = 'get' . ucfirst($value);
                $methodSet = 'set' . ucfirst($value);
                if (method_exists($collectiviteDraft, $methodGet) && method_exists($collectivite, $methodGet)) {
                    $coll = $collectivite->{$methodGet}();
                    $collDraft = $collectiviteDraft->{$methodGet}();
                    if (null !== $collDraft and $coll !== $collDraft) {
                        $collectivite->{$methodSet}($collDraft);
                    }
                }
            }
        }
        // passer change request à 0
        $collectivite->setChangeRequest(0);
        $collectivite->setDtModi(new \DateTime());
        $user->setUsername($collectiviteDraft->getNmSire());

        try {
            $em->persist($collectivite);
            $em->persist($user);
            // remove coll draft

            if (null != $resCollDraft || !empty($resCollDraft)){
                 $em->remove($collectiviteDraft);
            }


            $em->flush();

            $Service_contact->valideOuRefusBilanSocial($collectivite, 'VALIDEMODIF');
            $jsonContent = 'success';
            $this->addFlash('notice',  $this->get('translator')->trans('modificationaccepte.collectivite.flash'));
        } catch (Exception $ex) {
            $jsonContent = json_encode($ex);
            $this->addFlash('notice', $this->get('translator')->trans('erreur.collectivite.flash'));
        }

        $response = new Response();
        $response->setContent($jsonContent);

        return $response;
    }

    public function refuserCollectiviteAction(Request $request) {
        $Service_contact = $this->get('Bilan_Social.ContactBundle.Services.Contact');
        $em = $this->getDoctrine()->getManager();
        $getCdg = $this->getUser();
        $idColl = $request->get('collectivite');

        try {
            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);
            $resCollDraft = $em->getRepository('CollectiviteBundle:CollectiviteDraft')->findByCollectivite($collectivite);
            if (null != $resCollDraft || !empty($resCollDraft)) {
                $draft = $resCollDraft[0];
                // passer change request à 0
                $collectivite->setChangeRequest(0);

                //remove collDraft
                $em->remove($draft);
                $em->persist($collectivite);
                $em->flush();

                $this->addFlash('notice', $this->get('translator')->trans('modificationrefuse.collectivite.flash'));
                $Service_contact->valideOuRefusBilanSocial($collectivite, 'REFUSMODIF');
                $jsonContent = 'success';
            } else {
                $this->addFlash('notice', $this->get('translator')->trans('erreur.collectivite.flash'));
                $jsonContent = 'fail';
            }
        } catch (Exception $ex) {
            $this->addFlash('notice', $this->get('translator')->trans('erreur.collectivite.flash'));
            $jsonContent = 'fail';
        }

        $response = new Response();
        $response->setContent($jsonContent);

        return $response;
    }

    public function modificationMasseImportAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {
            //$idCdg = $current_user->getCdg()->getIdCdg();
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteByUtilisateur($current_user);
        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->findAll();
        }

        $siretImportArr = [];
        $siretErrors = [];
        $siretColl = [];

        $form = $this->createFormBuilder()->add('importCollectivite', FileType::class, array(
                    'label' => 'Choisissez un fichier',
                    'label_attr' => array(
                        'class' => 'btn btn-default btn-file',
                    ),
                    'attr' => array(
                        'style' => 'display:none;'
                    ),
                ))->getForm();
        $form->handleRequest($request);

        foreach ($collectivites as $coll) {
            if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {
                $siretColl[] = $coll['nmSire'];
            } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                $siretColl[] = $coll->getNmSire();
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['importCollectivite']->getData();
            if ('csv' == $file->getClientOriginalExtension()) {
                $pathname = $file->getPathName();

                if (($handle = fopen($pathname, "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $num = count($data);
                        for ($c = 0; $c < $num; $c++) {
                            if(!in_array($data[$c], $siretImportArr)){
                                if (in_array($data[$c], $siretColl)) {
                                    $siretImportArr[] = $data[$c];
                                } else {
                                    $siretErrors[] = $data[$c];
                                }
                            }
                        }
                    }
                    fclose($handle);
                    $this->addFlash('notice', $this->get('translator')->trans('importmassesuccess.collectivite.flash'));
                }
            } else {
                $this->addFlash('error', $this->get('translator')->trans('erreurtypefichier.collectivite.flash'));
            }
        }
         $form_filtre = $this->createForm(ParametrageEnqueteForm::class);
        return $this->render('@Collectivite/Collectivite/modiMasseLayout.html.twig', array('form' => $form->createView(), 'form_filtre' => $form_filtre->createView(),  'siretImp' => $siretImportArr, 'siretErrors' => $siretErrors, 'collectivites' => $collectivites));
    }

    public function modificationMasseAction(Request $request) {
        $infos_collectivites = $request->get('checked');

        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
              $blCollDgcl = $request->get('blCollDgcl');
        }
        $query = '';
        $array_param = [];
        foreach ($infos_collectivites as $key => $collectivite) {
            $collectivite['blCtCdg'] == true ? $collectivite['blCtCdg'] = 1 : $collectivite['blCtCdg'] = 0;
            $collectivite['blAffiColl'] == true ? $collectivite['blAffiColl'] = 1 : $collectivite['blAffiColl'] = 0;
            $collectivite['blSurclasDemo'] == true ? $collectivite['blSurclasDemo'] = 1 : $collectivite['blSurclasDemo'] = 0;
            $collectivite['blChsct'] == true ? $collectivite['blChsct'] = 1 : $collectivite['blChsct'] = 0;
            $collectivite['blCtCdg'] == true ? $collectivite['blCtCdg'] = 1 : $collectivite['blCtCdg'] = 0;


            $query .= 'UPDATE collectivite SET ';

            if($collectivite['blAffiColl'] == null){
                $collectivite['blAffiColl'] = 0;
            }
            if($collectivite['blSurclasDemo'] == null){
                $collectivite['blSurclasDemo'] = 0;
            }
            if($collectivite['nmStratColl'] == null){
                $collectivite['nmStratColl'] = NULL;
            }
            if($collectivite['blChsct'] == null){
                $collectivite['blChsct'] = 0;
            }
            if($collectivite['blCtCdg'] == null){
                $collectivite['blCtCdg'] = 0;
            }

            $query .= " BL_AFFI_COLL = :BL_AFFI_COLL_".$key.",";
            $query .= " BL_SURCLAS_DEMO = :BL_SURCLAS_DEMO_".$key.",";
            $query .= " NM_STRAT_COLL = :NM_STRAT_COLL_".$key.",";
            $query .= " BL_CT_CDG = :BL_CT_CDG_".$key.",";
            $query .= " BL_CHSCT = :BL_CHSCT_".$key.",";
            $query .= " NM_SIRE = :NM_SIRE_".$key;
            $query .= " WHERE ID_COLL = :ID_COLL_".$key.";";

            $array_param["BL_AFFI_COLL_".$key] = $collectivite['blAffiColl'];
            $array_param["BL_SURCLAS_DEMO_".$key] = $collectivite['blSurclasDemo'];
            $array_param["NM_STRAT_COLL_".$key] = $collectivite['nmStratColl'];
            $array_param["BL_CT_CDG_".$key] = $collectivite['blCtCdg'];
            $array_param["BL_CHSCT_".$key] = $collectivite['blChsct'];
            $array_param["NM_SIRE_".$key] = $collectivite['nmSire'];
            $array_param["ID_COLL_".$key] = $collectivite['idColl'];

        }

        try {
            $stmt = $em->getConnection()->prepare($query);
            $stmt->execute($array_param);

            $jsonContent = 'success';
            $this->addFlash('notice', $this->get('translator')->trans('modificationmasse.collectivite.flash'));
        } catch (Exception $ex) {
            $this->addFlash('notice', $this->get('translator')->trans('erreur.collectivite.flash'));
            $jsonContent = $ex;
        }

        $response = new Response();
        $response->setContent(json_encode($jsonContent));

        return $response;
    }

    public function ficheCollectiviteAction(Request $request, $id = null) {
        $em = $this->getDoctrine()->getManager();
        $encoder = $this->container->get('security.password_encoder');
        $current_user = $this->getUser();
        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneBy(array('utilisateur' => $current_user->getIdUtil()));
        $enquete = null;
        $historiqueBS = null;
        $historiqueEcha = null;
        $droitsCdg = null;
        $historiqueCollectivite = null;
        $historiqueColl = new HistoriqueCollectivite();
        $nmSiret = null;


        if (null == $id) {
            $collectivite = new Collectivite();
            $nmSiret = false;
        }
        else {
            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($id);
            $enquete = $this->getMonEnquete($collectivite);
            $historiqueBS = $em->getRepository('BilanSocialBundle:HistoriqueBilanSocial')->findBy(array('enquete' => $enquete, 'collectivite' => $collectivite),array('dtChgt' => 'asc'));
            $historiqueEcha = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->findBy(array('collectivite' => $collectivite), array('dtEcha' => 'DESC'));
            if(!$current_user->hasRole('ROLE_ADMIN')){
                 $droitsColl = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectivite($id,$utilCdg->getIdUtilisateurCdg());
                if(($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_COLLECTIVITE)){
                    $droitsCdg = 'read';
                }
                if(($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)){
                    $droitsCdg = 'write';
                }

                $nmSiret = true;
            }else{
                $droitsCdg = 'write';
                $nmSiret = false;
            }
            $historiqueCollectivite = $em->getRepository('CollectiviteBundle:HistoriqueCollectivite')->findOneBy(array('collectivite' => $collectivite), array('dtCrea' => 'DESC'),1);


        }

        $ancien_siret = $collectivite->getNmSire();
        $info_nouvelle_collectivite = null;
        if($current_user->hasRole('ROLE_ADMIN') || $current_user->hasRole('ROLE_CDG')){

            $info_nouvelle_collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->getCollHistoByNewSiret($ancien_siret);

        }
        $form = $this->createForm(CollectiviteType::class, $collectivite, array('nmSire' => $nmSiret));
        $form->add('cmInfoComp', TextareaType::class, array(
                    'attr' => array('class' => 'tinymce'),
                    'label' => 'Informations complémentaires',
                    'required' => false,
                ))

                ->add('blAffiColl', ChoiceType::class, array(
                    'label' => 'La collectivité est-elle affiliée au CDG ? *',
                    'choices' => array('Oui' => true, 'Non' => false),
                    'placeholder' => false,
                    'required' => false,
                    'expanded' => true,
                    'multiple' => false,
                ))
                ->add('blCollDgcl', ChoiceType::class, array(
                    'label' => 'La collectivité fait-elle partie de l’échantillon de la DGCL ? *',
                    'choices' => array('Oui' => true, 'Non' => false),
                    'placeholder' => false,
                    'required' => false,
                    'expanded' => true,
                    'multiple' => false,
                ))
                ->remove('blCtCdg')
               // ->remove('blChsct')
                ->add('blCtCdg', ChoiceType::class, array(
                    'label' => 'La collectivité est-elle rattachée au comité technique (CT) du CDG ? *',
                    'choices' => array('Oui' => true, 'Non' => false),
                    'placeholder' => false,
                    'required' => false,
                    'expanded' => true,
                    'multiple' => false,
                ))
                ->add('blChsct', ChoiceType::class, array(
                    'label' => 'La collectivité a-t-elle son propre CHSCT ? *',
                    'choices' => array('Oui' => true, 'Non' => false),
                    'placeholder' => false,
                    'required' => false,
                    'expanded' => true,
                    'multiple' => false,
                ))
                ->remove('soumettreValidation')
                ->remove('contacts')
                ->remove('cdg_is_authorized_by_collectivity')
                ->remove('nmLogeOphlmOdhlm');
        if($this->get('security.authorization_checker')->isGranted('ROLE_CDG')){
            $form->add('departement', EntityType::class, array(
                'class' => Departement::class,
                'choice_label' => 'lbDepa',
                'label' => 'Département *',
                'required' => false,
                'placeholder' => 'Choisissez un département',
                'query_builder' => function (EntityRepository $er) use ($utilCdg){
                    return $er->createQueryBuilder('d')
                            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'd.idDepa = cd.departement')
                            ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                            ->where('ud.utilisateurCdg = :utilisateurCdg')
                            ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit')
                            ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)
                            ->setParameter('utilisateurCdg',$utilCdg)
                            ->setParameter("droit", bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE))
                    ;
                },
            ));
        }elseif($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $form->add('departement', EntityType::class, array(
                'class' => Departement::class,
                'choice_label' => 'lbDepa',
                'label' => 'Département *',
                'required' => false,
                'placeholder' => 'Choisissez un département',
            ));
            //->add('blChsct');
        }
        if (null == $id) {
            $form->add('cmMoti', TextareaType::class, array(
                'attr' => array('class' => 'tinymce'),
                'label' => 'Motif de création',
                'data' => 'Non existant dans la base INSEE',
                'required' => false,
            ))
            ->remove('modifier');
        }else{
            $form->remove('creer');
        }
        if($droitsCdg == null || $droitsCdg == 'read'){
            $form->remove('modifier');
        }

        $formArchive = $this->createForm(HistoriqueCollectiviteType::class, $historiqueColl, array('blCrea'=>0));

        $form->handleRequest($request);
        $formArchive->handleRequest($request);
        $errors = null;
        if ($form->isSubmitted()) {

            if ($id != null) {
                if ($form->get('modifier')->isClicked()) {
                    $validator = $this->get('validator');
                    $errors = $validator->validate($collectivite, null, array('notNull'));
                }
            } else {
                if ($form->get('creer')->isClicked()) {
                    $validator = $this->get('validator');
                    $errors = $validator->validate($collectivite, null, array('notNull'));
                }
            }

            if ($form->isValid() && (count($errors) == 0 )) {
                if (null == $id) {
                    if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {
                        $collectivite->setBlActi(0);
                    } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                        $collectivite->setBlActi(1);
                    }
                    $collectivite->setCdgIsAuthorizedByCollectivity(0);
                        //if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {
                        // TODO: Attention, si par la suite un utilisateur peut sélectionner son CDG sur lequel il souhaite travailler alors il faudra le passer en paramètre
                        // Mais pour le moment nous considérons qu'un utilisateur n'aura qu'un seul CDG lié
                    if (!empty($form->get('departement')->getData())) {
                        $departement = $form->get('departement')->getData()->getIdDepa();
                        $cdgDepartement = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByContactCdgDepartementByUtilisateur($departement);
                        if (!empty($cdgDepartement)) {
                                $collectivite->setCdgDepartement($cdgDepartement);
                            }
                        //}
                    }
                    $collectivite->setCdUtilcrea($current_user->getUsername());
                    $collectivite->setDtCrea(new \DateTime());
                } else {
                    if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {
                        $departement = $form->get('departement')->getData()->getIdDepa();
                        $cdgDepartement = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByContactCdgDepartementByUtilisateur($departement);
                        if (!empty($cdgDepartement)) {
                            $collectivite->setCdgDepartement($cdgDepartement);
                        }
                    }
                    $collectivite->setCdUtilmodi($current_user->getUsername());
                    $collectivite->setDtModi(new \DateTime());
                }
                try{
                    $em->persist($collectivite);
                    $em->flush();

                    if($ancien_siret !== $collectivite->getNmSire()){
                        $user = $em->getRepository('UserBundle:User')->findOneByUsername($ancien_siret);
                        if($user !== null){
                            $user->setUsername($collectivite->getNmSire());
                            $em->flush();
                        }
                    }

                    if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') && null == $id) {
                        $id_camp = $currentCampagne!==null ? $currentCampagne->getIdCamp() : null;
                        $resEnq = $em->getRepository('EnqueteBundle:Enquete')->findEnqueteLanceeByDepartement($collectivite->getDepartement(), $id_camp);
                        $newUser = new User();
                        $newUser->setCollectivite($collectivite);
                        $newUser->setCreatedAt(new \DateTime());
                        $newUser->setIsActive(1);
                        $passTemp = $this->generatePassword();
                        $newUser->setLbPassTemp($passTemp);
                        $hashPasswordUser = $encoder->encodePassword($newUser, $passTemp);
                        $newUser->setPassword($hashPasswordUser);
                        $newUser->setRoles([User::ROLE_COLLECTIVITY]);
                        $newUser->setUsername($collectivite->getNmSire());
                        $newUser->setCdUtilcrea($current_user->getUsername());
                        $newUser->setFgStat(1);


                        if($resEnq !== null){
                            $enqueteCollectivite = new EnqueteCollectivite();
                            $enqueteCollectivite->setEnquete($resEnq);
                            $enqueteCollectivite->setCollectivite($collectivite);
                            $enqueteCollectivite->setBlApa(0);
                            $enqueteCollectivite->setBlBasecarr(0);
                            $enqueteCollectivite->setBlBilasoci(0);
                            $enqueteCollectivite->setBlBilasocivide(0);
                            $enqueteCollectivite->setBlCons(0);
                            $enqueteCollectivite->setBlDgcl(0);
                            $enqueteCollectivite->setBlGepe(0);
                            $enqueteCollectivite->setBlGpeecPlus(0);
                            $enqueteCollectivite->setBlHand(0);
                            $enqueteCollectivite->setBlN4ds(0);
                            $enqueteCollectivite->setBlRast(0);
                        }

                        try {
                            if($enqueteCollectivite !== null){
                                $em->persist($enqueteCollectivite);
                            }

                            $em->persist($newUser);
                            $em->flush();

                            $this->addFlash('notice', $this->get('translator')->trans('newcollectiviteadmin.collectivite.flash', array('login' => $newUser->getUsername(), 'psw' => $newUser->getLbPassTemp() )));
                            return $this->redirectToRoute('collectivite_fiche');
                        } catch (Exception $ex) {
                            echo $ex->getMessage();
                            $this->addFlash('error', $this->get('translator')->trans('erreur.collectivite.flash'));
                        }
                    } else {
                        if (null == $id) {
                            if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG'))
                            {
                                $this->addFlash('notice', $this->get('translator')->trans('demandedecreationenvoyecdg.collectivite.flash'));
                            }
                            elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
                            {
                                $this->addFlash('notice', $this->get('translator')->trans('newcollectiviteadmin.collectivite.flash',  array('login' => $newUser->getUsername(), 'psw' => $newUser->getLbPassTemp())));
                                return $this->redirectToRoute('collectivite_fiche');
                            }
                        }else {
                            $this->addFlash('notice', $this->get('translator')->trans('editfiche.collectivite.flash'));
                            return $this->redirectToRoute('collectivite_fiche', array('id' => $id));
                        }
                    }
                } catch (\Exception $e) {
                  $this->addFlash('error',$this->get('translator')->trans('erreur.collectivite.flash'));
                }
            } else {
                foreach($errors as $key => $error) {
                    $property = $error->getPropertyPath();
                    $messageTemplate = $error->getMessageTemplate();
                    $form->get($property)->addError(new FormError($this->get('translator')->trans($messageTemplate)));
                }
            }
        }

        if ($formArchive->isSubmitted() && $formArchive->isValid()) {
            $historiqueColl->setNmAnciSire($collectivite->getNmSire());
            $historiqueColl->setCollectivite($collectivite);
            $user = $em->getRepository('UserBundle:User')->findOneByCollectivite($collectivite);

            $type = $formArchive->getData()->getLbTypeArch();
            if($type == 'fusion'){
                $collectivite->setBlFusi(1);
                $collectivite->setDtFusi(new \DateTime());
            }elseif($type == 'dissolution'){
                $collectivite->setBlDiss(1);
                $collectivite->setDtDiss(new \DateTime());
            }elseif($type == 'absorption'){
                $collectivite->setBlAbso(1);
                $collectivite->setDtAbso(new \DateTime());
            }

            $collectivite->setBlActi(0);
            $user->setIsActive(0);

            $em->getConnection()->beginTransaction();
            try{
                $em->persist($historiqueColl);
                $em->persist($collectivite);
                $em->persist($user);
                $em->flush();

                $em->getConnection()->commit();
                $this->addFlash('notice',$this->get('translator')->trans('fiche.collectivite.archive.flash'));
            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('notice',$this->get('translator')->trans('erreur.collectivite.flash'));
            }

        }

        return $this->render('@Collectivite/Collectivite/fiche.html.twig', array('form' => $form->createView(), 'errors' => $errors, 'historiqueBs' => $historiqueBS, 'historiqueEcha' => $historiqueEcha, 'droitsCdg' => $droitsCdg, 'formArchive' => $formArchive->createView(), 'historiqueCollectivite' => $historiqueCollectivite, "infoCollectivite" => $info_nouvelle_collectivite, "collectivite" => $collectivite));
    }

    public function listeDemandeCreationCollectiviteAction() {
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->findByBlActi(0);

        return $this->render('@Collectivite/Collectivite/listeDemandeCreation.html.twig', array('collectivites' => $collectivites));
    }

    public function validerDemandeCreationCollectiviteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $resColl = $em->getRepository('CollectiviteBundle:Collectivite')->findOneBy(array('idColl' => $id, 'blActi' => 0));

        $nmSiret = false;
        if (!empty($resColl) && isset($resColl)){
            $collectivite = $resColl;
            $form = $this->createForm(CollectiviteType::class, $collectivite, array('nmSire' => $nmSiret));
            $form->remove('contacts');
            $form->remove('nmLogeOphlmOdhlm');
            $form->remove('modifier');
            $form->remove('creer');
            $form->remove('soumettreValidation');
            $form->remove('cdg_is_authorized_by_collectivity');
            $form->add('cmInfoComp', TextareaType::class, array(
                    'attr' => array('class' => 'tinymce'),
                    'label' => 'Informations complémentaires',
                    'required' => false,
                ))
                ->add('cmMoti', TextareaType::class, array(
                'attr' => array('class' => 'tinymce'),
                'label' => 'Motif de création',
                'data' => 'Non existant dans la base INSEE',
                'required' => false,
            ));
        }else{
            return $this->render('@Collectivite/Collectivite/validerCreation.html.twig');
        }

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->getConnection()->beginTransaction();
            $enqueteCollectivite = null;
            $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
            if($currentCampagne!=null){
                $resEnq = $em->getRepository('EnqueteBundle:Enquete')->findEnqueteLanceeByDepartement($resColl->getDepartement(), $currentCampagne->getIdCamp());

                /*Set une enquete collectivite a la collectivite nouvellement créee*/
                if($resEnq !== null){
                    $enq = isset($resEnq[0]) ? $resEnq[0] : null;
                    $enqueteCollectivite = new EnqueteCollectivite();
                    $enqueteCollectivite->setEnquete($enq);
                    $enqueteCollectivite->setCollectivite($collectivite);
                    $enqueteCollectivite->setBlApa(0);
                    $enqueteCollectivite->setBlBasecarr(0);
                    $enqueteCollectivite->setBlBilasoci(0);
                    $enqueteCollectivite->setBlBilasocivide(0);
                    $enqueteCollectivite->setBlCons(0);
                    $enqueteCollectivite->setBlDgcl(0);
                    $enqueteCollectivite->setBlGepe(0);
                    $enqueteCollectivite->setBlGpeecPlus(0);
                    $enqueteCollectivite->setBlHand(0);
                    $enqueteCollectivite->setBlN4ds(0);
                    $enqueteCollectivite->setBlRast(0);

                }
            }
            try{

                if($enqueteCollectivite !== null){
                    $em->persist($enqueteCollectivite);
                }
                $em->persist($collectivite);
                $em->flush();

                $em->getConnection()->commit();
                return $this->validerCreationCollectiviteAction($collectivite->getIdColl());
            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('notice',$this->get('translator')->trans('erreur.collectivite.flash'));
            }
        }

        return $this->render('@Collectivite/Collectivite/validerCreation.html.twig', array('collectivite' => $collectivite, 'form' => $form->createView()));
    }

    public function validerCreationCollectiviteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $encoder = $this->container->get('security.password_encoder');
        //$idColl = $request->get('collectivite');
        $current_user = $this->getUser();

        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($id);
        $collectivite->setBlActi(1);

        try {
            $em->persist($collectivite);
            $em->flush();

            //TODO : créer utilisateur
            $newUser = $em->getRepository('UserBundle:User')->findOneByUsername($collectivite->getNmSire());
            $newUser = $newUser==null ? new User() : $newUser;
            $newUser->setCollectivite($collectivite);
            $newUser->setCreatedAt(new \DateTime());
            $newUser->setIsActive(1);
            $passTemp = $this->generatePassword();
            $newUser->setLbPassTemp($passTemp);
            $hashPasswordUser = $encoder->encodePassword($newUser, $passTemp);
            $newUser->setPassword($hashPasswordUser);
            $newUser->setRoles([User::ROLE_COLLECTIVITY]);
            $newUser->setUsername($collectivite->getNmSire());
            $newUser->setCdUtilcrea($current_user->getUsername());
            $newUser->setFgStat(1);
            try {
                $em->persist($newUser);
                $em->flush();
                $this->addFlash('notice', $this->get('translator')->trans('creationaccepte.collectivite.flash'));
                return $this->redirectToRoute('collectivite_liste_demande_creation');
            } catch (Exception $ex) {
                $this->addFlash('notice',$this->get('translator')->trans('erreur.collectivite.flash'));
                return $this->redirectToRoute('collectivite_valider_demande_creation', array('id' => $id));
            }
        } catch (Exception $ex) {
            $this->addFlash('notice',$this->get('translator')->trans('erreur.collectivite.flash'));
            return $this->redirectToRoute('collectivite_valider_demande_creation', array('id' => $id));
        }
    }

    public function refuserCreationCollectiviteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $idColl = $request->get('collectivite');

        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);

        try {
            $em->remove($collectivite);
            $em->flush();

            $jsonContent = 'success';
            $this->addFlash('notice', $this->get('translator')->trans('creationrefuse.collectivite.flash'));
        } catch (Exception $ex) {
           $jsonContent = 'fail';
            $this->addFlash('notice', $this->get('translator')->trans('erreur.collectivite.flash'));
        };

        $response = new Response();
        $response->setContent($jsonContent);

        return $response;
    }

    public function exporterCollectiviteAction(Request $request) {
        set_time_limit(0);
        $em = $this->getDoctrine()->getManager();
        $collectivites = $request->get('collectivite');
        $columns = $request->get('columns');
        $data_explode =  explode (',' , $collectivites);

        $data_columns =  explode (',' , $columns);
        $array_fields = array();
        $array_name_columns = array();
            if (!empty($data_explode) && !empty($data_columns)) {

                foreach ($data_columns as $c) {

                        switch ($c) {
                            case 'blTypeColl':
                                array_push($array_fields ,  ' rtc.lbTypeColl ');
                                array_push($array_name_columns ,  ' Type de collectivite ');

                                break;
                            case 'blLibe':
                                array_push($array_fields ,  ' c.lbColl ');
                                array_push($array_name_columns ,  ' Libellé ');
                                break;
                            case 'blSire':
                                break;
                            case 'blAffiCdg':
                                break;
                            case 'blDepa':
                                break;
                            case 'blCdPost':
                                break;
                            case 'blLbVill':
                                break;
                            case 'blCdInse':
                                break;
                            case 'blNmPopuInse':
                                break;
                            case 'blSurclasDemo':
                                break;
                            case 'blNmStratColl':
                                break;
                            case 'blCtCdg':
                                break;
                            case 'blChsct':
                                break;
                            case 'blCollDgcl':
                                break;
                            case 'blCdgColl':
                                break;
                            case 'blLbAdresse':
                                break;
                        }
                    }

                $conn = $this->container->get('database_connection');
                $query_sql_without_parameters = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteInfoForCsv($data_explode,$array_fields);
                $sql_with_parameters = str_replace(array('?'), $data_explode, $query_sql_without_parameters);
                $results = $conn->query($sql_with_parameters);
        }
           $response = new Response();
           $handle = fopen('php://output', 'w+');
           ob_start();
           fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
           fputcsv($handle, $array_name_columns, ';');


            //Champs
            $tab = array();
            while ($row = $results->fetchAll()) {

                foreach ($row as $key => $value) {
                    array_push($tab, $value);
                }
            }

            fputcsv($handle, $tab, ';');

            fclose($handle);
            $content = ob_get_clean();
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="test.csv"');
            $response->setContent($content);
            return $response;
    }

    public function setParametrageAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        $colonnes = $request->get('colonnes');
        $filters = $request->get('filtres');
        $lbPara = $request->get('lbPara');
        $value = $request->get('value');
        $para = new ParametrageAffichageCollectivite();

        //check si nom param n'existe pas déjà
        $parametre = $em->getRepository('CollectiviteBundle:ParametrageAffichageCollectivite')->findOneBy(array('lbPara' => $lbPara, 'utilisateur' => $current_user));

        if(NULL == $parametre){
            if (NULL != $colonnes) {
                foreach ($colonnes as $colonne) {
                    //$colonne = str_replace(" ", "", ucwords(strtolower(str_replace("_", " ", $colonne))));
                    $method = 'set' . ucfirst($colonne);
                    if (method_exists($para, $method)) {
                        $para->{$method}(1);
                    }
                }
            }

            if (NULL != $filters) {
                $para->setFiltres($filters);
            }

            $para->setUtilisateur($current_user);
            $para->setLbPara($lbPara);
            try {
                $em->persist($para);
                $em->flush();

                $jsonContent = json_encode(array($para->getIdParaAffiColl(), $lbPara));
            } catch (Exception $ex) {
                $jsonContent = 'error';
            }
        }else{
            $jsonContent = 'exist';
        }
        $response = new Response();
        $response->setContent($jsonContent);

        return $response;
    }

    public function getParametrageAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $this->saveAndUnlockSession($request);
        $resColonnes = $em->getRepository('CollectiviteBundle:ParametrageAffichageCollectivite')->getColonnes($id);
        $resFiltres = $em->getRepository('CollectiviteBundle:ParametrageAffichageCollectivite')->getFiltres($id);
        $response = new Response();

        $resPara = [];

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        if (!empty($resColonnes)) {
            foreach ($resColonnes[0] as $k => $v) {
                $resPara[$k] = $v;
            }
        }

        $resPara = array_merge($resPara, $resFiltres);

        if (!empty($resPara)) {
            $jsonContent = $serializer->serialize($resPara, 'json');
            $response->setContent($jsonContent);
        } else {
            $response->setContent('empty');
        }
        return $response;
    }

    public function removeParametrageAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $jsonContent = 'fail';

        $resPara = $em->getRepository('CollectiviteBundle:ParametrageAffichageCollectivite')->find($id);

        if (!empty($resPara)) {
            $em->remove($resPara);
            $em->flush();

            $jsonContent = 'done';
        }

        $response = new Response();
        $response->setContent($jsonContent);

        return $response;
    }

    public function rechercheAction() {
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        $formCol = $this->createForm(ParametrageEnqueteForm::class);
        $params = $em->getRepository('CollectiviteBundle:ParametrageAffichageCollectivite')->findByUtilisateur($current_user);

        return $this->render('@Collectivite/Collectivite/recherche.html.twig', array(/*'collectivites' => $collectivites,*/ 'formCol' => $formCol->createView(), 'params' => $params/*,'effectifsArr' => $effectifsArr*/));
    }

    protected function nouveauMdp($coll) {
        $em = $this->getDoctrine()->getManager();
        $encoder = $this->container->get('security.password_encoder');
        foreach ($coll as $idColl) {
            $mdp = $this->generatePassword();
            $results = $em->getRepository('UserBundle:User')->findByCollectivite($idColl);
            $util = $results[0];
            $hashPasswordUser = $encoder->encodePassword($util, $mdp);
            $util->setPassword($hashPasswordUser);
            $util->setLbPassTemp($mdp);
            if($util->getFgStat() != 1){
                $util->setFgStat(2);
            }
            $em->persist($util);
            $em->flush();
        }
    }

    protected function generatePassword($size = 8) {
        $c = 1; // nombre de lettre capitale
        $n = 1; // nombre de chiffre
        $s = 1; // nombre de caractères spéciaux
        $l = $size - $c - $n - $s;

        $passwd = strtolower(md5(uniqid(rand())));
        $passwd = substr($passwd, 2, $l);

        // liste des valeurs possibles pour chaque type de caractères
        $chars = "abcdefghijklmnopqrstuvwxyz";
        $caps = strtoupper($chars);
        $nums = "0123456789";
        $syms = "!@#$%^&*()-+?";

        $passwd .= self::select($caps, $c); // sélectionne aléatoirement les lettres majuscules
        $passwd .= self::select($nums, $n); // sélectionne aléatoirement les chiffres
        $passwd .= self::select($syms, $s); // sélectionne aléatoirement les caractères spéciaux
        $passwd = strtr(
                $passwd, 'o0ODQGCiIl15Ss7', 'BEFHJKMNPRTUVWX'
        );
        $passwd = str_shuffle($passwd);
        return $passwd;
    }

    private static function select($src, $l) {
        for ($i = 0; $i < $l; $i++) {
            $passwd = substr($src, mt_rand(0, strlen($src) - 1), 1);
        }
        return $passwd;
    }

    public function CollectiviteBloqueAction($response = null) {
        if(!empty($response)){
            $response->send();
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneBy(array('utilisateur' => $user->getIdUtil()));
        $droitsCdg = [];
        if($this->get('security.authorization_checker')->isGranted('ROLE_CDG')){
            $results = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteBloqueByCdg($user);
            foreach($results as $coll){
                $id = $coll->getCollectivite()->getIdColl();
                $droitsColl = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectivite($id,$utilCdg->getIdUtilisateurCdg());
                if(($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_COLLECTIVITE)){
                    $droitsCdg[$id] = 'read';
                }
                if(($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)){
                    $droitsCdg[$id] = 'write';
                }
            }
        }elseif($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $results = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteBloque();
            foreach($results as $coll){
                $id = $coll->getCollectivite()->getIdColl();
                $droitsCdg[$id] = 'write';
            }
        }



        return $this->render('@Collectivite/Collectivite/collectiviteBloque.html.twig', array('collectivite' => $results, 'droitsCdg' => $droitsCdg));
    }

    public function UnlockAccountAction(Request $request, $idUtil) {
        if($this->checkIsUserUtilisateurOwner($idUtil)){
            $em = $this->getDoctrine()->getManager();
            $encoder = $this->container->get('security.password_encoder');
            $user = $em->getRepository('UserBundle:user')->findOneByIdUtil($idUtil);

            $user->setIsActive(1);
            $passTemp = $this->generatePassword();

            $hashPasswordUser = $encoder->encodePassword($user, $passTemp);
            $user->setPassword($hashPasswordUser);

            $user->setFgBlocage(0);
            $user->setDtBlocage(null);
            $user->setNmErreConn(0);
            $user->setLbPassTemp($passTemp);
            if($user->getFgStat() != 1){
                $user->setFgStat(2);
            }
            try {
                $em->persist($user);
                $em->flush();
                $response = new Response();
                $handle = fopen('php://output', 'w+');
                fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
                // Nom des colonnes du CSV
                fputcsv($handle, array('Raison sociale','Collectivité', 'Mot de passe temporaire'), ';');
                fputcsv($handle, array($user->getCollectivite()->getLbColl(),$user->getUsername(), $passTemp ), ';');
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
                $response->headers->set('Content-Disposition', 'attachment; filename=MotDePasseTemporaire.csv');
                setcookie("downloadMdp", true, time()+5, '/', $request->getHost());
                return $response->send();

            } catch (\Exception $ex) {
               return $ex;
            }
        }else{
            return $this->redirectToRoute('collectivite_bloque');
        }
    }

    public function formulaireHistoriqueEchangeAjaxAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $this->saveAndUnlockSession($request);
        if($id == ''){
            $echange = new HistoriqueEchange();
        }else{
            $echange = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->findOneBy(array('idHistEcha' => $id));
        }

        $form = $this->createForm(HistoriqueEchangeType::class, $echange, array('action' => $this->generateUrl('submit_echange')));

        $template = $this->renderView('@Collectivite/Collectivite/modalEchange.html.twig', array('formEchange' => $form->createView()));
        return new JsonResponse($template);
    }

    public function submitEchangeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $idColl = $request->get('collectivite');
        $lbIntiEcha = $request->get('lbIntiEcha');
        $lbTypeEcha = $request->get('lbTypeEcha');
        $cmEcha = $request->get('cmEcha');
        $idHistEcha = $request->get('idHistEcha');

        $dtEcha = $request->get('dtEcha');
        if ($dtEcha) {
            list($day, $month, $year) = explode('/', $dtEcha);
        }
        $date = new \DateTime();
        if ($dtEcha) {
            $date->setDate($year, $month, $day);
        }

        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByIdColl($idColl);
        if($idHistEcha == ''){
            $echange = new HistoriqueEchange();
        }else{
            $echange = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->find($idHistEcha);
        }

        $em->getConnection()->beginTransaction();
        try{
            $echange->setLbTypeEcha($lbTypeEcha);
            $echange->setLbIntiEcha($lbIntiEcha);
            $echange->setCmEcha($cmEcha);
            $echange->setDtEcha($date);
            $echange->setCollectivite($collectivite);

            $em->persist($echange);
            $em->flush();

            $em->getConnection()->commit();
            $enregistrement = 'ok';
        } catch (Exception $ex) {
            $em->getConnection()->rollBack();
            $enregistrement = 'nok';
        }

        return  new JsonResponse($enregistrement);
    }


    public function supprimerEchangeAjaxAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $echange = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->findOneBy(array('idHistEcha' => $id));

        $em->getConnection()->beginTransaction();
        try{
            $em->remove($echange);
            $em->flush();

            $em->getConnection()->commit();
            $suppression = 'ok';
        } catch (Exception $ex) {
            $em->getConnection()->rollBack();
            $suppression = 'nok';
        }

        return  new JsonResponse($suppression);

    }


    public function reloadTableauEchangeAjaxAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $id = $request->get('collectivite');
        $this->saveAndUnlockSession($request);
        $droitsCdg = null;
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneBy(array('utilisateur' => $current_user->getIdUtil()));
        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($id);
        $droitsColl = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectivite($id,$utilCdg->getIdUtilisateurCdg());
        if(($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_COLLECTIVITE)){
            $droitsCdg = 'read';
        }
        if(($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)){
            $droitsCdg = 'write';
        }

        $historiqueEcha = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->findBy(array('collectivite' => $collectivite), array('dtEcha' => 'DESC'));
        $template = $this->renderView('@Collectivite/Collectivite/tableauEchange.html.twig', array('historiqueEcha' => $historiqueEcha, 'droitsCdg' => $droitsCdg));
        return new JsonResponse($template);
    }

    public function historiqueEchangesAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $historique = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->findBy(array('collectivite' => $user->getCollectivite()), array('dtEcha' => 'DESC'));

        return $this->render('@Collectivite/Collectivite/historiqueEchange.html.twig', array('historiqueEcha' => $historique));
    }

    public function getCdgAjaxAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $departement = $request->get('depa');
        $this->saveAndUnlockSession($request);
        $cdg = [];

        $results = $em->getRepository('CollectiviteBundle:CdgDepartement')->findOneBy(array('departement' => $departement));
        if($results != null){
            $cdg[$results->getCdg()->getIdCdg()] = $results->getCdg()->getLbCdg();
            return new JsonResponse($cdg);
        }else{
            $cdg = null;
            return new Response($cdg);
        }
    }

    public function indexModificationsAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteModifieesByCdg($user);
            if (empty($collectivites) || null == $collectivites) {
                return $this->render('@Collectivite/Collectivite/indexModifications.html.twig', array('collectivitesModif' => null));
            }
        }elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getAllCollectivitesModifiees();
        }
        return $this->render('@Collectivite/Collectivite/indexModifications.html.twig', array('collectivitesModif' => $collectivites));
    }

    public function gestionCollectiviteAction(Request $request){

        $filtres = $request->get('filtres');

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $this->saveAndUnlockSession($request);
        $collectivites = null;
        $current_user = $this->getUser();



        if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {
            $user_cdg = $em->getRepository('UserBundle:UtilisateurCdg')->findByUtilisateur($current_user);
            $camp = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();

            $UtilisateurDroits = $em->getRepository('UserBundle:UtilisateurDroits')->getDroitByCdg($user_cdg);
            $idCdgDepartement = "";
            foreach ($UtilisateurDroits as $key => $value) {
                $idCdgDepartement .= $value->getCdgDepartement()->getIdCdgDepartement();
                if ($value !== end($UtilisateurDroits)) {
                    $idCdgDepartement .= ',';
                }
            }

            $enquetes = $em->getRepository('EnqueteBundle:Enquete')->findEnqueteLanceeByUtilisateurCDG($idCdgDepartement, $camp);

            $tab_id_enq = array();

            foreach ($enquetes as $enquete){
                array_push($tab_id_enq, $enquete->getIdEnqu());
            }



            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteFiltered($user,$tab_id_enq, $filtres);

        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getAllCollectivites($filtres);
        }
        if(count($collectivites)>0){
            $collectivites[0]['blGpeec'] = $current_user->getBlGpeec();
        }
        $result = array(
            'data'  => $collectivites,
        );

        return new JsonResponse($result);
    }

    public function getSurclassDemoByReftypecollAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $idTypeColl = $request->get('idTypeColl');

        if($idTypeColl !== null){
           $refTypeColl =  $em->getRepository('ReferencielBundle:RefTypeCollectivite')->findOneByIdTypeColl($idTypeColl);
           if($refTypeColl !== null){
               $refTypeSurClassDemo =  $em->getRepository('ReferencielBundle:RefTypeSurclassDemo')->findByCdTypeSurclassDemo($refTypeColl->getCdTypeColl());
           }
        }else{
            $idTypeColl = NULLLLLL;
        }
         $count = \count($refTypeSurClassDemo);

        $exist = false;
        if($count > 0){
            $exist = true;
        }

        $array_ref = array();
        foreach($refTypeSurClassDemo as $key => $value){
            $array_ref['list'][$value->getIdTypeSurclassDemo()] = $value->getStratSurclassDemo();
        }
        $array_ref['count'] = $exist;

        return new JsonResponse($array_ref);
    }


    public function getHistoriqueEchangeByCollectiviteAction($idColl){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneBy(array('utilisateur' => $user->getIdUtil()));
        $check = false;

        $historique = null;

        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectiviteByCdg($utilCdg,$idColl);
        if(!empty($collectivite)){
            $historique = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->findBy(array('collectivite' => $idColl), array('dtEcha' => 'DESC'));
            $check = true;
        }


        return $this->render('@Collectivite/Collectivite/historiqueEchange.html.twig', array('historiqueEcha' => $historique, 'check' => $check));

    }


    public function gestionCollectiviteHistorisationCreationAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $this->saveAndUnlockSession($request);
        $current_user = $this->getUser();
        $admin = 0;

        if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {

        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $admin = 1;
        }

        $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($current_user, 0, 'Création', $admin);

        $result = array(
            'data'  => $collectivites,
        );

        return new JsonResponse($result);
    }

    public function gestionCollectiviteHistorisationSuppresionAction(Request $request){
        $filtres = $request->get('filtres');
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $this->saveAndUnlockSession($request);
        $current_user = $this->getUser();

        $admin = 0;

        if ($this->get('security.authorization_checker')->isGranted('ROLE_CDG')) {

        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $admin = 1;
        }

        $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($current_user, 1, 'vide', $admin);

        $result = array(
            'data'  => $collectivites,
        );

        return new JsonResponse($result);
    }

    public function gestionCollectiviteHistorisationErreurAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $this->saveAndUnlockSession($request);

        $collectivites = null;
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationErreur();
        }

        $result = array(
            'data'  => $collectivites,
        );

        return new JsonResponse($result);
    }

    public function indexHistorisationCdgAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $formCol = $this->createForm(ParametrageEnqueteForm::class);

        $admin = 0;
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $admin = 1;
        }

        $collectivitesCreation_presentes = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($user, 0, 'Création', $admin);

       if(!empty($collectivitesCreation_presentes)){
           return $this->render('@Collectivite/Cdg/indexHistorisationSiretCreation.html.twig', array(
               'formCol' => $formCol->createView(),
               'params' => null,
           ));
       }else{
           return $this->render('@Collectivite/Cdg/indexHistorisationSiretSuppression.html.twig', array(
               'formCol' => $formCol->createView(),
               'params' => null,
           ));
       }


    }
}
