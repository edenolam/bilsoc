<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Bilan_Social\Bundle\AnalyseBundle\Entity\DemandeAnalyse;
use Bilan_Social\Bundle\AnalyseBundle\Entity\ModeleAnalyse;
use Bilan_Social\Bundle\AnalyseBundle\Entity\HeaderExportHRG;
use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerType;
use Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialQuestionsBoeths;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use SplFileObject;
use ZipArchive;
use Symfony\Component\HttpKernel\KernelInterface;

class DefaultController extends AbstractBSController
{
    protected $em;
    protected $container;

    public function __construct(EntityManager $entityManager = null, ContainerInterface $container) {
        $this->em = $entityManager;
        $this->container = $container;
    }
    /*
    *   page de gestion des analyse, modèles d'analyse et demande d'analyse
    */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($user);
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($user);
        $campagne = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        $modeleAnalyse = $em->getRepository('AnalyseBundle:ModeleAnalyse')->findOneBy(array('cdg' => $cdg, 'campagne' => $campagne));
        $disabled = false;
        $infosFichier = [];

        $fileManager = $this->getBSFileManager();

        if (empty($modeleAnalyse)) {
            $modeleAnalyse = new ModeleAnalyse();
        }

        if ($cdg != null) {
            $ownerKey = "CDG-" . $cdg->getIdCdg();
        }

        $logicalFolders = ['PARTA'];
        $fichiers = $em->getRepository('FileManagerBundle:Fichier')->findFichiersByOwnerAndCampagne($ownerKey, $campagne->getNmAnne(), $logicalFolders);

        $form = $this->createFormBuilder()
            ->add('importAnalyse', FileManagerType::class, array(
                'mapped' => true,
                'label' => false,
            ))
            ->getForm();
        $form->handleRequest($request);

        $formCol = $this->createForm('Bilan_Social\Bundle\EnqueteBundle\Form\ParametrageEnqueteForm');

        $formAnalyse = $this->createForm('Bilan_Social\Bundle\AnalyseBundle\Form\ModeleAnalyseType', $modeleAnalyse,
            array('collectivites' => []));

        if (!empty($fichiers) && sizeof($fichiers) > 0) {
            $disabled = true;
            foreach ($fichiers as $key => $fichier) {
                $fileInfo = $fileManager->getFileInfos($fichier->getFileKey());
                if (isset($fileInfo) && isset($fileInfo['status']) && $fileInfo['status'] == 200) {
                    $infosFichier[$key]['nom'] = $fileInfo['json_response']['originalFileName'];
                    $infosFichier[$key]['fileKey'] = $fileInfo['json_response']['fileKey'];
                    $infosFichier[$key]['fileUrl'] = $fileManager->getFileUrl($fileInfo['json_response']['fileKey']);
                }
            }
        }

        $formAnalyse->handleRequest($request);
        if ($formAnalyse->isSubmitted() && $formAnalyse->isValid()) {

            $idColls = $formAnalyse->get('idColl')->getData();
            $idColls = explode(',', $idColls);
            $collectivites = $em->getRepository('CollectiviteBundle:Collectivite')->getCollectiviteByIds($idColls);
            foreach ($collectivites as $key => $collectivite) {
                $modeleAnalyse->addCollectivite($collectivite);
            }
            $modeleAnalyse->setCdg($cdg);
            $modeleAnalyse->setCampagne($campagne);
            $modeleAnalyse->setBlAffi(1);
            $modeleAnalyse->setDtCrea(new \DateTime);
            $modeleAnalyse->setCdUtilCrea($user->getUsername());

            $em->getConnection()->beginTransaction();
            try {
                $em->persist($modeleAnalyse);
                $em->flush();

                $em->getConnection()->commit();
                $this->addFlash('notice', $this->get('translator')->trans('enregistrement.modele.analyse.flash'));
            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('error', $this->get('translator')->trans('erreur.envoi.demande.analyse.flash'));
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('form')['importAnalyse']['file'];
            $folder = "PARTA";
            if (isset($file)) {

                $response_upload = $fileManager->uploadFileInFolder($folder,
                    $fileManager->prepareFileToAdd($file));

                if (!$response_upload['isOk']) {
                    $this->addFlash('error', $response_upload['errMsg']);
                    return $this->render('AnalyseBundle:Default:index.html.twig',
                        array('collectivites' => []/*$collectivites*/,
                            'formCol' => $formCol->createView(),
                            'formAnalyse' => $formAnalyse->createView(),
                            'form' => $form->createView(),
                            'demandesAnalyse' => [],
                            'disabled' => $disabled,
                            'infosFichier' => $infosFichier
                        ));
                }

                //
                // Rattachement au collectivités
                if (!empty($collectivites) && sizeof($collectivites) > 0) {
                    try {
                        foreach ($collectivites as $key => $collectivite) {
                            if (!empty($collectivite)) {
                                $coll = $em->getRepository('CollectiviteBundle:Collectivite')->find($collectivite['idColl']);
                                $coll->addFichier($fichier);
                                $em->persist($coll);
                                $fichier->addCollectivite($coll);
                            }
                        }
                        $em->persist($fichier);
                        $em->flush();

                    } catch (Exception $ex) {
                        $this->addFlash('error', 'Une erreur est survenue durant le rattachement de l\'analyse aux collectivités');
                        return $this->render('AnalyseBundle:Default:index.html.twig',
                            array('collectivites' => []/*$collectivites*/,
                                'formCol' => $formCol->createView(),
                                'formAnalyse' => $formAnalyse->createView(),
                                'form' => $form->createView(),
                                'demandesAnalyse' => [],
                                'disabled' => $disabled,
                                'infosFichier' => $infosFichier
                            ));
                    }
                }
                $this->addFlash('notice', $this->get('translator')->trans('depot.analyse.flash'));
            }

            return $this->render('AnalyseBundle:Default:index.html.twig',
                array('collectivites' => [],
                    'formCol' => $formCol->createView(),
                    'formAnalyse' => $formAnalyse->createView(),
                    'form' => $form->createView(),
                    'demandesAnalyse' => [],
                    'disabled' => $disabled,
                    'infosFichier' => $infosFichier
                ));
        }
        return $this->render('AnalyseBundle:Default:index.html.twig',
            array('collectivites' => [],
                'formCol' => $formCol->createView(),
                'formAnalyse' => $formAnalyse->createView(),
                'form' => $form->createView(),
                'demandesAnalyse' => [],
                'disabled' => $disabled,
                'infosFichier' => $infosFichier));
    }

    public function demandeAnalyseAction(Request $request, $anneeCampagne = null)
    {
        $em = $this->getDoctrine()->getManager();
        $demandeAnalyse = new DemandeAnalyse();
        $user = null;
        if(($username = $this->getFromSession('username')) != null){
            $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            //dump($user);die;
        }else {
            $user = $this->getUser();
        }

        $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->findOneByNmSire($user->getUsername());
        $siretCol = $collectivite->getNmSire();
        $libCol= $collectivite->getLbColl();

        $campagne = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        if($anneeCampagne == null){
            $anneeCampagne = $campagne->getNmAnne();
        }
        $campagnePrecedente = $em->getRepository('CampagneBundle:Campagne')->findAll();
        $infosFichier = [];
        $infosFichierPerso = [];
        $infosFichierPv = [];

        $fileManager = $this->getBSFileManager();
        
        $listeDemandes = $em->getRepository('AnalyseBundle:DemandeAnalyse')->findByCollectivite($collectivite);
        
        $cdg = $collectivite->getCdgDepartement()->getCdg();

        if ($cdg != null) {
            $ownerKey = "CDG-" . $cdg->getIdCdg();
        }else{
            $ownerKey = "COLL-" . $this->getUser()->getCollectivite()->getIdColl();
        }
        
        $folders = ['PARTA'];
        $fichiers = $em->getRepository('FileManagerBundle:Fichier')->findFichiersByOwnerAndCampagne($ownerKey, $anneeCampagne, $folders);

        if (!empty($fichiers) && sizeof($fichiers) > 0) {
            foreach ($fichiers as $key => $fichier) {
                $fileInfo = $fileManager->getFileInfos($fichier->getFileKey());
                if (isset($fileInfo) && isset($fileInfo['status']) && $fileInfo['status'] == 200) {
                    $infosFichier[$key]['nom'] = $fileInfo['json_response']['originalFileName'];
                    $infosFichier[$key]['fileKey'] = $fileInfo['json_response']['fileKey'];
                    $infosFichier[$key]['fileUrl'] = $fileManager->getPublicFileUrl($fileInfo['json_response']['fileKey']);
                }
            }
        }
        
        $folders = ['PERSO'];
        $folder_proces_verbaux = ["PV"];
        $analysePerso = $em->getRepository('FileManagerBundle:Fichier')->findFichiersByCollectiviteAndCampagne($collectivite, $anneeCampagne, $folders);
        $pvs = $em->getRepository('FileManagerBundle:Fichier')->findFichiersByCollectiviteAndCampagne($collectivite, $anneeCampagne, $folder_proces_verbaux);
        if (!empty($analysePerso) && $analysePerso != null) {
            foreach ($analysePerso as $key => $fichier) {
                $fileInfo = $fileManager->getFileInfos($fichier->getFileKey());
                if (isset($fileInfo) && isset($fileInfo['status']) && $fileInfo['status'] == 200) {
                    $infosFichierPerso[$key]['nom'] = $fileInfo['json_response']['originalFileName'];
                    $infosFichierPerso[$key]['fileKey'] = $fileInfo['json_response']['fileKey'];
                    $infosFichierPerso[$key]['fileUrl'] = $fileManager->getPublicFileUrl($fileInfo['json_response']['fileKey']);

                }
            }
        }
        if (!empty($pvs) && $pvs != null) {
            foreach ($pvs as $key => $fichier) {
                $fileInfo = $fileManager->getFileInfos($fichier->getFileKey());
                if (isset($fileInfo) && isset($fileInfo['status']) && $fileInfo['status'] == 200) {
                    $infosFichierPv[$key]['nom'] = $fileInfo['json_response']['originalFileName'];
                    $infosFichierPv[$key]['fileKey'] = $fileInfo['json_response']['fileKey'];
                    $infosFichierPv[$key]['fileUrl'] = $fileManager->getPublicFileUrl($fileInfo['json_response']['fileKey']);
                }
            }
        }
            
        $form = $this->createForm('Bilan_Social\Bundle\AnalyseBundle\Form\DemandeAnalyseType', $demandeAnalyse);
        $form_depot_pv = $this->createFormBuilder()
            ->add('importPv', FileManagerType::class, array(
                'mapped' => false,
                'label' => false,
            ))
            ->getForm();

        $form_depot_pv->handleRequest($request);
        $form->handleRequest($request);
       
       if($form !== null && $form_depot_pv !== null){

            if ($form->isSubmitted() && $form->isValid()) {
                $demandeAnalyse->setDtCrea(new \DateTime());
                $demandeAnalyse->setCollectivite($collectivite);
                $demandeAnalyse->setCdUtilCrea($user->getUsername());
                $demandeAnalyse->setCdg($cdg);
                $demandeAnalyse->setFgStat(0);

                $em->getConnection()->beginTransaction();
                try {
                    $em->persist($demandeAnalyse);
                    $em->flush();
                    $em->getConnection()->commit();
                    $this->addFlash('notice', $this->get('translator')->trans('envoi.demande.analyse.flash'));
                } catch (Exception $ex) {
                    $em->getConnection()->rollBack();
                    $this->addFlash('error', $this->get('translator')->trans('erreur.envoi.demande.analyse.flash'));
                }
            }
            
            if ($form_depot_pv->isSubmitted() && $form_depot_pv->isValid()) {

                $file = $request->files->get('form')['importPv']['file'];
                $folder_proces_verbaux = "PV";
                if (isset($file)) {
                    $response_upload = $fileManager->uploadFileInPublicFolder($folder_proces_verbaux, $fileManager->prepareFileToAdd($file, true));
                    if (!$response_upload['isOk']) {
                        $this->addFlash('error', $response_upload['errMsg']);
                    }
                }
            }
       }
        
        return $this->render('AnalyseBundle:Default:demandeAnalyse.html.twig',
                array(
                    'form' => $form->createView(),
                    'form_depot_pv' =>  $form_depot_pv->createView(), 
                    'listeDemandes' => $listeDemandes, 
                    'analysePartagee' => $infosFichier, 
                    'analysePerso' => $infosFichierPerso, 
                    'procesVerbaux' => $infosFichierPv,
                    'campagnePrecedente' => $campagnePrecedente,
                    'anneeCampagneLoad' => $anneeCampagne,
                    'siretCol' => $siretCol,
                    'libCol' => $libCol,
                ));
    }


