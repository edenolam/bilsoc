<?php

namespace Bilan_Social\Bundle\BilanSocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\BilanSocialBundle\Entity\InitBilanSocial;
use Bilan_Social\Bundle\BilanSocialBundle\Form\InitBilanSocialType;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\BilanSocialBundle\Entity\HistoriqueBilanSocial;
use Symfony\Component\Serializer\Exception\Exception;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use ZipArchive;
use \PDO;

class BilanSocialController extends AbstractBSController
{
    private function _checkBSExistsInDB($em, $idColl, $idEnqu)  {

        $resCons = $em->getRepository('ConsoBundle:BilanSocialConsolide')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
        if ($resCons != null) return "cons";

        $resApa = $em->getRepository('ApaBundle:BilanSocialAgent')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
        if ($resApa != null) return "apa";

        return null;
    }

    public function indexAction(Request $request)
    {
        // RÃ©cupÃ©ration connexion BdD et utilisateur connectÃ©
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        
        $collectivite = $this->getMaCollectivite();
        // RÃ©cupÃ©ration de la collectivitÃ© de l'utilisateur
        $idColl = $collectivite->getIdColl();
        // Recherche de l'enquete en cours
        $departement = $collectivite->getDepartement();

        $user = null;
        if(($username = $this->getFromSession('username')) != null){
            $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            //dump($user);die;
        }else {
            $user = $this->getUser();
        }
        $collectiviteByCDG = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByNmSire($user->getUsername());
        $siretCol = $collectivite->getNmSire();
        $libCol= $collectivite->getLbColl();

        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $resEnq = $em->getRepository('EnqueteBundle:Enquete')->getEnqueteActive($idColl, $currentCampagne->getIdCamp());
        $idEnqu = $resEnq->getIdEnqu();

        // Lecture des paramÃ¨tres de configuration du mode de saisie dÃ©finis pour cette collectivitÃ©/enquete
        $res = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
        if(!$res){
            return $this->redirectToRoute('homepage');
        }
        $enquCollParams = $res;

        // Lecture des rÃ©ponses aux questions de configuration apportÃ©e si dÃ©jÃ  fait
        $resInit = $em->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
        $bsType = null;
        if(isset($resInit)){
            $bsType = $resInit->getInitSource();
        }

        if (!$resInit) {
            $resInit = new InitBilanSocial($enquCollParams);
            $BSExistsInDBType = null;
        }
        else {
            // Le champ BlCons ne sert plus à rien. Seul le champ BlApa est utilisé avec les valeurs suivantes (0 = Consolidé et 1 = Agent par agent)
            $BSExistsInDBType = ($resInit->getBlApa()) ? "apa" : "cons";
        }
        if($resInit->getInitSource() == 'bs-vide'){
            $this->addFlash('notice', 'Un Bilan Social "Consolidé vide" a été initialisé. Vous pouvez y accéder directement ou bien le réinitialiser.');
        }else if($resInit->getBlCons() == 1 && $resInit->getBlApa() == 1 ){
            $this->addFlash('notice', 'Un Bilan Social "Consolidé" a été généré via un agent par agent. Vous pouvez y accéder directement ou bien le réinitialiser.');
        }else if ($BSExistsInDBType === "apa") {
            $this->addFlash('notice', 'Un Bilan Social "Agent par agent" a été initialisé. Vous pouvez y accéder directement ou bien le réinitialiser.');
        }
        else if ($BSExistsInDBType === "cons") {
            if($bsType == 'n4ds'){
                $this->addFlash('notice', 'Un Bilan Social "Consolidé" via un N4ds a été initialisé. Vous pouvez y accéder directement ou bien le réinitialiser.');
            }else if($bsType == 'basecarr'){
                $this->addFlash('notice', 'Un Bilan Social "Consolidé" via un Base carrière a été initialisé. Vous pouvez y accéder directement ou bien le réinitialiser.');
            }else{
                $this->addFlash('notice', 'Un Bilan Social "Consolidé" a été initialisé. Vous pouvez y accéder directement ou bien le réinitialiser.');
            }
        }

        $config = $this->getInitConfig($resInit);

        foreach ($config['rows'] as $key => &$row){
           foreach ($row['blocks'] as $key1 => &$block){
                if($block['show_condition'] === true){
                    $block['show'] = true;
                }else{
                    foreach ($block['show_condition'] as $value){
                        if(method_exists($enquCollParams,$value)){
                            $methode = $value;
                            $block['show'] = $enquCollParams->$methode();
                        }else{
                            $block['show'] = true;
                        }
                    }
                }


           }
        }

        $url = $this->getUrlAction($resInit);
//        $url = null;
//            if($resInit->getInitSource() == 'n4ds' || $resInit->getInitSource() == 'basecarr' && ($resInit->getBlApa() == 0 && $resInit->getBlCons() == 1)){
//                $url = $this->generateUrl('bilan_conso_edit');
//            }else if($resInit->getInitSource() == 'bs-vide'){
//                $url = $this->generateUrl('bilan_conso_edit');
//            }else if($resInit->getIdInitBs() == null){
//                $url = null;
//            }else if($resInit->getInitSource() == 'n4ds' || $resInit->getInitSource() == 'basecarr' && ($resInit->getBlApa() == 1 && $resInit->getBlCons() == 0)){
//                $url = $this->generateUrl('bilansocialagent_index');
//            }else if($resInit->getBlApa() == 1 &&  $resInit->getBlCons() == null ){
//                $url = $this->generateUrl('bilansocialagent_index');
//            }else if($resInit->getBlApa() == 1 && $resInit->getBlCons() == 1){
//                $url = $this->generateUrl('bilan_conso_edit');
//            }else if($resInit->getBlApa() == 0 && $resInit->getInitSource() !== null && $resInit->getInitSource() !== 'n4ds' ){
//                $url = $this->generateUrl('bilan_conso_edit');
//            }else if($resInit->getBlApa() == 1 && $resInit->getInitSource() !== null && $resInit->getInitSource() !== 'n4ds'){
//                $url = $this->generateUrl('bilansocialagent_index');
//            }

        $array_enquete_coll = array(
            'blbilasocivide' => $enquCollParams->getBlBilasocivide(),
            'blbilasoci' => $enquCollParams->getBlBilasoci(),
            'blrast' => $enquCollParams->getBlRast(),
            'blhand' => $enquCollParams->getBlHand(),
            'blgepe' => $enquCollParams->getBlGepe(),
            'blgpeecplus' => $enquCollParams->getBlGpeecPlus(),
            'blapa' => $enquCollParams->getBlApa(),
            'blcons' => $enquCollParams->getBlCons(),
            'bln4ds' => $enquCollParams->getBlN4ds(),
            'blbasecarr' => $enquCollParams->getBlBasecarr(),
            'bldgcl' => $enquCollParams->getBlDgcl()
        );
        return $this->render('@BilanSocial/BilanSocial/index.html.twig',
            array('params' => $array_enquete_coll, 'data' => $resInit,
                'existingBSAccessUrl' => $url,
                    "config_init" => $config,
                'siretCol' => $siretCol,
                'libCol' => $libCol,
                ));
    }

