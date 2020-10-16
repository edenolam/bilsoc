<?php

namespace Bilan_Social\Bundle\CampagneBundle\Controller;

use Bilan_Social\Bundle\CampagneBundle\Entity\Campagne;
use Bilan_Social\Bundle\CampagneBundle\Entity\Relance;
use Bilan_Social\Bundle\CampagneBundle\Form\CampagneType;
use Bilan_Social\Bundle\CampagneBundle\Form\RelanceType;
use function Bilan_Social\Bundle\InfoCentreBundle\Controller\in_array_nested;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CampagneController  extends AbstractBSController
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $campagnes = $em->getRepository('CampagneBundle:Campagne')->findAll();
        $affiAjou = true;
        $array_enquetes_ouvertes = [];
        $array_enquetes_lancees = [];
        $array_enquetes_clotures = [];
        $array_enquetes_archivees = [];
        $current_campagne = $this->getMaCampagne();
        if($current_campagne !== null){
            $query = "CALL getResultSetEnquetesByFgStat(:campagne)";
            $idCamp = $current_campagne->getIdCamp();
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->bindParam(':campagne', $idCamp);
            $stmt->execute();
            $array_enquetes_lancees = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $stmt->getWrappedStatement()->nextRowset();
            $array_enquetes_clotures = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $stmt->getWrappedStatement()->nextRowset();
            $array_enquetes_archivees = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $stmt->getWrappedStatement()->nextRowset();
            $array_enquetes_ouvertes = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $stmt->closeCursor();



        }

        foreach ($campagnes as $campagne){
            $fgStat = $campagne->getFgStat();
            if("0" == $fgStat || "1" == $fgStat || "2" == $fgStat){
                $affiAjou = false;
                break;
            }
        }

        return $this->render('@Campagne/Campagne/index.html.twig',array('listeCampagnes' => $campagnes,'affiAjou' => $affiAjou,
            'enquetes_ouvertes' => count($array_enquetes_ouvertes),
            'enquetes_lancees' => count($array_enquetes_lancees),
            'enquetes_clotures' => count($array_enquetes_clotures),
            'enquetes_archivees' => count($array_enquetes_archivees)
        ));
    }

    public function createAction(Request $request){
        $session = $request->getSession();
        $current_user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if(null !== $request->get('id')){
            $action = 'Modifier';
            $id = $request->get('id');
            $result = $em->getRepository('CampagneBundle:Campagne')->findBy(array('idCamp' => $id));
            $campagne = $result[0];

            $flow = $this->get('campagne.form.flow.create'); // must match the flow's service id
            $flow->bind($campagne);

            $form = $flow->createForm();

            if($flow->isValid($form)){
                $flow->saveCurrentStepData($form);
                if($flow->nextStep()){
                    $form = $flow->createForm();
                }else{
                    /* Set the current datetime */
                    $campagne->setDtModi(new \DateTime());
                    /* Set the current id user */
                    $campagne->setCdUtilmodi($current_user->getIdUtil());
                    try{
                        $em->persist($campagne);
                        $em->flush();

                        $flow->reset();

                        $this->addFlash('notice', $this->get('translator')->trans('edit.campagne.flash'));

                        return $this->redirectToRoute('campagne_homepage');
                    }  catch (UniqueConstraintViolationException $e){
                        $this->addFlash('notice', $this->get('translator')->trans('existe.campagne.flash'));
                    }
                }
            }
        }else{
            $action = 'Ajouter';
            $campagnes = $em->getRepository('CampagneBundle:Campagne')->findAll();
            $affiAjou = true;
            foreach ($campagnes as $campagne){
                $fgStat = $campagne->getFgStat();
                if("1" == $fgStat){
                    $affiAjou = false;
                    break;
                }
            }
            $campagne = new Campagne();

            $flow = $this->get('campagne.form.flow.create'); // must match the flow's service id
            $flow->bind($campagne);

            $form = $flow->createForm();

            if($flow->isValid($form)){
                $flow->saveCurrentStepData($form);
                if($flow->nextStep()){
                    $form = $flow->createForm();
                }else{
                    if($affiAjou){
                        /* Set the current datetime */
                        $campagne->setDtCrea(new \DateTime());
                        /* Set the current id user */
                        $campagne->setCdUtilcrea($current_user->getIdUtil());
                        /* Set le statut à "initialisée" */
                        $campagne->setFgStat("0");

                        try{
                            $em->persist($campagne);
                            $em->flush();

                            $this->addFlash('notice', $this->get('translator')->trans('new.campagne.flash'));

                            return $this->redirectToRoute('campagne_homepage');
                        }  catch (UniqueConstraintViolationException $e){
                            $this->addFlash('notice', $this->get('translator')->trans('existe.campagne.flash'));
                        }
                    }
                }
            }
        }
        return $this->render('@Campagne/Campagne/createCampagne.html.twig', array('form' => $form->createView(),'action' => $action, 'flow' => $flow));
    }

    public function ajoutAction(Request $request)
    {
        $current_user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        if(null !== $request->get('id')){
            $id = $request->get('id');
            $result = $em->getRepository('CampagneBundle:Campagne')->findBy(array('idCamp' => $id));
            $campagne = $result[0];
            $form = $this->createForm(CampagneType::class, $campagne);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /* Set the current datetime */
                $campagne->setDtModi(new \DateTime());
                /* Set the current id user */
                $campagne->setCdUtilmodi($current_user->getIdUtil());

                try{
                    $em->persist($campagne);
                    $em->flush();

                    $this->addFlash('notice', $this->get('translator')->trans('edit.campagne.flash'));

                    return $this->redirectToRoute('campagne_homepage');
                }  catch (UniqueConstraintViolationException $e){
                    $this->addFlash('notice', $this->get('translator')->trans('existe.campagne.flash'));
                }
            }
            $action = "Modifier";
        }else{
            $campagnes = $em->getRepository('CampagneBundle:Campagne')->findAll();
            $affiAjou = true;
            foreach ($campagnes as $campagne){
                $fgStat = $campagne->getFgStat();
                if("1" == $fgStat){
                    $affiAjou = false;
                    break;
                }
            }
            $campagne = new Campagne();
            $form = $this->createForm(CampagneType::class, $campagne);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                if($affiAjou){
                    /* Set the current datetime */
                    $campagne->setDtCrea(new \DateTime());
                    /* Set the current id user */
                    $campagne->setCdUtilcrea($current_user->getIdUtil());
                    /* Set le statut à "initialisée" */
                    $campagne->setFgStat("0");

                    try{
                        $em->persist($campagne);
                        $em->flush();

                        $this->addFlash('notice', $this->get('translator')->trans('new.campagne.flash'));

                        return $this->redirectToRoute('campagne_homepage');
                    }  catch (UniqueConstraintViolationException $e){
                    $this->addFlash('notice', $this->get('translator')->trans('existe.campagne.flash'));
                }
                }else{
                    $this->addFlash('notice', $this->get('translator')->trans('dejaouverte.campagne.flash'));
                    return $this->redirectToRoute('campagne_homepage');
                }
            }
            $action = "Ajouter";
        }
        return $this->render('@Campagne/Campagne/ajout.html.twig', array('form' => $form->createView(),'action' => $action));
    }

    public function ouvrirAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $campagnes = $em->getRepository('CampagneBundle:Campagne')->findAll();
        $affiAjou = true;
        foreach ($campagnes as $campagne){
            $fgStat = $campagne->getFgStat();
            if("1" == $fgStat){
                $affiAjou = false;
                break;
            }
        }
        if($affiAjou){
            $campagne = $em->getRepository('CampagneBundle:Campagne')->findOneBy(array('idCamp' => $id));
            $enquetes = $em->getRepository('EnqueteBundle:Enquete')->findBy(array('idCamp' => $campagne));

            $campagne->setFgStat("1");
            $campagne->setDtClot(null);
            try{
                if($enquetes !== null){
                    foreach($enquetes as $enquete){
                        $enquete->setFgStat(2);
                        $em->persist($enquete);
                    }
                }
                $em->persist($campagne);
                $em->flush();
                $this->addFlash('notice', $this->get('translator')->trans('ouverture.campagne.flash'));
            } catch (Exception $ex) {
                $this->addFlash('notice', $this->get('translator')->trans('erreur.campagne.flash'));
            }
        }else{
            $this->addFlash('notice', $this->get('translator')->trans('existe.campagne.flash'));
        }
        return $this->redirectToRoute('campagne_homepage');
    }

    public function cloturerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $campagne = $em->getRepository('CampagneBundle:Campagne')->findOneBy(array('idCamp' => $id));
        $enquetes = $em->getRepository('EnqueteBundle:Enquete')->findBy(array('idCamp' => $campagne));
        $campagne->setFgStat("2");
        $campagne->setDtClot(new \DateTime());
        try{
            try{
                foreach($enquetes as $enquete){
                    $enquete->setFgStat(3);
                    $em->persist($enquete);
                }
            }catch(Exception $ex1){
                $this->addFlash('notice', $ex1->getMessage());
            }
            $this->saveDataAgentsAction();
            $em->persist($campagne);
            $em->flush();
            $this->addFlash('notice', $this->get('translator')->trans('cloture.campagne.flash'));
        } catch (Exception $ex) {
            $this->addFlash('notice', $this->get('translator')->trans('erreur.campagne.flash'));
        }
        return $this->redirectToRoute('campagne_homepage');
    }

    public function archiverAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('CampagneBundle:Campagne')->findBy(array('idCamp' => $id));
        $campagne = $result[0];
        $campagne->setFgStat("3");
        try{
            $em->persist($campagne);
            $em->flush();
            $this->addFlash('notice', $this->get('translator')->trans('archive.campagne.flash'));
        } catch (Exception $ex) {
            $this->addFlash('notice', $this->get('translator')->trans('erreur.campagne.flash'));
        }
        return $this->redirectToRoute('campagne_homepage');
    }

    public function suiviAction(){
        $em = $this->getDoctrine()->getManager();

        $query = "CALL getResultSetEnquetesByFgStat(:campagne)";
        $idCamp = $this->getMaCampagne()->getIdCamp();
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->bindParam(':campagne', $idCamp);
        $stmt->execute();
        $array_enquetes_lancees = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $stmt->getWrappedStatement()->nextRowset();
        $array_enquetes_clotures = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $stmt->getWrappedStatement()->nextRowset();
        $array_enquetes_archivees = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $stmt->getWrappedStatement()->nextRowset();
        $array_enquetes_ouvertes = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $stmt->getWrappedStatement()->nextRowset();
        $array_enquetes_non_crees = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $stmt->closeCursor();

        $relanceEntity = new Relance();
        $formRelance = $this->createForm(RelanceType::class, $relanceEntity);
        return $this->render('@Campagne/Campagne/suivi.html.twig',array(
                'enquetes_ouvertes' => $array_enquetes_ouvertes,
                'enquetes_lancees' => $array_enquetes_lancees,
                'enquetes_clotures' => $array_enquetes_clotures,
                'enquetes_archivees' => $array_enquetes_archivees,
                'enquetes_non_crees' => $array_enquetes_non_crees,
                'formRelance' => $formRelance->createView()

            )
        );
    }

    public function relancerAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $idCamp = $request->get('campagne');
        $idCdg = $request->get('idCdg');

        $message = $request->get('message');

        $result = $em->getRepository('CollectiviteBundle:CdgContact')->findBy(array('cdg' => $idCdg, 'blContactPrincipal' => true ));


        $campagne = $this->getMaCampagne();
        if($result != null){
            foreach ($result as $contact){
                $contact->getLbMail();
                $email = $contact->getLbMail();

                $relance = new Relance();
                $relance->setCampagne($campagne);
                $relance->setCdg($contact->getCdg());
            }
            try{
                if(null != $message){
                    $relance->setDtDernrela(new \DateTime());
                    $relance->setLbMessrela($message);
                    $msg = (new \Swift_Message('Bilan Social - Relance campagne'))
                            ->setFrom($this->getParameter('mailer_user'))
                            ->setTo($email)
                            ->setBody($message, 'text/html');
                    try {
                        $this->get('mailer')->send($msg);
                        $jsonContent = 'email_sent';
                    } catch (Exception $ex) {
                        $jsonContent = 'not_sent';
                    }

                    $em->persist($relance);
                    $em->flush();

                    $jsonContent = json_encode('done');
                    $this->addFlash('notice', $this->get('translator')->trans('mailrelance.campagne.flash'));
                }
            } catch (Exception $ex) {
                $jsonContent = json_encode($ex);
            }


        }else{
            $jsonContent = json_encode('no_contact');
        }
        $response = new Response();
        $response->setContent($jsonContent);

        return $response;
    }

    public function dashboardCampagneAction(){
        $em = $this->getDoctrine()->getManager();
        $departements = $em->getRepository('CollectiviteBundle:Departement')->findAll();
        $infosDepts = [];

        foreach ($departements as $dept){
            //todo : récup infos collectivite du dept
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getInfosCollectiviteByDepartement($dept);
            $infosDepts[$dept->getCdDepa()]['nbBsValide'] = 0;
            if(!empty($collectivites)){
                foreach ($collectivites as $coll){
                    if($coll['fgStat'] == 2){
                        $infosDepts[$dept->getCdDepa()]['nbBsValide']++;
                    }
                }
                $infosDepts[$dept->getCdDepa()]['nbColl'] =  count($collectivites);
            }else{
                $infosDepts[$dept->getCdDepa()]['nbColl'] =  0;
            }
        }

        return $this->render('@Campagne/Campagne/dashboard.html.twig', array('departements' => $departements, 'infosDepts' => $infosDepts));
    }

    public function GetCampagneCouranteAction() {
        $em = $this->getDoctrine()->getManager();
        $campagneCourante = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        $anneeCampagneCourante = "";
        if ($campagneCourante != null) {
            $anneeCampagneCourante = $campagneCourante->getNmAnne();
        }

        $annee_campagne = '{"annee_campagne" : '.$anneeCampagneCourante.'}';

        $response = new JsonResponse();
        $response->setContent($annee_campagne);
        return $response;
    }

    function saveDataAgentsAction() {
        $em = $this->getDoctrine()->getManager();
        $campagne = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();

        try {
            $queryCleanBSA = "CALL remove_old_bilan_social_agent (" . $campagne->getIdCamp() . ")";
            $queryExec1 = $em->getConnection()->prepare($queryCleanBSA);
            $queryExec1->execute();

            $queryCleanSaveTable = "CALL clean_data_agents_table ()";
            $queryExec2 = $em->getConnection()->prepare($queryCleanSaveTable);
            $queryExec2->execute();

            $query = "CALL save_data_agents_when_closing_campagne (" . $campagne->getIdCamp() . ")";
            $stmt = $em->getConnection()->prepare($query);
            $stmt->execute();
        }
        catch (Exception $ex) {
            return 'Exception reçue : ' . $ex->getMessage() . '\n';
        }
    }

}
