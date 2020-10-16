<?php

namespace Bilan_Social\Bundle\ConsoBundle\Controller;

use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\QuestionCollectiviteConsolideType;
use Symfony\Component\HttpFoundation\Response;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Bilan_Social\Bundle\ConsoBundle\Controller\BilanSocialConsolideController;
use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Doctrine\ORM\Query\ResultSetMapping;

class QuestionCollectiviteConsolideController extends BilanSocialConsolideController {

    public function GetQuestionCollectiviteConsolideAction(Request $request) {

        $user = $this->getUser();
        //$idColl = $user->getCollectivite()->getIdColl();
        $session = $this->get('session');
        if(null == $session->get('coll_id')){
            $idColl = $user->getCollectivite()->getIdColl();
            //$coll = $user->getCollectivite();
        }else{
            $idColl = $session->get('coll_id');
            //$coll = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByIdColl($idColl);
        }

        if ($idColl == null) {
            $this->addFlash(
                    'notice', $this->get('translator')->trans('nocollectiviteassocie.consolide.flash')
            );
            return $this->render('@Conso/QuestionCollectiviteConsolide/edit.html.twig', array('canwrite' => $this->isUserCanWrite()));
        }
        $campagne = $this->getMaCampagne();
        $bilanConso = '';
        $em = $this->getDoctrine()->getManager();
        $enquete = $this->getMonEnquete();
        if ($enquete == null) {
            $this->addFlash(
                    'notice', $this->get('translator')->trans('noenqueteactive.consolide.flash')
            );
            return $this->render('@Conso/QuestionCollectiviteConsolide/edit.html.twig', array('bilanConso' => $bilanConso, 'canwrite' => $this->isUserCanWrite()));
        }

        // Find Enquete active



        $idEnqu = $enquete->getIdEnqu();

        $cdUtil = $this->getUser()->getUsername();

        $initBilanSocial = $this->getEntityManager()->getRepository('BilanSocialBundle:InitBilanSocial')
                                ->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
        if (empty($initBilanSocial)) {
            $this->addFlash(
                    'notice', "Pas de saisie consolidé initialisée"
            );
            $redirectionConso = $this->redirectToRoute('bilan_social_homepage');
            return $redirectionConso;
        }

        $questionCollectiviteConsolide = $em->getRepository('ConsoBundle:QuestionCollectiviteConsolide')
                ->findOneByActif($idColl, $idEnqu);


        $exist = true;
        if ($questionCollectiviteConsolide == null) {
            $this->addFlash('notice', $this->get('translator')->trans('questionnaire.consolide.flash'));
            $questionCollectiviteConsolide = new QuestionCollectiviteConsolide();
            $questionCollectiviteConsolide->setEnquete($this->getMonEnquete());
            $questionCollectiviteConsolide->setCollectivite($this->getMaCollectivite());
            $exist = false;
        }

        $form = $this->createForm(QuestionCollectiviteConsolideType::class, $questionCollectiviteConsolide);

        $form->handleRequest($request);
        $now = new DateTime('NOW');
        if ($form->isSubmitted() && $form->isValid()) {
            $questionCollectiviteConsolide->setUpdatedAt($now);
            $questionCollectiviteConsolide->setCdUtilmodi($cdUtil);
            if (!$exist) {
                $questionCollectiviteConsolide->setCreatedAt($now);
                $questionCollectiviteConsolide->setCdUtilcrea($cdUtil);
                $em->persist($questionCollectiviteConsolide);
            }

            $em->flush();

            if ($this->getMonBilanSocialConsolide()->getIdBilaSociCons() != null) {
                $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
            }
            else {
                $bilanSocialConsolide = new BilanSocialConsolide;
                $bilanSocialConsolide->setEnquete($this->getMonEnquete());
                $bilanSocialConsolide->setFgStat(0);
                $bilanSocialConsolide->setCollectivite($this->getMaCollectivite());
                $bilanSocialConsolide->setQuestionCollectiviteConsolide($this->GetMonQuestionnaireAction());
                $em->persist($bilanSocialConsolide);
                $em->flush();
            }

            $idBilaSociCons = $bilanSocialConsolide->getIdBilasocicons();
            $blAffiColl = $this->getMaCollectivite()->getBlAffiColl();
            if ($blAffiColl == true) {
                $blAffiCollInt = 1;
            }
            elseif ($blAffiColl == false || $blAffiColl == null) {
                $blAffiCollInt = 0;
            }
            $this->logMessage('Update indicateurs by questionnaire : questionnaire -> '.json_encode($questionCollectiviteConsolide));
            if ($this->isZeroAction($form->getData()) == true) {
                // Toutes les questions sont à 0
                $this->setConsoToZeroAction($idBilaSociCons, $idEnqu, $blAffiCollInt);
                return $this->redirectToRoute('bilan_conso_edit');
            } else {
                if ($idBilaSociCons) {
                    $this->logMessage('Update indicateur descativé','warning');
                    // $this->updateIndicateurWithQuestionnaire($questionCollectiviteConsolide, $em);
                    $this->UpdateIncoherenceLog($bilanSocialConsolide, $questionCollectiviteConsolide);
                }
            }




            $this->addFlash(
                    'notice', $this->get('translator')->trans('questionnairemodifie.consolide.flash')
            );

            return $this->redirectToRoute('bilan_conso_edit');
        }
        $nombreQuestion = $this->getNumberQuestion();
        return $this->render('@Conso/QuestionCollectiviteConsolide/edit.html.twig', array('questionCollectiviteConsolide' => $questionCollectiviteConsolide, 'nombreQuestion' => $nombreQuestion,
                    'form' => $form->createView(), 'canwrite' => $this->isUserCanWrite(),'collectivite'=>$user->getCollectivite()
        ));
    }

    public function getQuestionCollectiviteToTwigAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        //$idColl = $user->getIdColl();
        $session = $this->get('session');
        if(null == $session->get('coll_id')){
            $idColl = $user->getCollectivite()->getIdColl();
        }else{
            $idColl = $session->get('coll_id');
        }
        $campagne = $this->getMaCampagne();
        $enquete = $this->getMonEnquete();
        $idEnqu = $enquete->getIdEnqu();



        $questionCollectiviteConsolide = $em->getRepository('ConsoBundle:QuestionCollectiviteConsolide')
                ->findOneByActif($idColl, $idEnqu);
        if (!empty($questionCollectiviteConsolide)) {
            $exist = 1;
        } else {
            $exist = 0;
        }
        return new Response($exist);
        ;
    }

    public function updateIndicateurWithQuestionnaire($questionnaireCollectiviteConsolide, $em){

        //$repo = $this->getEntityManager()->getRepository('ConsoBundle:BilanSocialConsolide');

        $collectivite = $this->getMaCollectivite();
        $bilanSocialConsolide = $this->getMonBilanSocialConsolide();
        $champToUpdate = '';

        if($questionnaireCollectiviteConsolide->getQ4() == false){

        $this->removeIndicateur($bilanSocialConsolide, 'ind121'); // effectif
        $this->removeIndicateur($bilanSocialConsolide, 'ind122'); // effectif
        $this->removeIndicateur($bilanSocialConsolide, 'ind123'); // effectif

        $champToUpdate .= ' BL_INCO_IND121 = 0, MOYENNE_IND121 = 0,BL_INCO_IND122 = 0, MOYENNE_IND122 = 0,BL_INCO_IND123 = 0, MOYENNE_IND123 = 0';
        }
        if($questionnaireCollectiviteConsolide->getQ5() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind2131'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2132'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2133'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind331'); // remuneration
            $this->removeIndicateur($bilanSocialConsolide, 'ind5121'); // formation
            $this->removeIndicateur($bilanSocialConsolide, 'ind5122'); // formation

            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND213 = 0, MOYENNE_IND213 = 0, BL_INCO_IND331 = 0, MOYENNE_IND331 = 0, BL_INCO_IND512 = 0, MOYENNE_IND512 = 0 ';

        }
        if($questionnaireCollectiviteConsolide->getQ3() == false || $questionnaireCollectiviteConsolide->getQ1() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind423'); // condition
            $this->removeIndicateur($bilanSocialConsolide, 'ind424'); // condition
            $this->removeIndicateur($bilanSocialConsolide, 'ind214'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind215'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind216'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind154'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind155'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind156'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind7141'); // droits
            $this->removeIndicateur($bilanSocialConsolide, 'ind7142'); // droits

            $this->removeIndicateur($bilanSocialConsolide, 'ind5111'); // formation
            $this->removeIndicateur($bilanSocialConsolide, 'ind5112'); // formation
            $this->removeIndicateur($bilanSocialConsolide, 'ind5113'); // formation
            $bilanSocialConsolide->setQS7141(null);
            $bilanSocialConsolide->setQS7142(null);
            $bilanSocialConsolide->setQP7143(null);
            $bilanSocialConsolide->setQP7144(null);
            $bilanSocialConsolide->setR71411HC(null);
            $bilanSocialConsolide->setR71412HC(null);
            $bilanSocialConsolide->setR71421HC(null);
            $bilanSocialConsolide->setR71422HC(null);

            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND714 = 0, MOYENNE_IND714 = 0, BL_INCO_IND156 = 0, MOYENNE_IND156 = 0, BL_INCO_IND155 = 0, MOYENNE_IND155 = 0, BL_INCO_IND154 = 0, MOYENNE_IND154 = 0, BL_INCO_IND214 = 0, MOYENNE_IND214 = 0, BL_INCO_IND215 = 0, MOYENNE_IND215 = 0, BL_INCO_IND216 = 0, MOYENNE_IND216 = 0, BL_INCO_IND424 = 0, MOYENNE_IND424 = 0, BL_INCO_IND423 = 0, MOYENNE_IND423 = 0, BL_INCO_IND5111 = 0, MOYENNE_IND5111 = 0,BL_INCO_IND5112 = 0, MOYENNE_IND5112 = 0, BL_INCO_IND5113 = 0, MOYENNE_IND5113 = 0, BL_INCO_IND514 = 0, MOYENNE_IND514 = 0 ';
        }
        if($questionnaireCollectiviteConsolide->getQ1() == false || $questionnaireCollectiviteConsolide->getQ3() == false || $questionnaireCollectiviteConsolide->getQ5() == false){

            $bilanSocialConsolide->setR4131(null);
            $bilanSocialConsolide->setR4141(null);
            $bilanSocialConsolide->setQ415(null);
            $bilanSocialConsolide->setQ4161(null);
            $bilanSocialConsolide->setQ4162(null);
            $bilanSocialConsolide->setQ4163(null);
            $bilanSocialConsolide->setQ417(null);
            $bilanSocialConsolide->setR3451(null);
            $bilanSocialConsolide->setR3452(null);
            $bilanSocialConsolide->setQ613(null);
            $bilanSocialConsolide->setQ7111(null);
            $bilanSocialConsolide->setQ7112(null);
            //$bilanSocialConsolide->setQ7121(null);
            $bilanSocialConsolide->setQ7122(null);
            $bilanSocialConsolide->setQ7131(null);
            $bilanSocialConsolide->setQ7132(null);
            $bilanSocialConsolide->setQ7133(null);
            $bilanSocialConsolide->setR7133(null);
            $this->removeIndicateur($bilanSocialConsolide, 'ind613'); // droits
            $this->removeIndicateur($bilanSocialConsolide, 'ind431'); // condition
            $this->removeIndicateur($bilanSocialConsolide, 'ind421'); // condition
            $this->removeIndicateur($bilanSocialConsolide, 'ind422'); // condition
            $this->removeIndicateur($bilanSocialConsolide, 'ind231'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind513'); // formation
            if(!empty($champToUpdate)){
                    $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND231 = 0, MOYENNE_IND231 = 0, BL_INCO_IND431 = 0, MOYENNE_IND431 = 0, BL_INCO_IND421 = 0, MOYENNE_IND421 = 0, BL_INCO_IND422 = 0, MOYENNE_IND422 = 0, BL_INCO_IND613 = 0, MOYENNE_IND613 = 0, BL_INCO_IND711 = 0, MOYENNE_IND711 = 0, BL_INCO_IND712 = 0, MOYENNE_IND712 = 0, BL_INCO_IND713 = 0, MOYENNE_IND713 = 0, BL_INCO_IND344 = 0, MOYENNE_IND344 = 0, BL_INCO_IND345 = 0, MOYENNE_IND345 = 0, BL_INCO_IND414 = 0, MOYENNE_IND414 = 0, BL_INCO_IND413 = 0, MOYENNE_IND413 =  0, BL_INCO_IND513 = 0, MOYENNE_IND513 =  0  ';

            if($collectivite->getRefTypeCollectivite()->getCdTypeColl() !== 'CDG' || ($collectivite->getBlAffiColl() == null || $collectivite->getBlAffiColl() == false )){
                $bilanSocialConsolide->setR6121(null);
                $bilanSocialConsolide->setR6122(null);
                $bilanSocialConsolide->setR6123(null);
                $bilanSocialConsolide->setR6124(null);
                $bilanSocialConsolide->setR6125(null);
                $bilanSocialConsolide->setR6126(null);
                if(!empty($champToUpdate)){
                    $champToUpdate .= ',';
                }
                $champToUpdate .= ' BL_INCO_IND612 = 0, MOYENNE_IND612 = 0 ';
            }
        }
        if($questionnaireCollectiviteConsolide->getQ3() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind2121'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2122'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2123'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind124'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind321'); // remuneration
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND212 = 0, MOYENNE_IND212 = 0, BL_INCO_IND124 = 0, MOYENNE_IND124 = 0, BL_INCO_IND321 = 0, MOYENNE_IND321 = 0 ';
        }
        if($questionnaireCollectiviteConsolide->getQ8() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind1101'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind1102'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind1103'); // effectif

            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND110 = 0, MOYENNE_IND110 = 0 ';

        }
        if($questionnaireCollectiviteConsolide->getQ1() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind2111'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2112'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2113'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind114'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind158'); // mouvement
            $this->removeIndicateur($bilanSocialConsolide, 'ind311'); // remuneration

            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND211 = 0, MOYENNE_IND211 = 0, BL_INCO_IND114 = 0, MOYENNE_IND114 = 0, BL_INCO_IND158 = 0, MOYENNE_IND158 = 0, BL_INCO_IND311 = 0, MOYENNE_IND311 = 0 ';
        }
        if($questionnaireCollectiviteConsolide->getQ4() == false || $questionnaireCollectiviteConsolide->getQ2() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind221'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind222'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2231'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2232'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind2233'); // temps de travail
            $this->removeIndicateur($bilanSocialConsolide, 'ind411'); // condition

            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND411 = 0, MOYENNE_IND411 = 0,BL_INCO_IND221 = 0, MOYENNE_IND221 = 0,BL_INCO_IND222 = 0, MOYENNE_IND222 = 0,BL_INCO_IND223 = 0, MOYENNE_IND223 = 0 ';
        }
        if($questionnaireCollectiviteConsolide->getQ2() == false || $questionnaireCollectiviteConsolide->getQ4() == false || $questionnaireCollectiviteConsolide->getQ6() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind161'); // mouvement
            $this->removeIndicateur($bilanSocialConsolide, 'ind1612'); // mouvement
            $this->removeIndicateur($bilanSocialConsolide, 'ind171'); // mouvement
            $this->removeIndicateur($bilanSocialConsolide, 'ind224'); // temps de travail
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND161 = 0, MOYENNE_IND161 = 0,BL_INCO_IND171 = 0, MOYENNE_IND171 = 0,BL_INCO_IND224 = 0, MOYENNE_IND224 = 0 ';
        }
        if($questionnaireCollectiviteConsolide->getQ2() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind111'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind112'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind113'); // effectif
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND111 = 0, MOYENNE_IND111 = 0,BL_INCO_IND112 = 0, MOYENNE_IND112 = 0,BL_INCO_IND113 = 0, MOYENNE_IND113 = 0 ';
        }
        if($questionnaireCollectiviteConsolide->getQ5() == false || $questionnaireCollectiviteConsolide->getQ6() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind1311'); // effectif
            $this->removeIndicateur($bilanSocialConsolide, 'ind1312'); // effectif
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND131 = 0, MOYENNE_IND131 = 0 ';
        }
        if($questionnaireCollectiviteConsolide->getQ9() == false || $questionnaireCollectiviteConsolide->getQ10() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind1501'); // mouvement
            $this->removeIndicateur($bilanSocialConsolide, 'ind1502'); // mouvement
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND150 = 0, MOYENNE_IND150 = 0 ';
        }
        if($questionnaireCollectiviteConsolide->getQ7() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind1511'); // mouvement
            $this->removeIndicateur($bilanSocialConsolide, 'ind1512'); // mouvement
            $this->removeIndicateur($bilanSocialConsolide, 'ind1513'); // mouvement
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND151 = 0, MOYENNE_IND151 = 0  ';
        }
        if($questionnaireCollectiviteConsolide->getQ12() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind152');  // mouvement
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND152 = 0, MOYENNE_IND152 = 0 ';

        }
        if($questionnaireCollectiviteConsolide->getQ13() == false){
            $this->removeIndicateur($bilanSocialConsolide, 'ind1531'); // mouvement
            $this->removeIndicateur($bilanSocialConsolide, 'ind1532'); // mouvement
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND1531 = 0, MOYENNE_IND1531 = 0, BL_INCO_IND1532 = 0, MOYENNE_IND1532 = 0  ';

        }
        if($collectivite->getBlAffiColl() == true){
             $bilanSocialConsolide->setR6111(null);
             $bilanSocialConsolide->setR6112(null);
             $bilanSocialConsolide->setR6117(null);
             $bilanSocialConsolide->setQ6113(null);
             $bilanSocialConsolide->setR6113(null);
             $bilanSocialConsolide->setQ6114(null);
             $bilanSocialConsolide->setR6114(null);
             $bilanSocialConsolide->setR6115(null);
             $bilanSocialConsolide->setR6116(null);
            if(!empty($champToUpdate)){
                $champToUpdate .= ',';
            }
            $champToUpdate .= ' BL_INCO_IND611 = 0, MOYENNE_IND611 = 0 ';

        }
        $em->flush();
        
        $this->updateIncoEtValuePb($champToUpdate, $bilanSocialConsolide);
    }
    /* methode pour supprimer les entites qui ne sont plus demander via le questionnaire collectivite pour le consolide */
    public function removeIndicateur($BilanSocialConsolide, $entity_name){
        $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
              'DELETE ConsoBundle:'. ucfirst($entity_name) .' ind
               WHERE ind.bilanSocialConsolide = :bilanConso')
            ->setParameter('bilanConso', $BilanSocialConsolide->getIdBilasocicons());

        try {
            $query->execute();
        } catch (NoResultException $e) {
            return $e;
        }
    }

    public function updateIncoEtValuePb($champToUpdate,$bilanSocialConsolide){
        $em = $this->getDoctrine()->getManager();

        if($champToUpdate !== ''){
                 $query = 'UPDATE bilan_social_consolide SET ' . $champToUpdate . ' WHERE ID_BILASOCICONS = ' . $bilanSocialConsolide->getIdBilasocicons();
            try {
                $stmt = $em->getConnection()->prepare($query);
                $stmt->execute();
            } catch (\Exception $e) {
                return $e;
            }
        }
    }

    public function setConsoToZeroAction($idBilaSociCons, $idEnqu, $blAffiColl) {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        $session = $this->get('session');
        if (null == $session->get('coll_id')) {
            $idColl = $user->getCollectivite()->getIdColl();
        }
        else {
            $idColl = $session->get('coll_id');
        }
        
        $query = "CALL conso_set0_every_fields (" . $idBilaSociCons . "," . $idEnqu . "," . $blAffiColl . "," . $idColl . ")";
        $stmt = $em->getConnection()->prepare($query);
        $stmt->execute();
        

        return $this->forward('ConsoBundle:BilanSocialConsolide:transmettre', array('request' => null, 'idBilaSociCons' => $idBilaSociCons));
    }

    public function isZeroAction($q) {
        $isZero = false;

        if ($q->getQ1() == false && $q->getQ2() == false && $q->getQ3() == false && $q->getQ4() == false && $q->getQ5() == false && $q->getQ6() == false && $q->getQ7() == false &&
                $q->getQ8() == false && $q->getQ9() == false && $q->getQ10() == false && $q->getQ11() == false && $q->getQ12() == false && $q->getQ13() == false && $q->getQ14() == false) {
            $isZero = true;
        }

        return $isZero;
    }
    
    public function checkBeforeRemoveIndicatorAction(Request $request){
        $bilan_social_consolide = $this->getMonBilanSocialConsolide();
        $arraytocheck_json = $request->get('arraytocheck');
        $array_to_check = json_decode($arraytocheck_json, true);
        $array_to_prevent = array();
        
        foreach($array_to_check as $key => $value){
            $indicateur_string = '';
            if($key == 'q1' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_423')){
                    $indicateur_string .= 'indicateur 4.2.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_424')){
                    $indicateur_string .= 'indicateur 4.2.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_214')){
                    $indicateur_string .=  'indicateur 2.1.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_215')){
                    $indicateur_string .=  'indicateur 2.1.5 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_216')){
                    $indicateur_string .=  'indicateur 2.1.6 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_154')){
                    $indicateur_string .=  'indicateur 1.5.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_155')){
                    $indicateur_string .=  'indicateur 1.5.5 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_156')){
                    $indicateur_string .=  'indicateur 1.5.6 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_7141')){
                    $indicateur_string .=  'indicateur 7.1.4.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_7142')){
                    $indicateur_string .=  'indicateur 7.1.4.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_5111')){
                    $indicateur_string .=  'indicateur 5.1.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_5112')){
                    $indicateur_string .=  'indicateur 5.1.1.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_5113')){
                    $indicateur_string .=  'indicateur 5.1.1.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_613')){
                    $indicateur_string .=  'indicateur 6.1.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_431')){
                    $indicateur_string .=  'indicateur 4.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_421')){
                    $indicateur_string .=  'indicateur 4.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_421')){
                    $indicateur_string .=  'indicateur 4.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_422')){
                    $indicateur_string .=  'indicateur 4.2.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_231')){
                    $indicateur_string .=  'indicateur 2.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2152')){
                    $indicateur_string .=  'indicateur 2.1.5.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2151')){
                    $indicateur_string .=  'indicateur 2.1.5.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_513')){
                    $indicateur_string .=  'indicateur 5.1.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_211_1')){
                    $indicateur_string .=  'indicateur 2.1.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_211_2')){
                    $indicateur_string .=  'indicateur 2.1.1.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_211_3')){
                    $indicateur_string .=  'indicateur 2.1.1.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_114')){
                    $indicateur_string .=  'indicateur 1.1.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_158')){
                    $indicateur_string .=  'indicateur 1.5.8 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_311')){
                    $indicateur_string .=  'indicateur 3.1.1 ;';
                }

            }
            if($key == 'q2' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_221')){
                    $indicateur_string .=  'indicateur 2.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_222')){
                    $indicateur_string .=  'indicateur 2.2.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2231')){
                    $indicateur_string .=  'indicateur 2.2.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2232')){
                    $indicateur_string .=  'indicateur 2.2.3.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2233')){
                    $indicateur_string .=  'indicateur 2.2.3.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_411')){
                    $indicateur_string .=  'indicateur 4.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_161')){
                    $indicateur_string .=  'indicateur 1.6.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_1612')){
                    $indicateur_string .=  'indicateur 1.6.1.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_171')){
                    $indicateur_string .=  'indicateur 1.7.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_224')){
                    $indicateur_string .=  'indicateur 2.2.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_111')){
                    $indicateur_string .=  'indicateur 1.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_112')){
                    $indicateur_string .=  'indicateur 1.1.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_113')){
                    $indicateur_string .=  'indicateur 1.1.3 ;';
                }
            }
            if($key == 'q3' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_423')){
                    $indicateur_string .=  'indicateur 4.2.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_424')){
                    $indicateur_string .=  'indicateur 4.2.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_214')){
                    $indicateur_string .=  'indicateur 2.1.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_215')){
                    $indicateur_string .=  'indicateur 2.1.5 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_216')){
                    $indicateur_string .=  'indicateur 2.1.6 ;';
                }
