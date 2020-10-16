<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Controller;

use Bilan_Social\Bundle\CampagneBundle\Entity\Relance;
use Bilan_Social\Bundle\CampagneBundle\Form\RelanceType;
use Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete;
use Bilan_Social\Bundle\EnqueteBundle\Entity\EnqueteCollectivite;
use Bilan_Social\Bundle\EnqueteBundle\Form\InfosEnqueteType;
use Bilan_Social\Bundle\EnqueteBundle\Form\ParametrageEnqueteForm;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Session\Session;

//use Exporter\Writer\XlsWriter;

class EnqueteController extends AbstractBSController
{
    public function indexAction(Request $request){
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $departements = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByUtilisateur($user);
        $campagne = $this->getMaCampagne();
        if ($campagne == null) {
            return $this->redirectToRoute('homepage', array(), 301);
        }
        $enquetes = [];
        $idUtil = $user->getIdUtil();
        $departements_with_enquete = $em->getRepository('CollectiviteBundle:Departement')->getDepartementsWithEnqueteByUtilisateurAndDroitFormStatement($idUtil);

        foreach ($departements_with_enquete as $key => $value) {
            array_push($enquetes, $value['idEnqu']);
        }

        $departements_no_enquete = $em->getRepository('CollectiviteBundle:Departement')->getDepartementsWithoutEnqueteByUtilisateurAndDroitSQLForm($idUtil);
        $noenquete = true;
        if(empty($departements_no_enquete)){
            $noenquete = false;
        }

        $collectivitesCreation = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($user, 0, 'Création', 0);
        $collectivitesSuppression = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($user, 1, 'vide', 0);

        $createEnqueteEnable = true;
        if(!empty($collectivitesCreation) || !empty($collectivitesSuppression)){
            $createEnqueteEnable = false;
        }

        return $this->render('@Enquete/Enquete/index.html.twig',array('listeEnquetesActive' => $departements_with_enquete,
                                                                        'noenquete' => $noenquete,
                                                                        'campagne' => $campagne,
                                                                        'createEnqueteEnable' => $createEnqueteEnable,
                                                                        "departements" => $departements));
    }

        CONST config_routing_dispatcher = array(
        'new' => "@Enquete/Enquete/enquete.html.twig",
        'edit' => "@Enquete/Enquete/enquete.html.twig",
        'import_bc' => "@Enquete/Enquete/import.html.twig",
        'param' => "@Enquete/Enquete/param.html.twig"

    );