    public function showAction($id){

        $em = $this->getDoctrine()->getManager();
        $Collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($id);

        $session = $this->get('session');
        $session->set('coll_id', $Collectivite -> getIdColl());
        $session->set('username', $Collectivite -> getNmSire());

        return $this->redirectToRoute('analyse_demande');
    }


     public function switchColToCdgAction(){

            $session = $this->get('session');
            $session->remove('coll_id');
            $session->remove('username');
            $test = $session->get('username');

            return $this->redirectToRoute('enquete_suivi');
    }

    public function deleteDemandeAnalyseAction(Request $request, DemandeAnalyse $demandeAnalyse)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($demandeAnalyse);
        $em->flush();
        $flash = $this->get('translator')->trans('suppression.analyse.ok');
        $return = new JsonResponse([
                        'success'   => true,
                        'message'   => $flash,
                        ]);   
            return $return;
    }

    public function ficheDemandeAnalyseAction(Request $request, DemandeAnalyse $demandeAnalyse, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $demandeAnalyse->setAnalyseRead(true);
        $em->flush();
        $user = $this->getUser();
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($user);
        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($user);
        $demande = $em->getRepository('AnalyseBundle:DemandeAnalyse')->find($id);
        $droitsCdg = null;
        $campagne = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        $fileManager = $this->getBSFileManager();

        $disabled = false;
        $infosFichier = [];

        if ($cdg != null) {
            $ownerKey = "CDG-" . $cdg->getIdCdg();
        }

        if ($demande != null) {
            $collectivite = $demande->getCollectivite();

            $droitsColl = $em->getRepository('CollectiviteBundle:Collectivite')->getDroitsSurCollectivite($collectivite->getIdColl(), $utilCdg->getIdUtilisateurCdg());
            if (($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_COLLECTIVITE)) {
                $droitsCdg = 'read';
            }
            if (($droitsColl['fgDroits'] & bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)) === bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)) {
                $droitsCdg = 'write';
            }
        } else {
            $demande = null;
            return $this->render('AnalyseBundle:Default:ficheDemandeAnalyse.html.twig', array('demande' => $demande, 'form' => $form->createView(), 'droits' => $droitsCdg, 'disabled' => $disabled, 'infosFichier' => $infosFichier));
        }

        $logicalFolders = ['PERSO'];

        $fichiers = $em->getRepository('FileManagerBundle:Fichier')->findFichiersByOwnerAndCampagne($ownerKey, $campagne->getNmAnne(), $logicalFolders, $collectivite->getIdColl());

        $form = $this->createFormBuilder()
            ->add('importAnalyse', FileManagerType::class, array(
                'mapped' => true,
                'label' => false,
            ))
            ->getForm();

        if (!empty($fichiers) && sizeof($fichiers) > 0) {
            $disabled = true;
            foreach ($fichiers as $key => $fichier) {
                $fileInfo = $fileManager->getFileInfos($fichier->getFileKey());
                if (isset($fileInfo) && isset($fileInfo['status']) && $fileInfo['status'] == 200) {
                    $infosFichier[$key]['nom'] = $fileInfo['json_response']['originalFileName'];
                    $infosFichier[$key]['fileKey'] = $fileInfo['json_response']['fileKey'];
                    $infosFichier[$key]['fileUrl'] = $fileManager->getFileUrl($fileInfo['json_response']['fileKey']);
                }
            }
        }

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('form')['importAnalyse']['file'];
            
            $option = [
                'collectivite' => $collectivite
            ];
            
            
            if (isset($file)) {
                try{
                        $logicalFolders = 'PERSO';
                        $fileManager = $this->getBSFileManager();
                        $response_upload = $fileManager->uploadFileInPublicFolder($logicalFolders, $fileManager->prepareFileToAdd($file, true, null,$option));

                        if ($response_upload['isOk']) {
                            $this->addFlash('notice', 'Analyse envoyée');
                            $demande->setFgStat(1);
                            $em->flush();
                            $contactService = $this->get('Bilan_Social.ContactBundle.Services.Contact');
                            $contact_Collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->GetContactPrincipal($collectivite->getIdColl());
                            $contactService->sendEmailInterneAppli('DEPOSANALYSE', $contact_Collectivite->getLbMail(), false, $cdg);
                         }else{
                            $this->addFlash('error', $response_upload['errMsg']);
                        }
                }
                catch (\Exception $ex) {
                    $this->addFlash('error',  $this->get('translator')->trans('erreur.collectivite.flash'));
                }
            }
        }

        return $this->render('AnalyseBundle:Default:ficheDemandeAnalyse.html.twig',
            array('demande' => $demande,
                'form' => $form->createView(),
                'droits' => $droitsCdg,
                'disabled' => $disabled,
                'infosFichier' => $infosFichier
            ));
    }

    public function getDemandeAnalyseAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $this->saveAndUnlockSession($request);
        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($user);
        $demandesAnalyse = $em->getRepository('AnalyseBundle:DemandeAnalyse')->getDemandeAnalyseByCdg($cdg);
        $data = array("data" => $demandesAnalyse);
        return new JsonResponse($data);
    }
    
    public function removeFileAction(Request $request){
       
        $fileManager = $this->getBSFileManager();
        $filekey = $request->get('fileKey');
        
        if(!empty($filekey)){
            $fileManager->deleteFile($filekey);
        }
        
        return $this->redirectToRoute('analyse_homepage');
    }

    public function callExportHRGAction(Request $request, $codeExport = null) {
        try {
            $log_file_full_name = $request->get('log_file_full_name',null);
            $log_infos = array('log_file_full_name'=>$log_file_full_name, 'prefix'=>$codeExport);
            ob_start();
            $user = $this->getUser();
            $fileManager = $this->getBSFileManager();
            $em = $this->em != null ? $this->em : ($this->getDoctrine()!=null ? $this->getDoctrine()->getManager() : null);
            
            $id_pool = $request->get('id_pool');
            $anonymisation = $request->get('anonymisation',false);
            //get pool item where id pool = id récupéré de la request

            $arr = [];
            $idColl = null;
            $consos = null;
            $annee = "";

            $user = null;
            if(($username = $this->getFromSession('username')) != null){
                $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            }else {
                $user = $this->getUser();
            }

             $create_prepa_table_sql = "CREATE TABLE IF NOT EXISTS WORKING_export_hrg_bsc_rows (ID_COLL INT(11), ID_ENQU INT(11), ID_BSC INT(11), CD_EXPORT VARCHAR(50), ID_POOL_EXPORT INT(11) NULL, ID_WORKING_EXPORT INT(11), PRIMARY KEY(ID_WORKING_EXPORT, ID_BSC), INDEX (ID_COLL), INDEX (ID_ENQU), INDEX (ID_BSC), INDEX(ID_POOL_EXPORT), INDEX(ID_WORKING_EXPORT));";
            $empty_prepa_table_sql = "DELETE FROM WORKING_export_hrg_bsc_rows WHERE ID_WORKING_EXPORT = :id_working_export;";
            $base_insert_in_prepa_table_sql = "INSERT INTO WORKING_export_hrg_bsc_rows (ID_COLL,ID_ENQU,ID_BSC,CD_EXPORT,ID_POOL_EXPORT,ID_WORKING_EXPORT)
                SELECT bsc.ID_COLL, bsc.ID_ENQU, bsc.ID_BILASOCICONS, :code_export, :id_pool_export, :id_working_export
                FROM bilan_social_consolide bsc
                WHERE ";
            try{
            $id_pool_export = null;
            $id_working_export = null;
            if ($user->hasRole('ROLE_CDG') || $user->hasRole('ROLE_INFOCENTRE')) {
                $header = $em->getRepository('AnalyseBundle:HeaderExportHRG')->findOneByCodeExport($codeExport);
                $header->setStatus(1);
                $em->persist($header);
                $em->flush();
                $id_pool_export = $header->getPoolExport()->getId();
                $id_working_export = $id_pool_export;
                $pool = $em->getRepository('InfoCentreBundle:Pool')->findOneById($id_pool);
                $grouped_pool_items = $pool->getGroupsAnnee();
                $msg = array("------ DÉBUT préparation des données pour ".count($grouped_pool_items).' année(s) : '.implode(', ', array_keys($grouped_pool_items)));
                file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
                foreach ($grouped_pool_items as $items_annne => $pool_items) {
                    $msg = array('début préparation année '.$items_annne.' pour '.count($pool_items).' collectivités');
                    file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
                    $em_annee = $this->getDataWellConnection($items_annne);
 
                    $this->SQLNativeQuery($create_prepa_table_sql,array(),null,$items_annne);
                    $this->SQLNativeQuery($empty_prepa_table_sql,array('id_working_export'=>$id_working_export),null,$items_annne);
                    
                    $where_sql = "";
                    //$arr = array();
                    if (!array_key_exists($items_annne, $arr)) {
                        $arr[$items_annne] = count($pool_items);
                    }
                    foreach ($pool_items as $key => $item) {
                        $where_sql .= $key > 0 ? " OR " : "";
                        $where_sql .= "(bsc.ID_COLL = ".$item->getIdCollectivite()." AND bsc.ID_ENQU = ".$item->getIdEnquete().")";
                        /*$bilaSociCons = $em_annee->getRepository('ConsoBundle:BilanSocialConsolide')->findOneByActif($item->getIdCollectivite(), $item->getIdEnquete(),$items_annne);

                        if ($bilaSociCons) {
                            $idBilaSociCons = $bilaSociCons->getIdbilasocicons();
                            $idColl = $bilaSociCons->getCollectivite()->getIdColl();
                            $annee = $item->getAnneeCampagne();
                            // if (!array_key_exists($annee, $arr)) {
                            //     $arr[$annee] = [];
                            // }
                            array_push($arr[$annee], array("idBsc" => $idBilaSociCons, "idColl" => $idColl, "nmAnnee" => $annee));
                        }
                        error_log(empty($arr[$items_annne]), 0);
                        if(empty($arr[$items_annne])){
                            array_push($arr[$items_annne], array("idBsc" => null, "idColl" => null, "nmAnnee" => $items_annne));
                            $annee = $items_annne;
                        } 
                        error_log(json_encode($items_annne), 0);
                        error_log(json_encode($arr), 0);
                        error_log(json_encode($arr[$items_annne]), 0);*/
                    }
                    $this->SQLNativeQuery($base_insert_in_prepa_table_sql.' '.$where_sql.';',
                        array('id_working_export'=>$id_working_export,'id_pool_export'=>$id_pool_export,'code_export'=>$codeExport),
                        null,$items_annne
                    );
                    $msg = array('fin préparation année '.$items_annne.' pour '.count($pool_items).' collectivités');
                    file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
                }
                $msg = array("------ FIN préparation des données pour ".count($arr).' année(s) : '.implode(', ', array_keys($arr)));
                file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
            } elseif ($user->hasRole('ROLE_COLLECTIVITY')) {
                $bsc = $this->getMonBilanSocialConsolide();
                $idBilaSociCons = $bsc->getIdBilasocicons();
                $idColl = $user->getCollectivite()->getIdColl(); //$$this->getFromSession('coll_id');
                $idEnqu = $bsc->getEnquete()->getIdEnqu();
                $codeExport = "from_collectivite_".$idColl;
                $id_working_export = $idColl.$idEnqu;
                $where_sql = "";
                $result = $em->getRepository('EnqueteBundle:Enquete')->findOneByIdEnqu($idEnqu);
                $annee = $result->getNmAnne();
                $this->SQLNativeQuery($create_prepa_table_sql,array(),null,$annee);
                $this->SQLNativeQuery($empty_prepa_table_sql,array('id_working_export'=>$id_working_export),null,$annee);
                if (!array_key_exists($annee, $arr)) {
                    $arr[$annee] = 1;
                }
                $where_sql .= "(bsc.ID_COLL = ".$idColl." AND bsc.ID_ENQU = ".$idEnqu.")";
                $this->SQLNativeQuery($base_insert_in_prepa_table_sql.' '.$where_sql.';',
                    array('id_working_export'=>$id_working_export,'id_pool_export'=>$id_pool_export,'code_export'=>$codeExport),
                    null,$annee
                );
                //array_push($arr[$annee], array("idBsc" => $idBilaSociCons, "idColl" => $idColl, "nmAnnee" => $annee));
            }
            }catch(\Exception $e){
                exportHrgLog(array($e->getMessage(),$e->getFile(),$e->getLine(), $e->getTraceAsString()));

            }
            if ($user->hasRole('ROLE_CDG') || $user->hasRole('ROLE_INFOCENTRE')) {
                $msg = array("export de ".count($arr).' année(s) : '.implode(', ', array_keys($arr)));
                file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
                $analyse_controller = new DefaultController($this->em, $this->container);
                $chemin = 'EXPORT_HRG';
                foreach ($arr as $annee => $infos) {
                    
                    $msg = array("traitement pour ".$annee.' avec '.$infos.' collectivité(s)');
                    file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
                    
                    $download = $analyse_controller->exportHandiRassctGpeecExcelAction($infos,$log_infos,$id_working_export,$annee);

                    $temp_dir = sys_get_temp_dir();
                    $original_name = 'export_hrg_' . $annee . '.xls';
                    $file_path = $temp_dir.'/'.$original_name;
                    $temp_file = fopen($file_path,"w+");
                    
                    $msg = array("traitement terminé pour ".$annee,'file_path : '.$file_path, 'file_name : '.$original_name);
                    file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
                    
                    fwrite($temp_file, $download->getContent());
                    $obj_file = new UploadedFile($file_path, $original_name, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');            
                    $response_upload = $fileManager->uploadFileInPublicFolder($chemin, $fileManager->prepareFileToAdd($obj_file, false));
                    if ($response_upload['isOk']) {
                        $fichier = $em->getRepository('FileManagerBundle:Fichier')->findOneByFileKey($response_upload['fichier']->getFileKey());
                        $header->addFileKey($fichier);
                        
                        $msg = array("fichier uploadé pour ".$annee,'file_key : '.$fichier->getFileKey().' ('.json_encode($fichier).')');
                        file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
                    }
                    fclose($temp_file);
                }
                $msg = array("traitements terminés les ".count($arr)." années");
                file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));

                $header->setStatus(2);
                $header->setDateEnd(new \DateTime());
                $em->persist($header);
                $em->flush();
                
                $msg = array("prêt à tuer le process ".$header->getPid());
                file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));

                $cmd = "kill -9 " . $header->getPid();
                exec($cmd);

                $msg = array("proccess tué ".$header->getPid(),"=======");
                file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
                
                $response = new Response(json_encode($user->getRoles()), 200);
            } elseif ($user->hasRole('ROLE_COLLECTIVITY')) {
                $zip = new ZipArchive;
                $zipName = 'export_handitorial_rassct_gpeec.zip';
                $res = $zip->open($zipName, ZipArchive::CREATE);
    
                if ($res === TRUE) {
                    /*
                        pour ne pas changer la config de la methode appellée, il faut ciblier l index 0 du tableau passé en argument,
                        ici nous ne devrions jamais avoir plusieurs bilan consolidé en même temps
                    */
                    $download = $this->forward('AnalyseBundle:Default:exportHandiRassctGpeecExcel', array('array_info' => $arr[$annee],'log_infos' => $log_infos,'id_working_export' => $id_working_export));
                    $zip->addFromString('export.xls', $download->getContent());
                }

                $zip->close();
                ob_end_clean();

                $zip_ressource = fopen($zipName, "r");
                $content = stream_get_contents($zip_ressource);
                $response = new Response($content, 200, 
                        array(
                        'Content-Type'        => 'application/zip;charset=UTF-8',
                        'Content-Disposition' => 'attachment; filename="' . $zipName . '"',
                        'Content-Length: ' . filesize($zipName)
                    )
                );

                fclose($zip_ressource);
                unlink($zipName);
            }
            ob_clean();
        } catch(\Exception $e) {
            error_log($e->getMessage());
            error_log($e->getFile());
            error_log($e->getLine());
            error_log($e->getTraceAsString());
            $msg = array($e->getMessage(),' in '.$e->getFile().' at line '.$e->getLine(),$e->getTraceAsString());
            file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
        }  

        return $response;
    }

    public function exportHandiRassctGpeecExcelAction($array_info,$log_infos=null,$id_working_export=null,$annee=null) {
        set_time_limit(0);
        $msg = array('début de l\'action pour une année');
        file_log_error($log_infos,$msg);
        try{
            // FetchMode
            $user = $this->getUser();

            $em = $this->getDoctrine()->getManager();

            $user = null;
            if(($username = $this->getFromSession('username')) != null){
                $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
                //dump($user);die;
            }else {
                $user = $this->getUser();
            }
            $nmAnnee = $annee;
            $array_idColls = [];
            $array_idBscs = [];
            $array_idEnqu = [];
            $get_coll_list_sql = "SELECT ID_COLL FROM WORKING_export_hrg_bsc_rows WHERE ID_WORKING_EXPORT = :id_working_export;";
            $get_bsc_list_sql = "SELECT ID_BSC FROM WORKING_export_hrg_bsc_rows WHERE ID_WORKING_EXPORT = :id_working_export;";
            $get_enqu_list_sql = "SELECT ID_ENQU FROM WORKING_export_hrg_bsc_rows WHERE ID_WORKING_EXPORT = :id_working_export;";
            $array_params = array('id_working_export'=>$id_working_export);
            $array_idColls = $this->SQLNativeQuery($get_coll_list_sql,$array_params,true,$nmAnnee,array('fetch_style'=>\PDO::FETCH_COLUMN, 'fetch_argument'=>0));
            $array_idBscs = $this->SQLNativeQuery($get_bsc_list_sql,$array_params,true,$nmAnnee,array('fetch_style'=>\PDO::FETCH_COLUMN, 'fetch_argument'=>0));
            $array_idEnqu = $this->SQLNativeQuery($get_enqu_list_sql,$array_params,true,$nmAnnee,array('fetch_style'=>\PDO::FETCH_COLUMN, 'fetch_argument'=>0));

            $isFromCdg = $user->hasRole('ROLE_CDG') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_INFOCENTRE');

            /*foreach ($array_info as $value) {
                if($value['idBsc']) {
                    array_push($array_idColls, $value['idColl']);
                    array_push($array_idBscs, $value['idBsc']);
                }
                $nmAnnee = $value['nmAnnee'];
            }*/
            $json_encoded_info = json_encode($array_info);
            $msg = array('année '.$nmAnnee.' avec '.count($array_idColls).' élément(s)',$json_encoded_info);
            file_log_error($log_infos,$msg);
            $user = $this->getUser();
            $em =  $isFromCdg ? $this->getDataWellConnection($nmAnnee) : $this->getDoctrine()->getManager();
            $bsc_repo = $em->getRepository('ConsoBundle:BilanSocialConsolide');

            $collectivites_array = $em->getRepository('CollectiviteBundle:Collectivite')->findBy(array('idColl' => $array_idColls));
            //$bilaconso_array = $em->getRepository('ConsoBundle:BilanSocialConsolide')->findByActif($array_idBscs,$nmAnnee);

            if (empty($get_bsc_list_sql)) {
                $msg = array('année '.$nmAnnee.' génération du fichier');
                file_log_error($log_infos,$msg);
                return $this->render('AnalyseBundle:Export:export_dgcl_handi_rassct_gpeec.xls.twig', array(
                    'isEmpty' => true
                ));
            } else {
                /*foreach ($bilaconso_array as $conso) {

                    $idEnqu = $conso->getEnquete();
                    if (!in_array($idEnqu, $array_idEnqu)) {
                        array_push($array_idEnqu, $idEnqu);
                    }
                }*/

                $query = 'SELECT Q_HANDI_B22 AS qHandiB22 FROM bilan_social_consolide 
                    JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bilan_social_consolide.ID_BILASOCICONS
                    WHERE wehbr.ID_WORKING_EXPORT = :id_working_export;'; 
                    // WHERE ID_BILASOCICONS IN (:arrayId);';
                $QHandiB22 = $this->SQLNativeQuery($query, $array_params,null,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs,null,$nmAnnee);

                $query = 'SELECT Q_HANDI_B23 AS qHandiB23 FROM bilan_social_consolide 
                    JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bilan_social_consolide.ID_BILASOCICONS
                    WHERE wehbr.ID_WORKING_EXPORT = :id_working_export;'; 
                    //WHERE ID_BILASOCICONS IN (:arrayId);';
                $QHandiB23 = $this->SQLNativeQuery($query, $array_params,null,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs,null,$nmAnnee);
                // $QHandiB22  = $em->getRepository('ConsoBundle:bilanSocialConsolide')->getQHandiB22($array_idBscs);
                // $QHandiB23  = $em->getRepository('ConsoBundle:bilanSocialConsolide')->getQHandiB23($array_idBscs);

                $mesEnquetesCollectivites = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->findBy(array('enquete' => $array_idEnqu, 'collectivite' => $collectivites_array));

                // Handitorial
                if ($user->hasRole('ROLE_COLLECTIVITY')) {
                    if ($bsc_repo->isPropInAnnee('bscHanditorialQuestionsGenerales',$nmAnnee)) {
                        $query = 'SELECT Q_A3 AS qA3 FROM bsc_handitorial_questions_generales
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsc_handitorial_questions_generales.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export;';
                            //WHERE ID_BILASOCICONS IN (:arrayId);';
                        $result = $this->SQLNativeQuery($query, $array_params,null,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs,null,$nmAnnee);
                        $bscQA3 = array('qA3' => $result);
                    } else {
                        $bscQA3 = array('qA3' => '');
                    }

                    if ($bsc_repo->isPropInAnnee('bscHanditorialQuestionsGenerales',$nmAnnee)) {
                        $query = 'SELECT Q_A17 AS qA17 FROM bsc_handitorial_questions_generales
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsc_handitorial_questions_generales.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export;';
                            //WHERE ID_BILASOCICONS IN (:arrayId);';
                        $result = $this->SQLNativeQuery($query, $array_params,null,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs,null,$nmAnnee);
                        $bscQA17 = $result;
                    } else {
                        $bscQA17 = array('qA17' => '');
                    }
                    // $bscQA17 = $bsc_repo->isPropInAnnee('bscHanditorialQuestionsGenerales',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialQuestionsGenerales')->getQA17($array_idBscs) : array('qA17' => '');

                    if ($bsc_repo->isPropInAnnee('bscHanditorialInaptitudeEtReclassement',$nmAnnee)) {
                        $query = 'SELECT Q_A8 AS qA8 FROM bsc_handitorial_inaptitude_et_reclassement 
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsc_handitorial_inaptitude_et_reclassement.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export;';
                            //WHERE ID_BILASOCICONS IN (:arrayId);';
                        $result = $this->SQLNativeQuery($query, $array_params,null,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs,null,$nmAnnee);
                        $bscQA8 = array('qA8' => $result);
                    } else {
                        $bscQA8 = array('qA8' => '');
                    }
                    // $bscQA8 = $bsc_repo->isPropInAnnee('bscHanditorialInaptitudeEtReclassement',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialInaptitudeEtReclassement')->getQA8($array_idBscs) : array('qA8' => '');
                }
                else {
                    $bscQA3 = array('qA3' => '');
                    $bscQA17 = array('qA17' => '');
                    $bscQA8 = array('qA8' => '');
                }
                // $bscHandiQuestGenes = $em->getRepository('ConsoBundle:BscHanditorialQuestionsGenerales')->getResultsForExport($array_idBscs);

                // Inap et reclassement
                //dump($nmAnnee);
                if ($bsc_repo->isPropInAnnee('bscHanditorialInaptitudeEtReclassement',$nmAnnee)) {
                    $query = 'SELECT SUM(q_A511) AS qA511, SUM(q_A512) AS qA512, SUM(q_A513) AS qA513, SUM(r_A9) AS rA9, SUM(q_A521) AS qA521, 
                                            SUM(r_A101) AS rA101, SUM(q_A522) AS qA522, SUM(q_A523) AS qA523, SUM(q_A62) AS qA62, SUM(q_A72) AS qA72,
                                            SUM(q_A82) AS qA82 FROM bsc_handitorial_inaptitude_et_reclassement
                        JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsc_handitorial_inaptitude_et_reclassement.ID_BILASOCICONS
                        WHERE wehbr.ID_WORKING_EXPORT = :id_working_export;';
                        //WHERE ID_BILASOCICONS IN (:arrayId);';
                    $bscHandiInapEtRecla = $this->SQLNativeQuery($query, $array_params,null,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs,null,$nmAnnee);
                    //dump($bscHandiInapEtRecla);
                } else {
                    $bscHandiInapEtRecla = array();
                }

                    //dump($bscHandiInapEtRecla);
                // En cours
                if ($bsc_repo->isPropInAnnee('bscHanditorialAvisInaptitudes',$nmAnnee)) {
                    $query = 'SELECT temp.lbInaptitudeBoeth AS lbInaptitudeBoeth, SUM(temp.avisInaptitudeH) AS avisInaptitudeH, SUM(temp.avisInaptitudeF) AS avisInaptitudeF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_INAPTITUDE_BOETH, ref.lb_inaptitude_boeth AS lbInaptitudeBoeth, 0 AS avisInaptitudeH, 0 AS avisInaptitudeF
                            FROM ref_inaptitude_boeth ref
                            WHERE ref.BL_VALI = 0    
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_INAPTITUDE_BOETH, ref.lb_inaptitude_boeth AS lbInaptitudeBoeth, SUM(bsch.avis_inaptitude_H) AS avisInaptitudeH, SUM(bsch.avis_inaptitude_F) AS avisInaptitudeF
                            FROM bsc_handitorial_avis_inaptitudes bsch
                            JOIN ref_inaptitude_boeth ref ON bsch.ID_INAPTITUDE_BOETH = ref.ID_INAPTITUDE_BOETH
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_INAPTITUDE_BOETH
                        ) temp 
                        GROUP BY temp.ID_INAPTITUDE_BOETH
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiAvisInaps = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiAvisInaps = array();
                }
                // $bscHandiAvisInaps = $bsc_repo->isPropInAnnee('bscHanditorialAvisInaptitudes',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialAvisInaptitudes')->getResultsForExport($array_idBscs) : array();

                if ($bsc_repo->isPropInAnnee('bscHanditorialMesureInaptitudes',$nmAnnee)) {
                    $query = 'SELECT temp.lbMesureBoeth AS lbMesureBoeth, SUM(temp.mesureInaptitudeH) AS mesureInaptitudeH, SUM(temp.mesureInaptitudeF) AS mesureInaptitudeF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_MESURE_BOETH, ref.lb_Mesure_boeth AS lbMesureBoeth, 0 AS mesureInaptitudeH, 0 AS mesureInaptitudeF
                            FROM ref_mesure_boeth ref
                            WHERE ref.BL_VALI = 0    
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_MESURE_BOETH, ref.lb_Mesure_boeth AS lbMesureBoeth, SUM(bsch.mesure_Inaptitude_H) AS mesureInaptitudeH, SUM(bsch.mesure_Inaptitude_F) AS mesureInaptitudeF
                            FROM bsc_handitorial_mesure_inaptitudes bsch
                            JOIN ref_mesure_boeth ref ON bsch.ID_MESURE_BOETH = ref.ID_MESURE_BOETH
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_MESURE_BOETH
                        )temp
                        GROUP BY temp.ID_MESURE_BOETH
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiMesureInaps = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiMesureInaps = array();
                }
                // $bscHandiMesureInaps = $bsc_repo->isPropInAnnee('bscHanditorialMesureInaptitudes',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialMesureInaptitudes')->getResultsForExport($array_idBscs) : array();


                // Avant

                if ($bsc_repo->isPropInAnnee('bscHanditorialAvisInaptitudesAvant',$nmAnnee)) {
                    $query = 'SELECT temp.lbInaptitudeAvant AS lbInaptitudeAvant, SUM(temp.avisInaptitudeAvantH) AS avisInaptitudeAvantH, SUM(temp.avisInaptitudeAvantF) AS avisInaptitudeAvantF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_INAPTITUDE_BOETH, ref.lb_Inaptitude_boeth AS lbInaptitudeAvant, 0 AS avisInaptitudeAvantH, 0 AS avisInaptitudeAvantF
                            FROM ref_inaptitude_boeth ref
                            WHERE ref.BL_VALI = 0    
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_INAPTITUDE_BOETH, ref.lb_Inaptitude_boeth AS lbInaptitudeAvant, SUM(bsch.avis_Inaptitude_Avant_H) AS avisInaptitudeAvantH, SUM(bsch.avis_Inaptitude_Avant_F) AS avisInaptitudeAvantF
                            FROM bsc_handitorial_avis_inaptitudes_avant bsch
                            JOIN ref_inaptitude_boeth ref ON bsch.ID_INAPTITUDE_BOETH = ref.ID_INAPTITUDE_BOETH
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_INAPTITUDE_BOETH
                        ) temp
                        GROUP BY temp.ID_INAPTITUDE_BOETH
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiAvisInapsAvant = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiAvisInapsAvant = array();
                }
                // $bscHandiAvisInapsAvant = $bsc_repo->isPropInAnnee('bscHanditorialAvisInaptitudesAvant',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialAvisInaptitudesAvant')->getResultsForExport($array_idBscs) : array();

                if ($bsc_repo->isPropInAnnee('bscHandiMesureInaptitudesAvant',$nmAnnee)) {
                    $query = 'SELECT temp.lbMesureAvant AS lbMesureAvant, SUM(temp.mesureInaptitudeAvantH) AS mesureInaptitudeAvantH, SUM(temp.mesureInaptitudeAvantF) AS mesureInaptitudeAvantF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_MESURE_BOETH, ref.lb_Mesure_boeth AS lbMesureAvant, 0 AS mesureInaptitudeAvantH, 0 AS mesureInaptitudeAvantF
                            FROM ref_mesure_boeth ref
                            WHERE ref.BL_VALI = 0    
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_MESURE_BOETH, ref.lb_Mesure_boeth AS lbMesureAvant, SUM(bsch.mesure_Inaptitude_Avant_H) AS mesureInaptitudeAvantH, SUM(bsch.mesure_Inaptitude_Avant_F) AS mesureInaptitudeAvantF
                            FROM bsc_handitorial_mesure_inaptitudes_avant bsch
                            JOIN ref_mesure_boeth ref ON bsch.ID_MESURE_BOETH = ref.ID_MESURE_BOETH
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_MESURE_BOETH
                        ) temp 
                        GROUP BY temp.ID_MESURE_BOETH
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiMesureInapsAvant = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiMesureInapsAvant = array();
                }
                // $bscHandiMesureInapsAvant = $bsc_repo->isPropInAnnee('bscHanditorialAvisInaptitudesAvant',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialMesureInaptitudesAvant')->getResultsForExport($array_idBscs) : array();

                if ($bsc_repo->isPropInAnnee('bscHanditorialAncienneteAgents',$nmAnnee)) {
                    $query = 'SELECT COALESCE(SUM(bsch.moins_Un_An_H),0) AS moinsUnAnH, 
                                    COALESCE(SUM(bsch.moins_Un_An_F),0) AS moinsUnAnF, 
                                    COALESCE(SUM(bsch.entre_Un_Et_Trois_H),0) AS entreUnEtTroisH, 
                                    COALESCE(SUM(bsch.entre_Un_Et_Trois_F),0) AS entreUnEtTroisF, 
                                    COALESCE(SUM(bsch.entre_Quatre_Et_Six_H),0) AS entreQuatreEtSixH, 
                                    COALESCE(SUM(bsch.entre_Quatre_Et_Six_F),0) AS entreQuatreEtSixF, 
                                    COALESCE(SUM(bsch.entre_Sept_Et_Douze_H),0) AS entreSeptEtDouzeH, 
                                    COALESCE(SUM(bsch.entre_Sept_Et_Douze_F),0) AS entreSeptEtDouzeF, 
                                    COALESCE(SUM(bsch.plus_Douze_H),0) AS plusDouzeH, 
                                    COALESCE(SUM(bsch.plus_Douze_F),0) AS plusDouzeF
                                FROM bsc_handitorial_anciennete_agents bsch
                                JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                                WHERE wehbr.ID_WORKING_EXPORT = :id_working_export;';
                                //WHERE ID_BILASOCICONS IN (:arrayId);';
                    $bscHandiAncienneteAgents = $this->SQLNativeQuery($query, $array_params,null,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs,null,$nmAnnee);
                } else {
                    $bscHandiAncienneteAgents = array();
                }
                // $bscHandiAncienneteAgents = $bsc_repo->isPropInAnnee('bscHanditorialAvisInaptitudesAvant',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialAncienneteAgents')->getResultsForExport($array_idBscs) : array();
                
                // Inap et recla cadre emplois
                if ($bsc_repo->isPropInAnnee('bscHanditorialInaptEtReclaCadreEmplois',$nmAnnee)) {
                    if ($bsc_repo->isPropInAnnee('bscHanditorialInaptEtReclaCadreEmplois',$nmAnnee)) {
                    $query = 'SELECT temp.idFili AS idFili, temp.lbFili AS lbFili, temp.refCadreEmploi AS refCadreEmploi, SUM(temp.cadreEmploiH) AS cadreEmploiH, SUM(temp.cadreEmploiF) AS cadreEmploiF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_CADREMPL, reff.ID_FILI AS idFili, reff.LB_FILI AS lbFili, ref.LB_CADREMPL AS refCadreEmploi, 0 AS cadreEmploiH, 0 AS cadreEmploiF
                            FROM ref_cadre_emploi ref
                            JOIN ref_filiere reff ON reff.ID_FILI = ref.ID_FILI
                            WHERE ref.BL_VALI = 0    
                                AND reff.BL_VALI = 0
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_CADREMPL, reff.ID_FILI AS idFili, reff.LB_FILI AS lbFili, ref.LB_CADREMPL AS refCadreEmploi, SUM(bsch.cadre_Emploi_H) AS cadreEmploiH, SUM(bsch.cadre_Emploi_F) AS cadreEmploiF
                            FROM bsc_handitorial_inapt_et_recla_cadre_emplois bsch
                            JOIN ref_cadre_emploi ref ON bsch.ID_CADREMPL = ref.ID_CADREMPL
                            JOIN ref_filiere reff ON reff.ID_FILI = ref.ID_FILI
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_CADREMPL
                        )temp
                        GROUP BY temp.ID_CADREMPL
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiInapEtReclaCadreEmplois = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiInapEtReclaCadreEmplois = array();
                }
                // $bscHandiInapEtReclaCadreEmplois = $bsc_repo->isPropInAnnee('bscHanditorialInaptEtReclaCadreEmplois',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialInaptEtReclaCadreEmplois')->getResultsForExport($array_idBscs) : array();
                
                // Inap et recla métiers
                if ($bsc_repo->isPropInAnnee('bscHanditorialInaptEtReclaMetiers',$nmAnnee)) {
                    $query = 'SELECT temp.idFamilleMetier AS idFamilleMetier, temp.lbFamilleMetier AS lbFamilleMetier, temp.lbMetier AS lbMetier, temp.cdMetier AS cdMetier, SUM(temp.metierH) AS metierH, SUM(temp.metierF) AS metierF 
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_METIER, rfm.ID_FAMILLE_METIER AS idFamilleMetier, rfm.LB_FAMILLE_METIER AS lbFamilleMetier, ref.LB_METIER AS lbMetier, ref.CD_METIER AS cdMetier, 0 AS metierH, 0 AS metierF 
                            FROM ref_metier ref
                            JOIN ref_famille_metier rfm
                            WHERE ref.BL_VALIDE = 0    
                                AND rfm.BL_VALIDE = 0
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_METIER, rfm.ID_FAMILLE_METIER AS idFamilleMetier, rfm.LB_FAMILLE_METIER AS lbFamilleMetier, ref.LB_METIER AS lbMetier, ref.CD_METIER AS cdMetier, SUM(bsch.metier_H) AS metierH, SUM(bsch.metier_F) AS metierF 
                            FROM bsc_handitorial_inapt_et_recla_metiers bsch
                            JOIN ref_metier ref ON bsch.ID_METIER = ref.ID_METIER
                            JOIN ref_famille_metier rfm ON rfm.ID_FAMILLE_METIER = ref.ID_FAMILLE_METIER
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_METIER
                        ) temp
                        GROUP BY temp.ID_METIER
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiInapEtReclaMetiers = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiInapEtReclaMetiers = array();
                }
                // $bscHandiInapEtReclaMetiers = $bsc_repo->isPropInAnnee('bscHanditorialInaptEtReclaMetiers',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialInaptEtReclaMetiers')->getResultsForExport($array_idBscs) : array();

                // Inap et recla temps de travail
                if ($bsc_repo->isPropInAnnee('bscHanditorialInaptEtReclaTempsComplets',$nmAnnee)) {
                    $query = 'SELECT COALESCE(SUM(bsch.temps_Complet_H),0) AS tempsCompletH, 
                                    COALESCE(SUM(bsch.temps_Complet_F),0) AS tempsCompletF, 
                                    COALESCE(SUM(bsch.temps_Non_Complet_H),0) AS tempsNonCompletH, 
                                    COALESCE(SUM(bsch.temps_Non_Complet_F),0) AS tempsNonCompletF
                                FROM bsc_handitorial_inapt_et_recla_temps_complets bsch
                                JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                                WHERE wehbr.ID_WORKING_EXPORT = :id_working_export;';
                                //WHERE ID_BILASOCICONS IN (:arrayId);';
                    $bscHanditorialInaptEtReclaTempsComplets = $this->SQLNativeQuery($query, $array_params,null,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs,null,$nmAnnee);
                } else {
                    $bscHanditorialInaptEtReclaTempsComplets = array();//array("tempsCompletH" => 0,"tempsCompletF" => 0,"tempsNonCompletH" => 0,"tempsNonCompletF" => 0);
                }
                // $bscHanditorialInaptEtReclaTempsComplets = $bsc_repo->isPropInAnnee('bscHanditorialInaptEtReclaTempsComplets',$nmAnnee) ? $em->getRepository('ConsoBundle:bscHanditorialInaptEtReclaTempsComplets')->getResultsForExport($array_idBscs) : array();

                // Questions BOETH
                if ($bsc_repo->isPropInAnnee('bscHanditorialQuestionsBoeths',$nmAnnee)) {
                    $query = 'SELECT temp.lbCategorieboeth AS lbCategorieboeth, SUM(temp.categorieH) AS categorieH, SUM(temp.categorieF) AS categorieF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_CATEGORIE_BOETH, ref.lb_Categorie_boeth AS lbCategorieboeth, 0 AS categorieH, 0 AS categorieF
                            FROM ref_categorie_boeth ref
                            WHERE ref.BL_VALI = 0    
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_CATEGORIE_BOETH, ref.lb_Categorie_boeth AS lbCategorieboeth, SUM(bsch.categorie_H) AS categorieH, SUM(bsch.categorie_F) AS categorieF
                            FROM bsc_handitorial_questions_boeths bsch
                            JOIN ref_categorie_boeth ref ON bsch.ID_CATEGORIE_BOETH = ref.ID_CATEGORIE_BOETH
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_CATEGORIE_BOETH
                        ) temp
                        GROUP BY temp.ID_CATEGORIE_BOETH
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiCategBoeths = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiCategBoeths = array();
                }
                // $bscHandiCategBoeths = $bsc_repo->isPropInAnnee('bscHanditorialQuestionsBoeths',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialQuestionsBoeths')->getResultsForExport($array_idBscs) : array();

                if ($bsc_repo->isPropInAnnee('bscHanditorialNatureHandicaps',$nmAnnee)) {
                    $query = 'SELECT temp.lbNathandiboeth AS lbNathandiboeth, SUM(temp.natureHandicapH) AS natureHandicapH, SUM(temp.natureHandicapF) AS natureHandicapF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_NATURE_HANDICAP_BOETH, ref.LB_NATURE_HANDICAP_BOETH AS lbNathandiboeth, 0 AS natureHandicapH, 0 AS natureHandicapF
                            FROM ref_nature_handicap_boeth ref
                            WHERE ref.BL_VALI = 0    
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_NATURE_HANDICAP_BOETH, ref.LB_NATURE_HANDICAP_BOETH AS lbNathandiboeth, SUM(bsch.nature_Handicap_H) AS natureHandicapH, SUM(bsch.nature_Handicap_F) AS natureHandicapF
                            FROM bsc_handitorial_nature_handicaps bsch
                            JOIN ref_nature_handicap_boeth ref ON bsch.ID_NATURE_HANDICAP_BOETH = ref.ID_NATURE_HANDICAP_BOETH
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_NATURE_HANDICAP_BOETH
                        ) temp
                        GROUP BY temp.ID_NATURE_HANDICAP_BOETH
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiNatureHandis = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiNatureHandis = array();
                }
                // $bscHandiNatureHandis = $bsc_repo->isPropInAnnee('bscHanditorialNatureHandicaps',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialNatureHandicaps')->getResultsForExport($array_idBscs) : array();

                if ($bsc_repo->isPropInAnnee('bscHanditorialModeEntrees',$nmAnnee)) {
                    $query ='SELECT temp.lbMotiarri AS lbMotiarri, SUM(temp.modeEntreeH) AS modeEntreeH, SUM(temp.modeEntreeF) AS modeEntreeF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_MOTIARRI, ref.LB_MOTIARRI AS lbMotiarri, 0 AS modeEntreeH, 0 AS modeEntreeF
                            FROM ref_motif_arrivee ref
                            WHERE ref.BL_VALI = 0    
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_MOTIARRI, ref.lb_Motiarri AS lbMotiarri, SUM(COALESCE(bsch.mode_Entree_H,0)) AS modeEntreeH, SUM(COALESCE(bsch.mode_Entree_F,0)) AS modeEntreeF
                            FROM bsc_handitorial_mode_entrees bsch
                            RIGHT JOIN ref_motif_arrivee ref ON bsch.ID_MOTIARRI = ref.ID_MOTIARRI
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_MOTIARRI
                        ) temp
                        GROUP BY temp.ID_MOTIARRI
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE bsch.ID_BILASOCICONS IN (:arrayId)
                    /*$query = 'SELECT ref.lb_Motiarri AS lbMotiarri, SUM(bsch.mode_Entree_H) AS modeEntreeH, SUM(bsch.mode_Entree_F) AS modeEntreeF
                                FROM bsc_handitorial_mode_entrees bsch
                                JOIN ref_motif_arrivee ref ON bsch.ID_MOTIARRI = ref.ID_MOTIARRI
                                WHERE ID_BILASOCICONS IN (:arrayId)
                                GROUP BY bsch.ID_MOTIARRI;';*/
                    $bscHandiModeEntrees = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiModeEntrees = array();
                }
                // $bscHandiModeEntrees = $bsc_repo->isPropInAnnee('bscHanditorialModeEntrees',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialModeEntrees')->getResultsForExport($array_idBscs) : array();

                if ($bsc_repo->isPropInAnnee('bscHanditorialDerniersDiplomes',$nmAnnee)) {
                    $query = 'SELECT temp.lbDomaineDiplome AS lbDomaineDiplome, SUM(temp.dernierDiplomeH) AS dernierDiplomeH, SUM(temp.dernierDiplomeF) AS dernierDiplomeF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_DOMAINE_DIPLOME, ref.lb_Domaine_Diplome AS lbDomaineDiplome, 0 AS dernierDiplomeH, 0 AS dernierDiplomeF
                            FROM ref_domaine_diplome ref
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_DOMAINE_DIPLOME, ref.lb_Domaine_Diplome AS lbDomaineDiplome, SUM(bsch.dernier_Diplome_H) AS dernierDiplomeH, SUM(bsch.dernier_Diplome_F) AS dernierDiplomeF
                            FROM bsc_handitorial_derniers_diplomes bsch
                            JOIN ref_domaine_diplome ref ON bsch.ID_DOMAINE_DIPLOME = ref.ID_DOMAINE_DIPLOME
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_DOMAINE_DIPLOME
                        )temp 
                        GROUP BY temp.ID_DOMAINE_DIPLOME
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiDernierDiplomes = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiDernierDiplomes = array();
                }
                // $bscHandiDernierDiplomes = $bsc_repo->isPropInAnnee('bscHanditorialDerniersDiplomes',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialDerniersDiplomes')->getResultsForExport($array_idBscs) : array();

                if ($bsc_repo->isPropInAnnee('bscHanditorialStatutAgents',$nmAnnee)) {
                    $query = 'SELECT temp.lbStat AS lbStat, SUM(temp.statutAgentH) AS statutAgentH, SUM(temp.statutAgentF) AS statutAgentF
                        FROM (
                            SELECT ref.NM_ORDRE, ref.ID_STAT, ref.lb_Stat AS lbStat, 0 AS statutAgentH, 0 AS statutAgentF
                            FROM ref_statut ref
                            WHERE ref.BL_VALI = 0    
                                UNION
                            SELECT ref.NM_ORDRE, ref.ID_STAT, ref.lb_Stat AS lbStat, SUM(bsch.statut_Agent_H) AS statutAgentH, SUM(bsch.statut_Agent_F) AS statutAgentF
                            FROM bsc_handitorial_statut_agents bsch
                            JOIN ref_statut ref ON bsch.ID_STAT = ref.ID_STAT
                            JOIN WORKING_export_hrg_bsc_rows wehbr ON wehbr.ID_BSC = bsch.ID_BILASOCICONS
                            WHERE wehbr.ID_WORKING_EXPORT = :id_working_export
                            GROUP BY bsch.ID_STAT
                        ) temp
                        GROUP BY temp.ID_STAT
                        ORDER BY temp.NM_ORDRE;';
                            //WHERE ID_BILASOCICONS IN (:arrayId)
                    $bscHandiStatuts = $this->SQLNativeQuery($query, $array_params, true,$nmAnnee);// $this->SQLNativeQueryForExport($query, $array_idBscs, true,$nmAnnee);
                } else {
                    $bscHandiStatuts = array();
                }
                $bscHandiStatuts = $bsc_repo->isPropInAnnee('bscHanditorialStatutAgents',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialStatutAgents')->getResultsForExport($array_idBscs) : array();

                // Boeth Cadre Emplois
                $bscHandiCadreEmplois = $bsc_repo->isPropInAnnee('bscHanditorialCadreEmplois',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialCadreEmplois')->getResultsForExport($array_idBscs) : array();

                // Boeth Métiers
                $bscHandiMetiers = $bsc_repo->isPropInAnnee('bscHanditorialMetiers',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialMetiers')->getResultsForExport($array_idBscs) : array();

                // Boeth Temps de travail
                $bscHandiTempsComplet = $bsc_repo->isPropInAnnee('bscHanditorialTempsComplets',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialTempsComplets')->getResultsForExport($array_idBscs) : array();
                $bscHandiTempsPleins = $bsc_repo->isPropInAnnee('bscHanditorialTempsPleins',$nmAnnee) ? $em->getRepository('ConsoBundle:BscHanditorialTempsPleins')->getResultsForExport($array_idBscs) : array();

                // RASSCT
                $bscRassctAcciTravs = [];
                $bscRassctAcciTravs['sansArret']['N_1'] = '';
                $bscRassctAcciTravs['sansArret']['N'] = '';
                $bscRassctAcciTravs['entre1et3']['N_1'] = '';
                $bscRassctAcciTravs['entre1et3']['N'] = '';
                $bscRassctAcciTravs['entre4et21']['N_1'] = '';
                $bscRassctAcciTravs['entre4et21']['N'] = '';
                $bscRassctAcciTravs['entre22et89']['N_1'] = '';
                $bscRassctAcciTravs['entre22et89']['N'] = '';
                $bscRassctAcciTravs['plusDe90']['N_1'] = '';
                $bscRassctAcciTravs['plusDe90']['N'] = '';


                foreach ($array_idBscs as $key => $idBilasocicons) {
                    $BscRassctAccidentTravail = $bsc_repo->isPropInAnnee('bscRassctAccidentTravail',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctAccidentTravail')->findBy(array('bilanSocialConsolide' => $idBilasocicons)) : array();
                    foreach ($BscRassctAccidentTravail as $key => $value) {

                        if ($value != null) {
                            if ($key == 0) {
                                $bscRassctAcciTravs['sansArret']['N_1'] += $value->getRAccident1();
                                $bscRassctAcciTravs['sansArret']['N'] += $value->getRAccident2();
                            }
                            elseif ($key == 1) {
                                $bscRassctAcciTravs['entre1et3']['N_1'] += $value->getRAccident1();
                                $bscRassctAcciTravs['entre1et3']['N'] += $value->getRAccident2();
                            }
                            elseif ($key == 2) {
                                $bscRassctAcciTravs['entre4et21']['N_1'] += $value->getRAccident1();
                                $bscRassctAcciTravs['entre4et21']['N'] += $value->getRAccident2();
                            }
                            elseif ($key == 3) {
                                $bscRassctAcciTravs['entre22et89']['N_1'] += $value->getRAccident1();
                                $bscRassctAcciTravs['entre22et89']['N'] += $value->getRAccident2();
                            }
                            elseif ($key == 4) {
                                $bscRassctAcciTravs['plusDe90']['N_1'] += $value->getRAccident1();
                                $bscRassctAcciTravs['plusDe90']['N'] += $value->getRAccident2();
                            }
                        }
                    }
                }

                $bscRassctReaFormationSanteTravails = $bsc_repo->isPropInAnnee('bscRassctRealisationFormationSanteTravail',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctRealisationFormationSanteTravail')->getResultsForExport($array_idBscs) : array();
                $bscRassctPrevFormationSanteTravails = $bsc_repo->isPropInAnnee('bscRassctPrevisionFormationSanteTravail',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctPrevisionFormationSanteTravail')->getResultsForExport($array_idBscs) : array();
                $bscRassctAutresMesures = $bsc_repo->isPropInAnnee('bscRassctAutresMesures',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctAutresMesures')->getResultsForExport($array_idBscs) : array();
                $bscRassctMaladiePros = $bsc_repo->isPropInAnnee('bscRassctMaladieProCaracPro',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctMaladieProCaracPro')->getResultsForExport($array_idBscs) : array();
                $bscRassctPrevAutresMesures = $bsc_repo->isPropInAnnee('bscRassctPredictionsAutresMesures',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctPredictionsAutresMesures')->getResultsForExport($array_idBscs) : array();
                $bscRassctNbMaladiePros = $bsc_repo->isPropInAnnee('bscRassctNbMaladiePro',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctNbMaladiePro')->getResultsForExport($array_idBscs) : array();
                $bscRassctNbAccidentTravails = $bsc_repo->isPropInAnnee('bscRassctNbAccidentTravail',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctNbAccidentTravail')->getResultsForExport($array_idBscs) : array();
                $bscRassctNatureLesions = $bsc_repo->isPropInAnnee('bscRassctNatureLesion',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctNatureLesion')->getResultsForExport($array_idBscs) : array();
                $bscRassctSiegeLesions = $bsc_repo->isPropInAnnee('bscRassctSiegeLesion',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctSiegeLesion')->getResultsForExport($array_idBscs) : array();
                $bscRassctElementMateriels = $bsc_repo->isPropInAnnee('bscRassctElementMateriel',$nmAnnee) ? $em->getRepository('ConsoBundle:BscRassctElementMateriel')->getResultsForExport($array_idBscs) : array();

                $totalBscRassctSiegeLesions = 0;
                foreach ($bscRassctSiegeLesions as $value) {
                    $totalBscRassctSiegeLesions += $value['rNbAccident'];
                }
                $totalBscRassctNbMaladiePros = 0;
                foreach ($bscRassctNbMaladiePros as $value) {
                    $totalBscRassctNbMaladiePros += $value['rNbMpReconnues'];
                }

                $totalBscRassctElementMateriels = 0;
                foreach ($bscRassctElementMateriels as $value) {
                    $totalBscRassctElementMateriels += $value['rNbAccident'];
                }

                $totalBscRassctNbAccidentTravails = 0;
                foreach ($bscRassctNbAccidentTravails as $value) {
                    $totalBscRassctNbAccidentTravails += $value['rNbAccidentsSurvenus'];
                }

                // GPEEC
                $bscGpeecMetierParAges = $bsc_repo->isPropInAnnee('bscGpeecNbAgentsTituEmpPermaParFoncEtAge',$nmAnnee) ? $em->getRepository('ConsoBundle:BscGpeecNbAgentsTituEmpPermaParFoncEtAge')->getResultsForExport($array_idBscs) : array();
                $bscGpeecDiplomes = $bsc_repo->isPropInAnnee('bscGpeecNiveauDiplome',$nmAnnee) ? $em->getRepository('ConsoBundle:BscGpeecNiveauDiplome')->getResultsForExport($array_idBscs) : array();
                $bscGpeecSpecParAges = $bsc_repo->isPropInAnnee('bscGpeecPlusNbAgentsParSpeEtAge',$nmAnnee) ? $em->getRepository('ConsoBundle:BscGpeecPlusNbAgentsParSpeEtAge')->getResultsForExport($array_idBscs) : array();
                $empty_prepa_table_sql = "DELETE FROM WORKING_export_hrg_bsc_rows WHERE ID_WORKING_EXPORT = :id_working_export;";
                $this->SQLNativeQuery($empty_prepa_table_sql, $array_params, null,$nmAnnee);
                return $this->render('AnalyseBundle:Export:export_dgcl_handi_rassct_gpeec.xls.twig', [
                            'bscHandiCadreEmplois'                => $bscHandiCadreEmplois,
                            'bscHandiNatureHandis'                => $bscHandiNatureHandis,
                            'bscHandiMetiers'                     => $bscHandiMetiers,
                            // 'bscHandiQuestGenes'                  => $bscHandiQuestGenes,
                            'bscHandiInapEtRecla'                 => $bscHandiInapEtRecla,
                            'bscHandiInapEtReclaCadreEmplois'     => $bscHandiInapEtReclaCadreEmplois,
                            'bscHandiInapEtReclaMetiers'          => $bscHandiInapEtReclaMetiers,
                            'bscHanditorialInaptEtReclaTempsComplets' => $bscHanditorialInaptEtReclaTempsComplets,
                            'bscHandiCategBoeths'                 => $bscHandiCategBoeths,
                            'bscHandiAvisInaps'                   => $bscHandiAvisInaps,
                            'bscHandiMesureInaps'                 => $bscHandiMesureInaps,
                            'bscHandiAvisInapsAvant'              => $bscHandiAvisInapsAvant,
                            'bscHandiMesureInapsAvant'            => $bscHandiMesureInapsAvant,
                            'bscHandiAncienneteAgents'            => $bscHandiAncienneteAgents,
                            'bscHandiModeEntrees'                 => $bscHandiModeEntrees,
                            'bscHandiStatuts'                     => $bscHandiStatuts,
                            'bscHandiDernierDiplomes'             => $bscHandiDernierDiplomes,
                            'bscHandiTempsComplet'                => $bscHandiTempsComplet,
                            'bscHandiTempsPleins'                 => $bscHandiTempsPleins,
                            'bscRassctAcciTravs'                  => $bscRassctAcciTravs,
                            'bscRassctReaFormationSanteTravails'  => $bscRassctReaFormationSanteTravails,
                            'bscRassctPrevFormationSanteTravails' => $bscRassctPrevFormationSanteTravails,
                            'bscRassctAutresMesures'              => $bscRassctAutresMesures,
                            'bscRassctMaladiePros'                => $bscRassctMaladiePros,
                            'bscRassctPrevAutresMesures'          => $bscRassctPrevAutresMesures,
                            'bscRassctNbMaladiePros'              => $bscRassctNbMaladiePros,
                            'bscRassctNbAccidentTravails'         => $bscRassctNbAccidentTravails,
                            'bscRassctNatureLesions'              => $bscRassctNatureLesions,
                            'bscRassctSiegeLesions'               => $bscRassctSiegeLesions,
                            'bscRassctElementMateriels'           => $bscRassctElementMateriels,
                            'bscGpeecMetierParAges'               => $bscGpeecMetierParAges,
                            'bscGpeecDiplomes'                    => $bscGpeecDiplomes,
                            'bscGpeecSpecParAges'                 => $bscGpeecSpecParAges,
                            'totalBscRassctElementMateriels'      => $totalBscRassctElementMateriels,
                            'totalBscRassctSiegeLesions'          => $totalBscRassctSiegeLesions,
                            'totalBscRassctNbAccidentTravails'    => $totalBscRassctNbAccidentTravails,
                            'totalBscRassctNbMaladiePros'         => $totalBscRassctNbMaladiePros,
                            'QHandiB22'                           => $QHandiB22,
                            'QHandiB23'                           => $QHandiB23,
                            'bscQA3'                              => $bscQA3,
                            'bscQA17'                             => $bscQA17,
                            'bscQA8'                              => $bscQA8,
                            'mesEnquetesCollectivites'            => $mesEnquetesCollectivites,
                            'isEmpty'                             => false,
                            'bscRepo'                            => $bsc_repo,
                            'nmAnnee'                            => $nmAnnee
                ]);
            }}
        }catch(\Exception $e){
            $msg = array($e->getMessage(),' in '.$e->getFile().' at line '.$e->getLine(),$e->getTraceAsString());
            file_log_error($log_infos,$msg);//,array('prefix'=>$codeExport));
            error_log('ERREUR Export HRG');
            error_log($e->getMessage());
            error_log($e->getFile());
            error_log($e->getLine());
            error_log($e->getTraceAsString());
            return new Response('Une erreur est survenu pendant l\'export HRG',500);
        }
    }


    public function callExportAgentParAgentAction(Request $request) {
        //$nmAnnee = 2017;
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $nmAnnee = $currentCampagne->getNmAnne();
        $em_annee = $this->getDataWellConnection($nmAnnee);
        $id_pool = $request->get('id_pool');
        
        $anonymisation = $request->get('anonymisation');
        // get pool item where id pool = id récupéré de la request

        $user = null;
        if(($username = $this->getFromSession('username')) != null){
            $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            //dump($user);die;
        }else {
            $user = $this->getUser();
        }
        
        $arr = [];
        if ($user->hasRole('ROLE_CDG')) {
            $arrayOfCollEnqs = $em->getRepository('InfoCentreBundle:Pool')->findOneById($id_pool);
            $arrayOfCollEnqs->initDependancy($em_annee);
            foreach ($arrayOfCollEnqs->getItems() as $enqColl) {
                $result = $em_annee->getRepository('EnqueteBundle:Enquete')->findOneByIdEnqu($enqColl->getEnquete()->getIdEnqu());
                $idColl = $enqColl->getCollectivite()->getIdColl();
                $annee = $result->getNmAnne();
                if (!array_key_exists($annee, $arr)) {
                    $arr[$annee] = [];
                }
                array_push($arr[$annee], $idColl);
            }
        }
        elseif ($user->hasRole('ROLE_COLLECTIVITY')) {
            $idColl = $user->getCollectivite()->getIdColl();
            $coll = [$idColl];
        }
        $zipName = 'export_agent_par_agent.zip';
        $zip = new ZipArchive;
        $res = $zip->open($zipName, ZipArchive::CREATE);

        if ($res === TRUE) {
            if ($user->hasRole('ROLE_CDG')) {
                foreach ($arr as $key => $coll) {
                    $download = $this->forward('AnalyseBundle:Default:exportHandiGpeecAgentExcel', array('colls' => $coll, 'annee' => $key, 'anonymisation' => $anonymisation));
                    $zip->addFromString('export_agent_par_agent_' . $key . '.xls', $download->getContent());
                }
            }
            elseif ($user->hasRole('ROLE_COLLECTIVITY')) {
                $download = $this->forward('AnalyseBundle:Default:exportHandiGpeecAgentExcel', array('colls' => $coll));
                $zip->addFromString('export_agent_par_agent.xls', $download->getContent());
            }
        }
        $zip->close();
        $zip_ressource = fopen($zipName, "r");
        $content = stream_get_contents($zip_ressource);

        $response = new Response($content, 200, array(
            'Content-Type'        => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $zipName . '"',
            'Content-Length: ' . filesize($zipName)
        ));
        fclose($zip_ressource);
        unlink($zipName);

        return $response;
    }

    public function exportHandiGpeecAgentExcelAction($colls, $annee = null, $anonymisation = false) {
        $em = $this->getDoctrine()->getManager();
       // $user = $this->getUser();
       if($annee){
           $currentCampagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
           $nmAnnee = $currentCampagne->getNmAnne();
       }

        $user = null;
        if (($username = $this->getFromSession('username')) != null) {
            $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
        } else {
            $user = $this->getUser();
        }

        if ($user->hasRole('ROLE_CDG')) {
            $em_annee = $this->getDataWellConnection($nmAnnee);
            $myAgents = $em_annee->getRepository('ApaBundle:BilanSocialAgent')->getResultsForExportCdg($colls, $annee);
        }
        elseif ($user->hasRole('ROLE_COLLECTIVITY')) {
            $myAgents = $em->getRepository('ApaBundle:BilanSocialAgent')->getResultsForExport($colls);
        }

//        $myAgents = $em->getRepository('ApaBundle:BilanSocialAgent')->findBy(array('enquete' => $enquete->getIdEnqu(), 'collectivite' => $user->getCollectivite()->getIdColl()));
//        foreach ($myAgents as $myAgent) {
//            dump($myAgent);
//            exit();
//        }
        return $this->render('AnalyseBundle:Export:export_dgcl_handi_gpeec_agent.xls.twig', [
                    'agents' => $myAgents,
                    'anonymisation' => $anonymisation
        ]);
    }

    public function SQLNativeQueryForExport($query, $arrayIdBscs, $fetchAll = false, $annee = null) {
        $em = $annee==null ? $this->getDoctrine()->getManager() : $em_annee = $this->getDataWellConnection($annee);

        $stmt = $em->getConnection()->prepare($query);
        $stmt->bindValue('arrayId', implode(", ", $arrayIdBscs));
        $stmt->execute();

        if ($fetchAll == true) {
            return $stmt->fetchAll();
        } else {
            return $stmt->fetch();
        }
    }
    
    public function SQLNativeQuery($query, $params = array(), $fetchAll = false, $annee=null,$options=array()){
        $start_query = startRuUsage('start query : ');
        $current_campagne = $this->getMaCampagne();
        $annee = ($annee!=null && $current_campagne!=null && $current_campagne->getNmAnne()>$annee) ? $annee : null;
        $em = $annee==null ? $this->getDoctrine()->getManager() : $em_annee = $this->getDataWellConnection($annee);

        $stmt = $em->getConnection()->prepare($query);
        //$stmt->bindValue('arrayId', implode(", ", $arrayIdBscs));
        foreach ($params as $key => $param) {
            $stmt->bindValue($key, $param);
        }
        $stmt->execute();
        $fetch_style = getFromOr('fetch_style', $options);
        $fetch_argument = getFromOr('fetch_argument', $options);
        $result = null;
        if ($fetchAll == true) {
            //return $stmt->fetchAll($fetch_style,$fetch_argument);
            $result = $stmt->fetchAll($fetch_style,$fetch_argument);
        } else if($fetchAll === false){
            //return $stmt->fetch($fetch_style,$fetch_argument);
            $result = $stmt->fetch($fetch_style,$fetch_argument);
        }/*else{
            return null;
        }*/
        return $result;
    }

    public function callScriptExportAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $id_pool = $request->get('id_pool');
        $pool_export_id = $request->get('pool_export_id');
        $pool_export = $em->getRepository('InfoCentreBundle:PoolExport')->findOneById($pool_export_id);
        
        try {
            $codeExport = substr( str_shuffle( str_repeat( 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 10 ) ), 0, 7 );
            $header = new HeaderExportHRG();
            $header->setCodeExport($codeExport);
            $header->setPoolExport($pool_export);
            $em->persist($header);
            $em->flush();

            $cmd = "cd ../ && pwd && php bin/console iorga:export-hrg " . $codeExport . " " . $id_pool;
            $response = $this->execInBackground($cmd, $user->getIdUtil());
            $header->setPid($response['pid']);
            $header->setIdUtil($response['idUtil']);
            
            //$msg = array("Lancement de la commande (php bin/console iorga:export-hrg " . $codeExport . " " . $id_pool),"code export : ".$codeExport,"id_pool : ".$id_pool,'pid : '.$response->['pid']);
            //file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));

            //$em->persist($header);
            $em->flush();
        } catch(Exception $e) {
            return $e->getMessage();
        }

        return $this->redirectToRoute('info_centre_index');
    }

}