    /**
     * Enregistrement des informations apportÃ©es Ã  la configuration de la saisie
     * @param Request $request
     * @return JsonResponse
     */
    public function saveInitialisationAction(Request $request) {


        $type_file = $request->get('file');

        // RÃ©cupÃ©ration connexion BdD et utilisateur connectÃ©
        $em = $this->getDoctrine()->getManager();
        //$current_user = $this->getUser();
        $current_user = null;
        if(($username = $this->getFromSession('user_siret')) != null){
            $current_user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            //dump($user);die;
        }else {
            $current_user = $this->getUser();
        }
        // RÃ©cupÃ©ration de la collectivitÃ© de l'utilisateur
        $idColl = $current_user->getCollectivite()->getIdColl();
        // Recherche de l'enquete en cours
        $departement = $current_user->getCollectivite()->getDepartement();
        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $resEnq = $em->getRepository('EnqueteBundle:Enquete')->getEnqueteActive($idColl, $currentCampagne->getIdCamp());
        $idEnqu = $resEnq->getIdEnqu();

        // Lecture des paramÃ¨tres de configuration du mode de saisie dÃ©finis pour cette collectivitÃ©/enquete
        $res = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->findBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
        $enquCollParams = $res[0];

        // Lecture des rÃ©ponses aux questions de configuration apportÃ©e si dÃ©jÃ  fait
        $resInit = $em->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
        if (!$resInit) {
            $resInit = new InitBilanSocial($enquCollParams);
            // Memo des refs
            $resInit->setCollectivite($current_user->getCollectivite());
            $resInit->setEnquete($resEnq);
            // Init infos
            $resInit->setDtCrea(new \DateTime());
            $resInit->setCdUtilcrea($current_user->getIdUtil());
        } else {
            $resInit->setDtModi(new \DateTime());
            $resInit->setCdUtilmodi($current_user->getIdUtil());
        }

        // Mise Ã  jour des choix
        $resInit->setBlDeclAgen($request->get('declaAgent'));
        $declaBS = $request->get('declaBS');
        if (isset($declaBS) && !empty($declaBS)) {
            $resInit->setBlBsExis($declaBS);
        } else {
            $resInit->setBlBsExis(0);
        }

        $bsInitSource = $request->get('bsInitSource');
        
        
        if($bsInitSource == 'bs-dgcl' || $bsInitSource == 'n4ds' ){
            if($type_file !== 'text/plain' && $type_file !== 'text/csv' && $type_file !== 'application/vnd.ms-excel'){
                $response = new JsonResponse(array( "status" => "failed", "msg" => $this->get('translator')->trans('erreur.format.modal')));
                return $response;
            }
        }

        $isTypeAPA = $request->get('isTypeAPA');
        if (isset($isTypeAPA) && !empty($isTypeAPA)) {
            $isTypeAPA = $request->get('isTypeAPA');
        } else if ($bsInitSource == "n4ds") {
            $isTypeAPA = 1;
        } else {
            $isTypeAPA = 0;
        }


        $resInit->setInitSource($bsInitSource);
        $resInit->setBlApa($isTypeAPA);
        $resInit->setBlCons(null);  // Inutile
        //TODO : ajouter chgt etat dans table historique bilan social
        $histBS = new HistoriqueBilanSocial();
        $histBS->setDepartement($departement);
        $histBS->setCollectivite($current_user->getCollectivite());
        $histBS->setEnquete($resEnq);
        $histBS->setFgStat(0);
        $histBS->setDtChgt(new \DateTime());
        if ($isTypeAPA) {
            $histBS->setCdTypebilasoci(0);
        } else {
            $histBS->setCdTypebilasoci(1);
        }

        $em->getConnection()->beginTransaction(); // suspend auto-commit
        try {
            $em->persist($resInit);
            $em->persist($histBS);
            $em->flush();
            $em->getConnection()->commit();

            $url = $this->getUrlAction($resInit);



            $response = new JsonResponse(array("status" => "success",
                "msg" => $this->get('translator')->trans('modesaisie.bilansocial.flash'),
                "targetUrl" => $url
            ));
        }
        catch (Exception $ex) {
            $em->getConnection()->rollBack();
            error_log('saveInitialisationAction: error : '.$ex);
            $response = new JsonResponse(array( "status" => "failed", "msg" => $this->get('translator')->trans('erreur.modesaisie.flash')));
        }
        return $response;
    }