    public function editEnqueteAction(Request $request, Enquete $enquete) {
        $etat = 'edit';
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $session->set('idEnqu', $enquete->getIdEnqu());
        $form = $this->createForm(InfosEnqueteType::class, $enquete, array( 'user' => $this->getUser(), 'status' => $etat, 'departements' => $enquete->getDepartements() ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();


            $response = $this->forward('Bilan_Social\Bundle\ImportCarriereBundle\Controller\DefaultController::importFichierCarriereAction');

            return $response;
        }
        return $this->render(self::config_routing_dispatcher['edit'], array('enquete' => $enquete, 'form' => $form->createView(), 'status' => $etat ));
    }
    public function newEnqueteAction(Request $request) {
        $etat = 'new';
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $collectivitesCreation = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($user, 0, 'Création', 0);
        $collectivitesSuppression = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteHistorisationMotif($user, 1, 'vide', 0);

        if(!empty($collectivitesCreation) || !empty($collectivitesSuppression)){
            // Blocage de l'action
            return $this->redirectToRoute('enquete_homepage');
        }

        $session = new Session();
        $session->remove('idEnqu');
        $idUtil = $this->getUser()->getIdUtil();
        $enquete = new Enquete();
        /* il est compliqué de faire un sous select avec un join sous doctrine, une premiere méthode en sql recupere les ids, la deuxieme en dql retourne les objets departements */
        $array_id_depa = $em->getRepository('CollectiviteBundle:Departement')->getDepartementsWithoutEnqueteByUtilisateurAndDroitForm($idUtil);
        $departements_no_enquete = $em->getRepository('CollectiviteBundle:Departement')->getDepartementByIdStr($array_id_depa);
        $form = $this->createForm(InfosEnqueteType::class, $enquete, array( 'user' => $this->getUser(), 'status' => $etat, 'departements' => $departements_no_enquete));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $departements = $form['departements']->getData()->getValues();
            $blReinitMdp = $form['reinitMdp']->getData();

            if(!empty($blReinitMdp)){
                $blReinitMdp = true;
            }else{
                $blReinitMdp = false;
            }
            $arrayDepartementsGroup = [];
            $arrayDepartementsAlone = [];
            $arrayDepartementsGroups = [];

            foreach($departements as $depa){
                $arrayCollecDepartementGroups = $depa->getGroups();
                if(!$arrayCollecDepartementGroups->isEmpty()){
                        foreach($arrayCollecDepartementGroups as $arrayGroup){
                            $arrayDepartementsGroups = $em->getRepository('CollectiviteBundle:Departement')->getDepartementByGroups($arrayGroup->getNmGroup());
                        if(!$this->in_array_r($arrayDepartementsGroups, $arrayDepartementsGroup)){
                            array_push($arrayDepartementsGroup, $arrayDepartementsGroups);
                        }
                    }
                }else{
                    array_push($arrayDepartementsAlone, $depa);
                }
            }

            if(!empty($arrayDepartementsGroup)){
                foreach($arrayDepartementsGroup as $arrayDepartementsByGroups){
                    $this->setSameEnquete($enquete,$arrayDepartementsByGroups,$blReinitMdp,$etat);
                }
            }

            if(!empty($arrayDepartementsAlone)){
                $this->setMultipleEnquete($enquete,$arrayDepartementsAlone,$blReinitMdp,$etat);
            }


            $response = $this->forward('Bilan_Social\Bundle\ImportCarriereBundle\Controller\DefaultController::importFichierCarriereAction');

            return $response;
        }

        return $this->render(self::config_routing_dispatcher['new'], array('enquete' => $enquete, 'form' => $form->createView(), 'status' => $etat));
    }
    public function setSameEnquete(Enquete $enquete,$departements,$blReinitMdp, $status){
            $em = $this->getDoctrine()->getManager();
            $campagne = $this->getMaCampagne();
            $depa_enqu = clone $enquete;
            foreach ($departements as $key => $departement) {

                if($enquete == null){
                    $enquete = $em->getRepository('EnqueteBundle:Enquete')->findEnqueteByDepartement($departement, $this->getMaCampagne());
                }


                $depa_enqu->setIdCamp($campagne->getIdCamp());
                $depa_enqu->setcampagne($campagne);
                $depa_enqu->setBlCloture(false);
                /* Set nm_anne */
                $depa_enqu->setNmAnne($campagne->getNmAnne());
                /* Set the current datetime */
                $depa_enqu->setDtCrea(new \DateTime());
                /* Set the current id user */
                $depa_enqu->setCdUtilcrea($this->getUser()->getUsername());
                /* Set status "Ouverte" */
                if($depa_enqu->getFgStat() == null){
                    $depa_enqu->setFgStat("0");
                }
                $depa_enqu->setCmDesc($depa_enqu->getCmDesc());
                $depa_enqu->setDtDebu($depa_enqu->getDtDebu());
                $depa_enqu->setLbEnqu($depa_enqu->getLbEnqu());
                $depa_enqu->addDepartement($departement);
                $depa_enqu->setBlReinitPassword($blReinitMdp);
                $departement->addEnquete($depa_enqu);
                $em->persist($depa_enqu);
                $em->flush();

                if($status === 'new'){
                    $session = new Session();
                    $session->set('idEnqu', $depa_enqu->getIdEnqu());
                    $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteByDepartement($departement);

                    $this->saveCreationEnqueteCollectivite($depa_enqu->getIdEnqu(),$collectivites);
                    if($blReinitMdp){
                        $this->nouveauMdp($collectivites);
                    }
                }

            }
        }
    public function setMultipleEnquete(Enquete $enqueteData,$departements,$blReinitMdp, $status){

        $em = $this->getDoctrine()->getManager();
        $campagne = $this->getMaCampagne();

        foreach ($departements as $key => $departement) {
            $enquete = new Enquete();

            $enquete->setIdCamp($campagne->getIdCamp());
            $enquete->setcampagne($campagne);
            $enquete->setBlCloture(false);
            /* Set nm_anne */
            $enquete->setNmAnne($campagne->getNmAnne());
            /* Set the current datetime */
            $enquete->setDtCrea(new \DateTime());
            /* Set the current id user */
            $enquete->setCdUtilcrea($this->getUser()->getUsername());
            /* Set status "Ouverte" */
            $enquete->setFgStat("0");
            $enquete->setCmDesc($enqueteData->getCmDesc());
            $enquete->setDtDebu($enqueteData->getDtDebu());
            $enquete->setLbEnqu($enqueteData->getLbEnqu());
            $enquete->setBlReinitPassword($blReinitMdp);
            $enquete->addDepartement($departement);
            $departement->addEnquete($enquete);
            $em->persist($enquete);
            $em->flush();

            $session = new Session();
            $session->set('idEnqu', $enquete->getIdEnqu());
            if($status === 'new'){


                $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteByDepartement($departement);
                $this->saveCreationEnqueteCollectivite($enquete->getIdEnqu(),$collectivites);
                 if($blReinitMdp){
                    $this->nouveauMdp($collectivites);
                }
            }


        }
    }
    public function importBcAction(Request $request){
        $response = $this->forward('Bilan_Social\Bundle\ImportCarriereBundle\Controller\DefaultController::importFichierCarriereAction');
        return $response;

    }
    public function saveCreationEnqueteCollectivite($idEnq,$coll){
            $em = $this->getDoctrine()->getManager();
            $query = '';
            foreach ($coll as $key => $value) {
                $query .= 'INSERT INTO enquete_collectivite (BL_BILASOCIVIDE, BL_BILASOCI, BL_RAST,BL_HAND,BL_GEPE,BL_GPEEC_PLUS,BL_APA,BL_CONS,BL_N4DS,BL_BASECARR,BL_DGCL,ID_ENQU,ID_COLL)
                 VALUES (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ' . $idEnq . ', ' . $value->getIdColl() . ');';
            }
            $stmt = $em->getConnection()->prepare($query);
            $stmt->execute();
            $em->flush();
    }
    protected function nouveauMdp($coll){
        $em = $this->getDoctrine()->getManager();
        foreach ($coll as $k => $v){
            $idColl = $v->getIdColl();
            $mdp = $this->generatePassword();
            $results = $em->getRepository('UserBundle:User')->findByCollectivite($idColl);
            $util = $results[0];
            $util->setLbPassTemp($mdp);
            if($util->getFgStat() != 1){
                $util->setFgStat(2);
            }
        }
        $em->flush();
    }
    protected function generatePassword($size = 8){
        $c = 1; // nombre de lettre capitale
        $n = 1; // nombre de chiffre
        $s = 1; // nombre de caractères spéciaux
        $l = $size - $c - $n - $s;

        $passwd = strtolower(md5(uniqid(rand())));
        $passwd = substr($passwd,2,$l);

        // liste des valeurs possibles pour chaque type de caractères
        $chars = "abcdefghijklmnopqrstuvwxyz";
        $caps = strtoupper($chars);
        $nums = "0123456789";
        $syms = "!@#$%^&*()-+?";

        $passwd .= self::select($caps, $c); // sélectionne aléatoirement les lettres majuscules
        $passwd .= self::select($nums, $n); // sélectionne aléatoirement les chiffres
        $passwd .= self::select($syms, $s); // sélectionne aléatoirement les caractères spéciaux
        $passwd = strtr(
            $passwd,
            'o0ODQGCiIl15Ss7',
            'BEFHJKMNPRTUVWX'
        );
        $passwd = str_shuffle($passwd);
        return $passwd;
    }
    private static function select($src, $l){
        for($i = 0; $i < $l; $i++){
            $passwd = substr($src, mt_rand(0, strlen($src)-1), 1);
        }
        return $passwd;
    }
    public function modifierAction(Request $request, $idEnq = null) {
        $session = new Session();

        $em = $this->getDoctrine()->getManager();
        $campagne = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        if($idEnq == null){
            $idEnq = $session->get('idEnqu');
        }
        $result = $em->getRepository('EnqueteBundle:Enquete')->findOneBy(array('idEnqu' => $idEnq));
        $form = $this->createForm(ParametrageEnqueteForm::class);

        if($request->isXmlHttpRequest()){


            $form = $this->createForm(ParametrageEnqueteForm::class);
            return $this->render('@Enquete/Enquete/modifier_ajax.html.twig', array(
                'form' => $form->createView(),
                'lbEnquete' => $result->getLbEnqu(),
                'nmAnne' => $result->getNmAnne(),
                'idEnqu' => $result->getIdEnqu(),

            ));
        }
    }
    public function cloturerAction($id){
        if($this->checkIsUserOwnerOf($id,'Enquete')){
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('EnqueteBundle:Enquete')->findBy(array('idEnqu' => $id));
            $enquete = $result[0];
            $enquete->setFgStat("2");
            $enquete->setDtClot(new \DateTime());
            try{
                $em->persist($enquete);
                $em->flush();
            } catch (Exception $ex) {
                $this->addFlash('error', $this->get('translator')->trans('erreur.enquete.flash'));
                return $this->redirectToRoute('enquete_homepage');
            }
            return $this->redirectToRoute('enquete_homepage');
        }else{
            return $this->redirectToRoute('enquete_homepage');
        }
    }
    public function ouvrirAction($id,$idCamp = null){
        if($this->checkIsUserOwnerOf($id,'Enquete')){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($user);
            $ouvrir = true;
            if(null != $idCamp){
                $parameters = array('idCamp' => $idCamp, 'utilisateur' => $user);
                //check si enquete avec idCamp existant
                $resEnq = $em->getRepository('EnqueteBundle:Enquete')->findEnqueteByCampagneAndCdg($parameters);
                $utilDroits = $em->getRepository('UserBundle:UtilisateurDroits')->findByUtilisateurCdg($utilCdg);
                if(count($resEnq) == count($utilDroits)){
                    $ouvrir = false;
                }
            }

            if($ouvrir){
                $result = $em->getRepository('EnqueteBundle:Enquete')->findBy(array('idEnqu' => $id));
                $enquete = $result[0];
                $enquete->setFgStat("0");
                $enquete->setDtClot(null);
                try{
                    $em->persist($enquete);
                    $em->flush();
                } catch (Exception $ex) {
                    $this->addFlash('error', $this->get('translator')->trans('erreur.enquete.flash'));
                    return $this->redirectToRoute('enquete_homepage');
                }
                $this->addFlash('notice', $this->get('translator')->trans('enqueteouverte.enquete.flash'));
            }else{
                $this->addFlash('notice',  $this->get('translator')->trans('enquetedejaouverte.enquete.flash'));
            }

            return $this->redirectToRoute('enquete_homepage');
        }else{
            return $this->redirectToRoute('enquete_homepage');
        }
    }
    public function generercsvAction($id){
        if($this->checkIsUserOwnerOf($id,'Enquete')){
            //$id = $request->get('id');
            $current_user = $this->getUser();
            $idUtil = $current_user->getIdUtil();
            //$idCdg = $current_user->getCdg()->getIdCdg();
            $droitBinary = DroitsEnum::MASK_READ_COLLECTIVITE;
            $droitToDecimal = bindec($droitBinary);

            $doctrineDatabaseConnection = $this->get('database_connection');
            $qb = 'SELECT c.LB_COLL as "Nom de la collectivité (Raison Sociale)", c.NM_SIRE as "Numéro de SIRET", u.LB_PASS_TEMP as "Mot de passe temporaire" '
                        . 'FROM utilisateur_cdg uc '
                        . 'JOIN utilisateur_droits ud ON ud.ID_UTILISATEUR_CDG = uc.ID_UTILISATEUR_CDG '
                        . 'JOIN cdg_departement cd ON cd.ID_CDG_DEPARTEMENT = ud.ID_CDG_DEPARTEMENT '
                        . 'JOIN departement d ON d.ID_DEPA = cd.ID_DEPA '
                        . 'JOIN collectivite c ON c.ID_DEPA = d.ID_DEPA '
                        . 'JOIN enquete_collectivite ec ON ec.ID_COLL = c.ID_COLL AND ec.ID_ENQU = '.$id.' '
                        . 'LEFT JOIN utilisateur u ON u.ID_COLL = c.iD_COLL '
                        . 'WHERE uc.ID_UTIL = '.$idUtil.' '
                        . 'AND u.LB_PASS_TEMP IS NOT NULL '
                        . 'AND CONV('.$droitBinary.', 2, 10) & ud.FG_DROITS = '.$droitToDecimal. '';
            try{

                $information = array(
                'filename' => "export_mot_de_passe_temporaire",

                'requete_sql' => $qb,

                'champ' => array('Nom de la collectivité (Raison Sociale)', 'Numéro de SIRET', 'Mot de passe temporaire'),
                );
               $conn = $this->container->get('database_connection');
               $results = $conn->query($information['requete_sql']);

               $handle = fopen('php://output', 'w+');

               fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
               ob_start();
               fputcsv($handle, $information['champ'], ';');

                //Champs
                while ($row = $results->fetch()) {
                    $tab = array();
                    foreach ($information['champ'] as $key => $value) {
                        array_push($tab, $row[$value]);
                    }
                    fputcsv($handle, $tab, ';');
                }

                fclose($handle);
                $buffer_size = ob_get_length();
                $buffer = ob_get_clean();
                ob_end_clean();
                $response = new Response();
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
                $response->headers->set('Content-Length', $buffer_size);
                $response->headers->set('Content-Disposition', 'attachment; filename="' . $information['filename'] . '.csv"');
                $response->setContent($buffer);
                return $response;

            }catch (\Exception $e) {

                error_log("Une erreur est surevnue lors de l'exécution de la requête ". $e);
                return $e->getMessage();
            }
        }else{
            return $this->redirectToRoute('enquete_homepage');
        }
    }
    public function LancerEnqueteUpdateMDP($idEnq){
        /*Au clique sur Lancer dans les enquetes, cette fonction permet de mettre a jour les contacts si une demande de reinitialisation des mots de passes à été demander à la création de l'enquête */
                $em = $this->getDoctrine()->getManager();
                $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteByUtilisateurForUpdateMdp($this->getUser());
                $query = '';
                foreach ($collectivites as $key => $collectivite) {
                    $passwordHash =  password_hash($collectivite->getLbPassTemp(), PASSWORD_BCRYPT);
                    $query .= 'UPDATE utilisateur SET PASSWORD = "'. $passwordHash .'" WHERE ID_COLL = ' . $collectivite->GetCollectivite()->getIdColl() . ';';
                }
                $stmt = $em->getConnection()->prepare($query);
                $stmt->execute();

    }
    public function lancerAction($id){
        if($this->checkIsUserOwnerOf($id,'Enquete')){
            $service = $this->container->get('password_controller');
            $em = $this->getDoctrine()->getManager();
            $enquete = $em->getRepository('EnqueteBundle:Enquete')->findOneByIdEnqu($id);
            $enquete->setFgStat("1");
            if($enquete->getBlReinitPassword() == 1){
                 $this->LancerEnqueteUpdateMDP($enquete->getIdEnqu());
            }



            try{
                $em->persist($enquete);
                $em->flush();
            } catch (Exception $ex) {
                $this->addFlash('error', $this->get('translator')->trans('erreur.enquete.flash'));
                return $this->redirectToRoute('enquete_homepage');
            }
            $this->addFlash('notice', $this->get('translator')->trans('enquetelancee.enquete.flash'));
            return $this->redirectToRoute('enquete_homepage');
        }else{
            return $this->redirectToRoute('enquete_homepage');
        }
    }
    public function archiverAction($id){
        if($this->checkIsUserOwnerOf($id,'Enquete')){
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('EnqueteBundle:Enquete')->findBy(array('idEnqu' => $id));
            $enquete = $result[0];
            $enquete->setFgStat("3");
            try{
                $em->persist($enquete);
                $em->flush();
            } catch (Exception $ex) {
                $this->addFlash('error', $this->get('translator')->trans('erreur.enquete.flash'));
                return $this->redirectToRoute('enquete_homepage');
            }
            return $this->redirectToRoute('enquete_homepage');
        }else{
            return $this->redirectToRoute('enquete_homepage');
        }
    }
    public function saveEnqueteCollectivite($data,$idEnq,$action,$coll){
        $em = $this->getDoctrine()->getManager();
        $enqCollArr = [];
        if('Ajouter' == $action){
            if(null == $data || empty($data)){
                foreach ($coll as $c){
                    $enqCollArr[$c['idColl']] = '0';
                }
            }else{
                $enqCollArr = $data;
            }
        }
        elseif ('Modifier' == $action) {
            foreach ($data as $key => $value){
                $k = explode('_',$key);

                if(is_numeric($k[0])){
                    if($value != '')
                        $enqCollArr[$k[0]][$k[1]] = $value;
                }
            }
        }
        if (count($enqCollArr) > 0) {
            foreach ($enqCollArr as $key => $value) {
                if (isset($value['idEnqucoll']) && null != $value['idEnqucoll']) {
                    $results = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->findOneBy(array('idEnqucoll' => $value['idEnqucoll']));
                    $enqColl = $results;
                }
                else {
                    $resEnq = $em->getRepository('EnqueteBundle:Enquete')->find($idEnq);
                    $resColl = $em->getRepository('CollectiviteBundle:Collectivite')->find($key);
                    $enqColl = new EnqueteCollectivite();
                    $enqColl->setEnquete($resEnq);
                    $enqColl->setCollectivite($resColl);
                }

                $enqColl->setBlBilasoci('0');
                $enqColl->setBlRast('0');
                $enqColl->setBlHand('0');
                $enqColl->setBlGepe('0');
                $enqColl->setBlGpeecPlus('0');
                $enqColl->setBlApa('0');
                $enqColl->setBlCons('0');
                $enqColl->setBlN4ds('0');
                $enqColl->setBlBasecarr('0');
                $enqColl->setBlDgcl('0');
                $enqColl->setBlBilasocivide('0');


                if ('0' != $value) {
                    foreach ($value as $k => $v) {
                        if ($k == 'blBilasoci' && $v == 'on') {
                            $enqColl->setBlBilasoci('1');
                        }
                        if ($k == 'blRast' && $v == 'on') {
                            $enqColl->setBlRast('1');
                        }
                        if ($k == 'blHand' && $v == 'on') {
                            $enqColl->setBlHand('1');
                        }
                        if ($k == 'blGepe' && $v == 'on') {
                            $enqColl->setBlGepe('1');
                        }
                        if ($k == 'blGpeecPlus' && $v == 'on') {
                            $enqColl->setBlGpeecPlus('1');
                        }
                        if ($k == 'blApa' && $v == 'on') {
                            $enqColl->setBlApa('1');
                        }
                        if ($k == 'blCons' && $v == 'on') {
                            $enqColl->setBlCons('1');
                        }
                        if ($k == 'blN4ds' && $v == 'on') {
                            $enqColl->setBlN4ds('1');
                        }
                        if ($k == 'blBasecarr' && $v == 'on') {
                            $enqColl->setBlBasecarr('1');
                        }
                        if ($k == 'blDgcl' && $v == 'on') {
                            $enqColl->setBlDgcl('1');
                        }
                        if ($k == 'blBilasocivide' && $v == 'on') {
                            $enqColl->setBlBilasocivide('1');
                        }
                    }
                }
                $em->persist($enqColl);
            }
        }
        try{
            $em->flush();
        } catch (Exception $ex) {
            return 'fail';
        }
        return 'ok';
    }
    public function saveEnqueteCollectiviteJsonAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $em->getConnection()->beginTransaction(); // suspend auto-commit
        $data = $request->get('data');
        //error_log($data);
        $response = new Response();
        try {

            $json_data = json_decode($data);
            $enqueteCollList = $json_data->enqueteCollList;
            $enqueteId = $json_data->idEnquete;
            $enquete = $em->getRepository('EnqueteBundle:Enquete')->findOneBy(array('idEnqu' => $enqueteId));
            error_log('Debut');

            foreach ($enqueteCollList as $enqueteColl) {
                $enquCollId = $enqueteColl->idEnquColl;
                $collId = $enqueteColl->idColl;
                $valeurStr = $enqueteColl->valeur;
                $valeurs = explode("|", $valeurStr);

                $enqColl = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->findOneBy(array('idEnqucoll' => $enquCollId));
                if($enqColl==null){
                    $enqColl = new EnqueteCollectivite();
                    $em->persist($enqColl);
                }
                if($enqColl->getCollectivite()==null){
                    $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneBy(array('idColl' => $collId));
                    $enqColl->setCollectivite($collectivite);
                }
                if($enqColl->getEnquete()==null){
                    $enqColl->setEnquete($enquete);
                }
                $enqColl->setBlBilasoci($valeurs[0]);
                $enqColl->setBlRast($valeurs[1]);
                $enqColl->setBlHand($valeurs[2]);
                $enqColl->setBlGepe($valeurs[3]);
                $enqColl->setBlGpeecPlus($valeurs[4]);
                $enqColl->setBlApa($valeurs[5]);
                $enqColl->setBlCons($valeurs[6]);
                $enqColl->setBlN4ds($valeurs[7]);
                $enqColl->setBlBasecarr($valeurs[8]);
                $enqColl->setBlBilasocivide($valeurs[9]);
                $enqColl->setBlDgcl($valeurs[10]);
            }

            error_log('before flush');

            $em->flush();
            $em->getConnection()->commit();

            error_log('commit ok"');

        } catch (Exception $e) {
            $em->getConnection()->rollBack();
            error_log("Error Message ". $e->getMessage(), 0);
            error_log("Error " . $e->getTraceAsString(), 0);
            $jsonReturn = "{" .
                "\"data\": \"" . "0" . "\"" .
                "}";

            $response->setContent($jsonReturn);
            return $response;
        }
        $jsonReturn = "{" .
            "\"data\": \"" . "1" . "\"" .
            "}";

