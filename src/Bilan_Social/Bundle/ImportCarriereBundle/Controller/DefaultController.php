<?php

namespace Bilan_Social\Bundle\ImportCarriereBundle\Controller;

use Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier;
use Bilan_Social\Bundle\ImportCarriereBundle\Form\FichierType;
use Bilan_Social\Bundle\ImportCarriereBundle\Repository\CirilRepository;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

const CIRIL_KEY = 1;
const AGIRHE_KEY = 2;

class DefaultController extends AbstractBSController
{
    private $config_finder;
    private $ref_finder;
    private $import_config;

    /*
    *   configuration pour l'autoload (les fichiers de config non déclarés ici sont chargés au besoin puis stockés)
    */
    private $blocs_name = array('agent_ciril', 'absences_ciril');
    private $refs_name = array('ref_sexe', 'ref_temps_travail', 'ref_type_contrat');
    private $em;
    private $config_blocs = array();
    private $refs = array();
    private $in_params = array();

    //private $current = array();

    public function testAction()
    {
        $this->init();
        $campagneCourante = $this->em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        if ($campagneCourante != null) {
            $year = $campagneCourante->getNmAnne();
            $annne_n = $year;
            $annee_n_31_12 = "31/12/" . $annne_n;
            $this->addInParam('annee_n', $annne_n);
            $this->addInParam('annee_n_31_12', $annee_n_31_12);
        }
        $user = $this->getUser();

        if ($user == null) {
            $response = new Response();
            $response->setContent("L'utilisateur est inconnu.");
            return $response;
        }
        $idColl = $user->getCollectivite()->getIdColl();
        if ($idColl == null) {
            $response = new Response();
            $response->setContent("L'utilisateur doit être une collectivité.");
            return $response;
        }
        $collectivite = $this->em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);

        if ($collectivite == null) {
            $response = new Response();
            $response->setContent("La collectivité associée n'existe pas.");
            return $response;
        }

        $algo_import_type = $this->getAlgoImportTypeFromSelectedColl($collectivite);
        $data = $this->getDataToImport($algo_import_type, $collectivite);//$ciril_repo->getDataToImport();
        $data_collectivite = $this->getDataToImportCollectivite($algo_import_type, $collectivite);
        $agent_magazine = array();
        $collectivite_magazine = array();
        $algo_agent_config_name = "";
        $algo_collectivite_config_name = "";
        if ($algo_import_type == CIRIL_KEY) {
            $algo_agent_config_name = "agent_ciril";
            $algo_collectivite_config_name = "collectivite_agirhe";
        } else if ($algo_import_type == AGIRHE_KEY) {
            $algo_agent_config_name = "agent_agirhe";
            $algo_collectivite_config_name = "collectivite_agirhe";
        }
        $cpt_agent = 0;
//        dump($data);
        try {
            foreach ($data as $key => $dummy) {
                $temp_entity = $this->processBloc($dummy, $algo_agent_config_name);//$this->getEntity($config_agent);
                //$refClass = new \ReflectionClass(get_class($temp_entity));
                //var_dump($refClass->getShortName());
                $agent_magazine[] = $temp_entity;
                $cpt_agent++;
            }
            echo "<p style='background-color:red'> collectivité </p>";
            foreach ($data_collectivite as $key => $dummy) {
                $temp_entity = $this->processBloc($dummy, $algo_collectivite_config_name);//$this->getEntity($config_agent);
                /*foreach ($config_agent['fields'] as $field_key => $field_config) {


                }*/
                $collectivite_magazine[] = $temp_entity;
            }
        } catch (\Exception $e) {
        }