//                if($this->checkIndicateur($bilan_social_consolide, 'ind_154')){
//                    $indicateur_string .=  'indicateur 1.5.4 ;';
//                }
//                if($this->checkIndicateur($bilan_social_consolide, 'ind_155')){
//                    $indicateur_string .=  'indicateur 1.5.5 ;';
//                }
//                if($this->checkIndicateur($bilan_social_consolide, 'ind_156')){
//                    $indicateur_string .=  'indicateur 1.5.6 ;';
//                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_7141')){
                    $indicateur_string .=  'indicateur 7.1.4.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_7142')){
                    $indicateur_string .=  'indicateur 7.1.4.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_5111')){
                    $indicateur_string .=  'indicateur 5.1.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_5112')){
                    $indicateur_string .=  'indicateur 5.1.1.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_5113')){
                    $indicateur_string .=  'indicateur 5.1.1.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_613')){
                    $indicateur_string .=  'indicateur 6.1.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_431')){
                    $indicateur_string .=  'indicateur 4.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_421')){
                    $indicateur_string .=  'indicateur 4.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_422')){
                    $indicateur_string .=  'indicateur 4.2.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_231')){
                    $indicateur_string .=  'indicateur 2.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2152')){
                    $indicateur_string .=  'indicateur 2.1.5.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2151')){
                    $indicateur_string .=  'indicateur 2.1.5.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_513')){
                    $indicateur_string .=  'indicateur 5.1.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_212_1')){
                    $indicateur_string .=  'indicateur 2.1.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_212_2')){
                    $indicateur_string .=  'indicateur 2.1.2.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_212_3')){
                    $indicateur_string .=  'indicateur 2.1.2.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_124')){
                    $indicateur_string .=  'indicateur 1.2.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_321')){
                    $indicateur_string .=  'indicateur 3.2.1 ;';
                }
            }
            if($key == 'q4' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_121')){
                    $indicateur_string .=  'indicateur 1.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_122')){
                    $indicateur_string .=  'indicateur 1.2.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_123')){
                    $indicateur_string .=  'indicateur 1.2.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_221')){
                    $indicateur_string .=  'indicateur 2.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_222')){
                    $indicateur_string .=  'indicateur 2.2.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2231')){
                    $indicateur_string .=  'indicateur 2.2.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2232')){
                    $indicateur_string .=  'indicateur 2.2.3.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2233')){
                    $indicateur_string .=  'indicateur 2.2.3.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_411')){
                    $indicateur_string .=  'indicateur 4.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_161')){
                    $indicateur_string .=  'indicateur 1.6.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_1612')){
                    $indicateur_string .=  'indicateur 1.6.1.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_171')){
                    $indicateur_string .=  'indicateur 1.7.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_224')){
                    $indicateur_string .=  'indicateur 2.2.4 ;';
                }
            }
            if($key == 'q5' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_213_1')){
                    $indicateur_string .=  'indicateur 2.1.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_213_2')){
                    $indicateur_string .=  'indicateur 2.1.3.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_213_3')){
                    $indicateur_string .=  'indicateur 2.1.3.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_331')){
                    $indicateur_string .=  'indicateur 3.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_5121')){
                    $indicateur_string .=  'indicateur 5.1.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_5122')){
                    $indicateur_string .=  'indicateur 5.1.2.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_613')){
                    $indicateur_string .=  'indicateur 6.1.3 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_431')){
                    $indicateur_string .=  'indicateur 4.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_421')){
                    $indicateur_string .=  'indicateur 4.2.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_422')){
                    $indicateur_string .=  'indicateur 4.2.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_231')){
                    $indicateur_string .=  'indicateur 2.3.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2152')){
                    $indicateur_string .=  'indicateur 2.1.5.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_2151')){
                    $indicateur_string .=  'indicateur 2.1.5.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_513')){
                    $indicateur_string .=  'indicateur 513 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_1311')){
                    $indicateur_string .=  'indicateur 1.3.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_1312')){
                    $indicateur_string .=  'indicateur 1.3.1.2 ;';
                }
            }
            if($key == 'q6' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_161')){
                    $indicateur_string .=  'indicateur 1.6.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_1612')){
                    $indicateur_string .=  'indicateur 1.6.1.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_171')){
                    $indicateur_string .=  'indicateur 1.7.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_224')){
                    $indicateur_string .=  'indicateur 2.2.4 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_1311')){
                    $indicateur_string .=  'indicateur 1.3.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_1312')){
                    $indicateur_string .=  'indicateur 1.3.1.2 ;';
                }
            }
            if($key == 'q7' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_151_1')){
                    $indicateur_string .=  'indicateur 1.5.1.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_151_2')){
                    $indicateur_string .=  'indicateur 1.5.1.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_151_3')){
                    $indicateur_string .=  'indicateur 1.5.1.3 ;';
                }
            }
            if($key == 'q8' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_110_1')){
                    $indicateur_string .=  'indicateur 1.1.0.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_110_2')){
                    $indicateur_string .=  'indicateur 1.1.0.2 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_110_3')){
                    $indicateur_string .=  'indicateur 1.1.0.3 ;';
                }
            }
            if($key == 'q9' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_150_1')){
                    $indicateur_string .=  'indicateur 1.5.0.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_150_2')){
                    $indicateur_string .=  'indicateur 1.5.0.2 ;';
                }
            }
            if($key == 'q10' && $value == 0){
                 if($this->checkIndicateur($bilan_social_consolide, 'ind_150_1')){
                    $indicateur_string .=  'indicateur 1.5.0.1 ;';
                }
                if($this->checkIndicateur($bilan_social_consolide, 'ind_150_2')){
                    $indicateur_string .=  'indicateur 1.5.0.2 ;';
                }
            }
            if($key == 'q11' && $value == 0){
            }
            if($key == 'q12' && $value == 0){
                if($this->checkIndicateur($bilan_social_consolide, 'ind_152')){
                    $indicateur_string .=  'indicateur 1.5.2 ;';
                }
            }
            if($key == 'q13' && $value == 0){
                 if($this->checkIndicateur($bilan_social_consolide, 'ind_153_1')){
                    $indicateur_string .=  'indicateur 1.5.3.1 ;';
                }
                 if($this->checkIndicateur($bilan_social_consolide, 'ind_1532')){
                    $indicateur_string .=  'indicateur 1.5.3.2 ;';
                }
            }
            $array_to_prevent[$key] = $indicateur_string;
        }
        
        return new JsonResponse($array_to_prevent);
    }
    
    public function checkIndicateur($BilanSocialConsolide, $entity_name){
         
        if ($BilanSocialConsolide->getIdBilasocicons() !== null){
            $conn = $this->container->get('database_connection');
            $results = $conn->query('SELECT count(*) as nb FROM '.$entity_name.' WHERE ID_BILASOCICONS = ' . $BilanSocialConsolide->getIdBilasocicons().';');
           
            try {
                $ind = $results->fetch();
            } catch (NoResultException $e) {
                return $e;
            }

            if($ind['nb'] !== '0' ){
                $bool = true;
            }else{
                $bool = false;
            }
        }else{
            $bool = false;
        }
       
        return $bool;
    }
}