    /**
     * RÃ©initialisation complÃ©te du BS de l'utilisateur connectÃ©
     * @param Request $request
     * @return Response
     */
    public function reinitialisationAction(Request $request)
    {
        ini_set('max_execution_time', 1000);
        // RÃ©cupÃ©ration connexion BdD et utilisateur connectÃ©
        $em = $this->getDoctrine()->getManager();
       // $current_user = $this->getUser();
        $current_user = null;
        if(($username = $this->getFromSession('user_siret')) != null){
            $current_user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            //dump($user);die;
        }else {
            $current_user = $this->getUser();
        }
        // RÃ©cupÃ©ration de la collectivitÃ© de l'utilisateur
        $idColl = $current_user->getCollectivite()->getIdColl();
        // Recherche de l'enquete en cours
        $departement = $current_user->getCollectivite()->getDepartement();
        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $resEnq = $em->getRepository('EnqueteBundle:Enquete')->findEnqueteLanceeByDepartement($departement, $currentCampagne->getIdCamp());
        if(!empty($resEnq)){
            $idEnqu = $resEnq[0]->getIdEnqu();
            $type = 3;
            // Le reinit supprime tout meme si rien de selectionne, $type inutile
            error_log('reinitialisationAction: start');

            $em->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                // Suppression des donnÃ©es APA
                $bilanSocialAgents = $em->getRepository('ApaBundle:BilanSocialAgent')->GetAllAgentsForImport($idEnqu, $idColl);
                if ($bilanSocialAgents != null) {
                    $type = 0;
                    foreach ($bilanSocialAgents as $bsa) {
                        $em->remove($bsa);
                    }
                }

                $resInfoCollAgen = $em->getRepository('ApaBundle:InformationColectiviteAgent')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
                if (null != $resInfoCollAgen) {
                    $type = 0;
                    $em->remove($resInfoCollAgen);
                }
                /* Suppresion des infos générales APA */
                $resInfoGene = $em->getRepository('ApaBundle:InformationGenerale')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
                if (null != $resInfoGene) {
                    $type = 0;
                    $em->remove($resInfoGene);
                }
                /* Suppression des imports */
                $resImports = $em->getRepository('ImportBundle:Import')->findBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
                foreach ($resImports as $imp) {
                    $em->remove($imp);
                }
                /* Suppression des historiques liés aux bilans sociaux */
    //            $resHistoriques = $em->getRepository('BilanSocialBundle:HistoriqueBilanSocial')->findBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
    //            foreach ($resHistoriques as $historique) {
    //                $em->remove($historique);
    //            }


                $em->flush();
                error_log('reinitialisationAction: APA done');

                $resultat = json_encode('done-apa');

                // Suppression des donnÃ©es CONS
                $resBsCons = $em->getRepository('ConsoBundle:BilanSocialConsolide')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
                if (null != $resBsCons) {
                    $type = 1;
                    $em->remove($resBsCons);
                }

                $resQuesCollCons = $em->getRepository('ConsoBundle:QuestionCollectiviteConsolide')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
                if (null != $resQuesCollCons) {
                    $type = 1;
                    $em->remove($resQuesCollCons);
                }

                $em->flush();
                error_log('reinitialisationAction: Consolidé done');

                $init = $em->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
                $initSource = $init->getInitSource();

                if (null != $init) {
                    $em->remove($init);
                }
                $em->flush();

                $histBSNew = new HistoriqueBilanSocial();
                $histBSNew->setDepartement($this->getMaCollectivite()->getDepartement());
                $histBSNew->setCollectivite($this->getMaCollectivite());
                $histBSNew->setEnquete($this->getMonEnquete($this->getMaCollectivite()));
                $histBSNew->setFgStat(8);
                $histBSNew->setDtChgt(new \DateTime());
                $histBSNew->setCdTypebilasoci($type);

                $this->getEntityManager()->persist($histBSNew);
                $this->getEntityManager()->flush();


                $em->getConnection()->commit();
                error_log('reinitialisationAction: commit done');

                $this->addFlash('notice', 'Le Bilan Social a été réinitialisé avec succès.');
                $response = new JsonResponse(array( "status" => "success"));
            }
            catch (Exception $ex) {
                $em->getConnection()->rollBack();
                error_log('reinitialisationAction: rollback');
                error_log("reinitialisationAction: Error Message " . $ex->getMessage(), 0);
                error_log("reinitialisationAction: Error " . $ex->getTraceAsString(), 0);
                $response = new JsonResponse(array( "status" => "failed",
                    "msg" => "Une erreur est survenue durant la réinitialisation du bilan social. " . $ex->getMessage()));
            }
        }else{
            $response = new JsonResponse(array( "status" => "failed",
                    "msg" => "Une erreur est survenue durant la réinitialisation du bilan social. " . $ex->getMessage()));
        }
        
