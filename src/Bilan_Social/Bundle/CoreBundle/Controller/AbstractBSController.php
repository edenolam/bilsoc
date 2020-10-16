<?php

namespace Bilan_Social\Bundle\CoreBundle\Controller;

use Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite;
use Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite;
use Bilan_Social\Bundle\FileManagerBundle\Services\FileManager;
use Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent;
use Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent;
use Bilan_Social\Bundle\ActualiteBundle\Entity\Actualite;
use Bilan_Social\Bundle\FaqBundle\Entity\Question;
use Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailCdg;
use Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailInterneAppliCdg;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\Exception\Exception;
use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
use Bilan_Social\Bundle\ApaBundle\Enums\InformationCollectiviteEnum;
use Bilan_Social\Bundle\BilanSocialBundle\Entity\InitBilanSocial;
use Bilan_Social\Bundle\EnqueteBundle\Entity\EnqueteCollectivite;
use Bilan_Social\Bundle\BilanSocialBundle\Entity\HistoriqueBilanSocial;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\importSiretHistorisation;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueEchange;
use ZipArchive;
USE PDO;
use Bilan_Social\Bundle\CollectiviteBundle\Form\ImportFileHIstorisationSiretType;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
/**
 * Class AbstractBSController
 * Classe à utiliser en tant qu'ancetre des Controlleurs de l'application BS
 * Cette classe offre un accès simplifié à:
 *   - l'EntityManager
 *   - la connexion BDAL rattachée à l'EM
 *   - des méthodes permettant de savoir si l'utilisateur courant est ADMIN / CDG
 *
 * @package Bilan_Social\Bundle\CoreBundle\Controller
 */
class AbstractBSController extends Controller
{

    private $em;
    private $dataWellEmPile = array();
    private $dataWellBatchsEmPile = array();
    private $dataWellBsltmEmPile = array();
    private $logger;
    private $fileManager;
    private $monEnqueteCollectiviteActive;
    private $maCollectivite;
    private $monCdg;
    private $monBilanSocialConsolide;
    private $monEnquete;
    private $maCampagne;
    private $canWrite;

