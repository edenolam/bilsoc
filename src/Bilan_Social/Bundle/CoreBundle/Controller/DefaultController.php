<?php

namespace Bilan_Social\Bundle\CoreBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use DateTimeZone;
use \PDO;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Bilan_Social\Bundle\UserBundle\Entity\HistoriqueConnexion;


class DefaultController extends AbstractBSController{

    /**
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getFromSession('hasInsertHistoConnexion')== null && $this->getFromSession('justConnect')==false){
            $user = $this->getUser();
            $user_id = $user->getIdUtil();
            $new_Date = new \DateTime('now');
            $new_Date->format('Y-m-d H:i:s');

            $LastDtConnexion = $em->getRepository('UserBundle:HistoriqueConnexion')->findOneBy(array('idUtil' => $user_id), array('dtConn' => 'DESC'));

            if ($LastDtConnexion != null) {
                $user->setDtLastconn($LastDtConnexion->getDtConn());
            }

            $historique_conn_new = new HistoriqueConnexion();
            $historique_conn_new->setDtConn($new_Date);
            $historique_conn_new->setIdUtil($user_id);

            $em->persist($historique_conn_new);
            $em->persist($user);
            $em->flush();
            $this->setToSession('hasInsertHistoConnexion',true);
        }
        $redirectToInitUser = $this->getRedirectToInitUser();
        if($redirectToInitUser!=false){
            return $redirectToInitUser;
        }
        $user = $this->getUser();

        $username = $user->getUsername();
        $roles = $user->getRoles();
        $role = $roles[0];

        

        $histoConnexion = $em->getRepository('UserBundle:HistoriqueConnexion')->findBy(array('idUtil' => $user->getIdUtil()), array('dtConn' => 'DESC'));

        
        $session = $request->getSession();
        
        $firstConnMessage = false;
        if ((count($histoConnexion) == 0 || count($histoConnexion) == 1) && !$session->has('hasBeenModified')) {
            $firstConnMessage = true;
        }

        if($session->get('connected') == null ){
             $session->set('connected', false);
        }

        if($session->get('connected') == false ){
            $dateTime = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $user->setDtLastConn($dateTime);
            $em->flush();
            $session->set('connected', true);
        }
        
        $twig = $this->container->get('twig');
        $globals = $twig->getGlobals();
        $etatsSaisie = $globals['etat_saisie_bilan_social'];
        foreach ($etatsSaisie as $etat) {
            $statutsTmp[$etat] = 0;
        }
        $enquete = null;
        $departements = [];

        // Pour la génération des URLs publiques
        $fileManager = $this->getBSFileManager();

        if ($user->hasRole('ROLE_ADMIN')) {
            $actualites = null;
            return $this->render('@Core/Default/index.html.twig', array(
                    'username' => $username,
                    'role' => $role,
                    'actualites' => $actualites,
                )
            );
        }
        else if ($user->hasRole('ROLE_CDG')) {

            $results = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByUtilisateurAndDroit($user);

            foreach ($results as $res) {
                $lb = $res->getDepartement()->getCdDepa() . ' - ' . $res->getDepartement()->getLbDepa();
                $departements[$res->getDepartement()->getCdDepa()] = $lb;
            }
            $ListIdCdg = array();
            foreach ($user->getUtilisateurCdgs() as $key => $value) {
                array_push($ListIdCdg, $value->getCdg()->getIdCdg());
            }

            $actualites = $em->getRepository('ActualiteBundle:Actualite')->findActualiteActiveByCDG($ListIdCdg);
            foreach ($actualites as $key => $actualite) {
                $actualite->setImagePublicUrl($fileManager->getPublicFileUrl($actualite->getFileKeyImg()));
            }
            return $this->render('@Core/Default/index.html.twig', array(
                    'username' => $username,
                    'role' => $role,
                    'actualites' => $actualites,
                    'departements' => $departements
                )
            );
        }
        else if ($user->hasRole('ROLE_COLLECTIVITY')) {
            
            $referer = $request->headers->get('referer');
            $firstConn = false;
            if ($this->generateUrl('reinit_account', array(), UrlGeneratorInterface::ABSOLUTE_URL) === $referer) {
                $firstConn = true;
            }

            $actualites = $em->getRepository('ActualiteBundle:Actualite')->findActualiteActiveByCollectivite($user);
            
            foreach ($actualites as $key => $actualite) {
                $actualite->setImagePublicUrl($fileManager->getPublicFileUrl($actualite->getFileKeyImg()));
            }
            return $this->render('@Core/Default/index.html.twig', array(
                    'username' => $username,
                    'role' => $role,
                    'actualites' => $actualites,
                    'firstconn' => $firstConn,
                    'firstConnMessage' => $firstConnMessage
                )
            );
        }else if($user->hasRole('ROLE_DGCL'))
        {
            $actualites = null;
            $filename = 'dgcl_export_DGCL.zip';
            
            $array_type_coll = $em->getRepository('CollectiviteBundle:Collectivite')->getNbCollByTypeColl();

            $sql = "SELECT
                    COALESCE(SUM(bsc.NB_AGENT_TITULAIRE),0) AS TITU, 
                    COALESCE(SUM(bsc.NB_AGENT_EMPLOI_PERMANENT),0) AS EMPPERM, 
                    COALESCE(SUM(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT),0) AS CONTNONPERM, 
                    COALESCE(SUM(bsc.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT),0) AS CONTPERM
                    FROM bilan_social_consolide bsc
                    JOIN enquete e ON e.ID_ENQU  = bsc.ID_ENQU
                    JOIN campagne c ON e.ID_CAMP = c.ID_CAMP
                    WHERE bsc.FG_STAT = 2
                    AND c.FG_STAT = 1";

            $conn = $this->container->get('database_connection');
            $results = $conn->query($sql);
            $array_nb_agents = $results->fetch();
          
            $bsltm = $this->get('long_task_manager');
            $tasks = $bsltm->list(array(
                "ownerKey"=> $this->getUser()->getUsername(),
                "taskType"=> 0,
                "statusMask"=> 111
              ));
            /*  foreach ($tasks as $key => &$task) {
                  $task->ficheView = $this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFiche', array('task' => $task))->getContent();
                 
              }*/

            
              