        /*
        
            NEED TO MAKE THE PERSIST   
        
        */
        if (!empty($agent_magazine) && count($agent_magazine) > 0) {
            foreach ($agent_magazine as $key => $agent) {
                //$agent->setCollectivite($collectivite);
                //$agent->setEnquete($enquete);
                //var_dump($agent);
                //$this->em->persist($agent);
            }
            //$this->em->flush();
        }
        if (!empty($collectivite_magazine) && count($collectivite_magazine) > 0) {
            foreach ($collectivite_magazine as $key => $collectivite) {
                //$agent->setCollectivite($collectivite);
                //$agent->setEnquete($enquete);
                //var_dump($agent);
                //$this->em->persist($collectivite);
            }
            //$this->em->flush();
        }
        return new Response();//$this->render('@ImportCarriere/Default/index.html.twig');
    }

    public function indexAction()
    {
        $this->init();

        $user = $this->getUser();

        if ($user == null) {
            $response = new Response();
            $response->setContent("L'utilisateur est inconnu.");
            return $response;
        }
        $idColl = $user->getCollectivite()->getIdColl();
        if ($idColl == null) {
            $response = new Response();
            $response->setContent("L'utilisateur doit être une collectivité.");
            return $response;
        }
        $collectivite = $this->em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);

        if ($collectivite == null) {
            $response = new Response();
            $response->setContent("La collectivité associée n'existe pas.");
            return $response;
        }

        //$ciril_repo = $this->em->getRepository('ImportCarriereBundle:CirilRepository');
        $algo_import_type = $this->getAlgoImportTypeFromSelectedColl($collectivite);
        $data = $this->getDataToImport($algo_import_type, $collectivite);//$ciril_repo->getDataToImport();
        $data_collectivite = $this->getDataToImportCollectivite($algo_import_type, $collectivite);
        //$dummy_data_finder = New Finder();
        //$dummy_data_finder->in(__DIR__."/../Resources/data/dummy")->files('import_carriere_dummy_data');
        //$dummy_data = readOneFileFromFinder($dummy_data_finder,null,'json');
        //$agent_magazine = array();
        //$config_agent = $this->getConfigFor('agent');
        $algo_agent_config_name = "";
        $algo_collectivite_config_name = "";
        if ($algo_import_type == CIRIL_KEY) {
            $algo_agent_config_name = "agent_ciril";
            $algo_collectivite_config_name = "collectivite_agirhe";
        } else if ($algo_import_type == AGIRHE_KEY) {
            $algo_agent_config_name = "agent_agirhe";
            $algo_collectivite_config_name = "collectivite_agirhe";
        }
        foreach ($data as $key => $dummy) {
            $temp_entity = $this->processBloc($dummy, $algo_agent_config_name);//$this->getEntity($config_agent);
            /*foreach ($config_agent['fields'] as $field_key => $field_config) {


            }*/
            $agent_magazine[] = $temp_entity;
        }
        foreach ($data_collectivite as $key => $dummy) {
            $temp_entity = $this->processBloc($dummy, $algo_collectivite_config_name);//$this->getEntity($config_agent);
            /*foreach ($config_agent['fields'] as $field_key => $field_config) {


            }*/
            $agent_magazine[] = $temp_entity;
        }

        //$data_collectivite;

        //var_dump($agent_magazine[19]->getFormationAgents());
        /*var_dump($this->container->getParameter('import_carriere')['config_files']);
        $agent_config_file = $this->container->getParameter('import_carriere')['config_files']['agent'];
        $config_finder = new Finder();
        $config_finder->in(__DIR__."\..\Resources\\config")->files()->name($agent_config_file);
        foreach ($config_finder as $key => $value) {
            var_dump($value->getContents());
        }*/
        /*
        
            NEED TO MAKE THE PERSIST   
        
        */

        $this->em->flush();
        return new Response();//$this->render('@ImportCarriere/Default/index.html.twig');
    }

    /**
     * @return JsonResponse
     */
    public function importAction()
    {
        $this->init();
        $em = $this->getEntityManager();
        $user = null;
        if(($username = $this->getFromSession('username')) != null){
            $user = $em->getRepository('UserBundle:User')->findOneByUsername($username);
            //dump($user);die;
        }else {
            $user = $this->getUser();
        }


        if ($user == null) {
            $reponse['msg'] = $this->get('translator')->trans('erreur.importbasecarriere.import.nouser.flash');
            $reponse['status'] = 'error';
            return new JsonResponse($reponse);
        }

        $idColl = $user->getCollectivite()->getIdColl();
        if ($idColl == null) {
            $reponse['msg'] = $this->get('translator')->trans('erreur.importbasecarriere.import.nousercollectivite.flash');
            $reponse['status'] = 'error';
            return new JsonResponse($reponse);
        }

        $collectivite = $this->em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);
        if ($collectivite == null) {
            $reponse['msg'] = "La collectivité associée n'existe pas.";
            $this->get('translator')->trans('erreur.importbasecarriere.import.aucune.basecarriere.flash');
            $reponse['status'] = 'error';
            return new JsonResponse($reponse);
        }

        $algo_import_type = $this->getAlgoImportTypeFromSelectedColl($collectivite);
        $campagneCourante = $this->em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        
        $enquete = $this->getMonEnquete();
        $reponse = array();
        if ($algo_import_type === -1) {
            $reponse['msg'] = $this->get('translator')->trans('erreur.importbasecarriere.import.aucune.basecarriere.flash');
            $reponse['status'] = 'error';
        } else if ($algo_import_type !== false) {
            if ($campagneCourante != null) {
                $year = $campagneCourante->getNmAnne();
                $annne_n = $year;
                $annee_n_31_12 = "31/12/" . $annne_n;
                $this->addInParam('annee_n', $annne_n);
                $this->addInParam('annee_n_31_12', $annee_n_31_12);
            }
            $data_agent = $this->getDataToImport($algo_import_type, $collectivite);//$ciril_repo->getDataToImport();
            $data_collectivite = $this->getDataToImportCollectivite($algo_import_type, $collectivite);
            //$dummy_data_finder = New Finder();
            //$dummy_data_finder->in(__DIR__."\..\Resources\\data\\dummy")->files('import_carriere_dummy_data');
            //$dummy_data = readOneFileFromFinder($dummy_data_finder,null,'json');
            $agent_magazine = array();
            $collectivite_magazine = array();
            $algo_agent_config_name = "";
            $algo_collectivite_config_name = "";
            if ($algo_import_type == CIRIL_KEY) {
                $algo_agent_config_name = "agent_ciril";
                $algo_collectivite_config_name = "collectivite_agirhe";
            } else if ($algo_import_type == AGIRHE_KEY) {
                $algo_agent_config_name = "agent_agirhe";
                $algo_collectivite_config_name = "collectivite_agirhe";
            }
            try {
                foreach ($data_agent as $key => $agent) {
                    $temp_entity = $this->processBloc($agent, $algo_agent_config_name);
                    $agent_magazine[] = $temp_entity;
                }
                foreach ($data_collectivite as $key => $d_collectivite) {
                    $temp_entity = $this->processBloc($d_collectivite, $algo_collectivite_config_name);
                    $collectivite_magazine[] = $temp_entity;
                }
            } catch (\Exception $e) {

                $reponse['msg'] = $this->get('translator')->trans('erreur.importbasecarriere.import.flash');
                $reponse['status'] = 'error';
//                $reponse['error'] = $e->getMessage();
//                $reponse['error1'] = $e->getLine();
//                $reponse['error2'] = $e->getFile();
//                $reponse['error3'] = $e->getTrace();
                $this->addFlash(
                    'import_carriere_result',
                    'Erreur lors de l\'import'
                );
                return new JsonResponse($reponse);
            }
            try {
                $this->em->getConnection()->beginTransaction();
                $agent = null;
                if (!empty($agent_magazine) && count($agent_magazine) > 0) {
                    foreach ($agent_magazine as $key => $agent) {
                        if ($agent != null) {
                            $agent->setCollectivite($collectivite);
                            $agent->setEnquete($enquete);
                            if ($agent->getRefGrade() != null) {
                                if ($agent->getRefGrade()->getRefCadreEmploi() != null) {
                                    $cadreEmploi = $agent->getRefGrade()->getRefCadreEmploi();
                                    $agent->setRefCadreEmploi($cadreEmploi);
                                    if ($cadreEmploi->getRefFiliere() != null && $cadreEmploi->getRefCategorie()) {
                                        $agent->setRefFiliere($cadreEmploi->getRefFiliere());
                                        $agent->setRefCategorie($cadreEmploi->getRefCategorie());
                                    }
                                }
                            }
                            $this->em->persist($agent);
                        }
                    }
                }
                if (!empty($collectivite_magazine) && count($collectivite_magazine) > 0) {
                    foreach ($collectivite_magazine as $key => $collectivite) {
                        if ($agent != null) {
                            $this->em->persist($collectivite);
                        }
                    }
                }
                $this->em->flush();
                $this->em->getConnection()->commit();
            } catch (\Exception $ex) {
                $this->em->getConnection()->rollBack();
                $reponse['msg'] = $this->get('translator')->trans('erreur.importbasecarriere.import.flash');
                $reponse['status'] = 'error';
                $this->addFlash(
                    'import_carriere_result',
                    'Erreur lors de l\'import'
                );
                return new JsonResponse($reponse);
            }
            $reponse['msg'] = $this->get('translator')->trans('success.importbasecarriere.import.flash');
            //$reponse['url_to_redirect'] = 'bilansocialagent_index';
            $reponse['status'] = 'success';
            $this->addFlash(
                'import_carriere_result',
                'Import base carrière réussi'
            );

        } else {
            $reponse['msg'] = $this->get('translator')->trans('erreur.importbasecarriere.import.flash');
            $reponse['status'] = 'error';
            $this->addFlash(
                'import_carriere_result',
                'Erreur lors de l\'import'
            );
        }
        return new JsonResponse($reponse);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function importFichierCarriereAction(Request $request)
    {
        $this->init();
        $type_import = "";
        $cdgDepartements = null;
        $current_user = $this->getUser();
        $fileManager = $this->getBSFileManager();

        // On récupère la campagne courante
        $campagneCourante = $this->em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();

        // On récupère le cdg par rapport à l'utilisateur connecté
        $cdg = $this->em->getRepository('CollectiviteBundle:Cdg')->findCDGByUtilisateur($current_user);

        if ($campagneCourante == null) {
            $this->addFlash('error', $this->get('translator')->trans('erreur.importbasecarriere.aucunecampagne.flash'));
            return $this->redirectToRoute('homepage');
        }
        if ($campagneCourante != null) {
            $year = $campagneCourante->getNmAnne();
            $annne_n = $year;
            $annee_n_31_12 = "31/12/" . $annne_n;
            $this->addInParam('annee_n', $annne_n);
            $this->addInParam('annee_n_31_12', $annee_n_31_12);
        }

        // On récupère la liste des fichiers par rapport
        //  * au CDG de l'utilisateur connecté,
        //  * à l'année N de la campagne
        //  * aux répertoires CIRIL et AGIRHE
        $logicalFolders = array('CIRIL', 'AGIRHE');
        $fichiers = $this->em->getRepository('FileManagerBundle:Fichier')->findFichiersByCdgAndCampagne($cdg, $campagneCourante->getNmAnne(), $logicalFolders);

        // collectivite good to import
        $tab_coll_ok = array_nested_unique(array_merge($this->getTableCollOkForImport(CIRIL_KEY, $current_user),
            $this->getTableCollOkForImport(AGIRHE_KEY, $current_user)), 'NM_SIRE');

        // only in import file ( agirhe/ciril tables)
        $tab_coll_left = array_nested_unique(array_merge($this->getTableCollOnlyLeft(CIRIL_KEY, $current_user),
            $this->getTableCollOnlyLeft(AGIRHE_KEY, $current_user)), 'siret');

        // only in bilan social tables
        $tab_coll_right = array_nested_unique(array_merge($this->getTableCollOnlyRight(CIRIL_KEY, $current_user),
            $this->getTableCollOnlyRight(AGIRHE_KEY, $current_user)), 'NM_SIRE', $tab_coll_ok);
        
        $form = $this->createForm(FichierType::class);

        // On itère sur la liste des fichiers afin de récupérer des informations supplémentaires
        if (!empty($fichiers) && sizeof($fichiers) > 0) {

            foreach ($fichiers as $key => $fichier) {

                $fileInfo = $fileManager->getFileInfos($fichier->getFileKey());

                if (isset($fileInfo) && isset($fileInfo['status']) && $fileInfo['status'] == 200) {
                    if (!empty($fileInfo['json_response'])) {
                        $info = $fileInfo['json_response'];
                        $fichier->setStorageDate($info['storageDate']);
                        $fichier->setFileName($info['originalFileName']);
                        $fichier->setStatut($info['status']);
                        if ($info['status'] == 1) {
                            $fichier->setLibelleStatut("Fichier en attente d'intégration");
                        } else {
                            $fichier->setLibelleStatut($info['statusLinkedData']);
                        }
                    } else {
                        unset($fichiers[$key]);
                    }
                }
            }
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $type_import = $form['typeImport']->getData();
            $specialFolder = "";
            if (isset($type_import)) {
                if ($type_import == CIRIL_KEY) {
                    $specialFolder = 'CIRIL';
                } else if ($type_import == AGIRHE_KEY) {
                    $specialFolder = 'AGIRHE';
                }
            }

            $file = $request->files->get('bilan_social_bundle_importcarrierebundle_fichier')['document']['file'];
            if (isset($file)) {
                // Le type du fichier doit obligatoirement être XML
                if ($file->getClientMimeType() !== 'text/xml' && $file->getClientMimetype() !== 'application/xml') {
                    $this->addFlash('error', $this->get('translator')->trans('uploadfile.importbasecarriere.badformat.flash'));
                    return $this->redirectToRoute('import_carriere_homepage');
                }

                $response_upload = $fileManager->uploadFileInSpecialFolder($specialFolder,
                    $fileManager->prepareFileToAdd($file, true, $specialFolder));

                if (!$response_upload['isOk']) {
                    $this->addFlash('error', $response_upload['errMsg']);
                    return $this->render('@ImportCarriere/Default/index.html.twig', array(
                        'form' => $form->createView(),
                        'fichiers' => $fichiers,
                        "tab_coll_ok" => $tab_coll_ok,
                        "tab_coll_left" => $tab_coll_left,
                        "tab_coll_right" => $tab_coll_right,
                        "algo_import_type" => $type_import,
                    ));
                }
            }
            $this->addFlash('notice', $this->get('translator')->trans('uploadfile.importbasecarriere.flash'));
            return $this->redirectToRoute('import_carriere_homepage');
        }
        if($request->isXmlHttpRequest()){
            return $this->render('@ImportCarriere/Default/index_no_layout.html.twig',
                array(
                    'form' => $form->createView(),
                    'fichiers' => $fichiers,
                    'tab_coll_ok' => $tab_coll_ok,
                    'tab_coll_left' => $tab_coll_left,
                    'tab_coll_right' => $tab_coll_right,
                ));
        }
        return $this->render('@ImportCarriere/Default/index.html.twig',
            array(
                'form' => $form->createView(),
                'fichiers' => $fichiers,
                'tab_coll_ok' => $tab_coll_ok,
                'tab_coll_left' => $tab_coll_left,
                'tab_coll_right' => $tab_coll_right,
            ));
    }

    /*
    *   
    */
    public function selectCollToImportAction(Request $request)
    {
        $this->init();
        $coll_selected = $request->request->get('coll_selected');

        if (empty($coll_selected)) {
            //$this->get('translator')->trans('uploadfile.importbasecarriere.flash')
            $res = $this->addFlash('notice', 'aucune collectivité de selectionnées');
            return new Response($res);
        }
        $algo_import_type = $request->request->get('algo_import_type');
        $res = $this->SetCollToImport($coll_selected, $algo_import_type);
        return new Response($res);
    }

    public function importBaseCarriereAction(Request $request)
    {
        $ids_coll = $request->param('ids_coll');
    }

    /*
    *   fonction d'initialisation à lancer avant tout traitemnt
    *       - récupère les paramètres /!\ MANDATORY /!\
    *       - initie le finder de la configuration des blocs /!\ MANDATORY /!\
    *       - charge les configs des blocs, les rendant disponible dans la pile /!\ OPTIONNAL /!\
    */
    public function init()
    {
        $this->em = $this->getDoctrine()->getManager();
        $this->import_config = $this->container->getParameter('import_carriere');
        $config_base_dir = isset($this->import_config['config_base_dir']) ? $this->import_config['config_base_dir'] : __DIR__ . "/../Resources/config/import_blocs";
        $config_base_dir = parsePathForSystem($config_base_dir);
        $this->config_finder = new Finder();
        $this->config_finder->in($config_base_dir);
        $ref_base_dir = isset($this->import_config['ref_base_dir']) ? $this->import_config['ref_base_dir'] : __DIR__ . "/../data/referentiel";
        $ref_base_dir = parsePathForSystem($ref_base_dir);
        $this->ref_finder = new Finder();
        $this->ref_finder->in($ref_base_dir);
        $this->loadConfigBlocs();
        $this->loadRefs();
        //$this->loadEntityToUse();
    }

    /*
    *
    */
    public function getAlgoImportTypeFromSelectedColl($collectivite = null)
    {
        $conn = $this->em->getConnection();
        $sql_nb_coll_algo = "SELECT COUNT(*) as nb_col FROM ciril_collectivite c_col 
            WHERE c_col.can_import = 1 ";
        $sql_nb_coll_algo .= $collectivite != null ? " AND c_col.siret = '" . $collectivite->getNmSire() . "' " : ' ';
        $sql_nb_coll_algo .= " UNION  
            SELECT COUNT(*) as nb_col FROM agirhe_collectivite a_col 
            WHERE a_col.can_import = 1 ";
        $sql_nb_coll_algo .= $collectivite != null ? " AND a_col.siret = '" . $collectivite->getNmSire() . "';" : ";";
        $stmt_nb_coll_algo = $conn->query($sql_nb_coll_algo);
        $nb_col_algo = array();
        $nb_col_algo = $stmt_nb_coll_algo->fetchAll();
        /*
        *   correspondance algo :
        *
        *   0 => ciril
        *   1 => agirhe
        */
        $ciril_tab_key = CIRIL_KEY - 1;
        $agirhe_tab_key = AGIRHE_KEY - 1;
        $algo_import_type = null;
        $nb_ciril = intval($nb_col_algo[$ciril_tab_key]['nb_col']);
        $nb_agirhe = 0;
        if (isset($nb_col_algo[$agirhe_tab_key])) {
            $nb_agirhe = intval($nb_col_algo[$agirhe_tab_key]['nb_col']);
        }
        //var_dump($nb_ciril);
        //var_dump($nb_agirhe);

        /*$nb_ciril = intval($nb_col_algo[$ciril_key]['nb_col']);
        $nb_agirhe = intval($nb_col_algo[$agirhe_key]['nb_col']);*/

        if ($nb_ciril > 0 && $nb_agirhe > 0) {
            $algo_import_type = false;
        } else if ($nb_ciril > 0) {
            $algo_import_type = CIRIL_KEY;
        } else if ($nb_agirhe > 0) {
            $algo_import_type = AGIRHE_KEY;
        } else if ($nb_ciril == 0 && $nb_agirhe == 0) {
            $algo_import_type = -1;
        }
        return $algo_import_type;
    }

    /*
    *
    */
    public function getDataToImport($algo_import_type, $collectivite = null)
    {
        $conn = $this->em->getConnection();
        if ($algo_import_type == CIRIL_KEY) {
            $sql_agent = "SELECT * FROM ciril_agent c_agent 
                JOIN ciril_collectivite c_coll 
                    ON c_coll.identifiant_collectivite=c_agent.identifiant_collectivite AND c_coll.file_key = c_agent.file_key
                WHERE c_coll.can_import = 1";
            $sql_agent .= $collectivite != null ? " AND c_coll.siret = '" . $collectivite->getNmSire() . "';" : ";";
            $stmt_agent = $conn->query($sql_agent);
            $agents = array();
            $agents = $stmt_agent->fetchAll();
            foreach ($agents as $key => $agent) {

                $id_agent = $agent['identifiant_agent'];
                $sql_form_agent = "SELECT c_form.date_formation, c_form.identifiant_agent, SUM(c_form.nombre_jours) nombre_jours, organisme_formateur, type_formation 
                    FROM ciril_formation c_form
                    WHERE c_form.identifiant_agent=" . $id_agent . "
                    GROUP BY c_form.type_formation, c_form.organisme_formateur, c_form.identifiant_agent";
                $stmt_form_agent = $conn->prepare($sql_form_agent);
                $stmt_form_agent->execute();
                $formations_agent = $stmt_form_agent->fetchAll();
                $agents[$key]['formations'] = $formations_agent;
            }
            return $agents;
        } else if ($algo_import_type == AGIRHE_KEY) {
            $sql_agent = "SELECT * FROM agirhe_agent a_agent 
                JOIN agirhe_collectivite a_coll 
                    ON a_coll.identifiant_agirhe=a_agent.identifiant_agirhe  AND a_coll.file_key = a_agent.file_key
                WHERE a_coll.can_import = 1";
            $sql_agent .= $collectivite != null ? " AND a_coll.siret = '" . $collectivite->getNmSire() . "';" : ";";
            $stmt_agent = $conn->query($sql_agent);
            $agents = array();
            $agents = $stmt_agent->fetchAll();
            foreach ($agents as $key => $agent) {

                $id_agent = $agent['agent_identifiant'];
                $sql_form_agent = "SELECT a_form.formation_date, a_form.agent_identifiant, SUM(a_form.formation_heures)/24 nombre_jours, a_form.formation_organisme, a_form.formation_type 
                    FROM agirhe_formation a_form
                    WHERE a_form.agent_identifiant=" . $id_agent . "
                    GROUP BY a_form.formation_type, a_form.formation_organisme, a_form.agent_identifiant";
                $stmt_form_agent = $conn->prepare($sql_form_agent);
                $stmt_form_agent->execute();
                $formations_agent = $stmt_form_agent->fetchAll();
                $agents[$key]['formations'] = $formations_agent;
                $sql_abs_agent = "SELECT a_abs.agent_identifiant, SUM(a_abs.absence_jours_arret) nombre_jours, a_abs.absence_motif, a_abs.absence_code_agirhe, COUNT(a_abs.id_agirhe_absence) nb_arret
                    FROM agirhe_absence a_abs
                    WHERE a_abs.agent_identifiant=" . $id_agent . "
                    GROUP BY a_abs.absence_motif, a_abs.agent_identifiant";
                $stmt_abs_agent = $conn->prepare($sql_abs_agent);
                $stmt_abs_agent->execute();
                $absences_agent = $stmt_abs_agent->fetchAll();
                $agents[$key]['absences'] = $absences_agent;
            }
            return $agents;
        } else {
            return false;
        }
    }

    public function getDataToImportCollectivite($algo_import_type, $collectivite = null)
    {
        $conn = $this->em->getConnection();
        /*if($algo_import_type==CIRIL_KEY){
            $sql_agent = "SELECT * FROM ciril_agent c_agent 
                JOIN ciril_collectivite c_coll 
                    ON c_coll.identifiant_collectivite=c_agent.identifiant_collectivite
                WHERE c_coll.can_import = 1";
            $sql_agent .= $collectivite!=null ? " AND c_coll.siret = '".$collectivite->getNmSire()."';" : ";";
            $stmt_agent = $conn->query($sql_agent);
            $agents = array();
            $agents = $stmt_agent->fetchAll();
            foreach ($agents as $key => $agent){

                $id_agent = $agent['identifiant_agent'];
                $sql_form_agent = "SELECT c_form.date_formation, c_form.identifiant_agent, SUM(c_form.nombre_jours) nombre_jours, organisme_formateur, type_formation 
                    FROM ciril_formation c_form
                    WHERE c_form.identifiant_agent=".$id_agent."
                    GROUP BY c_form.type_formation, c_form.organisme_formateur, c_form.identifiant_agent";
                $stmt_form_agent = $conn->prepare($sql_form_agent);
                $stmt_form_agent->execute();
                $formations_agent = $stmt_form_agent->fetchAll();
                $agents[$key]['formations']=$formations_agent;
            }
            return $agents;
        }else */
        if ($algo_import_type == AGIRHE_KEY) {
            $sql_collectivite = "SELECT * FROM agirhe_collectivite a_coll 
                JOIN collectivite bs_coll 
                    ON bs_coll.NM_SIRE=a_coll.siret
                WHERE a_coll.can_import = 1";
            $sql_collectivite .= $collectivite != null ? " AND a_coll.siret = '" . $collectivite->getNmSire() . "';" : ";";
            $stmt_collectivite = $conn->query($sql_collectivite);
            $collectivites = array();
            $collectivites = $stmt_collectivite->fetchAll();
            return $collectivites;
        } else {
            return array();
        }
    }

    /*
    *
    */
    public function getTableCollOkForImport($type_import, $user)
    {
        $conn = $this->em->getConnection();
        $tab_coll_ok = array();
        if ($type_import == CIRIL_KEY) {
            $sql_tab_ok = "SELECT * FROM ciril_collectivite c_coll
                INNER JOIN collectivite bs_coll
                    ON bs_coll.NM_SIRE = c_coll.siret
                JOIN departement depa 
                    ON depa.ID_DEPA = bs_coll.ID_DEPA
                JOIN cdg_departement cdg_depa
                    ON cdg_depa.ID_DEPA = depa.ID_DEPA
                JOIN utilisateur_cdg u_cdg
                    ON u_cdg.ID_CDG = cdg_depa.ID_CDG
                WHERE cdg_depa.FG_TYPE = 0
                    AND u_cdg.ID_UTIL = " . $user->getIdUtil() . ";";
            $stmt_tab_ok = $conn->query($sql_tab_ok);
            $tab_coll_ok = $stmt_tab_ok->fetchAll();
        } else if ($type_import == AGIRHE_KEY) {
            $sql_tab_ok = "SELECT * FROM agirhe_collectivite a_coll
                INNER JOIN collectivite bs_coll
                    ON bs_coll.NM_SIRE = a_coll.siret
                JOIN departement depa 
                    ON depa.ID_DEPA = bs_coll.ID_DEPA
                JOIN cdg_departement cdg_depa
                    ON cdg_depa.ID_DEPA = depa.ID_DEPA
                JOIN utilisateur_cdg u_cdg
                    ON u_cdg.ID_CDG = cdg_depa.ID_CDG
                WHERE cdg_depa.FG_TYPE = 0
                    AND u_cdg.ID_UTIL = " . $user->getIdUtil() . ";";
            $stmt_tab_ok = $conn->query($sql_tab_ok);
            $tab_coll_ok = $stmt_tab_ok->fetchAll();
        }
        return $tab_coll_ok;
    }

    /*
    *
    */
    public function getTableCollOnlyLeft($type_import, $user)
    {
        $conn = $this->em->getConnection();
        $tab_coll_left = array();
        $current_cdg = $this->em->getRepository('CollectiviteBundle:Cdg')->findOneCdgByUtilisateur($user);
        if ($type_import == CIRIL_KEY) {

            $sql_tab_left = "SELECT * FROM ciril_collectivite a_coll
                    LEFT OUTER JOIN collectivite bs_coll ON bs_coll.NM_SIRE = a_coll.siret
                      JOIN fichier f ON f.FILE_KEY = a_coll.file_key
                    WHERE bs_coll.NM_SIRE IS NULL AND f.OWNER_KEY = 'CDG-" . $current_cdg->getIdCdg() . "'";

            $stmt_tab_left = $conn->query($sql_tab_left);
            $tab_coll_left = $stmt_tab_left->fetchAll();
        } else if ($type_import == AGIRHE_KEY) {

            $sql_tab_left = "SELECT * FROM agirhe_collectivite a_coll
                LEFT OUTER JOIN collectivite bs_coll
                        ON bs_coll.NM_SIRE = a_coll.siret
                    JOIN fichier f ON f.FILE_KEY = a_coll.file_key
                    WHERE bs_coll.NM_SIRE IS NULL AND f.OWNER_KEY = 'CDG-" . $current_cdg->getIdCdg() . "'";
            $stmt_tab_left = $conn->query($sql_tab_left);
            $tab_coll_left = $stmt_tab_left->fetchAll();
        }
        return $tab_coll_left;
    }

    /*
    *
    */
    public function getTableCollOnlyRight($type_import, $user)
    {
        $conn = $this->em->getConnection();
        $tab_coll_right = array();
        if ($type_import == CIRIL_KEY) {
            $sql_tab_right = "SELECT * FROM ciril_collectivite c_coll
                   RIGHT OUTER JOIN collectivite bs_coll
                        ON bs_coll.NM_SIRE = c_coll.siret
                    JOIN departement depa 
                        ON depa.ID_DEPA = bs_coll.ID_DEPA
                   JOIN cdg_departement cdg_depa
                        ON cdg_depa.ID_DEPA = depa.ID_DEPA
                    JOIN utilisateur_cdg u_cdg
                        ON u_cdg.ID_CDG = cdg_depa.ID_CDG
                    WHERE c_coll.siret IS NULL
                        AND cdg_depa.FG_TYPE = 0
                        AND u_cdg.ID_UTIL = " . $user->getIdUtil();
            $stmt_tab_right = $conn->query($sql_tab_right);
            $tab_coll_right = $stmt_tab_right->fetchAll();
        } else if ($type_import == AGIRHE_KEY) {
            $sql_tab_right = "SELECT * FROM agirhe_collectivite a_coll
                   RIGHT OUTER JOIN collectivite bs_coll
                        ON bs_coll.NM_SIRE = a_coll.siret
                    JOIN departement depa 
                        ON depa.ID_DEPA = bs_coll.ID_DEPA
                    JOIN cdg_departement cdg_depa
                        ON cdg_depa.ID_DEPA = depa.ID_DEPA
                    JOIN utilisateur_cdg u_cdg
                        ON u_cdg.ID_CDG = cdg_depa.ID_CDG
                    WHERE a_coll.siret IS NULL
                        AND cdg_depa.FG_TYPE = 0
                        AND u_cdg.ID_UTIL = " . $user->getIdUtil();
            $stmt_tab_right = $conn->query($sql_tab_right);
            $tab_coll_right = $stmt_tab_right->fetchAll();
        }
        //dump($tab_coll_right);
        return $tab_coll_right;
    }

    /*
    *
    */
    public function SetCollToImport($coll_selected_sirets, $algo_import_type)
    {
        $conn = $this->em->getConnection();
        $tab_coll_right = array();
        $current_user = $this->getUser();
        $coll_selected_sirets = is_array($coll_selected_sirets) ? $coll_selected_sirets : array($coll_selected_sirets);
        $tab_coll_ok = array_nested_unique(array_merge($this->getTableCollOkForImport(CIRIL_KEY, $current_user),
            $this->getTableCollOkForImport(AGIRHE_KEY, $current_user)), 'NM_SIRE');

        $sql_unselect_ciril_coll = 'UPDATE ciril_collectivite SET can_import = 0 WHERE can_import = 1';
        $sql_unselect_agihre_coll = 'UPDATE agirhe_collectivite SET can_import = 0 WHERE can_import = 1';
        if(count($tab_coll_ok)>0){
            $sql_unselect_ciril_coll .= ' AND siret IN (';
            $sql_unselect_agihre_coll .= ' AND siret IN (';
            $first = true;
            foreach ($tab_coll_ok as $key => $coll) {
                $coll_siret = $coll['NM_SIRE'];
                $sql_unselect_ciril_coll .= $first ? "" : ",";
                $sql_unselect_ciril_coll .= '"' . $coll_siret . '"';
                $sql_unselect_agihre_coll .= $first ? "" : ",";
                $sql_unselect_agihre_coll .= '"' . $coll_siret . '"';
                $first = false;
            }
            $sql_unselect_ciril_coll .= ')';
            $sql_unselect_agihre_coll .= ')';
        }
        
        $sql_select_coll_ciril = "";
        $sql_select_coll_agihre = "";
        /* if($algo_import_type==CIRIL_KEY){

             $sql_select_coll = 'UPDATE ciril_collectivite SET can_import = 1 WHERE siret IN (';
         }
         else if($algo_import_type==AGIRHE_KEY){

             $sql_select_coll = 'UPDATE agirhe_collectivite SET can_import = 1 WHERE siret IN (';
         }*/
        $sql_select_coll_ciril = 'UPDATE ciril_collectivite SET can_import = 1 WHERE siret IN (';
        $sql_select_coll_agirhe = 'UPDATE agirhe_collectivite SET can_import = 1 WHERE siret IN (';
        $first = true;
        foreach ($coll_selected_sirets as $key => $coll_siret) {
            $sql_select_coll_ciril .= $first ? "" : ",";
            $sql_select_coll_ciril .= '"' . $coll_siret . '"';
            $sql_select_coll_agirhe .= $first ? "" : ",";
            $sql_select_coll_agirhe .= '"' . $coll_siret . '"';
            $first = false;
        }
        $sql_select_coll_ciril .= ");";
        $sql_select_coll_agirhe .= ");";
        $stmt_unselect_ciril_coll = $conn->query($sql_unselect_ciril_coll);
        $conn = $this->em->getConnection();
        $stmt_unselect_agirhe_coll = $conn->query($sql_unselect_agihre_coll);
        //$res_unselect_coll = $stmt_unselect_coll->fetchAll();
        $conn = $this->em->getConnection();
        $stmt_select_coll = $conn->query($sql_select_coll_ciril);
        $conn = $this->em->getConnection();
        $stmt_select_coll = $conn->query($sql_select_coll_agirhe);
        $res_select_coll = '';//$stmt_select_coll->fetchAll();
        return $res_select_coll;
    }

    /*
    *   fonction récupérant une instance de l'entitée résultant du traitement du bloc
    *   @param object $blocle bloc de données
            /!\ on parle ici d'un bloc et pas d'un ensemble de blocs, il faut bloucler si l'on souhaite traité un liste de blocs /!\
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @return Entity, l'instance de l'entitée à remplir ou null sinon
    */
    public function getEntity($bloc, $bloc_name)
    {
        $config_bloc = $this->getConfigFor($bloc_name);
        //echo "<p style='background-color:gray'>get entity</p>";
        $get_from_database = isset($config_bloc['get_from_database']) ? $config_bloc['get_from_database'] : false;
        $entity_to_use = isset($config_bloc['to_entity']) ? $config_bloc['to_entity'] : null;
        $vessel;
        if ($get_from_database != false) {
            $bloc_key = $get_from_database['bloc_key'];
            $key_field = $get_from_database['key_field'];
            $key_value = isset($bloc[$bloc_key]) ? $bloc[$bloc_key] : null;
            $entity_get_repo = $this->getBundleName($bloc_name) . ":" . $this->getEntityName($bloc_name);

            $repo = $this->em->getRepository($entity_get_repo);
            $vessel = $repo->findOneBy(array($key_field => $key_value));
        } else {
            $vessel = $entity_to_use != null ? new $entity_to_use() : null;
        }

        return $vessel;
    }

    /*
    *   fonction récupérant le nom de la méthode permettant de setter la valeur à l'entitée
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return string, le nom de la méthode permettant de setter la valeur
    */
    public function getSetMethod($bloc_name, $field_key)
    {
        $set_method = false;
        //$field_config = $this->getConfigFor($bloc_name)['fields'][$field_key];
        $is_field_collection = $this->isFieldCollection($bloc_name, $field_key);//$field_config['type'];
        $entity_field_data_key = $this->getEntityFieldDataKey($bloc_name, $field_key);//$field_config['right_key'];
        if (!is_null($entity_field_data_key)) {
            if (!$is_field_collection) {
                $set_method = "set" . ucfirst($entity_field_data_key);
            } else {
                $set_method = "add" . ucfirst($entity_field_data_key);
            }
        }
//        var_dump($set_method);
        return $set_method;
    }

    /*
    *   fonction récupérant le nom de la méthode permettant de setter un bloc parent à un sous bloc
    */
    public function getSetBackRefMethod($vessel)
    {
        $refClass = new \ReflectionClass(get_class($vessel));
        $vessel_class = $refClass->getShortName();

        $set_back_ref_method = "set" . ucfirst($vessel_class);
        //var_dump($set_back_ref_method);
        return $set_back_ref_method;
    }

    /*
    * fonction récupérant le nom de la méthode permettent de getter un propriété d'un objet
    */
    public function getGetMethod($object, $prop_name)
    {
        $get_method = "get" . ucfirst($prop_name);
        if (!method_exists($object, $get_method)) {
            $get_method = null;
        }
        return $get_method;
    }

    /*
    *   fonction principale de traitement d'un bloc 
    *       /!\ appel récursif imbriqué /!\
    *   @param mixed $bloc, le bloc de données
            /!\ on parle ici d'un bloc et pas d'un ensemble de blocs, il faut bloucler si l'on souhaite traité un liste de blocs /!\
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @return Entity, l'entitée résultant du traitement du bloc
    */
    public function processBloc($bloc, $bloc_name)
    {
        $bloc_fields_config = $this->getFieldConfigFor($bloc_name);
        $vessel = $this->getEntity($bloc, $bloc_name);
        //if($bloc_name=='collectivite_agirhe') dump($vessel);
        foreach ($bloc_fields_config as $field_key => $field_config) {
            $this->processField($bloc, $vessel, $bloc_name, $field_key);
        }

        return $vessel;
    }

    /*
    *   fonction principale de traitement d'un champ 
    *       /!\ appel récursif /!\
    *   @param mixed $bloc, le bloc de données passé par référence
            /!\ on parle ici d'un bloc et pas d'un ensemble de blocs, il faut bloucler si l'on souhaite traité un liste de blocs /!\
    *   @param Entity $vessel, l'entitée à remplir par le traitement du bloc (le receptacle) passé par référence
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    */
    public function processField(&$bloc, &$vessel, $bloc_name, $field_key)
    {
        //$field_config = $this->getConfigFor($bloc_name)['fields'][$field_key];
        //if($bloc_name=='collectivite_agirhe') dump($vessel);
        $field_type = $this->getFieldType($bloc_name, $field_key);
        $is_field_collection = $this->isFieldCollection($bloc_name, $field_key);
        $is_field_bloc = $this->isFieldBloc($bloc_name, $field_key);
        if (!$is_field_collection) {

            $is_condition_ok = $this->processCondition($bloc, $vessel, $bloc_name, $field_key);
            if ($is_field_bloc && $is_condition_ok) {
                $setMethod = $this->getSetMethod($bloc_name, $field_key);
                $sub_bloc_name = $this->getFieldBlocName($bloc_name, $field_key);
                $sub_bloc = $this->processBloc($collection_item, $sub_bloc_name);
                if ($this->doFieldNeedBackRef($bloc_name, $field_key, $sub_bloc)) {
                    $setBackRefMethod = $this->getSetBackRefMethod($vessel);
                    $sub_bloc->$setBackRefMethod($vessel);
                }
                if (method_exists($vessel, $setMethod)) $vessel->$setMethod($sub_bloc);
            } else if ($is_condition_ok) {

                $data = $this->processData($bloc, $bloc_name, $field_key);
                if ($this->doFieldNeedBackRef($bloc_name, $field_key, $data)) {
                    $setBackRefMethod = $this->getSetBackRefMethod($vessel);
                    $data->$setBackRefMethod($vessel);
                }
                $setMethod = $this->getSetMethod($bloc_name, $field_key);
                if (method_exists($vessel, $setMethod)) $vessel->$setMethod($data);
            }
        } else {
            $collection = $this->getBlocFieldData($bloc, $bloc_name, $field_key);
            if (is_array($collection)) {
                foreach ($collection as $key => $collection_item) {
                    $is_condition_ok = $this->processCondition($bloc, $vessel, $bloc_name, $field_key, $collection_item);
                    if ($is_field_bloc && $is_condition_ok) {
                        $setMethod = $this->getSetMethod($bloc_name, $field_key);
                        $sub_bloc_name = $this->getFieldBlocName($bloc_name, $field_key);
                        $sub_bloc = $this->processBloc($collection_item, $sub_bloc_name);
                        if ($this->doFieldNeedBackRef($bloc_name, $field_key, $sub_bloc)) {
                            $setBackRefMethod = $this->getSetBackRefMethod($vessel);
                            $sub_bloc->$setBackRefMethod($vessel);
                        }
                        if (method_exists($vessel, $setMethod)) $vessel->$setMethod($sub_bloc);
                    } else if ($is_condition_ok) {
                        $data = $this->processData($collection_item, $bloc_name, $field_key);
                        if ($this->doFieldNeedBackRef($bloc_name, $field_key, $data)) {
                            $setBackRefMethod = $this->getSetBackRefMethod($vessel);
                            $data->$setBackRefMethod($vessel);
                        }
                        $setMethod = $this->getSetMethod($bloc_name, $field_key);
                        if (method_exists($vessel, $setMethod)) $vessel->$setMethod($data);
                    }

                }
            }
        }
    }

    /*
    *   fonction principale de traitement des conditions
    *   @param mixed $bloc, le bloc de données passé par référence
            /!\ on parle ici d'un bloc et pas d'un ensemble de blocs, il faut bloucler si l'on souhaite traité un liste de blocs /!\
    *   @param Entity $vessel, l'entitée à remplir par le traitement du bloc (le receptacle) passé par référence
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param $sub_bloc [optionel], sous bloc c'est à dire élément d'une collection
    *   @return boolean, si la condition est vérifiée   
    */
    public function processCondition($bloc, $vessel, $bloc_name, $field_key, $sub_bloc = null)
    {
        $condition_params = $this->getConditionParams($bloc, $vessel, $bloc_name, $field_key, $sub_bloc);
        $is_ok = true;

        if ($condition_params != false) {
            $left_value = $condition_params['left_value'];
            $operator = $condition_params['operator'];
            $right_value = $condition_params['right_value'];
            $is_ok = $this->makeComparison($left_value, $operator, $right_value);
        }
        return $is_ok;
    }

    /*
    *   fonction récupérant les éléments d'une condition d'après la configuration du bloc
    *       son but principal est de récupérer les données à comparer (la data courante, depuis un champs du bloc, du réceptacle ou du sous bloc)
    *   @param mixed $bloc, le bloc de données passé par référence
            /!\ on parle ici d'un bloc et pas d'un ensemble de blocs, il faut bloucler si l'on souhaite traité un liste de blocs /!\
    *   @param Entity $vessel, l'entitée à remplir par le traitement du bloc (le receptacle) passé par référence
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param $sub_bloc [optionel], sous bloc c'est à dire élément d'une collection
    *   @param $data [optionel], la donnée courante
    *   @return boolean, si la condition est vérifiée   
    */
    public function getConditionParams($bloc, $vessel, $bloc_name, $field_key, $sub_bloc = null, $data = null)
    {
        $condition = $this->getFieldCondition($bloc_name, $field_key);
        $condition_params = false;
        if ($condition != null) {
            $condition_params = array();
            $left_value = isset($condition['left_value']) ? $condition['left_value'] : null;
            if (isObject($left_value)) {
                $left_value = $this->getValueFromParam($bloc, $bloc_name, $field_key, $left_value, $sub_bloc, $data);
                /*$from_type = isset($left_value['from']) ? $left_value['from'] : null;
                $from_field_key = isset($left_value['field']) ? $left_value['field'] : null;
                //$is_field_bloc = $this->isFieldBloc($bloc_name,$field);
                if($from_type!=null){
                    if($from_type=='vessel'){
                        $left_value = $this->processData($bloc,$bloc_name,$from_field_key);
                    }else if($from_type=='bloc'){
                        $left_value = $this->getBlocFieldData($bloc,$bloc_name,$from_field_key);
                    }
                }*/
            }
            $operator = isset($condition['operator']) ? $condition['operator'] : null;
            $right_value = isset($condition['right_value']) ? $condition['right_value'] : null;
            if (isObject($right_value)) {
                $right_value = $this->getValueFromParam($bloc, $bloc_name, $field_key, $right_value, $sub_bloc, $data);
            }
            $condition_params = array(
                "left_value" => $left_value,
                "operator" => $operator,
                "right_value" => $right_value
            );
        }
        return $condition_params;
    }

    /*
     *   fonction récupérant une valeur d'un champs du bloc, sous bloc ou réceptacle
     *       son but principal est de récupérer les données à comparer (la data courante, depuis un champs du bloc, du réceptacle ou du sous bloc)
     *   @param mixed $bloc, le bloc de données passé par référence
             /!\ on parle ici d'un bloc et pas d'un ensemble de blocs, il faut bloucler si l'on souhaite traité un liste de blocs /!\
     *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
     *   @param string $from_param, les arguments déterminant la source de la donnée
     *   @param $sub_bloc [optionel], sous bloc c'est à dire élément d'une collection
     *   @return boolean, si la condition est vérifiée
     */
    public function getValueFromVesselOrBlock($bloc, $bloc_name, $field_key, $from_param, $sub_bloc = null)
    {
        $from_type = isset($from_param['from']) ? $from_param['from'] : null;
        $from_field_key = isset($from_param['field']) ? $from_param['field'] : null;
        $from_field_sub_key = isset($from_param['sub_field']) ? $from_param['sub_field'] : null;
        $raw_get = isset($from_param['raw_get']) && is_bool($from_param['raw_get']) ? $from_param['raw_get'] : null;
        $value = null;
        //$is_field_bloc = $this->isFieldBloc($bloc_name,$field);
        switch ($from_type) {
            case 'bloc':
                if ($raw_get != true) {
                    $value = $this->getBlocFieldData($bloc, $bloc_name, $from_field_key);
                }
                if ($value == null && ($raw_get == null || $raw_get == true)) {
                    $value = $this->getRawBlocData($bloc, $from_field_key);
                }
                break;
            case 'sub_bloc':
                $sub_bloc_name = $this->getFieldBlocName($bloc_name, $field_key);
                if ($raw_get != true) {
                    $value = $this->getBlocFieldData($sub_bloc, $sub_bloc_name, $from_field_key);
                }
                if ($value == null && ($raw_get == null || $raw_get == true)) {
                    $value = $this->getRawBlocData($sub_bloc, $from_field_key);
                }
                break;
            case 'vessel':
                $value = $this->processData($bloc, $bloc_name, $from_field_key);
                break;
            case 'sub_vessel':
                $sub_bloc_name = $this->getFieldBlocName($bloc_name, $field_key);
                $value = $this->processData($sub_bloc, $sub_bloc_name, $from_field_key);
                break;
            case 'data':
                $value = $this->getRawBlocData($bloc, $from_field_key);
                break;
            case 'sub_data':
                $value = $this->getRawBlocData($sub_bloc, $from_field_key);
                break;
        }
        if (isset($from_field_sub_key)) {
            $value = $this->getSelfData($value, $from_param);
            /*if(gettype($value) == "object"){
                $getMethod = $this->getGetMethod($value,$from_field_sub_key);
                if($getMethod!=null){
                    $sub_value = $value->$getMethod();
                    $value = $sub_value != null ? $sub_value : $value;
                }
            }else if(is_array($value)){
                $value = isset($value[$from_field_sub_key]) ? $value[$from_field_sub_key] : $value;
            }*/
        }
        /*if($from_type!=null){
            if($from_type=='vessel'){
                $value = $this->processData($bloc,$bloc_name,$from_field_key);
            }else if($from_type=='bloc'){
                if($raw_get!=true){
                    $value = $this->getBlocFieldData($bloc,$bloc_name,$from_field_key);
                }
                if($value == null && ($raw_get==null || $raw_get==true)){
                    $value = $this->getRawBlocData($bloc,$from_field_key);
                }
            }else if($from_type=='sub_vessel'){
                $sub_bloc_name = $this->getFieldBlocName($bloc_name,$field_key);
                $value = $this->processData($sub_bloc,$sub_bloc_name,$from_field_key);
            }else if($from_type=='sub_bloc'){
                $sub_bloc_name = $this->getFieldBlocName($bloc_name,$field_key);
                if($raw_get!=true){
                    $value = $this->getBlocFieldData($sub_bloc,$sub_bloc_name,$from_field_key);
                }
                if($value == null && ($raw_get==null || $raw_get==true)){
                    $value = isset($sub_bloc[$from_field_key]) ? $sub_bloc[$from_field_key] : $value;
                }
            }else if(else if($from_type=='self_data_value'){
                $value = $this->getBlocFieldData($bloc,$bloc_name,$field_key);
            }
        }*/
        return $value;
    }

    /*
    *
    */
    public function getValueFromInParam($from_param)
    {
        $param_key = isset($from_param['field']) ? $from_param['field'] : null;
        $default_value = isset($from_param['def_value']) ? $from_param['def_value'] : null;
        $value = $default_value;
        if ($param_key != null) {
            $value = isset($this->in_params[$param_key]) ? $this->in_params[$param_key] : $default_value;
        }
        return $value;
    }

    /*
    *
    */
    public function getValueFromParam($bloc, $bloc_name, $field_key, $from_param, $sub_bloc = null, $data = null)
    {
        $from_type = isset($from_param['from']) ? $from_param['from'] : null;
        $value = null;
        switch ($from_type) {
            case 'in_param':
                $value = $this->getValueFromInParam($from_param);
                break;
            case 'self_data_value':
                $value = $this->getSelfData($data, $from_param);
                break;
            default:
                $value = $this->getValueFromVesselOrBlock($bloc, $bloc_name, $field_key, $from_param, $sub_bloc);
                break;
        }
        return $value;
    }

    /*
    *   
    */
    public function getSelfData($data, $from_param)
    {
        $value = $data;
        $from_field_sub_key = isset($from_param['sub_field']) ? $from_param['sub_field'] : null;
        if (isset($from_field_sub_key)) {
            if (gettype($value) == "object") {
                $getMethod = $this->getGetMethod($value, $from_field_sub_key);
                if ($getMethod != null) {
                    $sub_value = $value->$getMethod();
                    $value = $sub_value != null ? $sub_value : $value;
                }
            } else if (is_array($value)) {
                $value = isset($value[$from_field_sub_key]) ? $value[$from_field_sub_key] : $value;
            }
        }
        return $value;
    }

    /*
    *
    */
    public function processData(&$bloc, $bloc_name, $field_key)
    {
        $data = $this->getBlocFieldData($bloc, $bloc_name, $field_key);
        $data_trans = $this->transform($data, $bloc_name, $field_key, $bloc);
        return $data_trans;
    }

    /*
    *   
    */
    public function transform($data, $bloc_name, $field_key, $bloc)
    {
        $field_transform = $this->getFieldTransform($bloc_name, $field_key);
        if ($field_transform != null) {
            if (array_key_exists(0, $field_transform)) {
                foreach ($field_transform as $key => $transform) {
                    $data = $this->processTranform($data, $transform, $bloc_name, $field_key, $bloc);
                }
            } else {
                $data = $this->processTranform($data, $field_transform, $bloc_name, $field_key, $bloc);
                /*switch ($field_transform['name']) {
                    case 'date_format':
                        $format_to = $field_transform['format'];
                        $data = date_create_from_format('d/m/Y',$data);
                        $data = date_format($data,$format_to);
                        break;
                    case 'get_from_ref':
                        $ref_name = $field_transform['ref_name'];
                        $get_col = $field_transform['get_col'];
                        $by_col = $field_transform['by_col'];
                        $data = $this->getDataFromRef($data,$ref_name,$get_col,$by_col);

                    default:
                        # code...
                        break;
                }*/
            }

        }
        return $data;
    }

    /*
    *
    */
    public function processTranform($data, $transform, $bloc_name, $field_key, $bloc)
    {
        switch ($transform['name']) {
            case 'date_format':
                $format_to = $transform['format_to'];
                $format_from = isset($transform['format_from']) ? $transform['format_from'] : 'd/m/Y';
                $to_date_interface = isset($transform['to_date_interface']) ? $transform['to_date_interface'] : false;
                if ($data != null) {
                    $data = date_create_from_format($format_from, $data);
                    $data = date_format($data, $format_to);
                    if ($to_date_interface) {
                        $data = date_create_from_format($format_to, $data);
                    }
                }
                break;
            case 'get_from_ref':
                $ref_name = $transform['ref_name'];
                $get_col = $transform['get_col'];
                $by_col = $transform['by_col'];
                $data = $this->getDataFromRef($data, $ref_name, $get_col, $by_col);
                break;
            case 'get_from_base_ref':
                $from_repository = $transform['from_repository'];
                $entity_field = $transform['entity_field'];
                $operator = isset($transform['operator']) ? $transform['operator'] : '==';
                switch ($operator) {
                    case '==':
                        $data = $this->em->getRepository($from_repository)->findOneBy(array($entity_field => $data));
                        break;
                    case 'like':
                        if (!is_null($data) && !empty($data)) {
                            $query_b = $this->em->getRepository($from_repository)->createQueryBuilder('t')
                                ->where('t.' . $entity_field . ' LIKE :data')
                                ->setParameter('data', '%' . $data . '%')
                                ->setMaxResults(1);
                            $data = $query_b->getQuery()->getOneOrNullResult();
                        }
                        break;
                    default:
                        $data = $this->em->getRepository($from_repository)->findOneBy(array($entity_field => $data));
                        break;
                }
                break;
            case 'matching_swap':
                $swaping_board = $transform['swaping_board'];
                $default_value = isset($swaping_board['default_value']) ? $swaping_board['default_value'] : null;
                $data = isset($swaping_board[$data]) ? $swaping_board[$data] : $default_value;
                break;
            case 'comparison':
                $if_else = $transform['if_else'];
                foreach ($if_else as $key => $if_param) {
                    $operator = $if_param['operator'];
                    $right_value = isset($if_param['right_value']) ? $if_param["right_value"] : null;
                    if (isObject($right_value)) {
                        $right_value = $this->getValueFromParam($bloc, $bloc_name, $field_key, $right_value, null, $data);
                    }
                    $left_value = isset($if_param['left_value']) ? $if_param['left_value'] : $data;
                    if (isObject($right_value)) {
                        $left_value = $this->getValueFromParam($bloc, $bloc_name, $field_key, $left_value, null, $data);
                    }
                    $no_break = isset($if_param['no_break']) && $if_param['no_break'] == true ? true : false;
                    $comp_ok = $this->makeComparison($left_value, $operator, $right_value);//false;
                    /* switch ($operator) {
                         case '>':
                             $comp_ok = $data > $right_value;
                             break;
                         case '>=':
                             $comp_ok = $data >= $right_value;
                             break;
                         case '<':
                             $comp_ok = $data < $right_value;
                             break;
                         case '<=':
                             $comp_ok = $data <= $right_value;
                             break;
                         case '==':
                             $comp_ok = $data == $right_value;
                             break;
                         case '===':
                             $comp_ok = $data === $right_value;
                             break;
                     }*/
                    if ($comp_ok) {
                        if ((isset($if_param['value_if']) || is_null($if_param['value_if'])) && $if_param['value_if'] !== "self_data_value") {
                            if (isObject($if_param['value_if'])) {
                                $data = $this->getValueFromParam($bloc, $bloc_name, $field_key, $if_param['value_if'], null, $data);
                            } else {
                                $data = $if_param['value_if'];
                            }
                        }
                        if (!$no_break) {
                            break;
                        }
                    } else if ((isset($if_param['value_else']) || is_null($if_param['value_else'])) && $if_param['value_else'] !== "self_data_value") {
                        if (isObject($if_param['value_else'])) {
                            $data = $this->getValueFromParam($bloc, $bloc_name, $field_key, $if_param['value_else'], null, $data);
                        } else {
                            $data = $if_param['value_else'];
                        }
                    }
                }
                break;
            case 'same_as_field':
                $as_field = $transform['as_field'];
                $as_bloc = isset($transform['as_bloc']) ? $transform['as_bloc'] : $bloc_name;
                $data = $this->transform($data, $as_bloc, $as_field, $bloc);
                break;
            case 'to_entity':
                $to_data = null;
                $entity_class = $transform['entity_class'];
                $set_fields = $transform['set_fields'];
                if ($entity_class != null) {
                    $to_data = new $entity_class();
                }
                foreach ($set_fields as $key => $field) {
                    $field_enetity_key = isset($field['entity_field']) ? $field['entity_field'] : null;
                    $set_data = isset($field['set_data']) ? $field['set_data'] : $data;
                    if ($field_enetity_key != null) {
                        $set_data = isObject($set_data) ? $this->getValueFromParam($bloc, $bloc_name, $field_key, $set_data, null, $data) : $set_data;
                        $is_collection = isset($field['collection']) ? isTrue($field['collection']) : false;
                        $set_method = null;
                        if ($is_collection) {
                            $set_method = 'add' . ucfirst($field_enetity_key);
                        } else {
                            $set_method = 'set' . ucfirst($field_enetity_key);
                        }
                        $to_data->$set_method($set_data);
                    }
                }
                $data = $to_data;
                break;
            default:
                # code...
                break;
        }
        return $data;
    }

    /*
    *
    */
    public function makeComparison($left_value, $operator, $right_value = null)
    {
        $comp_ok = false;
        //var_dump($left_value);
        //var_dump($operator);
        //var_dump($right_value);
        //var_dump($left_value <= $right_value);
        //var_dump($left_value >= $right_value);
        switch ($operator) {
            case '>':
                $comp_ok = $left_value > $right_value;
                break;
            case '>=':
                $comp_ok = $left_value >= $right_value;
                break;
            case '<':
                $comp_ok = $left_value < $right_value;
                break;
            case '<=':
                $comp_ok = $left_value <= $right_value;
                break;
            case '==':
                $comp_ok = $left_value == $right_value;
                break;
            case '===':
                $comp_ok = $left_value === $right_value;
                break;
            case '!=':
                $comp_ok = $left_value != $right_value;
                break;
            case '!==':
                $comp_ok = $left_value !== $right_value;
                break;
            case 'is_array':
                $comp_ok = is_array($left_value);
                break;
            case 'is_empty':
                if ($left_value instanceof ArrayCollection) {
                    $comp_ok = $left_value->empty();
                } else {
                    $comp_ok = empty($left_value);
                }
                break;
            case 'is_null':
                $comp_ok = is_null($left_value);
                break;
            case 'is_not_null':
                $comp_ok = !is_null($left_value);
                break;
            case 'is_int':
                $comp_ok = is_array($left_value);
                break;
            case 'is_number':
                $comp_ok = !is_nan($left_value);
                break;
            case 'is_boll':
                $comp_ok = is_bool($left_value);
                break;
        }
        return $comp_ok;
    }

    /*
    *
    */
    public function getDataFromRef($key_data, $ref_name, $get_col, $by_col)
    {
        $ref = $this->getRefFor($ref_name);
        $return_data = null;
//        var_dump($ref_name);
//         var_dump($ref);
        // var_dump($key_data);
        // var_dump($get_col);
        // var_dump($by_col);
        foreach ($ref['data'] as $key => $data_ref) {
            if (isset($data_ref[$by_col]) && $key_data == $data_ref[$by_col]) {
                if (isset($data_ref[$get_col])) {
                    $return_data = $data_ref[$get_col];
                    break;
                }
            }
        }
        if ($ref_name == "ref_type_contrat" && $get_col == "cd_type_cdd") {
            //var_dump($key_data);
            //var_dump($return_data);
        }
        return $return_data;
    }

    /*
    *   fonction récupérant le type d'un champ donné (key : "type")
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return string, le type du champ
    */
    public function getFieldType($bloc_name, $field_key)
    {
        $field_config = $this->getFieldConfigFor($bloc_name, $field_key);
        $field_type = isset($field_config['type']) ? $field_config['type'] : null;
        return $field_type;
    }

    /*
    *   fonction récupérant le nom du bloc que le champ représente si il s'agit d'un bloc (key : "bloc_name")
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return string, le nom du bloc que le champ représente
    */
    public function getFieldBlocName($bloc_name, $field_key)
    {
        $field_config = $this->getFieldConfigFor($bloc_name, $field_key);
        $field_bloc_name = isset($field_config['bloc_name']) ? $field_config['bloc_name'] : null;
        return $field_bloc_name;
    }

    /*
    *   fonction récupérant la condtion éventuelle à appliquer (key : "condition")
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return mixed, la condition ou null
    */
    public function getFieldCondition($bloc_name, $field_key)
    {
        $field_config = $this->getFieldConfigFor($bloc_name, $field_key);
        $field_condition = isset($field_config['condition']) ? $field_config['condition'] : null;
        return $field_condition;
    }

    /*
    *   fonction récupérant la transformation éventuelle à appliquer (key : "transform")
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return mixed, la transformation ou null
    */
    public function getFieldTransform($bloc_name, $field_key)
    {
        $field_config = $this->getFieldConfigFor($bloc_name, $field_key);
        $field_transform = isset($field_config['transform']) ? $field_config['transform'] : null;
        return $field_transform;
    }

    /*
    *   fonction récupérant la clef permettant d'accéder à la donnée dans le bloc (key : "left_key")
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return string, la clef permettant d'accéder à la donnée dans le bloc (clef de gauche)
    */
    public function getBlocFieldDataKey($bloc_name, $field_key)
    {
        $field_config = $this->getFieldConfigFor($bloc_name, $field_key);
        $bloc_field_data_key = isset($field_config['left_key']) ? $field_config['left_key'] : null;
        return $bloc_field_data_key;
    }

    /*
    *   fonction récupérant la clef permettant d'accéder/setter à la donnée dans l'enitité receptacle (key : "right_key")
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return string, la clef permettant d'accéder à la donnée dans le bloc (clef de gauche)
    */
    public function getEntityFieldDataKey($bloc_name, $field_key)
    {
        $field_config = $this->getFieldConfigFor($bloc_name, $field_key);
        $entity_field_data_key = isset($field_config['right_key']) ? $field_config['right_key'] : null;
        return $entity_field_data_key;
    }

    /*
    *   fonction récupérant la donné d'un champ pour un bloc
    *   @param mixed $bloc, le bloc d'où l'on extrait la donnée (passage par réference)
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return mixed, la donnée récupéré du bloc
    */
    public function getBlocFieldData(&$bloc, $bloc_name, $field_key)
    {
        $bloc_field_data = null;
        $bloc_field_data_key = $this->getBlocFieldDataKey($bloc_name, $field_key);
        if ($bloc_field_data_key != null && isset($bloc[$bloc_field_data_key])) {
            $bloc_field_data = $bloc[$bloc_field_data_key];
        }
        return $bloc_field_data;
    }

    /*
    *
    *
    */
    public function getRawBlocData($bloc, $raw_field_key)
    {
        $raw_data = isset($bloc[$raw_field_key]) ? $bloc[$raw_field_key] : null;
        return $raw_data;
    }

    /*
    *   fonction déterminant si un champ est une collection
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return boolean, si le champ est une collection
    */
    public function isFieldCollection($bloc_name, $field_key)
    {
        $field_config = $this->getFieldConfigFor($bloc_name, $field_key);
        $is_field_collection = isset($field_config['collection']) ? $field_config['collection'] == true : false;
        return $is_field_collection;
    }

    /*
    *   fonction déterminant si un champ est une collection
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return boolean, si le champ est une collection
    */
    public function isFieldBloc($bloc_name, $field_key)
    {
        $field_bloc_name = $this->getFieldBlocName($bloc_name, $field_key);
        $is_field_bloc = $field_bloc_name != null;
        return $is_field_bloc;
    }

    /*
    *   
    */
    public function doFieldNeedBackRef($bloc_name, $field_key, $transformed)
    {
        $field_config = $this->getFieldConfigFor($bloc_name, $field_key);
        $field_need_back_ref = isset($field_config['back_ref']) && $field_config['back_ref'] == false ? false : gettype($transformed) == "object" ? true : false;
        if ($field_need_back_ref) {
            $refClass = new \ReflectionClass(get_class($transformed));
            $transformed_class = $refClass->getShortName();
            $field_need_back_ref = !in_array($transformed_class, array("DateTime"));
        }
        return $field_need_back_ref;
    }

    /*
    *   fonction chargeant l'ensemble des fichiers de config des blocs d'après les valeurs de $this->blocs_name
    */
    public function loadConfigBlocs()
    {
        foreach ($this->blocs_name as $key => $bloc_name) {
            $this->getConfigFor($bloc_name);
        }
    }

    /*
    *   fonction ajoutant une configuration à la pile de configurations des blocs $this->config_blocs
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param Array $config_bloc, la configuration extraite du fichier de configuration (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{value})
    */
    public function addConfigBloc($bloc_name, $config_bloc)
    {
        $this->config_blocs[$bloc_name] = $config_bloc;
        $this->loadDefInParams($bloc_name);
    }

    /*
    *
    */
    public function addInParam($param_key, $param_value, $force = true)
    {
        if (!isset($this->in_params[$param_key]) || ($force && isset($this->in_params[$param_key]))) {
            $this->in_params[$param_key] = $param_value;
        }
    }

    public function loadDefInParams($bloc_name, $force = false)
    {
        $config_bloc = $this->getConfigFor($bloc_name);
        if (isset($config_bloc['default_in_params'])) {
            foreach ($config_bloc['default_in_params'] as $param_key => $param_value) {
                $this->addInParam($param_key, $param_value, $force);
            }
        }
    }
    /*
    *   deprecated
    */
    /*public function loadEntityToUse(){
        $config_files = $this->import_config['config_files'];
        foreach ($config_files as $bloc_name => $config_file) {
            $config = $this->getConfigFor($bloc_name);
            $entity_to_use = $config['to_entity'];
            $entity = new $entity_to_use();
        }
    }*/
    /*
    *   fonction récupérant la configuration pour un bloc donné
    *       si la configuration est dans la pile, on la récupère de la pile
    *       sinon on tente de la charger depuis le fichier de config et on l'ajoute à la pile
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @return Array, la configuration du bloc, null sinon
    */
    public function getConfigFor($bloc_name)
    {
        //echo "<p style='background-color:silver'> get config for</p>";
        $bloc_config = null;
        if (isset($this->config_blocs[$bloc_name])) {
            $bloc_config = $this->config_blocs[$bloc_name];
        } else {
            $config_files = $this->import_config['config_files'];
            $bloc_config_file = isset($config_files[$bloc_name]) ? $config_files[$bloc_name] : null;
            $bloc_config = array();
            if ($bloc_config_file != null) {
                $this->config_finder->files()->name($bloc_config_file);
                $bloc_config = readOneFileFromFinder($this->config_finder, $bloc_config_file, 'json');
                $this->addConfigBloc($bloc_name, $bloc_config);
                /*foreach ($this->config_finder as $key => $file) {
                        $config_content = $file->getContents();
                        $bloc_config = json_decode($config_content,true);
                }*/
            }
        }
        return $bloc_config;
    }

    /*
    *
    */
    function getConfigBlocs()
    {
        return $this->config_blocs;
    }

    /*
    *   fonction retournant la configuration des champs pour un bloc ou d'un champ scpécifique d'un bloc
    *   @param string $bloc_name, le nom du bloc à traité, correspond à son nom dans la config (cf : Bilan_Social\Bundle\ImportCarriereBundle\Ressources\config\parameters:import_carriere:config_files:{key})
    *   @param string $field_key, [optionnel] la clef du champ dans la config (cf : bloc_config_file:fields:{key})
    *   @return Array, la configuration de l'ensemble des chamsp duc bloc ou du champ demandé, null sinon   
    */
    public function getFieldConfigFor($bloc_name, $field_key = null)
    {
        $bloc_config = $this->getConfigFor($bloc_name);
        $field_config = $bloc_config['fields'];
        if ($field_key != null) {
            $field_config = isset($field_config[$field_key]) ? $field_config[$field_key] : null;
        }
        return $field_config;
    }

    /*
    *
    */
    public function loadRefs()
    {
        foreach ($this->refs_name as $key => $ref_name) {
            $this->getRefFor($ref_name);
        }
    }

    /*
    *
    */
    public function addRefs($ref_name, $ref)
    {
        $this->refs[$ref_name] = $ref;
    }

    /*
    *
    */
    public function getRefFor($ref_name)
    {
        $ref = null;
        if (isset($this->refs[$ref_name])) {
            $ref = $this->refs[$ref_name];
        } else {
            $ref_files = $this->import_config['ref_files'];
            $ref_file = isset($ref_files[$ref_name]) ? $ref_files[$ref_name] : null;
            $ref = array();
            if ($ref_file != null) {

                $this->ref_finder->files()->name($ref_file);
                $ref = readOneFileFromFinder($this->ref_finder, $ref_file, 'json');
                $this->addRefs($ref_name, $ref);
                /*foreach ($this->config_finder as $key => $file) {
                    $config_content = $file->getContents();
                    $bloc_config = json_decode($config_content,true);
                }*/
            }
        }
        return $ref;
    }

    /*
    *
    */
    public function getConfigFinder()
    {
        return $this->config_finder;
    }

    public function getRefFinder()
    {
        return $this->ref_finder;
    }