        return $response;
    }
    public function checkbsexistsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idColl = $request->get('collectivite');
        $idEnqu = $request->get('enquete');
        $type = $request->get('type');

        if ('apa' == $type) {
            $resCons = $em->getRepository('ConsoBundle:BilanSocialConsolide')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
            if (null == $resCons)
                $resultat = json_encode('ok');
            else
                $resultat = json_encode('exists');
        } elseif ('cons' == $type) {
            $resApa = $em->getRepository('ApaBundle:BilanSocialAgent')->findOneBy(array('collectivite' => $idColl, 'enquete' => $idEnqu));
            if (null == $resApa)
                $resultat = json_encode('ok');
            else
                $resultat = json_encode('exists');
        }

        $response = new Response();
        $response->setContent($resultat);

        return $response;
    }
    public function historiqueCollectiviteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        $collectivite = $current_user->getCollectivite();
        $enquete = $this->getMonEnquete();

        $historique = $em->getRepository('BilanSocialBundle:HistoriqueBilanSocial')->findBy(array('enquete' => $enquete, 'collectivite' => $collectivite), array('dtChgt' => 'asc'));

        return $this->render('@BilanSocial/BilanSocial/historiqueCollectivite.html.twig', array('historique' => $historique));
    }
    public function historiqueAction()
    {
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();

        // todo : recup coll du cdg
        // recup historiques


        $collectivite = $current_user->getCollectivite();
        $idColl = $collectivite->getIdColl();
        $enquete = $this->getMonEnquete();

        $historique = $em->getRepository('BilanSocialBundle:HistoriqueBilanSocial')->findBy(array('enquete' => $enquete, 'collectivite' => $collectivite));

        return $this->render('@BilanSocial/BilanSocial/historique.html.twig', array('historique' => $historique));
    }
    public function generateBilanSocialVideAction($collectivite = null)
    {
        $em = $this->getDoctrine()->getManager();
       // $current_user = $this->getUser();
        $current_user = null;
        if(($username = $this->getFromSession('user_siret')) != null){
            $current_user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            //dump($user);die;
        }else {
            $current_user = $this->getUser();
        }
        $session = $this->get('session');
        $valide = false;
        if($collectivite !== null){
            $idColl = $collectivite;
            $enquete = $this->getMonEnquete($idColl);
            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByIdColl($idColl);
            $session->set('coll_id', $idColl);
            $session->set('return', 'suivienquete');
            $valide = true;
        }else{
            $collectivite = $current_user->getCollectivite();
            $idColl = $collectivite->getIdColl();
            $enquete = $this->getMonEnquete();
        }

        
        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        
        $idEnquete = $enquete->getIdEnqu();
        $blAffiColl = $collectivite->getBlAffiColl();


        $bilanSocialConsolideExist = $em->getRepository('ConsoBundle:BilanSocialConsolide')->findOneByActif($idColl,$idEnquete);

        if($bilanSocialConsolideExist !== null){
            $response = new JsonResponse(array("status" => "bsexist",
                "msg" => $this->get('translator')->trans('erreur.modesaisie.bilansocialvide.exist.flash'),
            ));
            return $response;
        }

        $questionCollectiviteConsolide = new QuestionCollectiviteConsolide();
        $questionCollectiviteConsolide->setEnquete($enquete);
        $questionCollectiviteConsolide->setCollectivite($collectivite);

        $em->persist($questionCollectiviteConsolide);
        $em->flush();

        $bilanSocialConsolide = new BilanSocialConsolide;
        $bilanSocialConsolide->setEnquete($enquete);
        if($valide){
            $bilanSocialConsolide->setFgStat(2);
        }else{
            $bilanSocialConsolide->setFgStat(0);
        }
        
        $bilanSocialConsolide->setCollectivite($collectivite);
        $bilanSocialConsolide->setQuestionCollectiviteConsolide($questionCollectiviteConsolide);

        $em->persist($bilanSocialConsolide);
        $em->flush();

        $idBilaSociCons = $bilanSocialConsolide->getIdBilasocicons();

        if ($blAffiColl == true) {
            $blAffiCollInt = 1;
        }elseif ($blAffiColl == false || $blAffiColl == null) {
            $blAffiCollInt = 0;
        }

       $response = $this->forward('ConsoBundle:QuestionCollectiviteConsolide:setConsoToZero', array(
            'idBilaSociCons'  => $idBilaSociCons,
            'idEnqu' => $idEnquete,
            'blAffiColl' => $blAffiCollInt,
        ));
        /* todo checker comment recuperer le data du json du dessus pour vérifier qu'il soit bien OK */
        $response = new JsonResponse(array("status" => "success",
                "msg" => 'Génération du bilan social à vide réussi',
        ));

        return $response;
    }
    public function getUrlAction($resInit){

        $url = null;

        if($resInit->getInitSource() == 'n4ds' && ($resInit->getBlCons() == 0 || $resInit->getBlCons() == null )){
            $url = $this->generateUrl('bilansocialagent_index');
        }else if($resInit->getInitSource() == 'n4ds' && $resInit->getBlCons() == 1){
            $url = $this->generateUrl('bilan_conso_edit');
        }else if($resInit->getInitSource() == 'basecarr' && ($resInit->getBlCons() == 0 || $resInit->getBlCons() == null )){
            $url = $this->generateUrl('bilansocialagent_index');
        }else if($resInit->getInitSource() == 'basecarr' && $resInit->getBlCons() == 1){
            $url = $this->generateUrl('bilan_conso_edit');
        }else if($resInit->getInitSource() == 'bs-vide'){
            $url = $this->generateUrl('bilan_conso_edit');
        }else if($resInit->getInitSource() == 'manu' && $resInit->getBlApa() == 0){
            $url = $this->generateUrl('bilan_conso_edit');
        }else if($resInit->getInitSource() == 'manu' && $resInit->getBlApa() == 1 && ($resInit->getBlCons() ==  0 || $resInit->getBlCons() == null)){
            $url = $this->generateUrl('bilansocialagent_index');
        }else if($resInit->getInitSource() == 'manu' && $resInit->getBlApa() == 1 && $resInit->getBlCons() == 1){
            $url = $this->generateUrl('bilan_conso_edit');
        }else if($resInit->getInitSource() == 'bs-dgcl'){
            $url = $this->generateUrl('bilan_conso_edit');
        }

        return $url;
    }
    public function lockInitialisationAction(){
        $em = $this->getDoctrine()->getManager();
        $collectivite = $this->getMaCollectivite();
        $enquete = $this->getMonEnquete();

        $resInit = $em->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $collectivite->getIdColl(), 'enquete' => $enquete->getIdEnqu()));

        $resInit->setBlLock(true);
        try{
             $em->flush();


            $response = new JsonResponse(array("status" => "success",
                "msg" => 'blocage initialisation reussi',
            ));
        } catch (Exception $ex) {
             $response = new JsonResponse(array("status" => "error",
                "msg" => 'une erreur est survenue',
            ));
        }

        return $response;
    }
    public function deleteInitialisationAction(){
        $em = $this->getDoctrine()->getManager();
        $collectivite = $this->getMaCollectivite();
        $enquete = $this->getMonEnquete();
        
        $resInit = $em->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $collectivite->getIdColl(), 'enquete' => $enquete->getIdEnqu()));
        
        
        
        $bilanSocialConsolideExist = $em->getRepository('ConsoBundle:BilanSocialConsolide')->findOneByActif($collectivite->getIdColl(),$enquete->getIdEnqu());
        $bsAgent = $em->getRepository('ApaBundle:BilanSocialAgent')->findOneByActif($collectivite->getIdColl(),$enquete->getIdEnqu());
        
        try{
            
            if( $bilanSocialConsolideExist == null && $bsAgent == null ){
                    $em->remove($resInit);
                    $em->flush();


                $response = new JsonResponse(array("status" => "success",
                    "msg" => 'Reinitialisation réussi',
                ));
            }else{
                $response = new JsonResponse(array("status" => "error",
                    "msg" => 'Reinitialisation impossible, un bilan social éxiste.',
                ));
            }
            
        } catch (Exception $ex) {
             $response = new JsonResponse(array("status" => "error",
                "msg" => 'une erreur est survenue',
            ));
        }

        return $response;
    }
    public function exportDGCLaction(){
        
        $bsltm = $this->get('long_task_manager');
        
        $response = $bsltm->run('fullDGCL',array(
                            "ownerEmail"=> "string",
                            "ownerKey"=> $this->getUser()->getUsername(),
                            "rowsLimit"=> 1000000,
                            "userId"=> $this->getUser()->getIdUtil()
                        )
                );
       
        return $this->redirectToRoute('homepage');
    }

    public function getInitConfig ($BsInit){

        $init_config = $this->get('bilan_social_config_finder')->getJsonConfigfile('config_init');

        return $init_config;

    }


}