            return $this->render('@Core/Default/index.html.twig', array(
                    'username' => $username,
                    'role' => $role,
                    'actualites' => $actualites,
                    'tasks' => $tasks,
                    'file_manager' => $this->get('file_manager.file_manager'),
                    'array_type_coll' => $array_type_coll,
                    'array_nb_agents_by_statut' => $array_nb_agents
                )
            );
        } else if ($user->hasRole('ROLE_INFOCENTRE')) {

            $actualites = null;
            
            return $this->render('@Core/Default/index.html.twig', array(
                'username'  => $username,
                'role'      => $role,
                'actualites'=> $actualites
            ));
        }
    }

    /** Affichage des information de la page d'acceuil CDG (dashboard)
     * @param Request $request
     * @return JsonResponse
     */
    public function getInfosDepartementsAjaxAction(Request $request)
    {
        $this->saveAndUnlockSession($request);

        // Lecture des paramètres de l'appel
        $departementsAjax = $request->get('departements');
        if ($departementsAjax == null) {
            // FIXME Aucun département de sélectionné
            
            $template = $this->renderView('@Core/Default/charts.html.twig', array(
               'departements' => false
            ));
             return new JsonResponse(array(
                'template' => $template
            ));
        }
        else {
            error_log(json_encode($departementsAjax), 0);
            $departementsAjax = implode(",", $departementsAjax);
        }
        
        $user = $this->getUser();
        $idUtil = $user->getIdUtil();

        $currentCampagne = $this->getMaCampagne();
        if ($currentCampagne == null) {
            // FIXME Aucune campagne en cours
            return null;
        }

        $idCamp = $currentCampagne->getIdCamp();

        // Appel procédure de remplissage des d'informations

        $query = "CALL DASHBOARD_cdg(:pIdUtil, :pIdCamp, :pCdDepaList);";
        
        $stmt = $this->getDBALConnection()->prepare($query);
        $stmt->bindParam(':pIdUtil',$idUtil,PDO::PARAM_INT);
        $stmt->bindParam(':pIdCamp',$idCamp,PDO::PARAM_INT);
        $stmt->bindParam(':pCdDepaList',$departementsAjax,PDO::PARAM_STR);
        $stmt->execute();

        // Information Départements
        $rowset = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $urlsMap = array();
        foreach ($rowset as $key => $row){
            if($row->lbUrlMap !== null ) {
                $urlsMap[$row->CD_DEPA][$key] = $row->lbUrlMap;
            }
        }
        // Lecture des compteurs par statuts
        $stmt->getWrappedStatement()->nextRowset();
        $rowset = $stmt->fetchAll(\PDO::FETCH_OBJ);

        $statuts = [0,0,0,0,0,0,0,0,0];
        $nbColls = 0;

        foreach ($rowset as $row){
            $statuts[$row->FG_STAT] = (1 * $row->NB_COLL);      // Pour avoir un INT, sinon plantage HighCharts
            $nbColls += $row->NB_COLL;
        }

        // Calcul taux de Validés (Statut=2)
        if ($nbColls == 0) {
            $tauxTransmis = 0;
        }
        else {
            $tauxTransmis = round(($statuts[2] / $nbColls) * 100, 2);
        }
        if ($tauxTransmis > 100) {
            $tauxTransmis = 100;
        }

        // Liste des Transmis (statut = 1 || 5)
        $bsTransmisArr = [];
        $stmt->getWrappedStatement()->nextRowset();
        $rowset2 = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $nbBsTransmit = count($rowset2);
        foreach ($rowset2 as $row){
            $item = array();
            $item['idUtil'] = $row->ID_UTIL;
            $item['idColl'] = $row->ID_COLL;
            $item['lbColl'] = $row->LB_COLL;
            $item['siret'] = $row->NM_SIRE;
            $item['incoherences'] = $row->NB_INCOHERENCES;
            $item['type_init'] = $row->TYPE_INIT;
            $item['nb_hand'] = $row->NB_PC_HAND;
            $item['nb_rassct'] = $row->NB_PC_RASSCT;
            $item['nb_gpeec'] = $row->NB_PC_GPEEC;
            $item['nb_bsc'] = $row->NB_PC_BSC;
            $item['date'] = $row->DT_CHGT;
            $item['blCtCdg'] = $row->BL_CT_CDG;

            array_push($bsTransmisArr, $item);
        }

        // Liste des Validés (statut = 2)
        $bsValidArr = [];

        $stmt->getWrappedStatement()->nextRowset();
        $rowset2 = $stmt->fetchAll(\PDO::FETCH_OBJ);

        foreach ($rowset2 as $row){
            $item = array();
            $item['idUtil'] = $row->ID_UTIL;
            $item['idColl'] = $row->ID_COLL;
            $item['lbColl'] = $row->LB_COLL;
            $item['siret'] = $row->NM_SIRE;
            $item['incoherences'] = $row->NB_INCOHERENCES;
            $item['type_init'] = $row->TYPE_INIT;
            $item['nb_hand'] = $row->NB_PC_HAND;
            $item['nb_rassct'] = $row->NB_PC_RASSCT;
            $item['nb_gpeec'] = $row->NB_PC_GPEEC;
            $item['nb_bsc'] = $row->NB_PC_BSC;
            $item['date'] = $row->DT_CHGT;
            $item['blCtCdg'] = $row->BL_CT_CDG;

            array_push($bsValidArr, $item);
        }

        // Taux retour effetif
        $tauxRetourEffectif = 0;

        $stmt->getWrappedStatement()->nextRowset();
        $rowset3 = $stmt->fetchAll(\PDO::FETCH_OBJ);

        foreach ($rowset3 as $row){
            $tauxRetourEffectif = round($row->TAUX_EFFECTIF, 2);
        }

        if ($tauxRetourEffectif > 100) {
            $tauxRetourEffectif = 100;
        }

        $stmt->closeCursor();
       
        $template = $this->renderView('@Core/Default/charts.html.twig', array(
            'nbBsTransmis' => $nbBsTransmit,
            'bsTransmisArr' => $bsTransmisArr,
            'bsValidArr'    => $bsValidArr,
            'url_maps' => $urlsMap,
            'departements' => true
        ));
        
        if(!empty($urlCarte)){
            $message_map = $this->get('translator')->trans('success.getmap');
        }else{
            $message_map = $this->get('translator')->trans('erreur.getmap.nodata');
        }
        
        return new JsonResponse(array(
            'template' => $template,
            'compteurBs' => $tauxTransmis,
            'compteurEff' => $tauxRetourEffectif,
            'nbBsTransmis' => $statuts[1],
            'nbEnCours' => $statuts[0],
            'nbValid' => $statuts[2],
            'nbNonValid' => $statuts[3],
            'nbEnCoursNonValid' => $statuts[4],
            'nbNvelleTrans' => $statuts[5],
            'nbNonConn' => $statuts[6],
            'nbNonSaisi' => $statuts[7],
            'nbReinit' => $statuts[8],
            'urlMap' => $urlsMap,
            'msg_map' => $message_map,
        ));

    }

    public function userdgclAction(){
        $actualites = null;
         
         /* todo : mettre les requetes concernants l'écran DGCL ici */
        
         
         
        return $this->render('@Core/Default/index.html.twig', array(
            'actualites' => $actualites,
        ));
    }

}