//    private function getFileInfos($urlFileManager, $fileKey) {
//        $url = $urlFileManager.'fileInfos/'.$fileKey;
//        $response = array();
//        try {
//            // On utilise curl pour réaliser les appels aux Webservices.
//            $curl = curl_init($url);
//            curl_setopt($curl, CURLOPT_HEADER, false);
//            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($curl, CURLOPT_HTTPGET, true);
//            $json_response = curl_exec($curl);
//            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//            curl_close($curl);
//            
//            // On récupère la réponse
//            $response['status'] = $status;
//            $response['json_response'] = json_decode($json_response, true);
//        } catch (Exception $ex) {
//            $response['status'] = 500;
//            $response['json_response'] = null;
//            return $response;
//        }
//        return $response;
//    }
//    

    public function getBundleName($bloc_name)
    {
        $bloc_config = $this->getConfigFor($bloc_name);
        $to_entity = $bloc_config['to_entity'];
        $bundle_and_entity = extractBundleAndNameFromfullEntityClass($to_entity);
        $bundle_name = isset($bundle_and_entity[1]) ? $bundle_and_entity[1] : null;
        return $bundle_name;
    }

    public function getEntityName($bloc_name)
    {
        $bloc_config = $this->getConfigFor($bloc_name);
        $to_entity = $bloc_config['to_entity'];
        $bundle_and_entity = extractBundleAndNameFromfullEntityClass($to_entity);
        $entity_name = isset($bundle_and_entity[2]) ? $bundle_and_entity[2] : null;
        return $entity_name;
    }
}