        $response->setContent($jsonReturn);
        return $response;
    }
    public function getoptionsselectAction(Request $request){
        $type = $request->get('type');

        $optionsArr = [];
        $conditionsArr = array();

        $em = $this->getDoctrine()->getManager();

        if($type == 'blTypeColl'){
            $results = $em->getRepository('ReferencielBundle:RefTypeCollectivite')->findBy(array('blVali' => false));
            $optionsArr['type'] = 'select';
            foreach ($results as $res){
                $lb = $res->getLbTypeColl();
                array_push($optionsArr,$lb);
            }
            $conditionsArr = array(
                'égal à' => '==',
                'différent de' => '!='
            );
        }elseif($type == 'blDepa'){
            $user = $this->getUser();
            $optionsArr['type'] = 'select';
            if($user->hasRole('ROLE_ADMIN')){
                $departements = $em->getRepository('CollectiviteBundle:Departement')->findAll();
                foreach ($departements as $key => $dept){
                    $lb = $dept->getCdDepa().' - '.$dept->getLbDepa();
                    $idDepa = $dept->getIdDepa();
                    $optionsArr[$key]['departement']['libelle'] = $lb;
                    $optionsArr[$key]['departement']['idDepa'] = $idDepa;
                }
            }else{
                $arrayDepartements = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByUtilisateur($user);
                foreach ($arrayDepartements as $key => $departements){

                    $lb = $departements['cdDepa'] . ' - ' . $departements['lbDepa'];
                    $optionsArr[$key]['departement']['libelle'] = $lb;
                    $optionsArr[$key]['departement']['idDepa'] = $departements['idDepa'];
                }
            }
            $conditionsArr = array(
                'égal à' => '==',
                'différent de' => '!='
            );

        }
        elseif ($type == 'blNom' ||$type == 'blTele' || $type == 'blLibe' || $type == 'blCdPost' || $type == 'blLbVill' || $type == 'blCdInse' || $type == 'blSire' || $type == 'lbAdre') {
            $optionsArr['type'] = 'text';
            $conditionsArr = array(
                'égal à' => '==',
                'différent de' => '!=',
                'contient' => 'in',
                'commence par' => '^=',
            );
        }elseif($type == 'blNmStratColl' || $type == 'blNmPopuInse' || $type == 'blNbAgenContPerm' || $type == 'blNbAgenPerm' || $type == 'blNbAgenTitu' || $type == 'blNbAgenContNonPerm'){
            $optionsArr['type'] = 'text';
             $conditionsArr = array(
                'est supérieur à' => '>',
                'est inférieur à' => '<',
                'est supérieur ou égale à' => '>=',
                'est inférieur ou égale à' => '<='
            );
        }
        elseif ($type == 'blAffiCdg' || $type == 'blCtCdg' || $type == 'blChsct' || $type == 'blCollDgcl' || $type == 'cdg_is_authorized_by_collectivity' || $type == 'blSurclasDemo' || $type == 'blBilaSoci' || $type == 'blRass' || $type == 'blHand' || $type == 'blApa' || $type == 'blCons' || $type == 'blN4ds' || $type == 'blBaseCarr' || $type == 'blBilaSociVide' || $type == 'blGpee' || $type == 'blGpeecPlus') {
            $optionsArr['type'] = 'select';
            $optionsArr['0'] = 'Non';
            $optionsArr['1'] = 'Non renseigné';
            $optionsArr['2'] = 'Oui';
            $conditionsArr = array(
                'égal à' => '==',
                'différent de' => '!='
            );
        }
        elseif ($type == 'fgStat') {
            $optionsArr['type'] = 'select';
            $optionsArr['0'] = 'En cours de saisie';
            $optionsArr['1'] = 'Transmis';
            $optionsArr['2'] = 'Validé';
            $optionsArr['3'] = 'Non validé';
            $optionsArr['4'] = 'En cours de saisie suite à non validation';
            $optionsArr['5'] = 'Nouvelle transmission en attente de validation';
            $optionsArr['6'] = 'Non connecté';
            $optionsArr['7'] = 'Non saisie';
            $optionsArr['8'] = 'Saisie réinitialisée';
            $conditionsArr = array(
                'égal à' => '==',
                'différent de' => '!=',
            );
        }
        elseif ($type == 'blCourtier') {
            $optionsArr['type'] = 'select';
            $optionsArr['0'] = 'Sofaxis';
            $optionsArr['1'] = 'Gras savoye';
            $optionsArr['2'] = 'Siaci';
            $conditionsArr = array(
                'égal à' => '==',
                'différent de' => '!='
            );
        }

        $response = new Response();
        $response->setContent(json_encode(array($optionsArr,$conditionsArr)));

        return $response;
    }
    public function suiviAction(){
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        $camp = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        if ($camp == null) {
            return $this->redirectToRoute('homepage', array(), 301);
        }
        $departements = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByUtilisateur($current_user);
        $string_idDepa = '';
        $count = count($departements);
        foreach ($departements as $key => $departement) {
            $string_idDepa .= $departement['idDepa'] ;
            if($count - 1 !== $key){
                $string_idDepa .= ',';
            }
        }
        $enquetes = $em->getRepository('EnqueteBundle:Enquete')->getEnquetesOuverteByDepartementsAndUtilisateurAndDroit($this->getUser());

        if(!empty($enquetes)){

            $form = $this->createForm(ParametrageEnqueteForm::class);
            $relanceEntity = new Relance();
            $formRelance = $this->createForm(RelanceType::class, $relanceEntity);

            return $this->render('@Enquete/Enquete/suivi.html.twig', array(
                'form' => $form->createView(),
                'formRelance' => $formRelance->createView(),
            ));
        }else{
            return $this->render('@Enquete/Enquete/suivi.html.twig');
        }
    }
    public function relancerAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $idColl = $request->get('collectivite');
        $idEnqu = $request->get('idEnqu');
        $message = $request->get('message');
        $result = $em->getRepository('CollectiviteBundle:Collectivite')->GetContactPrincipal($idColl);
        if($result != null){
            $email = $result->getLbMail();
            //enregistrer dans table relance
            $resRelance = $em->getRepository('CampagneBundle:Relance')->findBy(array('enquete' => $idEnqu,'collectivite' => $idColl));
            if(!empty($resRelance)){
                $relance = $resRelance[0];
            }else{
                $enquete = $em->getRepository('EnqueteBundle:Enquete')->find($idEnqu);
                $coll = $em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);
                $relance = new Relance();
                $relance->setEnquete($enquete);
                $relance->setCollectivite($coll);
            }

            try{
                if (null != $message && $email != null) {
                    $relance->setDtDernrela(new \DateTime());

                    $relance->setLbMessrela($message);

                    $em->persist($relance);
                    $em->flush();

                    $msg = (new \Swift_Message('Bilan Social - Relance enquête'))
                            ->setFrom($this->getParameter('mailer_user'))
                            ->setTo($email)
                            ->setBody($message, 'text/html');
                    try {
                        $this->get('mailer')->send($msg);
                        $jsonContent = json_encode('done');
                        $this->addFlash('notice', $this->get('translator')->trans('mailrelanceenvoye.enquete.flash'));
                        $debug = $this->container->getParameter('debug');
                        if($debug){
                            $this->addFlash('notice', "a l'adresse suivante " . $email);
                        }
                    } catch (Exception $ex) {
                        $jsonContent = 'not_sent';
                    }


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
    public function showBsApaAction($userId,$idColl,$droit){
        $session = $this->get('session');
        $session->clear();
        $session->set('user_id', $userId);
        $session->set('coll_id', $idColl);
        $session->set('droit', $droit);

        return $this->redirectToRoute('social_index', array('from' => 'cdg-apa'));
    }
    public function showBsConsAction($userId,$idColl,$return = null){

        $session = $this->get('session');
        $session->clear();
        $session->set('user_id', $userId);
        $session->set('coll_id', $idColl);
        $session->set('return', $return);

        return $this->redirectToRoute('social_index', array('from' => 'cdg-cons'));
    }
    public function removeCdgSessionAction(){
        $session = $this->get('session');
        $session->remove('user_id');
        $session->remove('user_siret');
        $session->remove('coll_id');
        $session->remove('droit');
        if($session->get('return') == 'accueil'){
            $session->remove('return');
            return $this->redirectToRoute('homepage');
        }
        if($session->get('return') == 'suivienquete'){
            $session->remove('return');
            return $this->redirectToRoute('enquete_suivi');
        }

        return $this->redirectToRoute('enquete_suivi');
    }
    public function importMasseCollectiviteAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        if($current_user->hasRole('ROLE_CDG')){
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteByUtilisateur($current_user);
        }elseif($current_user->hasRole('ROLE_ADMIN')){
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->findAll();
        }else{
            $collectivites = null;
        }


        $siretColl = [];
        $arrSirets = [];
        $infoCollectivites = [];
        $arrSirets['imp'] = [];
        foreach ($collectivites as $coll){
            if($current_user->hasRole('ROLE_CDG')){
                $siretColl[] = $coll['nmSire'];
            }elseif($current_user->hasRole('ROLE_ADMIN')){
                $siretColl[] = $coll->getNmSire();
            }
        }
        $file = $request->files->get('file');
        if('csv' == $file->getClientOriginalExtension()){
            $pathname = $file->getPathName();

            if (($handle = fopen($pathname, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    for ($c = 0; $c < $num; $c++) {
                        if (in_array($data[$c], $siretColl)) {
                            if (!in_array($data[$c], $arrSirets['imp'])) {
                                $arrSirets['imp'][] = $data[$c];
                            }
                            //$siretImportArr[] = $data[$c];
                        }else{
                            $arrSirets['err'][] = $data[$c];
                            //$siretErrors[] = $data[$c];
                        }
                    }
                }
                fclose($handle);
            }
        }
        else {
            return  new JsonResponse(array('erreur' => true, 'message' => $this->get('translator')->trans('erreurtypedefichier.enquete.flash')));

        }



        if(empty($arrSirets['err'])){
            foreach ($arrSirets['imp'] as $siret){
                foreach ($collectivites as $coll){
                    if($current_user->hasRole('ROLE_CDG')){
                        if($coll['nmSire'] == $siret){
                            $infoCollectivites[] = array(
                                'nmSire' => $siret,
                                'blSurclasDemo' => $coll['blSurclasDemo'],
                                'nmStratColl' => $coll['nmStratColl'],
                                'blAffiColl' => $coll['blAffiColl'],
                                'blCtCdg' => $coll['blCtCdg'],
                                'blChsct' => $coll['blChsct'],
                                'idColl' => $coll['idColl']
                            );
                        }
                    }elseif($current_user->hasRole('ROLE_ADMIN')){
                          if($coll->getNmSire() == $siret){
                            $infoCollectivites[] = array(
                                'nmSire' => $siret,
                                'blSurclasDemo' => $coll->getBlSurclasDemo(),
                                'nmStratColl' => $coll->getNmStratColl(),
                                'blAffiColl' => $coll->getBlAffiColl(),
                                'blCtCdg' => $coll->getBlCtCdg(),
                                'blChsct' => $coll->getBlChsct(),
                                'idColl' => $coll->getIdColl()
                            );
                        }
                    }
                }
            }
        }else{
            $infoCollectivites['code'] = 'err';
            $infoCollectivites['sirets'] = $arrSirets['err'];
        }

        $response = new JsonResponse($infoCollectivites);

        return $response;
    }
    public function ajaxGetEnqueteCollectiviteAction(Request $request) {

        $response = new StreamedResponse();

        $filtres = $request->get('filtres');
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        $session = new Session();
        $idEnq = $session->get('idEnqu');

        $collectivites = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->getEnqueteCollectiviteModifier($idEnq, $current_user, $filtres);

        $result = array(
            'data' => $collectivites
        );

        $content_length = mb_strlen(json_encode($result), '8bit');
        $response->setCallback(function () use ($result) {

            //error_log('fin ajax');

            echo json_encode($result);
            flush();
        });
        $response->send();
        //$response =  new JsonResponse($result);
        $response->headers->set('Content-Length', $content_length);
        return $response;
    }
    public function ajaxSuiviEnqueteAction(Request $request) {
        $filtres = $request->get('filtres');
        $em = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();

        $camp = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();

        $departements = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByUtilisateur($current_user);
        $string_idDepa = '';
        $count = count($departements);
        foreach ($departements as $key => $departement) {
            $string_idDepa .= $departement['idDepa'] ;
            if($count - 1 !== $key){
                $string_idDepa .= ',';
            }
        }
        $enquetes = $em->getRepository('EnqueteBundle:Enquete')->getEnquetesOuverteByDepartementsAndUtilisateurAndDroit($this->getUser());
        $tab_id_enq = array();

        foreach ($enquetes as $enquete){
            array_push($tab_id_enq, $enquete->getIdEnqu());
        }
        $collectivites = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->getSuiviCollectivite($tab_id_enq, $current_user, $filtres);

        return new JsonResponse(array('data' => $collectivites));
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
        }
        else {
            $response->setContent('empty');
        }
        return $response;
    }
    public function getCurrentProgressionEnqueteAction(){


       $em = $this->getDoctrine()->getManager();
       $cdgDepartement = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByCdgUtilisateur($this->getUser());
       $number_coll = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteByUtilisateurAndCdgDepartementCount($this->getUser(),$cdgDepartement);

       return new JsonResponse($number_coll);




    }
    public function gestionEnqueteAdminAction()
    {

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
        $stmt->closeCursor();

        return $this->render('@Enquete/Enquete/index_admin.html.twig',
            array(
                'enquetes_ouvertes' => $array_enquetes_ouvertes,
                'enquetes_lancees' => $array_enquetes_lancees,
                'enquetes_clotures' => $array_enquetes_clotures,
                'enquetes_archivees' => $array_enquetes_archivees
            )
        );
    }
    public function autorisationClotureAction(Request $request){

        $array_enquetes = $request->get('idEnqu');

        $em = $this->getDoctrine()->getManager();
        $enquetes = $em->getRepository('EnqueteBundle:Enquete')->findBy(array('idEnqu' => $array_enquetes));
        $etat = 'erreur';
        foreach ($enquetes as $key => $value){
            $blCloture = false;
            if($value->getBlCloture() === false){
                $blCloture = true;
            }
            $value->setBlCloture($blCloture);
            $em->persist($value);
        }
        try{
            $em->flush();
            $this->addFlash('notice', 'Les autorisations ont été modifiées avec succès.');
            $etat = 'done';
        } catch (Exception $ex) {
            $this->addFlash('error', $this->get('translator')->trans('erreur.enquete.flash'));
        }


        return new JsonResponse($etat);

    }
    public function SwitchCdgToColSaisEnquAction($id){

        $em = $this->getDoctrine()->getManager();
        $Collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($id);

        $session = $this->get('session');
        $session->set('coll_id', $Collectivite -> getIdColl());
        $session->set('username', $Collectivite -> getNmSire());

        return $this->redirectToRoute('bilan_social_homepage');
    }
}