    protected function setEM($em) {
        $this->em = $em;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|EntityManager
     */
    protected function getEntityManager(): EntityManager
    {
        if ($this->em == null) {
            $this->em = $this->getDoctrine()->getManager();
        }
        return $this->em;
    }

    protected function getBSFileManager(): FileManager
    {
        if ($this->fileManager == null) {
            $this->fileManager = $this->get('file_manager.file_manager');
        }
        return $this->fileManager;
    }

    protected function getDataWellConnection($nm_annee,$options=null){
        $annee_em = null;
        if(isset($this->dataWellEmPile[$nm_annee])){
            $annee_em = $this->dataWellEmPile[$nm_annee];
        }else{
            $serviceConnection = $this->get('bdd_connection_preparator');
            $annee_em = $serviceConnection->getDoctrineConnection($nm_annee);
            $this->dataWellEmPile[$nm_annee] = $annee_em;
        }
        return $annee_em;        
    }
    protected function getDataWellBatchsConnection($nm_annee,$options=null){
        $batchs_annee_em = null;
        if(isset($this->dataWellBatchsEmPile[$nm_annee])){
            $batchs_annee_em = $this->dataWellBatchsEmPile[$nm_annee];
        }else{
            $serviceConnection = $this->get('bdd_connection_preparator');
            $batchs_annee_em = $serviceConnection->getSqlBatchsDoctrineConnection($nm_annee);
            $this->dataWellBatchsEmPile[$nm_annee] = $batchs_annee_em;
        }
        return $batchs_annee_em;        
    }
    protected function getDataWellBsltmConnection($nm_annee,$options=null){
        $bsltm_annee_em = null;
        if(isset($this->dataWellBsltmEmPile[$nm_annee])){
            $bsltm_annee_em = $this->dataWellBsltmEmPile[$nm_annee];
        }else{
            $serviceConnection = $this->get('bdd_connection_preparator');
            $bsltm_annee_em = $serviceConnection->getSqlBsltmDoctrineConnection($nm_annee);
            $this->dataWellBsltmEmPile[$nm_annee] = $bsltm_annee_em;
        }
        return $bsltm_annee_em;        
    }

    protected function getDataWellBsltm($nm_annee,$bsltm=null){
        $bsltm = $bsltm!=null ? $bsltm : $this->get("long_task_manager");
        $bsltm_config_annees = $this->getFromConfigFile('data_weel_bsltm');
        $bsltm_config_annee = isset($bsltm_config_annees[$nm_annee]) ? $bsltm_config_annees[$nm_annee] : null;
        if($bsltm_config_annee!=null){
            $em_annee = $this->getDataWellConnection($nm_annee);
            $bsltm->hydrate($bsltm_config_annee,null,$em_annee);
        }else{
            $bsltm = null;
        }
        return $bsltm;
    }
    /**
     * @return \Doctrine\DBAL\Connection
     */
    protected function getDBALConnection(): Connection
    {
        return $this->getEntityManager()->getConnection();
    }

    /**
     * Un utilisateur est-il connecté
     * @return bool
     */
    protected function isUserConnected(): bool
    {
        return $this->getUser() != null;
    }

    /**
     * L'utilisateur connecté à les droits d'écriture
     * @return bool
     */
    protected function isUserCanWrite(): bool
    {
        $this->canWrite = true;
        /* verification quand role = CDG si le CDG a les droits en écriture sur l enquete */
            if($this->isUserCDG()){
                $user_cdg = $this->getEntityManager()->getRepository('UserBundle:UtilisateurCdg')->findByUtilisateur($this->getUser());
                $check_can_write = $this->getEntityManager()->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectivite($this->getMaCollectivite()->getIdColl(), $user_cdg);
                if(!empty($check_can_write)){
                    if((($check_can_write['fgDroits'] & bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE)) === bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE))){
                       $this->canWrite = true;
                    }else{
                       $this->canWrite = false;
                    }

                }
            }
            return $this->canWrite;
    }

    /**
     * L'utilisateur connecté est-il Administrateur
     * @return bool
     */
    protected function isUserAdmin(): bool
    {
        return $this->getUser() != null && $this->getUser()->hasRole('ROLE_ADMIN');
    }

    /**
     * L'utilisateur connecté est-il CDG
     * @return bool
     */
    protected function isUserCDG(): bool
    {
        return $this->getUser() != null && $this->getUser()->hasRole('ROLE_CDG');
    }

    /**
     * L'utilisateur connecté est-il une collectivité
     * @return bool
     */
    protected function isUserCollectivite(): bool
    {
        return $this->getUser() != null && $this->getUser()->hasRole('ROLE_COLLECTIVITY');
    }

    protected function getMonCDG()
    {
        if ($this->isUserCDG() && $this->monCdg == null) {
            $this->monCdg = $this->getEntityManager()->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($this->getUser());
        }
        return $this->monCdg;
    }

    protected function getMonEnqueteCollectiviteActive() {

        if ($this->monEnqueteCollectiviteActive == null && !$this->isUserAdmin()) {
            $idColl = null;
            $session = $this->get('session');
            if (null == $session->get('coll_id')) {
                $coll = $this->getUser()->getCollectivite();
                if ($coll == null) {
                    throw new NotFoundHttpException($this->get('translator')->trans('nocollectivite.consolide.exception'));
                }
                $idColl = $coll->getIdColl();
            }
            else {
                // Chargement de la collectivité simulée
                $idColl = $session->get('coll_id');
            }
            $campagne = $this->getMaCampagne();
            $enquete = $this->getMonEnquete();
            $this->monEnqueteCollectiviteActive = $this->getEntityManager()->getRepository('EnqueteBundle:EnqueteCollectivite')->getEnqueteCollectiviteActive($idColl, $campagne->getIdCamp(), $enquete->getIdEnqu());
            if ($this->monEnqueteCollectiviteActive == null) {
                throw new NotFoundHttpException($this->get('translator')->trans('noenqueteactive.consolide.exception'));
            }
        }
        return $this->monEnqueteCollectiviteActive;
    }

    protected function getMaCollectivite($idColl = null) {
        if($idColl !== null){
            $this->maCollectivite =  $this->getEntityManager()->getRepository('CollectiviteBundle:Collectivite')->find($idColl);
        }else{
            if ($this->maCollectivite == null && !$this->isUserAdmin()) {

                $session = $this->get('session');

                if (null == $session->get('coll_id')) {

                    $this->maCollectivite = $this->getUser()->getCollectivite();
                }else {
                    // Chargement de la collectivité simulée
                    $idColl = $session->get('coll_id');
                    $this->maCollectivite =  $this->getEntityManager()->getRepository('CollectiviteBundle:Collectivite')->find($idColl);
                }
            }
        }

        return $this->maCollectivite;
    }

    protected function getMonBilanSocialConsolide(bool $createIfNotExist = true, $annee_camp = null) {
        $bsc = $this->monBilanSocialConsolide;
        $current_campagne = $this->getMaCampagne();
        if($annee_camp!=null && $current_campagne!=null && $current_campagne->getNmAnne()>$annee_camp){
            $bsc = $this->getMonBilanSocialConsolideAnnee($createIfNotExist, $annee_camp);
        }
        else if ($this->monBilanSocialConsolide == null) {
            $monEnquete = $this->getMonEnquete();
            $maCollectivite = $this->getMaCollectivite();
            if($monEnquete!=null && $maCollectivite!=null){
                $this->monBilanSocialConsolide = $this->getEntityManager()->getRepository('ConsoBundle:BilanSocialConsolide')
                                                    ->findOneByActif($maCollectivite->getIdColl(),
                                                                    $monEnquete->getIdEnqu());
                $cdUtil = $this->getUser()->getUsername();
                if ($this->monBilanSocialConsolide == null && $createIfNotExist) {
                    $this->monBilanSocialConsolide = new BilanSocialConsolide();
                    $this->monBilanSocialConsolide->setEnquete($monEnquete);
                    $this->monBilanSocialConsolide->setCollectivite($maCollectivite);
                    $this->monBilanSocialConsolide->setQuestionCollectiviteConsolide($this->GetMonQuestionnaireAction());
                    $this->monBilanSocialConsolide->setFgStat(0);
                    $this->monBilanSocialConsolide->setDtCrea(new \DateTime('NOW'));
                    $this->monBilanSocialConsolide->setCdUtilcrea($cdUtil);
                }
                $bsc = $this->monBilanSocialConsolide;
            }
        }
        return $bsc;//$this->monBilanSocialConsolide;
    }

    protected function getMonBilanSocialConsolideAnnee(bool $createIfNotExist = true,$annee_camp = null) {
        $bsc = $this->monBilanSocialConsolide;
        if ($annee_camp == null) {
           $bsc = $this->getMonBilanSocialConsolide($createIfNotExist, $annee_camp);
        }else{
            $maCollectivite = $this->getMaCollectivite();
            $id_coll = $maCollectivite->getIdColl();
            $serviceConnection = $this->get('bdd_connection_preparator');
            $em =  $serviceConnection->getDoctrineConnection($annee_camp);
            $bsc = $em->getRepository('ConsoBundle:BilanSocialConsolide')
            ->findLastOneByActif($id_coll, $annee_camp);
        }
        return $bsc;//$this->monBilanSocialConsolide;
    }

    protected function getBilanSocialConsolide($id_coll, $id_enqu, $anneCamp = null) {

        $em = $this->getEntityManager();
        $campagne = $this->getMaCampagne();
        $annee_campagne = $campagne!=null ? $campagne->getNmAnne() : null;
        if($anneCamp!=null && ($annee_campagne==null || $annee_campagne>$anneCamp)){
            $serviceConnection = $this->get('bdd_connection_preparator');
            $em =  $serviceConnection->getDoctrineConnection($anneCamp);
        }
        $bilanSocialConsolide = $em->getRepository('ConsoBundle:BilanSocialConsolide')
            ->findOneByActif($id_coll,$id_enqu, $anneCamp);
        return $bilanSocialConsolide;
    }

    protected function getMonEnquete($collectivite = null) {

        if ($this->monEnquete == null) {
            if($collectivite == null){
                $this->monEnquete = $this->getEntityManager()->getRepository('EnqueteBundle:Enquete')->getEnqueteActive($this->getMaCollectivite(), $this->getMaCampagne());
            }else{
                $this->monEnquete = $this->getEntityManager()->getRepository('EnqueteBundle:Enquete')->getEnqueteActive($collectivite, $this->getMaCampagne());
            }
        }
        return $this->monEnquete;
    }

    protected function getMaCampagne() {
        if ($this->maCampagne == null) {
            $this->maCampagne = $this->getEntityManager()->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        }
        return $this->maCampagne;
    }

    public function getCurrentCampagne(){
        return $this->getEntityManager()->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
    }
    public function getCurrentAnneeCampagne(){
        $current_campagne = $this->getCurrentCampagne();
        return $current_campagne!=null ? $current_campagne->getNmAnne() : null;
    }
    
    protected function getLogger(){
        if ($this->logger == null) {
            $this->logger = $this->get('logger');
        }
        return $this->logger;
    }

    protected function logMessage($log_message,$log_level = 'info'){
        $logger = $this->getLogger();
        $log_level = method_exists($logger, $log_level) ? $log_level : 'info';
        $logger->$log_level(get_class($this).':'.__FUNCTION__.' - '.$log_message);
    }
    protected function saveAndUnlockSession($request=null,$force_not_xhr=false){
        if($request!=null){
            if($request->isXmlHttpRequest() || $force_not_xhr==true){
                $this->get('session')->save();
            }
        }else{
            $this->get('session')->save();
        }
    }

    public function generateCsvAction(Request $request) {
        $information = $request->get('information');

        $information = json_decode($information, true);

        $conn = $this->container->get('database_connection');
        $results = $conn->query($information['requete_sql']);
            $response = new Response();
            $handle = fopen('php://output', 'w+');
            ob_start();
            fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
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
            $content = ob_get_clean();
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="' . $information['filename'] . '.csv"');
            $response->setContent($content);

            return $response;
    }
    public function generatePasswordAndUpdateMdp($collectivites){


        $em = $this->getDoctrine()->getManager();
        foreach ($collectivites as $k => $v){

            $mdp = $this->generatePassword();
            $results = $em->getRepository('UserBundle:User')->findByCollectivite($v);
            $util = $results[0];
            $util->setLbPassTemp($mdp);
            $passwordHash =  password_hash($mdp, PASSWORD_BCRYPT);
            $util->setPassword($passwordHash);

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

    public function csvPreparAction(Request $request){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $user_cdg = $em->getRepository('UserBundle:UtilisateurCdg')->findByUtilisateur($user);

        $UtilisateurDroits = $em->getRepository('UserBundle:UtilisateurDroits')->getDroitByCdg($user_cdg);
        $idCdgDepartement = "";
        foreach ($UtilisateurDroits as $key => $value) {
            $idCdgDepartement .= $value->getCdgDepartement()->getIdCdgDepartement();
            if ($value !== end($UtilisateurDroits)) {
                $idCdgDepartement .= ',';
            }
        }
        $enquetes = $em->getRepository('EnqueteBundle:Enquete')->getEnquetesOuverteByDepartementsAndUtilisateurAndDroit($this->getUser());


        $collectivites =  $request->get('listIds');
        $nameCsv =  $request->get('button_sender');

        if($nameCsv == 'export-mdp-temp'){
            $collectivite_autorise = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectiviteByCdg($user_cdg,$collectivites);
            $departement_exclus = $em->getRepository('CollectiviteBundle:Collectivite')->getNonDroitsSurCollectiviteByCdg($user_cdg,$collectivites);
            $departements = array_column($departement_exclus, "lbDepa");
            $collectivites = array_column($collectivite_autorise, "idColl");

            if(!empty($departement_exclus)){
                $departements_string = implode(', ', $departements);
            }

        }

        $array_nom_de_colonne_export = array();
        $array_columns_to_filter =  $request->get('listeColumns') ? $request->get('listeColumns') : array();

        if(!empty($collectivites)){


                $selectQuery = "SELECT ";
                $selectQuery.= "contact.LB_MAIL as 'Mail Contact principal', ";
                $selectQuery.= "u.DT_LASTCONN as 'Date de dernière connection' ";

                array_push($array_nom_de_colonne_export, 'Mail Contact principal');
                array_push($array_nom_de_colonne_export, 'Date de dernière connection');
                if($nameCsv !== 'export-mdp-temp'){
                    if (in_array('fgStat', $array_columns_to_filter)) {
                       $selectQuery.= ", (CASE
                            WHEN u.DT_LASTCONN IS NULL AND (COUNT(bsa.ID_BILASOCIAGEN) = 0 OR COUNT(bsc.ID_BILASOCICONS) = 0) AND (MAX(enq.FG_STAT) NOT IN(1,2) OR MAX(enq.FG_STAT) IS NULL)  THEN 'Non connecté '
                            WHEN MAX(enq.FG_STAT) = 0 THEN 'En cours de saisie'
                            WHEN MAX(enq.FG_STAT) = 1 THEN 'Transmis'
                            WHEN MAX(enq.FG_STAT) = 2 THEN 'Validé'
                            WHEN MAX(enq.FG_STAT) = 3 THEN 'Non validé'
                            WHEN MAX(enq.FG_STAT) = 4 THEN 'En cours de saisie suite à non validation'
                            WHEN MAX(enq.FG_STAT) = 8 THEN 'Saisie reinitialisée'
                            WHEN MAX(enq.FG_STAT) = 5 THEN 'Nouvelle transmission en attente de validation'
                            WHEN MAX(enq.FG_STAT) = 7 THEN 'Non saisie'
                            ELSE '' END)  as 'Etat de saisie' ";
                        array_push($array_nom_de_colonne_export, 'Etat de saisie');
                    }

                    if (in_array('blTypeColl', $array_columns_to_filter)) {
                        $selectQuery.= " , type.LB_TYPE_COLL as 'Type de collectivité' ";
                        array_push($array_nom_de_colonne_export, 'Type de collectivité');
                    }
                    if (in_array('lbPassTemp', $array_columns_to_filter)) {
                        $selectQuery .= " , u.LB_PASS_TEMP as 'Mot de passe temporaire' ";
                        array_push($array_nom_de_colonne_export, 'Mot de passe temporaire');
                    }
                    if (in_array('blSurclasDemo', $array_columns_to_filter)) {
                        $selectQuery.= " , BL_SURCLAS_DEMO as 'Sur-classement démographique' ";
                        array_push($array_nom_de_colonne_export, 'Sur-classement démographique');
                    }
                    if (in_array('blLibe', $array_columns_to_filter)) {
                        $selectQuery.= " , `LB_COLL` as 'Libellé' ";
                        array_push($array_nom_de_colonne_export, 'Libellé');
                    }
                    if (in_array('blSire', $array_columns_to_filter)) {
                        $selectQuery.= " ,`NM_SIRE` as 'Siret' ";
                        array_push($array_nom_de_colonne_export, 'Siret');
                    }
                    if (in_array('blAffiCdg', $array_columns_to_filter)) {
                       $selectQuery.= ", (CASE WHEN BL_AFFI_COLL = 1 THEN 'Oui' WHEN BL_AFFI_COLL = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Affiliation CDG' ";
                       array_push($array_nom_de_colonne_export, 'Affiliation CDG');
                    }
                    if (in_array('blDepa', $array_columns_to_filter)) {
                        $selectQuery.= " , depa.LB_DEPA as 'Departement' ";
                        array_push($array_nom_de_colonne_export, 'Departement');
                    }
                    if (in_array('blCdPost', $array_columns_to_filter)) {
                        $selectQuery.= " , `CD_POST` as 'Code postal' ";
                        array_push($array_nom_de_colonne_export, 'Code postal');
                    }
                    if (in_array('blLbVill', $array_columns_to_filter)) {
                        $selectQuery.= " , `LB_VILL` as 'Ville' ";
                        array_push($array_nom_de_colonne_export, 'Ville');
                    }
                    if (in_array('blCtCdg', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN BL_CT_CDG = 1 THEN 'Oui' WHEN BL_CT_CDG = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Rattachement au comité technique' ";
                        array_push($array_nom_de_colonne_export, 'Rattachement au comité technique');
                    }
                    if (in_array('blCollDgcl', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN BL_COLL_DGCL = 1 THEN 'Oui' WHEN BL_COLL_DGCL = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Echantillon DGCL' ";
                        array_push($array_nom_de_colonne_export, 'Echantillon DGCL');
                    }
                    if (in_array('cdg_is_authorized_by_collectivity', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN c.cdg_is_authorized_by_collectivity = 1 THEN 'Oui' WHEN c.cdg_is_authorized_by_collectivity = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'CDG autorisé à prendre la place' ";
                        array_push($array_nom_de_colonne_export, 'CDG autorisé à prendre la place');
                    }
                    if (in_array('blSurclasDemo', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN BL_SURCLAS_DEMO = 1 THEN 'Oui' WHEN BL_SURCLAS_DEMO = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Sur-classement démographique' ";
                        array_push($array_nom_de_colonne_export, 'Sur-classement démographique');
                    }
                    if (in_array('blChsct', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN BL_CHSCT = 1 THEN 'Oui' WHEN BL_CHSCT = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'CHSCT propre à la collectivité' ";
                        array_push($array_nom_de_colonne_export, 'CHSCT propre à la collectivité');
                    }
                    if (in_array('blLbAdresse', $array_columns_to_filter)) {
                        $selectQuery.= " , `LB_ADRE` as 'Adresse' ";
                        array_push($array_nom_de_colonne_export, 'Adresse');
                    }

                    if (in_array('blCdInse', $array_columns_to_filter)) {
                        $selectQuery.= " , `CD_INSE` as 'Code INSE' ";
                        array_push($array_nom_de_colonne_export, 'Code INSE');
                    }
                    if (in_array('blNmPopuInse', $array_columns_to_filter)) {
                        $selectQuery.= " , `NM_POPU_INSE` as 'Population totale INSEE' ";
                        array_push($array_nom_de_colonne_export, 'Population totale INSEE');
                    }
                    if (in_array('blNmStratColl', $array_columns_to_filter)) {
                        $selectQuery.= " , `NM_STRAT_COLL` as 'Strate de sur-classement' ";
                        array_push($array_nom_de_colonne_export, 'Strate de sur-classement');
                    }
                    if (in_array('blTele', $array_columns_to_filter)) {
                        $selectQuery.= " , contact.LB_TELE as 'Téléphone' ";
                        array_push($array_nom_de_colonne_export, 'Téléphone');
                    }
                    if (in_array('blNom', $array_columns_to_filter)) {
                        $selectQuery.= " , contact.LB_NOM as 'Nom du contact' ";
                        array_push($array_nom_de_colonne_export, 'Nom du contact');
                    }

                        $selectQuery.= " , (CASE WHEN ec.BL_BILASOCIVIDE = 1 THEN 'Oui' WHEN ec.BL_BILASOCIVIDE = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Bilan social vide' ";
                        array_push($array_nom_de_colonne_export, 'Bilan social vide');

                        $selectQuery.= " , (CASE WHEN ec.BL_BILASOCI = 1 THEN 'Oui' WHEN ec.BL_BILASOCI = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Bilan social' ";
                        array_push($array_nom_de_colonne_export, 'Bilan social');

                    if (in_array('blRass', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN ec.BL_RAST = 1 THEN 'Oui' WHEN ec.BL_RAST = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'RASSCT' ";
                        array_push($array_nom_de_colonne_export, 'RASSCT');
                    }
                    if (in_array('blHand', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN ec.BL_HAND = 1 THEN 'Oui' WHEN ec.BL_HAND = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'HANDITORIAL' ";
                        array_push($array_nom_de_colonne_export, 'HANDITORIAL');
                    }
                    if (in_array('blGpee', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN ec.BL_GEPE = 1 THEN 'Oui' WHEN ec.BL_GEPE = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'GPEEC' ";
                        array_push($array_nom_de_colonne_export, 'GPEEC');
                    }
                    if (in_array('blGpeecPlus', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN ec.BL_GPEEC_PLUS = 1 THEN 'Oui' WHEN ec.BL_GPEEC_PLUS = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'GPEEC PLUS' ";
                        array_push($array_nom_de_colonne_export, 'GPEEC PLUS');
                    }
                    if (in_array('blApa', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN ec.BL_APA = 1 THEN 'Oui' WHEN ec.BL_APA = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Agent par agent' ";
                        array_push($array_nom_de_colonne_export, 'Agent par agent');
                    }
                    if (in_array('blCons', $array_columns_to_filter)) {
                        $selectQuery.= " , (CASE WHEN ec.BL_CONS = 1 THEN 'Oui' WHEN ec.BL_CONS = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Consolidé' ";
                        array_push($array_nom_de_colonne_export, 'Consolidé');
                    }
                    
                        $selectQuery.= " , (CASE WHEN ec.BL_N4DS = 1 THEN 'Oui' WHEN ec.BL_N4DS = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Fichier N4DS' ";
                        array_push($array_nom_de_colonne_export, 'Fichier N4DS');

                        $selectQuery.= " , (CASE WHEN ec.BL_BASECARR = 1 THEN 'Oui' WHEN ec.BL_BASECARR = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'Base carrière' ";
                        array_push($array_nom_de_colonne_export, 'Base carrière');

                        $selectQuery.= " , (CASE WHEN ec.BL_DGCL = 1 THEN 'Oui' WHEN ec.BL_DGCL = 0 THEN 'Non' ELSE 'Non renseigné' END) as 'DGCL' ";
                        array_push($array_nom_de_colonne_export, 'DGCL');


                        if (!empty($enquetes[0])) {
                    if (in_array('blNbAgenPerm', $array_columns_to_filter)) {
                        $selectQuery .= " , bsc.NB_AGENT_EMPLOI_PERMANENT as 'Nombre Agents Permanent' ";
                        array_push($array_nom_de_colonne_export, 'Nombre Agents Permanent');
                    }
                    if (in_array('blNbAgenContNonPerm', $array_columns_to_filter)) {
                        $selectQuery .= " , bsc.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT as 'Nombre Contractuels Non Permanent' ";
                        array_push($array_nom_de_colonne_export, 'Nombre Contractuels Non Permanent');
                    }
                    if (in_array('blNbAgenContPerm', $array_columns_to_filter)) {
                        $selectQuery .= " , bsc.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT as 'Nombre Contractuels Permanent' ";
                        array_push($array_nom_de_colonne_export, 'Nombre Contractuels Permanent');
                    }
                    if (in_array('blNbAgenTitu', $array_columns_to_filter)) {
                        $selectQuery .= " , bsc.NB_AGENT_TITULAIRE as 'Nombre Agents Titulaires' ";
                        array_push($array_nom_de_colonne_export, 'Nombre Agents Titulaires');
                    }

                    $selectQuery.= " , ibs.INIT_SOURCE as 'Mode de saisie' ";
                    array_push($array_nom_de_colonne_export, 'Mode de saisie'); 

                    $collectivitesString = implode( "," ,$collectivites);
                    
                    $histEchaQuery = "SELECT ID_HIST_ECHA FROM historique_echange he JOIN collectivite c ON he.ID_COLL = c.ID_COLL WHERE c.ID_COLL IN (" . $collectivitesString . ") ";
                    $histEcha = $em->getConnection()->prepare($histEchaQuery);
                    $histEcha->execute();
                    $histEchaResults = $histEcha->fetchAll();

                    $echanges = array();
                    foreach($histEchaResults as $key => $value){
                        array_push($echanges, $value['ID_HIST_ECHA']);
                        $echangesString = implode( "," ,$echanges);
                    }

                    $nbHistByColl = array();
                    foreach($collectivites as $key => $value){
                        $histEchaByCollQuery = "SELECT ID_HIST_ECHA FROM historique_echange he JOIN collectivite c ON he.ID_COLL = c.ID_COLL WHERE c.ID_COLL = " . $value . " "; 
                        $histEchaByColl = $em->getConnection()->prepare($histEchaByCollQuery);
                        $histEchaByColl->execute();
                        $histEchaByCollResults = $histEchaByColl->fetchAll();
                        array_push($nbHistByColl, $histEchaByCollResults);
                    }

                    $maxEchaByColl;
                    $nbEchaByColl=array();
                    foreach($nbHistByColl as $key => $value){
                        $echaByColl = count($value);
                        array_push($nbEchaByColl, $echaByColl);
                    }
                    $echaNotEmpty=array_filter($nbEchaByColl);
                    $maxEchaByColl=max($nbEchaByColl);

                    for($i=0; $i<$maxEchaByColl; $i++){
                        $j=$i+1;
                        $selectQuery.= " , (SELECT CONCAT (he2.DT_ECHLA, ' ' , he2.LB_TYPE_ECHA, ' ' , he2.LB_INTI_ECHA, ' ' , he2.CM_ECHA) FROM historique_echange he2 WHERE he2.ID_HIST_ECHA IN (" . $echangesString . ") AND he2.ID_COLL = c.ID_COLL GROUP BY he2.ID_HIST_ECHA LIMIT 1 OFFSET ".$i.") as 'Historique échange".$j."' ";
                        array_push($array_nom_de_colonne_export, 'Historique échange'.$j);
                    }
            
                    $selectQuery.= " , CONCAT(r.DT_DERNRELA , ' ', r.LB_MESSRELA) as 'Historique relance' ";
                    array_push($array_nom_de_colonne_export, 'Historique relance');

                }
            }

            if($nameCsv == 'export-mdp-temp'){
                    $array_nom_de_colonne_export_mdp = array();
                    $selectQuery = "SELECT c.LB_COLL as 'Nom de la collectivité (Raison Sociale)', NM_SIRE as 'Siret', LB_PASS_TEMP as 'Mot de passe temporaire', "
                        . "contact.LB_NOM as 'Nom', contact.LB_PREN as 'Prénom', contact.LB_FONC as 'Fonction', contact.LB_TELE as 'Téléphone', contact.LB_MAIL as 'Email' ";

                array_push($array_nom_de_colonne_export_mdp, 'Nom de la collectivité (Raison Sociale)');
                array_push($array_nom_de_colonne_export_mdp, 'Siret');
                array_push($array_nom_de_colonne_export_mdp, 'Mot de passe temporaire');
                array_push($array_nom_de_colonne_export_mdp, 'Nom');
                array_push($array_nom_de_colonne_export_mdp, 'Prénom');
                array_push($array_nom_de_colonne_export_mdp, 'Fonction');
                array_push($array_nom_de_colonne_export_mdp, 'Téléphone');
                array_push($array_nom_de_colonne_export_mdp, 'Email');

                $this->generatePasswordAndUpdateMdp($collectivites);
            }

            $collectivite = implode(',', $collectivites);

            $sql = '';

            if (!empty($enquetes[0])) {
                $sql = $selectQuery . "FROM collectivite c
                JOIN ref_type_collectivite type ON type.ID_TYPE_COLL = c.ID_TYPE_COLL
                LEFT JOIN departement depa ON c.ID_DEPA = depa.ID_DEPA
                LEFT JOIN collectivite_contact contact ON c.ID_COLL = contact.ID_COLL AND contact.BL_CONTACT_PRINCIPAL = 1
                JOIN utilisateur u ON u.ID_COLL = c.ID_COLL
                LEFT JOIN historique_bilan_social enq ON c.ID_COLL = enq.ID_COLL AND enq.ID_ENQU = " . $enquetes[0]->getIdEnqu() . "
                AND enq.DT_CHGT = (SELECT MAX(enq2.DT_CHGT) FROM historique_bilan_social as enq2 WHERE enq2.ID_COLL = c.ID_COLL)
                LEFT JOIN bilan_social_agent bsa ON bsa.ID_COLL = c.ID_COLL AND bsa.ID_ENQU = " . $enquetes[0]->getIdEnqu() . "
                LEFT JOIN bilan_social_consolide bsc ON bsc.ID_COLL = c.ID_COLL AND bsc.ID_ENQU = " . $enquetes[0]->getIdEnqu() . "
                LEFT JOIN enquete_collectivite ec ON ec.ID_COLL = c.ID_COLL AND ec.ID_ENQU = " . $enquetes[0]->getIdEnqu() . "
                LEFT JOIN init_bilan_social ibs ON ibs.ID_COLL = c.ID_COLL AND ibs.ID_ENQU = " . $enquetes[0]->getIdEnqu() . "
                LEFT JOIN historique_echange he ON he.ID_COLL = c.ID_COLL
                LEFT JOIN relance r ON r.ID_COLL = c.ID_COLL AND r.ID_ENQU = " . $enquetes[0]->getIdEnqu() . "
                WHERE c.ID_COLL IN (" . $collectivite . ") GROUP BY c.ID_COLL";
            }
            else {
                $sql = $selectQuery . "FROM collectivite c
                JOIN ref_type_collectivite type ON type.ID_TYPE_COLL = c.ID_TYPE_COLL
                LEFT JOIN departement depa ON c.ID_DEPA = depa.ID_DEPA
                LEFT JOIN collectivite_contact contact ON c.ID_COLL = contact.ID_COLL AND contact.BL_CONTACT_PRINCIPAL = 1
                JOIN utilisateur u ON u.ID_COLL = c.ID_COLL
                WHERE c.ID_COLL IN (" . $collectivite . ") GROUP BY c.ID_COLL";
            }




            if ($nameCsv == 'export-mdp-temp') {
                $information = array('filename' => $nameCsv, 'requete_sql' => $sql, 'champ' => $array_nom_de_colonne_export_mdp);
            }
            else {
                $information = array('filename' => $nameCsv, 'requete_sql' => $sql, 'champ' => $array_nom_de_colonne_export);
            }

            $information = json_encode($information);
            $request->request->set('information', $information);
            $request->query->set('information', $information);
            $request->attributes->set('information', $information);
            //$listIds =  $request->get('listIds');
            $response = $this->forward('CoreBundle:AbstractBS:generateCsv', array('request' => $request));
            //$responsehistorique = $this->forward('CoreBundle:AbstractBS:exportHistoriqueEchange', array('request' => $request));
            return $response;
            //return $responsehistorique;
        }
        else {
            $erreur = 'pas de collectivite';
            return new JsonResponse($erreur);
        }
    }
    /**
     *  Retourne la Response de redirectToRoute pour le login si pas d'utilisateur connecté,
     *  sinon false
     *  @return Response or boll
     */
    protected function getRedirectToLogin()
    {
        $redirect = false;
        if(!$this->isUserConnected()){
            $redirect = $this->redirectToRoute('login',array(),302);
        }
        return $redirect;
    }

    protected function getRedirectToInitUser(){
        $user = $this->getUser();
        $redirect = false;
        if ($user->hasRole('ROLE_COLLECTIVITY') && $user->getFgStat() == 1) {
            $message = "";
            $dtLastconn = $user->getDtLastconn();
            if (isset($dtLastconn) && !empty($dtLastconn)) {
                $message = 'Veuillez reinitialiser votre mot de passe';
            } else {
                $message = 'Ceci est votre première connexion, veuillez reinitialiser votre mot de passe et renseigner votre adresse email';
            }

            $this->addFlash('TempAccount', $message);

            $redirect = $this->redirectToRoute('reinit_account', array('username' => $user));
        }
        return $redirect;
    }

    /** Ex downloadAnalyseAction
     * @param $fileKey
     * @return BinaryFileResponse
     */
    public function getFileContentAction($fileKey)
    {
        $fileManager = $this->getBSFileManager();
        $fileInfo = $fileManager->getFileInfos($fileKey);
        $fileContent = $fileManager->getFileContent($fileKey);
        $filename = $fileInfo['json_response']['originalFileName'];

        file_put_contents($filename, $fileContent);

        $response = new BinaryFileResponse($filename);
        $response->headers->set('Content-Type', $fileInfo['json_response']['fileContentType']);
        $response->headers->set('Content-Length', $fileInfo['json_response']['fileContentSize']);
        $response->trustXSendfileTypeHeader();
        if ($fileInfo['json_response']['isAttachment']) {
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $filename,
                iconv('UTF-8', 'ASCII//TRANSLIT', $filename)
            );
        }
        $response->deleteFileAfterSend(true);
        return $response;
    }


    public function renderLogoAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $cdg = null;
        if($user->hasRole('ROLE_CDG')){
            $cdg =  $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($user);
        }else if($user->hasRole('ROLE_COLLECTIVITY')){
            $cdg =  $em->getRepository('CollectiviteBundle:Cdg')->findCdgByCollectivite($user);
        }
        $logoPublicUrl = null;
        if($cdg !== null && $cdg->getFileKey() !== null){
            $logoPublicUrl = $this->getBSFileManager()->getPublicFileUrl($cdg->getFileKey());
        }
        return $this->render('logo.html.twig',
            array(
            'logoPublicUrl' => $logoPublicUrl,
            ));
    }

    /**
    *   fonctions de vérification de l'appartenance des éléments à l'utilisateur connecté
    *
    */
    CONST SHOW_ACCESS_TYPE = 1;
    CONST EDIT_ACCESS_TYPE = 2;

    public function checkIsUserOwnerOf($obj_data, $obj_class = null, $acces_type = null) {
        if (is_object($obj_data)) {
            $reflec = new \ReflectionClass($obj_data);
            $obj_class = $obj_class==null ? $reflec->getShortName() : $obj_class;
        }
        if($obj_class==null){
            return false;
        }
        $is_owner = false;
        switch ($obj_class) {
            case 'BilanSocialAgent':
                $is_owner = $this->checkIsUserBsAgentOwner($obj_data);
                break;
            case 'InformationColectiviteAgent':
                $is_owner = $this->checkIsUserInfoCollectiviteAgentOwner($obj_data);
                break;
            case 'InformationGenerale':
                $is_owner = $this->checkIsUserInfoGeneralAgentOwner($obj_data);
                break;
            case 'Actualite':
                $is_owner = $this->checkIsUserActualiteOwner($obj_data, $acces_type);
                break;
            case 'Utilisateur':
                $is_owner = $this->checkIsUserUtilisateurOwner($obj_data);
                break;
            case 'Enquete':
                $is_owner = $this->checkIsUserEnqueteOwner($obj_data);
                break;
            case 'Question':
                $is_owner = $this->checkIsUserQuestionOwner($obj_data);
                break;
            case 'ModelMailCdg':
                $is_owner = $this->checkIsUserModelMailOwner($obj_data);
                break;
            case 'ModelMailInterneAppliCdg':
                $is_owner = $this->checkIsUserModelMailInterneAppliOwner($obj_data);
                break;
            default:
                 # code...
                 break;
        }
        return $is_owner;
    }
    public function checkIsUserBsAgentOwner(BilanSocialAgent $agent, $acces_type = null): bool {
        $id_coll = $this->getMaCollectivite()->getIdColl();
        $id_agent = $agent->getIdBilasociagen();
        $em = $this->getDoctrine()->getEntityManager();
        $is_owned = $em->getRepository('ApaBundle:BilanSocialAgent')->isOwnedByColl($id_coll,$id_agent);
        return $is_owned==true;
    }
    public function checkIsUserInfoCollectiviteAgentOwner(InformationColectiviteAgent $info_collec_agent, $acces_type = null): bool {
        $id_coll = $this->getMaCollectivite()->getIdColl();
        $id_coll_info_collec_agent = $info_collec_agent->getCollectivite()->getIdColl();
        //$em = $this->getDoctrine()->getEntityManager();
        $is_owned = $id_coll==$id_coll_info_collec_agent;//$em->getRepository('ApaBundle:BilanSocialAgent')->isAgentOwnedByColl($id_coll,$id_agent);
        return $is_owned==true;
    }
    public function checkIsUserInfoGeneralAgentOwner(InformationGenerale $info_gene_agent, $acces_type = null): bool {
        $id_coll = $this->getMaCollectivite()->getIdColl();
        $id_coll_info_gene_agent = $info_gene_agent->getCollectivite()->getIdColl();
        //$em = $this->getDoctrine()->getEntityManager();
        $is_owned = $id_coll==$id_coll_info_gene_agent;//$em->getRepository('ApaBundle:BilanSocialAgent')->isAgentOwnedByColl($id_coll,$id_agent);
        return $is_owned==true;
    }
    public function checkIsUserActualiteOwner(Actualite $actualite, $acces_type = null): bool {

        $id_actu = $actualite->getId();
        $em = $this->getDoctrine()->getEntityManager();
        if($this->isUserAdmin()){
            $is_owned = true;
            $current_user = $this->getUser();
            if ($acces_type == null) {
                $is_owned = $em->getRepository('ActualiteBundle:Actualite')->isOwnedByAdmin($current_user, $actualite);
            }
            else if ($acces_type == self::SHOW_ACCESS_TYPE) {
                $is_owned = true;
            }
            else if ($acces_type == self::EDIT_ACCESS_TYPE) {
                $is_owned = $em->getRepository('ActualiteBundle:Actualite')->isOwnedByAdmin($current_user, $actualite);
            }
        }else if($this->isUserCDG()){
            $cdg = $this->getMonCDG();
            if($acces_type==null){
                $is_owned = $em->getRepository('ActualiteBundle:Actualite')->isOwnedByCdg($cdg,$actualite);
            }
            else if ($acces_type == self::SHOW_ACCESS_TYPE) {
                $is_owned = $em->getRepository('ActualiteBundle:Actualite')->isReadableByCdg($cdg, $actualite);
            }
            else if ($acces_type == self::EDIT_ACCESS_TYPE) {
                $is_owned = $em->getRepository('ActualiteBundle:Actualite')->isOwnedByCdg($cdg, $actualite);
            }
        }else if ($this->isUserCollectivite()){
            $collectivite = $this->getMaCollectivite();
            $current_user = $this->getUser();
            if ($acces_type == null) {
                $is_owned = $em->getRepository('ActualiteBundle:Actualite')->isOwnedByColl($collectivite, $actualite);
            }
            else if ($acces_type == self::SHOW_ACCESS_TYPE) {
                $is_owned = $em->getRepository('ActualiteBundle:Actualite')->isReadableByColl($collectivite, $actualite);
            }
            else if ($acces_type == self::EDIT_ACCESS_TYPE) {
                $is_owned = $em->getRepository('ActualiteBundle:Actualite')->isOwnedByColl($collectivite, $actualite);
            }
        }

        return $is_owned==true;
    }
    public function checkIsUserUtilisateurOwner($id_util, $acces_type = null): bool {
        $em = $this->getDoctrine()->getEntityManager();
        $is_owned = false;
        $user = $em->getRepository('UserBundle:User')->findOneByIdUtil($id_util);

        if($this->isUserAdmin()){
            $is_owned = true;
        }else if($this->isUserCDG()){
            $cdg = $this->getMonCDG();
            $is_owned = $em->getRepository('UserBundle:User')->isOwnedByCdg($user,$cdg);
        }else if ($this->isUserCollectivite()){
            $current_user = $this->getUser();
            $is_owned = $user==$current_user;
        }

        return $is_owned==true;
    }
    public function checkIsUserEnqueteOwner($id_enqu, $acces_type = null): bool {
        $em = $this->getDoctrine()->getEntityManager();
        $is_owned = false;
        $enquete = $em->getRepository('EnqueteBundle:Enquete')->findOneByIdEnqu($id_enqu);
        if($this->isUserAdmin()){
            $is_owned = false;
        }else if($this->isUserCDG()){
            $cdg = $this->getMonCDG();
            $is_owned = $em->getRepository('EnqueteBundle:Enquete')->isOwnedByCdg($enquete,$cdg);
        }else if ($this->isUserCollectivite()){
            $current_user = $this->getUser();
            $is_owned = $em->getRepository('EnqueteBundle:Enquete')->isOwnedByCollectivite($enquete,$cdg);
        }

        return $is_owned==true;
    }
    public function checkIsUserQuestionOwner($question, $acces_type = null): bool {
        $em = $this->getDoctrine()->getEntityManager();
        $is_owned = false;
        $question = $question instanceof Question ? $question : is_int($question) ? $em->getRepository('FaqBundle:Question')->findOneById($question) : null;
        if($question!=null){
            if($this->isUserAdmin()){
                $is_owned = false;
            }else if($this->isUserCDG()){
                $cdg = $this->getMonCDG();
                $is_owned = $em->getRepository('FaqBundle:Question')->isOwnedByCdg($question,$cdg);
            }else if ($this->isUserCollectivite()){
                $current_user = $this->getUser();
                $is_owned = $em->getRepository('FaqBundle:Question')->isOwnedByCollectivite($question,$current_user);
            }
        }
        return $is_owned==true;
    }
    public function checkIsUserModelMailOwner($model_mail, $acces_type = null): bool {
        $em = $this->getDoctrine()->getEntityManager();
        $is_owned = false;
        $model_mail = $model_mail instanceof ModelMailCdg ? $model_mail : is_int($model_mail) ? $em->getRepository('ModelMailBundle:ModelMailCdg')->findOneById($model_mail) : null;
        if($model_mail!=null){
            if($this->isUserAdmin()){
                $is_owned = false;
            }else if($this->isUserCDG()){
                $cdg = $this->getMonCDG();
                $is_owned = $model_mail->getIdCdg()==$cdg;//$em->getRepository('ModelMailBundle:ModelMailCdg')->isOwnedByCdg($model_mail,$cdg);
            }else if ($this->isUserCollectivite()){
                $is_owned = false;
            }
        }
        return $is_owned==true;
    }

    public function checkIsUserModelMailInterneAppliOwner($model_mail_interne_appli, $acces_type = null): bool {
        $em = $this->getDoctrine()->getEntityManager();
        $is_owned = false;
        $model_mail_interne_appli = $model_mail_interne_appli instanceof ModelMailInterneAppliCdg ? $model_mail_interne_appli : is_int($model_mail_interne_appli) ? $em->getRepository('ModelMailBundle:ModelMailInterneAppliCdg')->findOneById($model_mail_interne_appli) : null;
        if ($model_mail_interne_appli != null) {
            if ($this->isUserAdmin()) {
                $is_owned = false;
            }
            else if ($this->isUserCDG()) {
                $cdg = $this->getMonCDG();
                $is_owned = $model_mail_interne_appli->getIdCdg() == $cdg;
//$em->getRepository('ModelMailBundle:ModelMailCdg')->isOwnedByCdg($model_mail,$cdg);
            }
            else if ($this->isUserCollectivite()) {
                $is_owned = false;
            }
        }
        return $is_owned == true;
    }

    public $pcOngletsConfig = array(
//        'onglet114'=>array(
//            'onglet_name'=>'onglet114',
//            'bit_mask'=>InformationCollectiviteEnum::MASK_114
//        ),
//        'onglet124'=>array(
//            'onglet_name'=>'onglet124',
//            'bit_mask'=>InformationCollectiviteEnum::MASK_124
//        ),
//        'onglet131'=>array(
//            'onglet_name'=>'onglet131',
//            'bit_mask'=>InformationCollectiviteEnum::MASK_131
//        ),
        'onglet132'=>array(
            'onglet_name'=>'onglet132',
            'bit_mask'=>InformationCollectiviteEnum::MASK_132
        ),
        'onglet157'=>array(
            'onglet_name'=>'onglet157',
            'bit_mask'=>InformationCollectiviteEnum::MASK_157
        ),
        'onglet162'=>array(
            'onglet_name'=>'onglet162',
            'bit_mask'=>InformationCollectiviteEnum::MASK_162
        ),
        'onglet21'=>array(
            'onglet_name'=>'onglet21',
            'bit_mask'=>InformationCollectiviteEnum::MASK_21
        ),
        'onglet225'=>array(
            'onglet_name'=>'onglet225',
            'bit_mask'=>InformationCollectiviteEnum::MASK_225
        ),
        'onglet341'=>array(
            'onglet_name'=>'onglet341',
            'bit_mask'=>InformationCollectiviteEnum::MASK_341
        ),
        'onglet342'=>array(
            'onglet_name'=>'onglet342',
            'bit_mask'=>InformationCollectiviteEnum::MASK_342
        ),
        'onglet343'=>array(
            'onglet_name'=>'onglet343',
            'bit_mask'=>InformationCollectiviteEnum::MASK_343
        ),
//        'onglet344'=>array(
//            'onglet_name'=>'onglet344',
//            'bit_mask'=>InformationCollectiviteEnum::MASK_344
//        ),
        'onglet345'=>array(
            'onglet_name'=>'onglet345',
            'bit_mask'=>InformationCollectiviteEnum::MASK_345
        ),
        'onglet412'=>array(
            'onglet_name'=>'onglet412',
            'bit_mask'=>InformationCollectiviteEnum::MASK_412
        ),
        'onglet413'=>array(
            'onglet_name'=>'onglet413',
            'bit_mask'=>InformationCollectiviteEnum::MASK_413
        ),
        'onglet414'=>array(
            'onglet_name'=>'onglet414',
            'bit_mask'=>InformationCollectiviteEnum::MASK_414
        ),
        'ongletq425'=>array(
            'onglet_name'=>'ongletq425',
            'bit_mask'=>InformationCollectiviteEnum::MASK_425
        ),
        'onglet227'=>array(
            'onglet_name'=>'onglet227',
            'bit_mask'=>InformationCollectiviteEnum::MASK_227
        ),
        'onglet417'=>array(
            'onglet_name'=>'onglet417',
            'bit_mask'=>InformationCollectiviteEnum::MASK_417
        ),
        'onglet215'=>array(
            'onglet_name'=>'onglet215',
            'bit_mask'=>InformationCollectiviteEnum::MASK_215
        ),
        'onglet216'=>array(
            'onglet_name'=>'onglet216',
            'bit_mask'=>InformationCollectiviteEnum::MASK_216
        ),
        'onglet217'=>array(
            'onglet_name'=>'onglet217',
            'bit_mask'=>InformationCollectiviteEnum::MASK_217
        ),
        'onglet311'=>array(
            'onglet_name'=>'onglet311',
            'bit_mask'=>InformationCollectiviteEnum::MASK_311
        ),
        'onglet321'=>array(
            'onglet_name'=>'onglet321',
            'bit_mask'=>InformationCollectiviteEnum::MASK_321
        ),
        'onglet43'=>array(
            'onglet_name'=>'onglet43',
            'bit_mask'=>InformationCollectiviteEnum::MASK_43
        ),
        'onglet514'=>array(
            'onglet_name'=>'onglet514',
            'bit_mask'=>InformationCollectiviteEnum::MASK_514
        ),
        'onglet611'=>array(
            'onglet_name'=>'onglet611',
            'bit_mask'=>InformationCollectiviteEnum::MASK_611
        ),
        'onglet612'=>array(
            'onglet_name'=>'onglet612',
            'bit_mask'=>InformationCollectiviteEnum::MASK_612
        ),
        'onglet613'=>array(
            'onglet_name'=>'onglet613',
            'bit_mask'=>InformationCollectiviteEnum::MASK_613
        ),
        'onglet71'=>array(
            'onglet_name'=>'onglet71',
            'bit_mask'=>InformationCollectiviteEnum::MASK_71
        ),
        'ongletHand'=>array(
            'onglet_name'=>'ongletHand',
            'bit_mask'=>InformationCollectiviteEnum::MASK_HAND
        ),
        'onglet614'=>array(
            'onglet_name'=>'onglet614',
            'bit_mask'=>InformationCollectiviteEnum::MASK_614
        ),
        'ongletRassct'=>array(
            'onglet_name'=>'ongletRassct',
            'bit_mask'=>InformationCollectiviteEnum::MASK_RASSCT
        )
    );

    function checkIfAllOngletsIsSave($array_pc_bool){
        $array_check_count = array();
        $checked = true;
        foreach($array_pc_bool as $key => $value){
            if($value == false){
                $checked = $value;
                break;
            }
        }

        $array_check_count['checked'] = $checked;
        $count = 0;
        foreach($array_pc_bool as $key => $value){
            if($value == true){
                $count++;
            }
        }
        $array_check_count['count'] = $count;

        return $array_check_count;
    }
    function getPcOngletsConfig() {
        return $this->pcOngletsConfig;
    }

    function setPcOngletsConfig($pcOngletsConfig) {
        $this->pcOngletsConfig = $pcOngletsConfig;
    }

    public function getOngletsConfig($onglet_key){
        $pcOngletsConfig = $this->getPcOngletsConfig();
        $config = isset($pcOngletsConfig[$onglet_key]) ? $pcOngletsConfig[$onglet_key] : null;
        return $config;
    }
    public function getOngletMask($onglet_key){
        $onglet_config = $this->getOngletsConfig($onglet_key);
        $mask = $onglet_config!=null && isset($onglet_config['bit_mask']) ? $onglet_config['bit_mask'] : null;
        return $mask;
    }
    public function updatePcOngletByName($onglet_key,$pcOnglets){
        $mask = $this->getOngletMask($onglet_key);
        if ($mask!=null) {
            $pcOnglets = $pcOnglets | bindec($mask);
        }
        return $pcOnglets;
    }
    public function getOngletsTabBool($pcOnglet){
        $pcOngletsConfig = $this->getPcOngletsConfig();
        $tab_bool = array();
        foreach ($pcOngletsConfig as $onglet_key => $onglet_config){
            $onglet_mask = $this->getOngletMask($onglet_key);
            $onglet_bool = false;
            if($onglet_mask!=null){
                $onglet_bool = ($pcOnglet & bindec($onglet_mask)) === bindec($onglet_mask);
            }
            $tab_bool[$onglet_key]=$onglet_bool;
        }
        return $tab_bool;
    }

    public function checkIfCdgCanWriteCollectivite($collectivite){
        $em = $this->getDoctrine()->getEntityManager();
        $cdg = $em->getRepository('CollectiviteBundle:cdg')->findCDGByUtilisateur($this->getUser());

        $cdgDepartement = $collectivite->getCdgDepartement();

        $droits = $em->getRepository('UserBundle:UtilisateurDroits')->findBy(array('utilisateurCdg' => $cdg->getIdCdg()));

        $cdgCanWrite = array();
        foreach ($droits as $key => $value) {
            if(($value->getFgDroits() & bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)) !== bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)){
                $cdgCanWrite[$key] = $value->getCdgDepartement()->getIdCdgDepartement();
                $this->addFlash('error', "Vous n'avez pas l'autorisation d'effectuer cette action sur le departement " . $value->getCdgDepartement()->getDepartement()->getLbDepa());
            }
        }

        return $cdgCanWrite;


    }


    public function getDepartementExcludeAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        $user_cdg = $em->getRepository('UserBundle:UtilisateurCdg')->findByUtilisateur($this->getUser());
        $collectivites =  $request->get('listIds');
        $departement_exclus = $em->getRepository('CollectiviteBundle:Collectivite')->getNonDroitsSurCollectiviteByCdg($user_cdg,$collectivites);

        $departements_autorise = $em->getRepository('CollectiviteBundle:Collectivite')->getDepartementDroitsSurCollectiviteByCdg($user_cdg,$collectivites);

            $departement_exclus = array_column($departement_exclus, "lbDepa");

            $departements_autorise = array_column($departements_autorise, "lbDepa");

            $message = null;
            $checkEmpty = true;
            if(!empty($departement_exclus)){
                $departements_string = implode(', ', $departement_exclus);
                $message = '';
                $message .= "<br>Vous n'avez pas les droits pour cette action sur le(s) département(s): " . $departements_string . "<br>";
            }
            if(!empty($departements_autorise)){
                $departements_string = implode(', ', $departements_autorise);
                $message = $message = null ? '' : $message;
                $message .= "<br>L'action est en cours sur le(s) département(s): " . $departements_string . "<br>";
                $message .= '<br>Veuillez patienter que le téléchargement de votre fichier soit lancé.<br>';
                $checkEmpty = false;

            }


            $response = new JsonResponse(array('message' => $message, 'checkEmpty' => $checkEmpty ));
            return $response;

    }

    public function bsVideCollectiviteMasseAction(Request $request){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $user_cdg = $em->getRepository('UserBundle:UtilisateurCdg')->findByUtilisateur($user);
        $UtilisateurDroits = $em->getRepository('UserBundle:UtilisateurDroits')->getDroitByCdg($user_cdg);
        $idCdgDepartement = "";
        $canwrite = true;
        $departement_exclu_list = "";

        foreach ($UtilisateurDroits as $key => $value) {
            $idCdgDepartement .= $value->getCdgDepartement()->getIdCdgDepartement();
            if ($value !== end($UtilisateurDroits)) {
                $idCdgDepartement .= ',';
            }

        }
        foreach ($UtilisateurDroits as $key => $value) {
            $idCdgDepartement .= $value->getCdgDepartement()->getIdCdgDepartement();
            if ($value !== end($UtilisateurDroits)) {
                $idCdgDepartement .= ',';
            }
            if((($value->getFgDroits() & bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE)) !== bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE))){
                $departement_exclu_list .= ' ' . $value->getCdgDepartement()->getDepartement()->getLbDepa();
            }
        }
        $enquetes = $em->getRepository('EnqueteBundle:Enquete')->findEnqueteLanceeByUtilisateurCDG($idCdgDepartement, $currentCampagne->getIdCamp());

        $collectivites =  $request->get('listIds');

        $check_droits_write = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurPlusieursCollectivites($collectivites, $user_cdg);
        //$droits = $em->getRepository('UserBundle:UtilisateurDroits')->findBy(array('utilisateurCdg' => $cdg->getIdCdg()));

        $cdgCanWrite = array();
        if(!empty($check_droits_write)){
            $canwrite = false;
        }

        if(!$canwrite){
            if($departement_exclu_list !== ''){
                $this->addFlash('error', "Vous n'avez pas les droits d'écriture sur les enquêtes pour les collectivités appartenants au(x) département(s) suivant(s) : " . $departement_exclu_list);
                $this->addFlash('error', "Action annulée");

            }
            return $this->redirectToRoute('enquete_suivi');
        }
        if(!empty($collectivites && $canwrite)){

            $array_id_enqu = [];

            foreach ($enquetes as $key => $enquete) {
                array_push($array_id_enqu, $enquete->getIdEnqu());
            }

            $enquete_str = implode(',', $array_id_enqu);
            $collectivite = implode(',', $collectivites);

            /* Check si les collectivites selectionnées ne se sont jamais connectées */
            $check = $em->getRepository('UserBundle:User')->checkFgStat($collectivite);

            if($check){
                foreach ($collectivites as $key => $value) {

                    $checkBSCexist = $this->getEntityManager()->getRepository('ConsoBundle:BilanSocialConsolide')
                                                ->findOneByActif($value, $this->getMonEnquete($value)->getIdEnqu());
                    $checkBSAexist = $this->getEntityManager()->getRepository('ApaBundle:BilanSocialAgent')
                                                ->findOneByActif($value, $this->getMonEnquete($value)->getIdEnqu());
                    $checkInitexist = $this->getEntityManager()->getRepository('BilanSocialBundle:InitBilanSocial')
                                                ->getCurrentInfoBilanSocial($value, $this->getMonEnquete($value)->getIdEnqu());

                    $historiqueBs = $em->getRepository('BilanSocialBundle:HistoriqueBilanSocial')->getLastHist($value,$this->getMonEnquete($value));
                    if(!empty($checkBSCexist)){
                        if($historiqueBs == null || $historiqueBs->getFgStat() != 2){
                            $this->chgtEtatBilanSocial(2, $this->getMaCollectivite($value), $this->getMonEnquete($value), $checkBSCexist->getIdBilasocicons() );
                        }
                    }
                    if(empty($checkBSCexist) && empty($checkBSAexist)){
                        if($checkInitexist == null){
                            $enqueteColl = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->findOneBy(array('collectivite' => $value, 'enquete' => $this->getMonEnquete($value)->getIdEnqu()));
                            if(count($enqueteColl)==0){
                               $enqueteColl =  new EnqueteCollectivite();
                               $enqueteColl->setEnquete($this->getMonEnquete($value));
                               $enqueteColl->setCollectivite($value);
                               $this->em->persist($enqueteColl);
                               $this->em->flush();
                            }

                            // Lecture des rÃ©ponses aux questions de configuration apportÃ©e si dÃ©jÃ  fait
                            $resInit = $em->getRepository('BilanSocialBundle:InitBilanSocial')->findOneBy(array('collectivite' => $value, 'enquete' => $this->getMonEnquete($value)->getIdEnqu()));

                            if (count($resInit) == 0) {

                                $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneBy(array('idColl' => $value));
                                $initBilanSocial = new InitBilanSocial($enqueteColl);
                                $initBilanSocial->setCollectivite($collectivite);
                                $initBilanSocial->setInitSource('bs-vide');
                                $initBilanSocial->setEnquete($this->getMonEnquete($value));
                                $this->em->persist($initBilanSocial);
                                $this->em->flush();
                            }
                            $response = $this->forward('BilanSocialBundle:BilanSocial:generateBilanSocialVide',array('collectivite'=> $value));

                            $bilaSocicons = $this->getBilanSocialConsolide($value, $this->getMonEnquete($value));

                            $historiqueBs = $em->getRepository('BilanSocialBundle:HistoriqueBilanSocial')->getLastHist($value,$this->getMonEnquete($value));


                            if($historiqueBs == null || $historiqueBs->getFgStat() != 2){
                                $this->chgtEtatBilanSocial(2, $this->getMaCollectivite($value), $this->getMonEnquete($value), $bilaSocicons);
                            }
                        }else{
                            $this->addFlash('error', $this->get('translator')->trans('initexist.enquete.flash'));
                            return $this->redirectToRoute('enquete_suivi');
                        }

                    }else{
                        $this->addFlash('error', $this->get('translator')->trans('bsexist.enquete.flash') . $checkBSCexist->getCollectivite()->getLbColl() );
                    }
                }
                return $this->forward('EnqueteBundle:Enquete:removeCdgSession');
            }else{
                $this->addFlash('error', $this->get('translator')->trans('erreurbadstatbsvide.enquete.flash'));
                return $this->redirectToRoute('enquete_suivi');
            }

        }else{
            $this->addFlash('error', $this->get('translator')->trans('nocollectiviteassocie.consolide.flash'));
            return $this->redirectToRoute('enquete_suivi');
        }
    }
    public function displayErrorFlash($form){
        $errors = $form->getErrors();

        foreach($errors as $e){
            $this->addFlash('error', $e->getMessage() );
      }
    }

    public function getListingPoolToTxtAction(Request $request){
        $id_pool = $this->get('id_pool');
        if($id_pool!=null){
            return $this->getListingPoolToTxt($id_pool);
        }
    }
    public function getListingPoolToTxt($id = null){
        $em_bs = $this->getDoctrine()->getManager();
        $current_user = $this->getUser();
        $pool = $em_bs->getRepository('InfoCentreBundle:Pool')->findOneById($id);
        $grouped_pool_items = $pool->getGroupsAnnee();
        $array_id_coll = array();
        $array_items = array();
        foreach ($grouped_pool_items as $annee => $group) {
            $em_annee = $this->getDataWellConnection($annee);
            $array_id_coll[$annee] = array();
            $array_items[$annee] = array();
            foreach ($group as $key => $item) {
                $item->initDependancy($em_annee,$annee);
                array_push($array_id_coll[$annee], $item->getCollectivite()->getIdColl());
                array_push($array_items[$annee], $item);
            }
        }
        $poolname = strtolower(str_replace(' ', '_', $pool->getNom()));
        $zipName = $poolname.'.zip';
        $zip = new ZipArchive();
        $res = $zip->open($zipName, ZipArchive::CREATE);
        if ($res !== TRUE) {

        }
        ob_start();
        foreach ($array_items as $annee => $group) {
            $em_annee = $this->getDataWellConnection($annee);
            $array_annee_id_coll = $array_id_coll[$annee];
            $utilCdg = $em_annee->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
            if ($current_user->hasRole('ROLE_INFOCENTRE')) {
                $id_depa_list = $current_user->getIdDepaArray();
                $array_not_allow_coll = $em_annee->getRepository('InfoCentreBundle:PoolItem')->getNonDroitsSurCollectiviteByInfoCentre($id_depa_list, $array_annee_id_coll);
            } else {
                $array_not_allow_coll = $em_annee->getRepository('InfoCentreBundle:PoolItem')->getNonDroitsSurCollectiviteByCdg( $utilCdg->getIdUtilisateurCdg(), $array_annee_id_coll);
            }
            $handle = fopen('php://output', 'w+');
            fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            $string = "Nom de l'échantillon : " . $poolname."\r\n";
            $string .= "Liste des collectivités : \r\n";
            foreach ($group as $key => $item) {
                $collectivite = $item->getCollectivite();
                $anonyme =  $this->in_array_r($collectivite->getIdColl(), $array_not_allow_coll) ? false : true;
                if($anonyme){
                    $string .= "******** ******** \r\n";
                }else{
                    $string .= $collectivite->getLbColl() . ' ' . $collectivite->getNmSire() .  "\r\n";
                }
            }
            $zip->addFromString($poolname.'_'.$annee.'.txt', $string);
        }
        $zip->close();
        ob_end_clean();
        $zip_ressource = fopen($zipName, "r");//astuce ici
        $content=stream_get_contents($zip_ressource);// et ici

        $response =  new Response($content, 200, array(
                    'Content-Transfert-encoding: binary',
                    'Content-Type' => 'application/zip',
                    'Content-Disposition' => 'attachment; filename="'.$zipName.'"',
                    'Content-Length: '.filesize($zipName)
                    ));
        fclose ($zip_ressource);
        unlink($zipName);
        return $response;
    }

    public function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }

     public function downloadDGCLAction(){

         if(file_exists('dgcl_export_DGCL.zip')){
            $zip_ressource = fopen('dgcl_export_DGCL.zip', "r");//astuce ici
            $content=stream_get_contents($zip_ressource);// et ici

            $response =  new Response($content, 200, array(
                'Content-Transfert-encoding: binary',
                'Content-Type' => 'application/zip',
                'Content-Disposition' => 'attachment; filename="dgcl_export_DGCL.zip"',
                'Content-Length: '.filesize('dgcl_export_DGCL.zip')
                ));
            fclose ($zip_ressource);
            return $response;

         }else{
            return $this->redirectToRoute('homepage');
         }
    }

    public function chgtEtatBilanSocial($etat, $collectivite, $enquete, $idBsc = null) {

        $histBSNew = new HistoriqueBilanSocial();
        $histBSNew->setDepartement($collectivite->getDepartement());
        $histBSNew->setCollectivite($this->getMaCollectivite());
        $histBSNew->setEnquete($this->getMonEnquete($this->getMaCollectivite()));
        $histBSNew->setFgStat($etat);
        $histBSNew->setDtChgt(new \DateTime());
        $histBSNew->setCdTypebilasoci(1);

        try{
            $this->getEntityManager()->persist($histBSNew);
            $this->getEntityManager()->flush();
            $result = 'done historique';

            if($histBSNew->getFgStat() === 2 && $idBsc !== null ){
                $query = "CALL bs_batchs.DGCL_export_generate(:pIdBilaSociCons)";
                $stmt = $this->getEntityManager()->getConnection()->prepare($query);
                $stmt->bindParam(':pIdBilaSociCons',$idBsc,PDO::PARAM_INT);
                $stmt->execute();
                $result = 'done export';

            }

        } catch (Exception $ex) {

            $this->addFlash('error', $this->get('translator')->trans("L'état du bilan n'a pu être changé, veuillez réessayer"));
        }



    }

    public function importFileHistorisationSiretAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $import_siret = new importSiretHistorisation();
        $import_allready_done = false;
        $form = $this->createForm(ImportFileHIstorisationSiretType::class, $import_siret);

        $import_present = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findOneBy(array('blErreur' => false, 'blConfirmed' => false));
        $import_creation = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findBy(array('blErreur' => false, 'blConfirmed' => true, 'blPresent' => true, 'motif' => "Création"));
        $import_unknow = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findBy(array('blErreur' => false, 'blConfirmed' => true, 'blPresent' => true, 'motif' => "vide"));
        $import_changement_adresse = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findBy(array('blErreur' => false, 'blConfirmed' => true, 'blPresent' => true, 'motif' => "Changement adresse"));
        $import_fusion = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findBy(array('blErreur' => false, 'blConfirmed' => true, 'blPresent' => true, 'motif' => "Fusion"));

        if(!empty($import_present)){
            $import_allready_done = true;
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $document = $request->files->get('bilan_social_bundle_import_historisation_siret')['document']['file'];
            /*
            0 => "NM_SIRE"
              1 => "LB_COLL"
              2 => "LB_ADRE"
              3 => "CD_POST"
              4 => "LB_VILL"
              5 => "CD_INSE"
              6 => "NM_POPU_INSE"
              7 => "LB_ZONE_EMPL_COLL"
              8 => "ID_COLL"
              9 => "ID_TYPE_COLL"
              10 => "ID_CDG_DEPARTEMENT"
              11 => "ID_DEPA"
              12 => "NM_SIRE_RATA"
              13 => "DT_POPU_INSE"
              14 => "Archiver"
              15 => "DATE_MAJSIRET"
              16 => "MAJSIRET"
              17 => "Motif"
            */

               if (isset($document)) {
                   $conn =   $this->getEntityManager()->getConnection();
                   $stmt = $conn->prepare('DELETE FROM import_siret_historisation');
                   $stmt->execute();
                   $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
                   $conn->beginTransaction();
                   $reader->open($document);

                   $string_sql_insert_import = " INSERT INTO `import_siret_historisation` (`id`, `ancienSiret`, `blPresent`, `blConfirmed`, `NM_SIRE`, `LB_COLL`, `LB_ADRE`, `CD_POST`, `LB_VILL`, `CD_INSE`, `NM_POPU_INSE`, `LB_ZONE_EMPL_COLL`, `ID_COLL`, `ID_TYPE_COLL`, `ID_CDG_DEPARTEMENT`, `ID_DEPA`, `NM_SIRE_RATA`, `DT_POPU_INSE`, `Bl_ARCHI`, `DATE_MAJSIRET`, `MAJSIRET`, `MOTIF`, `BL_ERREUR`, `LB_ERREUR`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,0,NULL);";



                   foreach ($reader->getSheetIterator() as $key => $sheet) {

                       foreach ($sheet->getRowIterator() as $key1 => $row) {
                                if($key1 > 1){

                                    $blPresent = null;
                                    $blConfirmed = null;
                                    /* if index of motif doesn't exist or is empty set "vide" to match switch case */
                                    if(!isset($row[17]) || $row[17] === ""){
                                        $row[17] = 'vide';
                                    }
                                    /* check of motif state */
                                    switch ($row[17]){
                                        case "Changement adresse":
                                            if(!empty($row[14]) && !empty($row[16])) {
                                                $blPresent  = true;
                                                $blConfirmed = true;
                                            }
                                            break;
                                        case "Création":
                                            $blConfirmed = false;
                                            $blPresent = false;
                                            break;
                                        case "Fusion":
                                            if(!empty($row[14]) && !empty($row[16])) {
                                                $blPresent  = true;
                                                $blConfirmed = true;
                                            }
                                            break;
                                        case "vide":

                                            /* si archiver == non et majsiret est vide et motif est vide == aucun changement */
                                            if($row[14] === "Non" && ($row[16] === "" || !isset($row[16])) && $row[17] === 'vide'){
                                                $blPresent  = true;
                                                $blConfirmed = true;
                                            }else{

                                            }
                                            break;
                                        default:
                                            echo $row[17]."\n";
                                    }


                                    $date_13 = NULL;
                                    if(strtotime($row[13] !== false)){
                                        $date_13 = $row[13]->format('Y-m-d H:i:s');
                                    }

                                    $date_15 = NULL;
                                    if(strtotime($row[15] !== false)){
                                        $date_15 = $row[15]->format('Y-m-d H:i:s');
                                    }

                                    $row[0] = !empty($row[0]) ? $row[0] : NULL;
                                    $row[1] = !empty($row[1]) ? $row[1] : NULL;
                                    $row[2] = !empty($row[2]) ? $row[2] : NULL;
                                    $row[3] = !empty($row[3]) ? $row[3] : NULL;
                                    $row[4] = !empty($row[4]) ? $row[4] : NULL;
                                    $row[5] = !empty($row[5]) ? $row[5] : NULL;
                                    $row[6] = !empty($row[6]) ? $row[6] : NULL;
                                    $row[7] = !empty($row[7]) ? $row[7] : NULL;
                                    $row[8] = !empty($row[8]) ? $row[8] : NULL;
                                    $row[9] = !empty($row[9]) ? $row[9] : NULL;
                                    $row[10] = !empty($row[10]) ? $row[10] : NULL;
                                    $row[11] = !empty($row[11]) ? $row[11] : NULL;
                                    $row[12] = !empty($row[12]) ? $row[12] : NULL;
                                    $row[13] = !empty($row[13]) ? $row[13] : NULL;



                                    if(!empty($row[14])){
                                        $row_14 = 1;
                                        if($row[14] === 'Non'){
                                            $row_14 = 0;
                                        }
                                    }else{
                                        $row_14 = NULL;
                                    }

                                    $row[15] = !empty($row[15]) ? $row[15] : NULL;
                                    $row[16] = (!empty($row[16]) && isset($row[16])) ? $row[16] : NULL;
                                    $row[17] = !empty($row[17]) ? $row[17] : NULL;

                                    $error = false;

                                    try {
                                        $stmt = $conn->prepare($string_sql_insert_import);
                                        $stmt->bindParam(1, $row[0], PDO::PARAM_INT);
                                        $stmt->bindParam(2, $blPresent, PDO::PARAM_BOOL);
                                        $stmt->bindParam(3, $blConfirmed, PDO::PARAM_BOOL);
                                        $stmt->bindParam(4, $row[0], PDO::PARAM_INT);
                                        $stmt->bindParam(5, $row[1], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(6, $row[2], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(7, $row[3], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(8, $row[4], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(9, $row[5], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(10, $row[6], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(11, $row[7], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(12, $row[8], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(13, $row[9], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(14, $row[10], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(15, $row[11], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(16, $row[12], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(17, $date_13, PDO::PARAM_STR, 255);
                                        $stmt->bindParam(18, $row_14, PDO::PARAM_STR, 255);
                                        $stmt->bindParam(19, $date_15, PDO::PARAM_STR, 255);
                                        $stmt->bindParam(20, $row[16], PDO::PARAM_STR, 255);
                                        $stmt->bindParam(21, $row[17], PDO::PARAM_STR, 255);
                                        $stmt->execute();
                                    } catch (\PDOException $e) {
                                        $error = true;
                                        $conn->rollBack();
                                        $this->addFlash('error', "Une erreur est survenue durant l'envoi du fichier. " . $e->getMessage());
                                    }
                                }

                            }


                       }
                   $conn->commit();
                   $this->addFlash('notice', "Import réalisé avec succès.");
                   $reader->close();

                   $redirect = $this->redirectToRoute('historisation_import_admin',array(),302);
                   return $redirect;
                }



            }
        return $this->render('@Core/admin/indexImportHistorisationSiret.html.twig', array(
            'form' => $form->createView(),
            'importDone' => $import_allready_done,
            'creation' => $import_creation,
            'vide' => $import_unknow,
            'ca' => $import_changement_adresse,
            'fusion' => $import_fusion
        ));

    }
    public function historisationTraitementAutomatiqueFusionAction(){
        $em = $this->getDoctrine()->getManager();
        try{
            $em->getConnection()->beginTransaction();

            // Init erreur => collectivite /departement inconnu
            $stmt = $em->getConnection()->prepare("CALL historisation_init_erreur()");
            $stmt->execute();

            $import_fusion = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findBy(array('blErreur' => false, 'blArchi' => true, 'motif' => "Fusion"));
            $motif = $em->getRepository('ReferencielBundle:RefNatureMAJ')->findOneBy(array('cdStat' => 'fs'));

            $dtArch = new \DateTime('2018-12-31');
            $time = new \DateTime();
            $time->format('Y-m-d H:i:s');

            foreach ($import_fusion as $key => $value){

                $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByIdColl($value->getIDCOLL());
                $departement = $em->getRepository('CollectiviteBundle:Departement')->findOneByCdDepa($value->getIDDEPA()); // CD_DEPA Dans import
                $historiqueCollectivite = new HistoriqueCollectivite();
                $historiqueCollectivite->setDepartement($departement);
                $historiqueCollectivite->setCollectivite($collectivite);
                $historiqueCollectivite->setRefNatureMAJ($motif);
                $historiqueCollectivite->setLbTypeArch('Fusion');
                $historiqueCollectivite->setNmAnciSire($value->getNMSIRE());
                $historiqueCollectivite->setNmNouvSire($value->getMAJSIRET());
                $historiqueCollectivite->setCdUtilcrea('Import');
                $historiqueCollectivite->setDtCrea($time);
                $historiqueCollectivite->setDtArch($dtArch);

                $em->persist($historiqueCollectivite);
                $em->remove($value);
                $collectivite->setBlActi(false);
            }


            $em->flush();

            $em->getConnection()->commit();

            $respoonse = new JsonResponse(array('status' => true));

        }catch (\Error $e) {
            $em->getConnection()->rollBack();
            $respoonse = new JsonResponse(array('status' => false, 'message' => $e->getMessage()));
        }

        return $respoonse;
    }

    public function historisationTraitementAutomatiqueCAAction(){
        $erro = "";
        try{
            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();

            $import_changement_adresse = $em->getRepository('CollectiviteBundle:importSiretHistorisation')->findBy(array('blErreur' => false, 'blArchi' => true, 'motif' => "Changement adresse"));
            $motif = $em->getRepository('ReferencielBundle:RefNatureMAJ')->findOneBy(array('cdStat' => 'ca'));

            $dtArch = new \DateTime('2018-12-31');
            $time = new \DateTime();
            $time->format('Y-m-d H:i:s');

            foreach ($import_changement_adresse as $key => $value){
                $erro = "Collectivité : IdColl = " . $value->getIDCOLL();
                $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByIdColl($value->getIDCOLL());

                if($collectivite == null ) {
                    $em->getConnection()->rollBack();
                    $respoonse = new JsonResponse(array('status' => false, 'message' => $erro . " : pas de collectivité trouvée pour un changement d'adresse" ));
                    return $respoonse;
                }

                //$departement = $em->getRepository('CollectiviteBundle:Departement')->findOneByIdDepa($value->getIDDEPA());
                $departement = $em->getRepository('CollectiviteBundle:Departement')->findOneByCdDepa($value->getIDDEPA()); // CD_DEPA Dans import
                $historiqueCollectivite = new HistoriqueCollectivite();
                $historiqueCollectivite->setDepartement($departement);
                $historiqueCollectivite->setCollectivite($collectivite);
                $historiqueCollectivite->setRefNatureMAJ($motif);
                $historiqueCollectivite->setLbTypeArch("Changement d'adresse");
                $historiqueCollectivite->setNmNouvSire($value->getMAJSIRET());
                $historiqueCollectivite->setNmAnciSire($value->getNMSIRE());
                $historiqueCollectivite->setCdUtilcrea('Import');
                $historiqueCollectivite->setDtCrea($time);
                $historiqueCollectivite->setDtArch($dtArch);

                $em->persist($historiqueCollectivite);
                $em->remove($value);
                $collectivite->setBlActi(false);
            }

            $em->flush();

            $em->getConnection()->commit();

            $respoonse = new JsonResponse(array('status' => true));

        }catch (\Error $e) {
            $em->getConnection()->rollBack();
            $respoonse = new JsonResponse(array('status' => false, 'message' => $erro . ":" . $e->getMessage()));
        }

        return $respoonse;
    }

    public function historisationTraitementAutomatiqueACAction(){

        try{

            $query = "CALL historisation_aucun_changement()";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();


            $respoonse = new JsonResponse(array('status' => true));

        }catch (\Error $e) {
          /*  $em->getConnection()->rollBack();*/
            $respoonse = new JsonResponse(array('status' => false, 'message' => $e->getMessage()));
        }

        return $respoonse;
    }
    public function historisationTraitementAutomatiqueCreationAction(){

        try{

            $query = "CALL historisation_creation()";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();

            $tempPassword = 'siret';

            $query2 = "CALL create_user_from_collectivite()";
            $stmt2 = $this->getEntityManager()->getConnection()->prepare($query2);
            $stmt2->execute();

            $respoonse = new JsonResponse(array('status' => true));

        }catch (\Error $e) {
            /*  $em->getConnection()->rollBack();*/
            $respoonse = new JsonResponse(array('status' => false, 'message' => $e->getMessage()));
        }

        return $respoonse;
    }
    public function historisationTraitementAutomatiqueManuelleAction(){

        try{

            $respoonse = new JsonResponse(array('status' => true));

        }catch (\Error $e) {
            /*  $em->getConnection()->rollBack();*/
            $respoonse = new JsonResponse(array('status' => false, 'message' => $e->getMessage()));
        }

        return $respoonse;
    }
    /*
    *   fonctions autour de la manipulation de la session
    */
    protected $session;
    public function getSession(){
        if($this->session == null){
            $this->session = new Session();
        }
        return $this->session;
    }
    public function getFromSession($key){
        $session = $this->getSession();
        if($key==null){
            return $session->all();
        }else{
            return $session->get($key);
        }
    }
    public function getAllFromSession(){
        $session = $this->getSession();
        return $session->all();
    }
    public function setToSession($key,$value){
        $session = $this->getSession();
        $session->set($key,$value);
    }
    public function removeFromSession($key){
        $session = $this->getSession();
        $session->remove($key);
    }
    public function clearSession($key){
        $session = $this->getSession();
        $session->clear();
    }

    /*
    *   fonction autour du BaseConfigFinder
    */
    protected function getFromConfigFile($config_name,$sub_config_name=null){
        return $this->get('core_config_finder')->getConfig($config_name,$sub_config_name);
    }

    public function exportHistoriqueEchangeAction(Request $request) {
        $listIds =  $request->get('listIds');      
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();       
        $listIds = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->findByCollectivite($listIds); 
       //$listIds = $em->getRepository('CollectiviteBundle:HistoriqueEchange')->findAll();  
        $header = $em->getClassMetadata('CollectiviteBundle:HistoriqueEchange')->getColumnNames();
        $fileName = "export_historique_echange_" . date("d_m_Y") . ".csv";
        $response = new Response();
        $handle = fopen('php://output', 'w+');
        ob_start();
        fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
        fputcsv($handle, array('Id',
                'Intitulé',
                'Type d\'échange',
                'Commentaire',
                'Date de l\'échange',
                'Collectivité'
            ), ';');

        //Champs
        foreach ($listIds as $index => $listId)
            {
                fputcsv($handle,array(
                    $listId->getIdHistEcha(),
                    $listId->getLbIntiEcha(),
                    $listId->getLbTypeEcha(),
                    $listId->getCmEcha(),
                    $listId->getDtEcha()->format('d-m-Y'),
                    $listId->getCollectivite()->getLbColl(),
                ),';');
            }

        fclose($handle);
        //});
        $content = ob_get_clean();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setContent($content);
        return $response;
    }

    function execInBackground($cmd, $idUtil = null) {  
        if (substr(php_uname(), 0, 7) == "Windows"){
            pclose(popen("start /B ". $cmd, "r")); 
        } else { 
            exec($cmd . " > /dev/null & echo $!", $output);

            $result = [
                'pid' => $output[0],
                'idUtil' => $idUtil
            ];

            return $result;
        } 
    }
}

function csv_content_parser($content) {
    foreach (explode("\n", $content) as $line) {
        // Generator saves state and can be resumed when the next value is required.
        yield str_getcsv($line);
    }
}