/*
*   fonction récupérant le premier fichier trouvé par un Finder
*       applique optionnellement un fonction de décodage
            - string : "json" => json_decode()
            - function : appel de la fonction avec le contenu du fichier en paramètre
                @param string $files_content, le contenu du fichier
                @return string, le contenu du fichier traité
*/
function readOneFileFromFinder($finder, $file_name = null, $decode = false)
{
    $file_content = null;
    foreach ($finder as $key => $file) {
        $files_content = $file->getContents();
        if ($decode == 'json') {
            $file_content = json_decode($files_content, true);
        } else if (is_callable($decode)) {
            $file_content = $decode($files_content);
        }
        if ($file_name != null) {
            if ($file_name == $file->getFileName()) {
                break;
            } else {
                $file_content = null;
            }
        } else {
            break;
        }
    }
    return $file_content;
}

function parsePathForSystem($path)
{
    return str_replace("\\", DIRECTORY_SEPARATOR, $path);
}

function extractBundleAndNameFromfullEntityClass($full_class)
{
    $bundle_pattern = "/.*\\\\(.*Bundle)\\\\Entity\\\\(\D*)$/";
    $match = array();
    preg_match($bundle_pattern, $full_class, $match);
    //dump($match);
    return $match;
}

function array_unique_multidimensional($input)
{
    $serialized = array_map('serialize', $input);
    $unique = array_unique($serialized);
    return array_intersect_key($input, $unique);
}

function array_nested_unique($tab, $by_key = null, $data_extract = null, $get_data = null)
{
    $unique = array();
    $extract = array();
    if ($data_extract != null) {
        $data_extract = is_array($data_extract) ? $data_extract : array($data_extract);
        $extract = get_from_array_nested($data_extract, $by_key);
    }
    $result = array();
    foreach ($tab as $key => $sub_obj) {
        if ($by_key != null) {
            $by_value = $sub_obj[$by_key];
        } else {
            $by_value = serialize($sub_obj);
        }
        if (!in_array($by_value, $unique) && !in_array($by_value, $extract)) {
            $unique[] = $by_value;
            $result[] = $sub_obj;
        }
    }
    return $result;
}

/*
*
*/
function get_from_array_nested($tab, $get_key = null)
{
    $result = $tab;
    if ($get_key != null) {
        $get_key = is_array($get_key) ? $get_key : array($get_key);
        $get_one_col = count($get_key) == 1;
        $result = array();
        foreach ($tab as $key => $sub_obj) {
            $sub_result = array();
            foreach ($get_key as $key_i => $key_value) {
                if (isset($sub_obj[$key_value])) {
                    if ($get_one_col) {
                        $sub_result = $sub_obj[$key_value];
                    } else {
                        $sub_result[$key_value] = $sub_obj[$key_value];
                    }

                }
            }
            $result[] = $sub_result;
        }
    }
    return $result;
}

function isObject($var)
{
    return is_array($var) && !array_key_exists(0, $var);
}

function isTrue($var)
{
    return isset($var) && $var == true;
}