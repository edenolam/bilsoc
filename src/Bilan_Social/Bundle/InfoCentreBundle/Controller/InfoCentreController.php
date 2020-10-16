<?php

namespace Bilan_Social\Bundle\InfoCentreBundle\Controller;

use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Bilan_Social\Bundle\CoreBundle\Model\ClassMap;
use Bilan_Social\Bundle\CoreBundle\Model\ConfigDynamicClass;
use Bilan_Social\Bundle\CoreBundle\Form\DynamicFormType;
use Bilan_Social\Bundle\InfoCentreBundle\Form\FilterType;
use Bilan_Social\Bundle\InfoCentreBundle\Form\EditPoolType;
use Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier;
use Bilan_Social\Bundle\InfoCentreBundle\Entity\Pool;
use Bilan_Social\Bundle\InfoCentreBundle\Entity\PoolItem;
use Bilan_Social\Bundle\InfoCentreBundle\Entity\PoolExport;
use Bilan_Social\Bundle\InfoCentreBundle\Entity\PoolExportTask;
use Symfony\Component\HttpFoundation\Session\Session;
use Bilan_Social\Bundle\LongTaskManagerBundle\Services\LongTaskManager;
use Bilan_Social\Bundle\LongTaskManagerBundle\Entity\LongTaskHeader;
use Bilan_Social\Bundle\AnalyseBundle\Entity\HeaderExportHRG;
use ZipArchive;

class InfoCentreController extends AbstractBSController
{
    protected $session;
    protected $container;
    private $export_available = array();
    private $current_pool = null;

    public function __construct($container){
        $this->container = $container;
        $this->export_available = $this->getExportAvailable();
    }
    public function getContainer(){
        return $this->container;
    }
    public function &getSession(){
        if(!isset($this->session) || $this->session==null){
            $this->session = new Session();
        }
        return $this->session; 
    }
    public function getFromSession($prop_key){
        $session = $this->getSession();
        return $session->get($prop_key);
    }
    public function setToSession($prop_key,$prop_value,$options=array()){
        $session = $this->getSession();
        $override = isset($options['force']) ? $options['force'] : true;
        if($session->get($prop_key)!=null){
            if($override){
                $session->set($prop_key,$prop_value);
            }
        }else{
            $session->set($prop_key,$prop_value);
        }
    }
    public function indexAction(Request $request)
    {   
        try{
            $current_annee_campagne = $this->getCurrentAnneeCampagne();
            $this->setToSession('current_annee_campagne',$current_annee_campagne);
           /* dump($connection_other_bdd->getRepository('CoreBundle:exportAdmin'));*/
            $is_newly_created_pool = $this->getIsNewlyCreatedPool()!=null && $this->getIsNewlyCreatedPool()==true ? true : false;
            $this->emptyCurrentParams($is_newly_created_pool);
            $utilisateur = $this->getUser();
            $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
            $view_params['pools'] = $pool_repo->getByUser($utilisateur);
            $view_params['tasks'] = array();//$this->getUserExportLongTasks();
            $view_params['current_pool'] = $this->getCurrentPool();
            $view_params['export_admin'] =  $export_admin = $this->getEntityManager()->getRepository('CoreBundle:exportAdmin')->findExportByType(10);
            $view_params['export_echantillon'] = $export_echantillon = $this->getEntityManager()->getRepository('CoreBundle:exportAdmin')->findExportByType(11);
            if(isset($view_params['current_pool']) && $view_params['current_pool']!=null){
                $id_current_pool = $view_params['current_pool']->getId();
                $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
                $current_pool = $pool_repo->getById($id_current_pool);
                $form_edit_pool = $this->createForm(EditPoolType::class, $current_pool);
                $form_edit_pool->handleRequest($request);
                $view_params['current_pool'] = $current_pool;
                $view_params['form_edit_pool'] = $form_edit_pool->createView();
            }
            $pool = new Pool();
            $form_create_pool = $this->createForm(EditPoolType::class, $pool);
            $form_create_pool->handleRequest($request);
            $view_params['form_create_pool'] = $form_create_pool->createView();
            $view_params['export_available']=$this->getExportAvailable();
            $view_params['file_manager']=$this->get('file_manager.file_manager');
            return $this->render('@InfoCentre/index.html.twig', $view_params);
        }catch(Exception $e){
            /*dump($e->getMessage());
            exit();*/
        }
    }


    public function getListUserPools(Request $request){
        $utilisateur = $this->getUser();
        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
        $user_pools = $pool_repo->getByUser($utilisateur);
        $response = new JsonResponse();
        $response->setData(array('data'=>$user_pools));
        return $response;
    }
    public function createPoolAction(Request $request){
        try{
            $em = $this->getEntityManager();
            $user_repo = $this->getEntityManager()->getRepository('UserBundle:User');
            $current_user = $user_repo->findOneBy(array('idUtil'=>$this->getUser()->getIdUtil()));
            $nom_pool = $request->get('new_pool_name');
            $pool = new Pool();
            $form_edit_pool = $this->createForm(EditPoolType::class, $pool);
            $form_edit_pool->handleRequest($request);
            $view_params['form_edit_pool'] = $form_edit_pool->createView();
            if($form_edit_pool->isSubmitted() && $form_edit_pool->isValid()){
                $pool->setUtilisateur($current_user);
                $pool->setDateCreation(date_create());
                $em->persist($pool);
                $em->flush();
                $id_new_pool = $pool->getId();
                $this->setCurrentPool($id_new_pool);
                $this->setIsNewlyCreatedPool(true);
            }

            return $this->redirectToRoute('info_centre_index');
        }catch(Exception $e){
            /*dump($e->getMessage());
            exit();*/
        }
    }

    public function clonePoolAction(Request $request){
        try{
            $id_pool_to_clone = $request->get('id_pool_to_clone');
            $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
           
            $pool_to_clone = $pool_repo->find($id_pool_to_clone);
            $pool_clone = new Pool();
            $pool_clone->setNom($pool_to_clone->getNom().'_COPIE');
            $pool_clone->setUtilisateur($this->getUser());
            $pool_clone->setDateCreation(date_create());
            $em = $this->getEntityManager();
            $em->persist($pool_clone);
            $em->flush();
            return $this->redirectToRoute('info_centre_index');
        }catch(Exception $e){
            /*dump($e->getMessage());
            exit();*/
        }
    }

    public function deletePoolAction(Request $request){
        try{
            $em = $this->getEntityManager();
            $id_pool_to_delete = $request->get('id_pool_to_delete');
            $pool_repo = $em->getRepository('InfoCentreBundle:Pool')->find($id_pool_to_delete);
            //$pool_to_delete = $pool_repo->find($id_pool_to_delete);
            // $em = $this->getEntityManager();*
            $pool_repo->setBlAct(0);
            $em->flush();
            return $this->redirectToRoute('info_centre_index');
        }catch(Exception $e){
            /*dump($e->getMessage());
            exit();*/
        }
    }

    public function selectPoolAction(Request $request){
        $id_pool_selected = $request->get('id_pool_selected');
        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
        $current_pool = $pool_repo->getById($id_pool_selected);
        $session = &$this->getSession();//new Session();
        $session->set('id_current_pool', $id_pool_selected);
        //$session->set('current_pool', $current_pool);
        $view_params['current_pool'] = $current_pool;
        return new JsonResponse($current_pool);
    }

    public function getFilterFormAction(Request $request){
        $filters = $this->getFiltersObject();
        $form = $this->createForm(FilterType::class, $filters);
        $form->handleRequest($request);
        $view_params = array();
        $view_params['filter_form'] = $form->createView();
        return $this->render('@InfoCentre/filter_form.html.twig',$view_params);
    }
    public function applyFiltersAction(Request $request){
        $session = &$this->getSession();//new Session();
        $current_pool = $this->getCurrentPool();
        $current_filters = $this->getCurrentFilters();
        $filters = $this->getFiltersObject();
        $form = $this->createForm(FilterType::class, $filters);
        $form->handleRequest($request);
        $view_params = array();
        $filter_results = array();
        $filter_list = null;
        if($form->isSubmitted() && $form->isValid()){

            if(isset($form['anneeCampPuitDeDonnee']) == true){
                $nm_annees = $form['anneeCampPuitDeDonnee']->getData();
                if(empty($nm_annees)){
                    $nm_annees = array('2017');
                    $filters->setAnneeCampPuitDeDonnee(array('2017'));
                }
                $this->setToSession('anneeCamp', $nm_annees);
            }else{
                $filters->setAnneeCampPuitDeDonnee(array('2017'));
            }
            $filterParser = $this->get('info_centre_filter_parser');
            $filterParser->setData($filters);
            $filterParser->processToFilterList();
            $filter_list = $filterParser->getFilterList();
            $this->setCurrentFilters($filter_list);
        }
        $view_params['filter_list']=$filter_list;
        if(isset($current_pool) && $current_pool!=null){
            $form_edit_pool = $this->createForm(EditPoolType::class, $current_pool);
            $form_edit_pool->handleRequest($request);
            $view_params['form_edit_pool'] = $form_edit_pool->createView();
            $view_params['filter_results'] = $filter_results;
            $view_params['current_pool'] = $current_pool;
        }
        
        return $this->render('@InfoCentre/filter_results.html.twig',$view_params);
    }

    public function processCurrentFilterDatatableAction(Request $request){
        set_time_limit(0);
        $em = $this->getEntityManager();
        $user = $this->getUser();
        $current_filters = $this->getCurrentFilters();
        $serviceConnection = $this->get('bdd_connection_preparator');
        $response = new JsonResponse();
        $results = array();
        $filter_results = array();
        $SqlFilterParser = $this->get('info_centre_sql_filter_parser');
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
        $id_util_cdg = "-1";
        if($utilCdg!=null){
           $id_util_cdg=$utilCdg->getIdUtilisateurCdg();
        }
        $SqlFilterParser->setUserCdg($id_util_cdg);
        $view_params['filter_list']=$current_filters;
        if(isset($current_filters) && $current_filters!=null && !empty($current_filters)){
            $SqlFilterParser->setFilterList($current_filters);
        
            $SqlFilterParser->processToPiles();

            $filter_results = $SqlFilterParser->getFilterResult($user);

            $current_pool = $this->getCurrentPool();
            if(isset($current_pool) && $current_pool!=null){
                if(count($filter_results)>0){
                    foreach ($current_pool->getItems() as $key => $item) {
                        $coll_in_result = array_search_nested($item->getIdCollectivite(),$filter_results,false,array('idColl'=>1));
                        $annee_in_result = array_search_nested($item->getAnneeCampagne(),$filter_results,false,array('anneeCamp'=>1));
                        if($coll_in_result!==false && $annee_in_result!==false){
                            array_splice($filter_results,$coll_in_result[0],1);
                        }
                    }
                }
            }
            $id_coll_list = array();
            //$array_not_allow_coll = $em->getRepository('InfoCentreBundle:PoolItem')->getNonDroitsSurCollectiviteByCdg($id_util_cdg, $id_coll_list);
            foreach ($filter_results as $index => $a_result) {
                $anonyme = $a_result['anonyme'];
                /*
                  if($anonyme){
                  $filter_results[$index]['nomColl'] = "********";
                  $filter_results[$index]['siretColl'] = "********";
                  $filter_results[$index]['lbDepa'] = "Autre";
                  unset($filter_results[$index]['cdDepa']);
                  }
                 */
                $filter_results[$index]['anonyme'] = $anonyme;
            }
            $results = $filter_results;

        }
        $response->setData($results);
        return $response;
    }

    public function getCurrentPoolItemsDatatableAction(Request $request){
        $em = $this->getEntityManager();
        $current_pool = $this->getCurrentPool();
        $current_user = $this->getUser();
        $serviceConnection = $this->get('bdd_connection_preparator');
        $arrayTempbyYears = array();
        $arrayConnection = array();
        $current_annee_campagne = $this->getCurrentAnneeCampagne();
        if(isset($current_pool) && $current_pool!=null){
            if(count($current_pool->getItems())>0){
                foreach ($current_pool->getItems() as $key => $item){
                    if(!array_key_exists($item->getAnneeCampagne(),$arrayConnection)){
                        $nm_annee = $item->getAnneeCampagne();
                        $base_key = $current_annee_campagne == $nm_annee ? 'bs' : $nm_annee;
                        $em_annee = $serviceConnection->getDoctrineConnection($base_key);
                        $arrayConnection[$item->getAnneeCampagne()] = $em_annee;
                        $arrayTempbyYears[$item->getAnneeCampagne()] = array();
                    }

                }
            }
        }
        foreach ($current_pool->getItems() as $key =>  $item){
            $em_annee = $arrayConnection[$item->getAnneeCampagne()];

            $collectivite = $em_annee->getRepository('CollectiviteBundle:Collectivite')->findOneByIdColl($item->getIdCollectivite());
            $enquete = $em_annee->getRepository('EnqueteBundle:Enquete')->findOneByIdEnqu($item->getIdEnquete());

            if($enquete !== null && $collectivite !== null){
                $item->setEnquete($enquete);
                $item->setCollectivite($collectivite);

                array_push($arrayTempbyYears[$item->getAnneeCampagne()],$item);
            }

        }

        $response = new JsonResponse();
        $data_table = array();
        //$id_coll_list = $current_pool->getItemsIdColl();
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
        $id_util_cdg = "-1";
        if($utilCdg!=null){
           $id_util_cdg=$utilCdg->getIdUtilisateurCdg();
        }
        /*$pool_item_repo = $em->getRepository('InfoCentreBundle:PoolItem');
        $array_not_allow_coll = array();
        if($this->getUser()->hasRole('ROLE_INFOCENTRE')){
            $id_depa_list = $current_user->getIdDepaArray();
            $array_not_allow_coll = $pool_item_repo->getNonDroitsSurCollectiviteByInfoCentre($id_depa_list, $id_coll_list);
        }else{
            $array_not_allow_coll = $pool_item_repo->getNonDroitsSurCollectiviteByCdg( $id_util_cdg, $id_coll_list);
        }*/
        $return_params = array();
        if(isset($arrayTempbyYears) && $arrayTempbyYears!=null){
            if(count($arrayTempbyYears)>0){
                $iter = 0;
                foreach ($arrayTempbyYears as $group_key => $items) {
                    $em = $arrayConnection[$group_key];
                    $pool_item_repo = $em->getRepository('InfoCentreBundle:PoolItem');
                    $id_coll_list = $current_pool->getItemsIdCollByAnnee($group_key);
                    if($this->getUser()->hasRole('ROLE_INFOCENTRE')){
                        $id_depa_list = $current_user->getIdDepaArray();
                        $array_not_allow_coll = $pool_item_repo->getNonDroitsSurCollectiviteByInfoCentre($id_depa_list, $id_coll_list);
                    }else{
                        $array_not_allow_coll = $pool_item_repo->getDroitsReadSurCollectiviteByCdg( $id_util_cdg, $id_coll_list);
                    }
                    foreach ($items as $key => $item){
                        if(isset($item) && ($item->getCollectivite() !== null ) && ($item->getEnquete() !== null)){
                            $anonyme =  $this->in_array_r($item->getIdCollectivite(), $array_not_allow_coll) ? false : true;
                            if($anonyme){
                                $data_table[$iter] = array(
                                    'id_pool_item'=>$item->getId(),
                                    'siret'=>"********",
                                    'nom'=>"********",
                                    'annee'=>$item->getAnneeCampagne(),
                                    'departement'=>"Autre"
                                );
                            }else{
                                $data_table[$iter] = array(
                                    'id_pool_item' => $item->getId(),
                                    'siret'        => $item->getCollectivite()->getNmSire(),
                                    'nom'          => utf8_encode($item->getCollectivite()->getLbColl()),
                                    'annee'        => $item->getAnneeCampagne(),
                                    'departement'  => utf8_encode($item->getCollectivite()->getDepartement()->getCdDepa() . ' - ' . $item->getCollectivite()->getDepartement()->getLbDepa())
                                );
                            }
                            $iter++;
                        }
                    }
                }
            }
            $is_secret_stat_ok = $this->checkPoolSecretStat($current_pool->getId());
            if($is_secret_stat_ok===false){
                $return_params['error'] = $this->get('translator')->trans('infocentre.filter_results.include_to_pool.error.no_stat_secret');
            }
        }
        $return_params['data']=$data_table;
        $response->setData($return_params);
        return $response;
    }

    public function getFiltersObject(){
        $filters_obj_config = $this->get('info_centre_config_finder')->getConfig('filters_object');
        $filters_obj = new ConfigDynamicClass($filters_obj_config);
        return $filters_obj;
    }

    public function includeToPoolAction(Request $request){
        $em = $this->getEntityManager();
        $item_to_include = $request->get('include_to_pool');
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());

        $id_util_cdg = "-1";
        if($utilCdg!=null){
           $id_util_cdg=$utilCdg->getIdUtilisateurCdg();
        }
        if(!empty($item_to_include)){
            $current_pool = $this->getCurrentPool();
            $view_params['current_pool'] = $current_pool;
            $em = $this->getEntityManager();

            $serviceConnection = $this->get('bdd_connection_preparator');
            $bdd_co_pile = array();
            $current_annee_campagne = $this->getCurrentAnneeCampagne();
            foreach ($item_to_include as $key => $col_enqu) {

                $col_enqu = explode('-',$col_enqu);
                $nm_annee = isset($col_enqu[2]) ? $col_enqu[2] : "2017"; 
                $base_key = $current_annee_campagne == $nm_annee ? 'bs' : $nm_annee;
                if(!isset($bdd_co_pile[$nm_annee])) $bdd_co_pile[$nm_annee] = $serviceConnection->getDoctrineConnection($base_key);
                $connection_other_bdd = $bdd_co_pile[$nm_annee];

                $new_pool_item = new PoolItem();

                $collectivite = $connection_other_bdd->getRepository('CollectiviteBundle:Collectivite')->findOneBy(array('idColl'=>$col_enqu[0]));

                $enquete = $connection_other_bdd->getRepository('EnqueteBundle:Enquete')->findOneBy(array('idEnqu'=>$col_enqu[1]));

                $new_pool_item->setCollectivite($collectivite);//->getIdColl());
                $new_pool_item->setEnquete($enquete);//->getIdEnqu());
                $new_pool_item->setAnneeCampagne($col_enqu[2]);
                $new_pool_item->setPool($current_pool);
                $current_pool->addItem($new_pool_item);
            }
           
            $em->flush();
            $is_secret_stat_ok = $this->checkPoolSecretStat($current_pool->getId());
            $return_params = array('data'=>$current_pool);
            if($is_secret_stat_ok===false){
                $return_params['error']=$this->get('translator')->trans('infocentre.filter_results.include_to_pool.error.no_stat_secret');
            }
            return new JsonResponse($return_params);
        }else{
            return new JsonResponse(array('error'=>true,'error'=>$this->get('translator')->trans('infocentre.filter_results.include_to_pool.error.no_pool_selected')));
        }
    }

    public function removeFromPoolAction(Request $request){
        $id_pool_item_to_remove = $request->get('remove_from_pool_item_id');
        $em = $this->getEntityManager();
        $pool_item_repo = $em->getRepository('InfoCentreBundle:PoolItem');
        $pool_item_to_remove = $pool_item_repo->findOneBy(array('id'=>$id_pool_item_to_remove));
        $current_pool = $this->getCurrentPool();
        $current_pool->removeItem($pool_item_to_remove);
        $em->remove($pool_item_to_remove);
        $em->flush();
        return $this->forward('InfoCentreBundle:InfoCentre:applyFilters');
    }

    public function saveEditPoolAction(Request $request){
        $current_pool = $this->getCurrentPool();
        $em = $this->getEntityManager();
        $form_edit_pool = $this->createForm(EditPoolType::class, $current_pool);
        $form_edit_pool->handleRequest($request);
        $view_params['form_edit_pool'] = $form_edit_pool->createView();
        if($form_edit_pool->isSubmitted() && $form_edit_pool->isValid()){
            $em->persist($current_pool);
            $em->flush();
        }
        return $this->forward('InfoCentreBundle:InfoCentre:applyFilters');
    }

    public function exportPoolAction(Request $request){
        $em = $this->getEntityManager();
        $export_action_key = $request->get('export_action');
        $export_pool_id = $request->get('export_pool_id');
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
        $id_util_cdg = "-1";
        if($utilCdg!=null){
           $id_util_cdg=$utilCdg->getIdUtilisateurCdg();
        }

        $is_secret_stat_ok = $this->checkPoolSecretStat($export_pool_id);
        $export_available = $this->getExportAvailable();
        $export_config = isset($export_available[$export_action_key]) ? $export_available[$export_action_key] : null;
        if($is_secret_stat_ok===true && $export_config!=null){
            $return = null;
            $pool = $em->getRepository('InfoCentreBundle:Pool')->findOneById($export_pool_id);
            $pool_export = new PoolExport();
            $pool_export->setExportType($export_action_key);
            $pool_export->setPool($pool);
            $em->persist($pool_export);
            $em->flush();
            $export_action = isset($this->export_available[$export_action_key]['action']) ? $this->export_available[$export_action_key]['action'] : null;
            $export_forward = isset($this->export_available[$export_action_key]['forward']) ? $this->export_available[$export_action_key]['forward'] : null;
            $export_redirect = isset($this->export_available[$export_action_key]['redirect']) ? $this->export_available[$export_action_key]['redirect'] : null;
            $export_param = isset($this->export_available[$export_action_key]['param']) ? $this->export_available[$export_action_key]['param'] : null;
            //$export_service = isset($this->export_available[$export_action_key]['service']) ? $this->export_available[$export_action_key]['service'] : null;
            $export_multiple_service = isset($this->export_available[$export_action_key]['multiple_service']) ? $this->export_available[$export_action_key]['multiple_service'] : null;
            if ($export_action != null && method_exists($this, $export_action)) {
                $return = $this->$export_action($export_pool_id);
                return $return;
            }
            else if ($export_forward != null) {
                $base_params = array('id_pool' => $export_pool_id);
                $params = array();
                $action = $export_forward;
                if(is_array($export_forward)){
                    $action = $export_forward['action'];
                    $params = isset($export_forward['params']) ? $export_forward['params'] : array();
                    
                    if($params !== null){
                        if(is_callable($params)){
                            $params = $params($request);
                        }
                    }
                }
                $params = array_merge($base_params,$params);
                $return = $this->forward($action, $params);
                return $return;
            }
            else if ($export_redirect != null) {
                $route = $export_redirect['route'];
                $slug = isset($export_redirect['slug']) ? $export_redirect['slug'] : array();
                if($export_param !== null){
                    $param = $export_param;
                    $slug = array_merge($slug,$param);
                }
                $slug = array_merge($slug, array('id_pool' => $export_pool_id, 'pool_export_id' => $pool_export->getId()));
                set_time_limit(0);
                
                $return = $this->redirectToRoute($route, $slug);
                return $return;
            }else{
                if($export_multiple_service!=null){
                    /*else if ($export_service != null) {
                        $export_long_task = isset($export_config['long_task']) ? $export_config['long_task'] : false;
                        if($export_long_task){
                            $return = $this->runLongTask($export_service,$request);
                            $data = json_decode($return->getContent(),true) != null ? json_decode($return->getContent(),true) : null;
                            $task_key = isset($data) && isset($data['task']) && isset($data['task']['taskKey']) ? $data['task']['taskKey'] : null ;
                            if(isset($task_key)){
                                $longTaskHeader = $em->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneLightByTaskKey($task_key);
                                if($longTaskHeader==null) {
                                    $em_bsltm = $this->getDataWellBsltmConnection('2017');
                                    $longTaskHeader = $em_bsltm->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneLightByTaskKey($task_key);
                                }
                                $pool_export->setlongTaskHeader($longTaskHeader);
                            }
                        }else{
                            $return = $this->runServices($export_service);
                        }
                    }*/
                    $this->runMultipleServices($export_multiple_service,$export_config,$request,$pool_export);
                    $em->flush();
                    $return = array('pool_export'=>$this->getUserExportLongTasks($pool_export));
                    return new JsonResponse($return);
                }else{
                    $return = $this->makeRunServices($export_config,$request);
                    $em->flush();
                    return new JsonResponse($return);
                }
            }
        }else if($is_secret_stat_ok===null){
            return new JsonResponse(array('error'=>$this->get('translator')->trans('infocentre.export_pool.error.pool_empty')));
        }else{
            return new JsonResponse(array('error'=>$this->get('translator')->trans('infocentre.export_pool.error.no_stat_secret')));
        }
    }

    public function getUserExportLongTasksAction(Request $request){
        /*$bsltm = $this->get('long_task_manager');
        $tasks = $bsltm->list(array(
          "ownerKey"=> $this->getUser()->getIdUtil(),
          "taskType"=> 0,
          "statusMask"=> 111
        ));*/
        $tasks = $this->getUserExportLongTasks();
        /*foreach ($tasks as $key => &$task) {
            $task->ficheView = $this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFiche', array('task' => $task));
            $task->pool_export = $poolExportRepo->findOneByTaskKey($task['taskKey']);
        }*/
        return $tasks;
    }

    public function getUserTasksAction(Request $request){
        $pool_export = $request->get('pool_export',null);
        ob_start();
        $tasks = $this->getUserExportLongTasks($pool_export);
        ob_get_clean();

        $response = new JsonResponse($tasks);
        $response->headers->set('Content-Type', 'text/json');
        $content = $response->getContent();

        return $response;
    }
   
    public function getUserExportLongTasks($pool_export=null){
        $em = $this->getEntityManager();
        $poolExportRepo = $em->getRepository('InfoCentreBundle:PoolExport');
        $poolExports = $poolExportRepo->getUserPoolExport($this->getUser(),$pool_export);
        $mapped_task_from_api = array();
        if($pool_export==null){
            /*  
            *    /!\-/!\-/!\-/!\-/!\-/!\-/!\-/!\-/!\
            *   
            *   IMPORTANT PERMET LE RAPATRIMENT DES DONNÉES DES LongTaskHeader DU DB_REPOSITORY SUR BS
            *
            *    /!\-/!\-/!\-/!\-/!\-/!\-/!\-/!\-/!\
            */
            $tasks_from_api = $this->forward('LongTaskManagerBundle:LongTaskManager:getUserTask')->getContent();
            $tasks_from_api = json_decode($tasks_from_api,true);
            foreach ($tasks_from_api as $key => $task_from_api) {
                $task_key = $task_from_api['taskKey'];
                $mapped_task_from_api[$task_key] = $task_from_api;   
            }
        }     
        $request = Request::createFromGlobals();
        foreach ($poolExports as $key => &$poolExport) {
            foreach ($poolExport->getLongTaskHeaders() as $key => &$task) {
                $task_key = $task->getTaskKey();
                if(empty($mapped_task_from_api)){
                    $run_data = json_decode($task->getRunData(),true);
                    $nm_annee = $run_data['refYear'];
                    $request->attributes->set('task_key',$task_key);
                    $request->attributes->set('nm_annee',$nm_annee);
                    /*  
                    *    /!\-/!\-/!\-/!\-/!\-/!\-/!\-/!\-/!\
                    *   
                    *   IMPORTANT PERMET LE RAPATRIMENT DES DONNÉES DES LongTaskHeader DU DB_REPOSITORY SUR BS
                    *
                    *    /!\-/!\-/!\-/!\-/!\-/!\-/!\-/!\-/!\
                    */
                    $task_from_api = json_decode($this->forward('LongTaskManagerBundle:LongTaskManager:getStatusTask',array('Request' => $request))->getContent(),true);
                    $task->fromApi = $task_from_api;
                }else{
                    if(isset($mapped_task_from_api[$task_key])){
                        $task->fromApi = $mapped_task_from_api[$task_key];
                    }
                }
                
            }
        }

        return $pool_export!=null && !empty($poolExports) ? $poolExports[0] : $poolExports;
    }
    public function runMultipleServices($multiple_config,$export_config,$request,&$pool_export){
        $groups_param = isset($multiple_config['groups']) ? $multiple_config['groups'] : null;
        if(is_callable($groups_param)){
            $groups = $groups_param($request);
        }
        $return = array();
        foreach ($groups as $group_key => $group) {
            $return[] = $this->makeRunServices($export_config,$request,$pool_export,$group,$group_key);
        }
        return $return;
    }
    public function runServices($data){
        $service_name = $data['name'];
        $service_method = $data['method'];
        $service_param = $data['param'];
        $extra_data = $data['extra'];
        $service = $this->get($service_name);
        $service_init_function = isset($data['service_init_function']) ? $data['service_init_function'] : null;
        if(is_callable($service_init_function)){
            $service = call_user_func($service_init_function,$service,$data);
        }
        return call_user_func_array(array($service,$service_method), $service_param);
    }
    public function runLongTask($export_service_config,$request,$group=null,$group_key=null){
        $params = isset($export_service_config['param']) ? $export_service_config['param'] : null;
        $extra = isset($export_service_config['extra']) ? $export_service_config['extra'] : null;
        $service_init_function = isset($export_service_config['service_init_function']) ? $export_service_config['service_init_function'] : null;
        if(is_callable($params)){
            $params = $params($request,$group,$group_key);
        }
        if(is_callable($extra)){
            $extra = $extra($request,$group,$group_key);
        }
        if($service_init_function==null || !is_callable($service_init_function)){
            $extra['group']=$group;
            $extra['group_key']=$group_key;
            $service_init_function = function($service_instance,$data){
                $extra = isset($data['extra']) ? $data['extra'] : null;
                $group = null;
                $group_key = null;
                $nm_annee = null;
                $bsltm_key = "db_repository";
                if($extra!=null){
                    $group = isset($extra['group']) ? $extra['group'] : $group;
                    $group_key = isset($extra['group_key']) ? $extra['group_key'] : $group_key;
                    $nm_annee = $group!=null ? $group_key : null;
                    $nm_annee = isset($extra['nm_annee']) ? $extra['nm_annee'] : $nm_annee;
                    $bsltm_key = isset($extra['bsltm_key']) ? $extra['bsltm_key'] : $bsltm_key;
                }
                if($bsltm_key!=null){
                    $bsltm_configs = $this->getFromConfigFile('data_weel_bsltm');
                    $bsltm_config = isset($bsltm_configs[$bsltm_key]) ? $bsltm_configs[$bsltm_key] : null;
                    if($bsltm_config==null && $nm_annee!=null){
                        $bsltm_config = isset($bsltm_configs[$nm_annee]) ? $bsltm_configs[$nm_annee] : null;
                        
                    }
                }
                if($bsltm_config!=null){
                    $em_annee = $nm_annee!=null ? $this->getDataWellConnection($nm_annee) : null;
                    $service_instance->hydrate($bsltm_config,null,$em_annee);
                }
                return $service_instance;
            };
        }
        $data = array(
            'name'=>'long_task_manager',
            'method'=>'run',
            'param'=>$params,
            'extra'=>$extra,
        );
        if(is_callable($service_init_function)) $data['service_init_function'] = $service_init_function;
        //if(is_array($extra) && isset($extra['nm_annee'])) $data['nm_annee'] = $extra['nm_annee'];
        $response = $this->runServices($data);
        $task_key = $response['taskKey'];
        $bsltm = $this->get('long_task_manager');
        $task = $bsltm->status(array(
            "taskKey"=>$task_key
        ));
        $task->setFicheView($this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFiche', array('task' => $task))->getContent());
        return new JsonResponse(array("task"=>$task,'runned'=>true));
    }
    public function makeRunServices($export_config,$request,&$pool_export,$group=null,$group_key=null){
        $em = $this->getEntityManager();
        $export_service = isset($export_config['service']) ? $export_config['service'] : null;
        $export_long_task = isset($export_config['long_task']) ? $export_config['long_task'] : false;
        if($export_long_task){
            $return = $this->runLongTask($export_service,$request,$group,$group_key);
            $data = json_decode($return->getContent(),true) != null ? json_decode($return->getContent(),true) : null;
            $task_key = isset($data) && isset($data['task']) && isset($data['task']['taskKey']) ? $data['task']['taskKey'] : null ;
            if(isset($task_key)){
                $longTaskHeader = $em->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneLightByTaskKey($task_key);
                if($longTaskHeader==null && $group_key!=null) {
                    $em_bsltm = $this->getDataWellBsltmConnection('repository');
                    $longTaskHeader = $em_bsltm->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneLightByTaskKey($task_key);
                }
                $pool_export->addLongTaskHeader($longTaskHeader);
            }
        }else{
            $return = $this->runServices($export_service);
        }
        return $return;
    }
    public function getExportAvailable(){
        if(empty($this->export_available)){
            if($this->getFromSession('export_available')!=null){
                $this->export_available = $this->getFromSession('export_available');
            }else{
                $this->initExportAvailable();
            }
        }
        return $this->export_available;
    }
    private function initExportAvailable() {
        $assert_manager = $this->getContainer()->get('assets.packages');
        $translator = $this->getContainer()->get('translator');

        /*
        *   Exemple de configuration d'un export
        *
            'listePool' => array(
                'name'   => $translator->trans('Liste des collectivités'),
                'label_logo' => array(
                    'src'=>$assert_manager->getUrl('/img/icone/BS_logo_HRG.jpg'),
                    'raw'=>'<i class="fa fa-file-text-o" aria-hidden="true"></i>',
                    'attr'=>array(
                        'alt'=>$translator->trans('logo liste échantillon')
                    )
                ),
                'action' => 'getListingPoolToTxt',
            ),
        */
        $export_available = array(
            'listePool' => array(
                'name'   => $translator->trans('infocentre.export_pool.export_liste.libelle'),
                'refs' => 1,
                'label_logo' => array(
                    'src'=>$assert_manager->getUrl('/img/icone/logo_export_liste_pool.png'),
                    'attr'=>array(
                        'alt'=>$translator->trans('infocentre.export_pool.export_liste.logo_alt')
                    )
                ),
                'action' => 'getListingPoolToTxt',
            ),
            'hrgExport' => array(
                'name'    => $translator->trans('infocentre.export_pool.export_hrg.libelle'),
                'refs' => 2,
                'label_logo' => array(
                    'src'=>$assert_manager->getUrl('/img/icone/BS_logo_HRG.png'),
                    'attr'=>array(
                        'alt'=>$translator->trans('logo Handitorial RASSTC GPEEC')
                    )
                ),
                //'forward' => 'AnalyseBundle:Default:callExportHRG',
                'redirect' => array(
                    'route' => 'call_script_export_hrg',
                ),
                'html_attr'=>array(
                    'title'=>$translator->trans('infocentre.export_pool.export_hrg.title')." <span class='export_logo_wrapper' ><img class='img-responsive' alt='".$translator->trans('infocentre.export_pool.export_hrg.logo_alt')."' src='".$assert_manager->getUrl('/img/icone/BS_logo_HRG.png')."'/></span>",
                    'data-toggle'=>"tooltip",
                    'data-html'=>"true",
                )
            ),
            'agentExport' => array(
                'name'     => $translator->trans('infocentre.export_pool.export_apa.libelle'),
                'refs' => 3,
                'label_logo' => array(
                    'src'=>$assert_manager->getUrl('/img/icone/logo_export_apa.png'),
                    'attr'=>array(
                        'alt'=>$translator->trans('logo export agent par agent')
                    )
                ),
                'long_task'  => true,
                //'forward' => 'AnalyseBundle:Default:callExportHRG',
                'service'    => array(
                    'long_task' => true,
                    'name'      => 'long_task_manager',
                    'param'     => function($request,$group,$group_key) {
                        $annee_to_process = $group_key;
                        $em_annee = $this->getDataWellConnection($annee_to_process);
                        $list_id_coll = array();
                        $id_util_cdg = null;
                        if (!$this->getUser()->hasRole('ROLE_INFOCENTRE')) {
                            $utilCdg = $this->getEntityManager()->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
                            $id_util_cdg = $utilCdg->getIdUtilisateurCdg();
                        }
                        $pool_id = $export_pool_id = $request->get('export_pool_id');
                        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
                        $current_pool = $pool_repo->getById($pool_id);
                        //$current_pool->initDependancy($em_annee);
                        $list_pool_item = array();
                        
                        foreach ($group as $key => $pool_item) {
                            $list_id_coll[] = $pool_item->getCollectivite()->getIdColl();
                        }
                        $param = array('agentParAgent');
                        $param[] = array(
                            "exportKey"  => $current_pool->getNom(),
                            "ownerEmail" => $this->getUser()->getEmail(),
                            "ownerKey"   => $this->getUser()->getIdUtil(),
                            "idCollList" => $list_id_coll,
                            "userCdg"    => $id_util_cdg,
                            "userId"     => $this->getUser()->getIdUtil(),
                            "refYear"    => $annee_to_process
                        );
                        return $param;
                    },
                    'extra'=> function($request){
                        return array('nm_annee'=>2017);
                    }
                ),
                'multiple_service' => array(
                    "groups" => function($request){
                        $list_pool_item = array();
                        $pool_id = $export_pool_id = $request->get('export_pool_id');
                        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
                        $current_pool = $pool_repo->getById($pool_id);
                        $groups_annee = $current_pool->getGroupsAnnee();
                        foreach ($groups_annee as $annee => &$item_list) {
                            $em_annee = $this->getDataWellConnection($annee);
                            foreach ($item_list as $item_key => &$item) {
                                $item->initDependancy($em_annee,$annee);
                            }
                        }
                        return $groups_annee;
                    }
                )
            ),
            /*'fullDGCL' => array(
                'name'     => 'Export multi DGCL',
                'long_task' => true,
                //'forward' => 'AnalyseBundle:Default:callExportHRG',
                'service' => array(
                    'long_task' => true,
                    'name' => 'long_task_manager',
                    'param'  => function($request){
                        $param = array('fullDGCL');
                        $param[] = array(
                            "ownerEmail"=> "string",
                            "ownerKey"=> $this->getUser()->getIdUtil(),
                            "rowsLimit"=> 3
                        );
                        return $param;
                    }
                        )
            ),*/
            'exportDGCLSimple' => array(
                'name' =>  $translator->trans('infocentre.export_pool.export_dgcl.libelle'),
                'refs' => 5,
                'forward'=> array(
                    "action"=>"ConsoBundle:BilanSocialConsolide:getImportTxtZippedFile",
                    "params"=> function($request){
                        $current_pool = $this->getCurrentPool();
                        $pool_items_groups = $current_pool->getGroupsAnnee();
                        $params = array();
                        $has_multiple_annee = count($pool_items_groups)>1;
                        if($has_multiple_annee) $params['multiple_annee'] = array(); 
                        foreach ($pool_items_groups as $annee_group => $group) {
                            $group_params = array();
                            $em_annee = $this->getDataWellConnection($annee_group);
                            if(!empty($group)){  
                                $first_item = $group[0];                         
                                $group_params['id_coll'] = $first_item->getIdCollectivite();
                                $group_params['id_enqu'] = $first_item->getIdEnquete();
                                $group_params['nm_annee'] = $first_item->getAnneeCampagne();
                                if($has_multiple_annee) $params['multiple_annee'][$annee_group] = $group_params; 
                                else $params = array_merge($params, $group_params);
                            }
                        }
                        $params['from_infocentre'] = true;
                        return $params;
                    }
                ),
                'condition'=>function($current_pool,$config_key,$config){
                    $pool_items_groups = $current_pool->getGroupsAnnee();
                    $is_ok = false;
                    if(!empty($pool_items_groups)){
                        foreach ($pool_items_groups as $group_key => $group) {
                            $bsc = null;
                            if(!empty($group) && count($group)==1){
                                $first_item = $group[0];
                                $id_coll = $first_item->getIdCollectivite();
                                $id_enqu = $first_item->getIdEnquete();
                                $anneeCampagne = $first_item->getAnneeCampagne();
                                $bsc = $this->getBilanSocialConsolide($id_coll,$id_enqu,$anneeCampagne);
                                if($bsc != null){
                                    $is_ok = true;
                                }else{
                                    $is_ok = false;
                                    break;
                                }
                            }else{
                                $is_ok =false;
                                break;
                            }
                        }                        
                    }
                    return $is_ok;
                }
            ),
            'consoDGCL' => array(
                'name'     => $translator->trans('infocentre.export_pool.export_aggr_dgcl.libelle'),
                'refs' => 4,
                'label_logo' => array(
                    'src'=>$assert_manager->getUrl('/img/icone/agregate_dgcl.png'),
                    'attr'=>array(
                        'alt'=>$translator->trans('infocentre.export_pool.export_aggr_dgcl.logo_alt')
                    )
                ),
                'long_task' => true,
                //'forward' => 'AnalyseBundle:Default:callExportHRG',
                'service' => array(
                    'long_task' => true,
                    'name' => 'long_task_manager',
                    'param'  => function($request,$group,$group_key){
                        $list_pool_item = array();
                        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
                        $pool_id = $request->get('export_pool_id');
                        $current_pool = $pool_repo->getById($pool_id);
                        $annee_to_process = $group_key;
                        foreach ($group as $key => $pool_item) {
                            if($key == 0){
                                $annee_to_process = $pool_item->getAnneeCampagne();
                            }
                            $temp_row = array(
                                "idEnqu"=> $pool_item->getEnquete()->getIdEnqu(),
                                "nmSiret"=> $pool_item->getCollectivite()->getNmSire()
                            );
                            $list_pool_item[]=$temp_row;
                        }
                        $param = array('aggregateDGCL');
                        $param[] = array(
                            "exportKey"=> $current_pool->getNom(),
                            "ownerEmail"=> $this->getUser()->getEmail(),
                            "ownerKey"=> $this->getUser()->getIdUtil(),
                            "refYear"=> $annee_to_process,
                            "toDoList"=>$list_pool_item,
                            "userId"=>  $this->getUser()->getIdUtil(),
                            "idPoolCollectivites" => $current_pool->getId()
                        );
                        return $param;
                    },
                    'extra'=> function($request){
                        return array();//array('nm_annee'=>2017);
                    }
                ),
                'multiple_service' => array(
                    "groups" => function($request){
                        $list_pool_item = array();
                        $pool_id = $export_pool_id = $request->get('export_pool_id');
                        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
                        $current_pool = $pool_repo->getById($pool_id);
                        $groups_annee = $current_pool->getGroupsAnnee();
                        foreach ($groups_annee as $annee => &$item_list) {
                            $em_annee = $this->getDataWellConnection($annee);
                            foreach ($item_list as $item_key => &$item) {
                                $item->initDependancy($em_annee,$annee);
                            }
                        }
                        return $groups_annee;
                    }
                ),
                'html_attr'=>array(
                    'title'=>$translator->trans('infocentre.export_pool.export_aggr_dgcl.title_1')."<span class='export_logo_wrapper' ><img class='img-responsive' alt='".$translator->trans('infocentre.export_pool.export_aggr_dgcl.logo_alt')."' src='".$assert_manager->getUrl('/img/icone/agregate_dgcl.png')."'/></span><br/>".$translator->trans('infocentre.export_pool.export_aggr_dgcl.title_2')
                    ,
                    'data-toggle'=>"tooltip",
                    'data-html'=>"true",
                ),
                'condition'=>function($current_pool,$config_key,$config){
                    $pool_items_groups = $current_pool->getGroupsAnnee();
                    $is_ok = false;
                    if(!empty($pool_items_groups)){
                        foreach ($pool_items_groups as $group_key => $group) {
                            if(!empty($group) && count($group)>1){
                                    $is_ok = true;
                            }else{
                                $is_ok =false;
                                break;
                            }
                        }                        
                    }
                    return $is_ok;
                }
            ),
        );
        //$this->setToSession('export_available',$export_available);
        $this->export_available = $export_available; 
    }
    public function getCurrentPool(){
        if(empty($this->current_pool)){
            $session = &$this->getSession();
            $id_pool_selected = $session->get('id_current_pool');
            $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
               
            $current_pool = $pool_repo->getById($id_pool_selected);
            $this->current_pool = $current_pool;
        }
        return $this->current_pool;
    }
    public function setCurrentPool($id_new_pool){
        $session = &$this->getSession();
        $session->set('id_current_pool',$id_new_pool);
        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
           
        $current_pool = $pool_repo->getById($id_new_pool);
        $this->current_pool = $current_pool;
        //$session->set('current_pool',$current_pool);
        return $this->current_pool;
    }
    public function emptyCurrentPool(){
        $session = &$this->getSession();
        $session->remove('id_current_pool');
        $session->remove('current_pool');
    }
    public function getCurrentFilters(){
        $session = &$this->getSession();
        return $session->get('current_filters');
    }
    public function setCurrentFilters($filters){
        $session = &$this->getSession();
        $session->set('current_filters',$filters);
    }
    public function emptyCurrentFilters(){
        $session = &$this->getSession();
        $session->remove('current_filters');
    }
    public function getIsNewlyCreatedPool(){
        $session = &$this->getSession();
        return $session->get('is_newly_created_pool');
    }
    public function setIsNewlyCreatedPool($is_newly_created_pool){
        $session = &$this->getSession();
        $session->set('is_newly_created_pool',$is_newly_created_pool);
    }
    public function emptyIsNewlyCreatedPool(){
        $session = &$this->getSession();
        $session->remove('is_newly_created_pool');
    }
    public function emptyCurrentParams($keep_pool=false){
        if(!$keep_pool) $this->emptyCurrentPool();
        $this->emptyCurrentFilters();
        $this->emptyIsNewlyCreatedPool();
    }

    public function getAutoCompleteAction(Request $request){
        $field_key = $request->get('field_to_autocomplete');
        $search_term = $request->get('search_term');
        $search_options = $request->get('search_options');
        $search_options = isset($search_options) ? $search_options : array();
        if(!isset($search_options['limit'])){
            $search_options['limit'] = 5;
        }
        $SqlFilterParser = $this->get('info_centre_sql_filter_parser');
        $data = $SqlFilterParser->getFieldListAsRef($field_key,$search_term,$search_options);
        return new JsonResponse($data);
    }
    public function checkPoolSecretStat($id_pool){
        $is_secret_stat_ok_response = $this->forward("InfoCentreBundle:InfoCentre:checkPoolSecretStat",['id_pool'=>$id_pool]);
        $is_secret_stat_ok_response = $is_secret_stat_ok_response->getContent();
        $is_secret_stat_ok_response = json_decode($is_secret_stat_ok_response, true);
        $is_secret_stat_ok = $is_secret_stat_ok_response['is_ok'];
        return $is_secret_stat_ok;
    } 
    public function checkPoolSecretStatAction(Request $request){
        $em = $this->getEntityManager();
        $current_user = $this->getUser();
        $pool_id = $request->get('id_pool');
        $this->setCurrentPool($pool_id);
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
        $id_util_cdg = "-1";
        if($utilCdg!=null){
           $id_util_cdg=$utilCdg->getIdUtilisateurCdg();
        }
        $pool = $em->getRepository('InfoCentreBundle:Pool')->getById($pool_id);
        $sorted_pool_item = array();
        foreach ($pool->getItems() as $key => $pool_item) {
            $nm_annee = $pool_item->getAnneeCampagne() ?? "2017";
            if(!isset($sorted_pool_item[$nm_annee])) $sorted_pool_item[$nm_annee] = array();
            array_push($sorted_pool_item[$nm_annee], $pool_item);
        }
        $is_secret_stat_ok = null;
        $current_annee_campagne = $this->getCurrentAnneeCampagne();
        foreach ($sorted_pool_item as $nm_annee => $pool_item_list){
            $base_key = $current_annee_campagne == $nm_annee ? 'bs' : $nm_annee;
            $em_annee = $this->getDataWellConnection($base_key);
            $pool_repo_annee = $em_annee->getRepository('InfoCentreBundle:Pool'); 
            if ($current_user->hasRole('ROLE_INFOCENTRE')) {
                $is_secret_stat_ok = $pool_repo_annee->isPoolOkForSecretStatistiqueInfoCentreAnnee($pool_item_list);
            } else {
                $is_secret_stat_ok = $pool_repo_annee->isPoolOkForSecretStatistiqueAnnee($pool_item_list,$id_util_cdg);
            }
            if($is_secret_stat_ok!=true) break;
        }
        $return_params = array('is_ok'=>$is_secret_stat_ok);
        if($is_secret_stat_ok===null){
            $return_params['error']=$this->get('translator')->trans('infocentre.export_pool.error.pool_empty');
        }else if(!$is_secret_stat_ok){
            $return_params['error']=$this->get('translator')->trans('infocentre.export_pool.error.no_stat_secret');
        }else{
            $return_params['export_buttons'] = $this->getExportButtons($request)->getContent();
        }
        return new JsonResponse($return_params);
    }
    /*public function checkPoolSecretStatVAction(Request $request){
        $em = $this->getEntityManager();
        $pool_id = $request->get('id_pool');
        $this->setCurrentPool($pool_id);
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
        $id_util_cdg = "-1";
        if($utilCdg!=null){
           $id_util_cdg=$utilCdg->getIdUtilisateurCdg();
        }
        $is_secret_stat_ok = $em->getRepository('InfoCentreBundle:Pool')->isPoolOkForSecretStatistique($pool_id,$id_util_cdg);
        $return_params = array('is_ok'=>$is_secret_stat_ok);
        if($is_secret_stat_ok===null){
            $return_params['error']=$this->get('translator')->trans('infocentre.export_pool.error.pool_empty');
        }else if(!$is_secret_stat_ok){
            $return_params['error']=$this->get('translator')->trans('infocentre.export_pool.error.no_stat_secret');
        }else{
            $return_params['export_buttons'] = $this->getExportButtonsTable($request)->getContent();
        }
        return new JsonResponse($return_params);
    }*/

    public function getFileFromBsfmAction(Request $request){
        $fileManager = $this->getBSFileManager();
        $file_key = $request->get('file_key');
        $fileInfo = $fileManager->getFileInfos($file_key);
    }
    public function getPoolExportFileAction(Request $request){
        $pool_export_id = $request->get('pool_export_id');
        if($pool_export_id!=null){
            $pool_export_repo = $this->getEntityManager()->getRepository(PoolExport::class);
            $pool_export = $pool_export_repo->findOneById($pool_export_id);
            if($pool_export!=null){
                $task_keys = array();
                foreach ($pool_export->getLongTaskHeaders() as $key => $lth) {
                    $task_keys[] = $lth->getTaskKey();
                }
                $file_response = $this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFile',array('task_keys'=>$task_keys));
                return $file_response;
            }else{
                return new Response("l'export demandé n'a pas été trouvé.", "404");
            }
        }else{
            return new Response("l'identifiant de l'export est obligatoire.", "400");
        }
    }
    public function getExportHRGFileAction(Request $request){
        $fileManager = $this->getBSFileManager();
        $header_export_hrg = $request->get('header_export_hrg');
        $header_export_hrg_repo = $this->getEntityManager()->getRepository(HeaderExportHRG::class);
        $header = $header_export_hrg_repo->findOneById($header_export_hrg);

        $zip = new ZipArchive();
        $zipName = 'export_handitorial_rassct_gpeec.zip';
        $res = $zip->open($zipName, ZipArchive::OVERWRITE|ZipArchive::CREATE);

        $fichier_repo = $this->getEntityManager()->getRepository(Fichier::class);
        if ($res === TRUE) {
            foreach ($header->getFileKeys() as $key => $eachFile) {
                $file = $fichier_repo->findOneByIdFichier($eachFile);
                $fileKey = $file->getFileKey();
                $fileInfo = $fileManager->getFileInfos($fileKey);
                $original_name = getFromOr(array('json_response','originalFileName'),$fileInfo);
                $original_name = !empty($original_name) ? $original_name : 'export_'.$key.'.xls';
                $publicFileUrl = $fileManager->getPublicFileUrl($fileKey);
                $fileUrlContent = file_get_contents($publicFileUrl);
                
                $zip->addFromString($original_name, $fileUrlContent);
            }

            $zip->close();        
            
            $response = new Response(file_get_contents($zipName), 200, 
                array(
                    'Content-Type'        => 'application/zip;charset=UTF-8',
                    'Content-Disposition' => 'attachment; filename="' . $zipName . '"',
                    'Content-Length: ' . filesize($zipName)
                )
            );

            unlink($zipName);

            return $response;
        } else {
            return new Response('Erreur lors du téléchargement', 400);
        }

        // $file_response = $this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFile',array('task_keys'=>$task_keys));
        // return $file_response;
    }
    public function getExportButtons(Request $request){
        $user = $this->getUser();
        $config_availables = array();
        $current_pool = $this->getCurrentPool();
        $export_available = $this->getExportAvailable();
        foreach ($this->export_available as $config_key => $config) {
            if(isset($config['condition'])){
                $temp_condition = $config['condition'];
                $is_valid = false;
                if(is_callable($temp_condition)){
                    $is_valid = $temp_condition($current_pool,$config_key,$config);
                }else{
                    $is_valid = $temp_condition;
                }
                if($is_valid){
                   $config_availables[$config_key]=$config; 
                }
            }else{
                $config_availables[$config_key]=$config;
            }
        }
        $view_params['export_available'] = $config_availables;

        if ($user->hasRole('ROLE_INFOCENTRE')) {
            $profil = $user->getProfils();
            $exports_available = $profil->getExportsAdmin();
            $view_params['export_echantillon'] = $export_echantillon = $exports_available;
        } else {
            $view_params['export_echantillon'] = $export_echantillon = $this->getEntityManager()->getRepository('CoreBundle:exportAdmin')->findExportByType(11);
        }

        return $this->render('@InfoCentre/pool_export_bay_buttons.html.twig', $view_params);
    }
    public function getExportButtonsTable(Request $request){
        $config_availables = array();
        $current_pool = $this->getCurrentPool();
        $export_available = $this->getExportAvailable();
        foreach ($this->export_available as $config_key => $config) {
            if(isset($config['condition'])){
                $temp_condition = $config['condition'];
                $is_valid = false;
                if(is_callable($temp_condition)){
                    $is_valid = $temp_condition($current_pool,$config_key,$config);
                }else{
                    $is_valid = $temp_condition;
                }
                if($is_valid){
                   $config_availables[$config_key]=$config;
                }
            }else{
                $config_availables[$config_key]=$config;
            }
        }
        $view_params['export_available'] = $config_availables;
        return $this->render('@InfoCentre/pool_export_bay_table.html.twig', $view_params);
    }

    public function getCollectiviteDataToExportAction(Request $request){
        $em = $this->getEntityManager();
        $pool_id = $request->request->get('pool');
        $pool_repo = $this->getEntityManager()->getRepository("InfoCentreBundle:Pool");
        $pool = $pool_repo->findOneById($pool_id);
        $job = $request->request->get('job');
        $return = null;

        switch ($job) {
            case 'job1':
                $fields = 'c.lbColl, c.lbVill';
                $collectivite = $em->getRepository('InfoCentreBundle:PoolItem')->getCollectiviteByIdPool($pool_id, $fields);
                $array_column_name = array('Nom collectivités', 'Nom ville');

                break;
            case 'job2':
                $fields = 'c.lbColl, c.lbVill';
                $collectivite = $em->getRepository('InfoCentreBundle:PoolItem')->getCollectiviteByIdPool($pool_id, $fields);
                $array_column_name = array('Numéro de départements','Nom du département');
                break;
            case (LongTaskManager::BSLTM_COLL_DEPA_TALENT_JOB):
                $pool = $em->getRepository('InfoCentreBundle:Pool')->findOneById($pool_id);
                $pool_export = new PoolExport();
                $pool_export->setExportType($job);
                $pool_export->setPool($pool);
                $em->persist($pool_export);
                $em->flush();
                $bsltm_configs = $this->getFromConfigFile('data_weel_bsltm');
                $annee_grouped_pool_item = $pool->getGroupsAnnee();
                foreach ($annee_grouped_pool_item as $annee => $pool_item_group) {
                    $bsltm_config = $bsltm_configs['db_repository'];
                    $em_annee = $annee!=null ? $this->getDataWellConnection($annee) : null;
                    $bsltm = $this->get('long_task_manager');
                    $bsltm->hydrate($bsltm_config,null,$em_annee);
                    $params = array(
                        "ownerEmail" => $this->getUser()->getEmail(),
                        "ownerKey"   => $this->getUser()->getIdUtil(),
                        "idDepartementList" => array(),
                        "idPoolCollectivites" => $pool_id,
                        "refYear" => $annee,
                        "talendJobId" => LongTaskManager::BSLTM_COLL_DEPA_TALENT_JOB
                    );
                    $response = $bsltm->run(LongTaskManager::BSLTM_TALENT_JOB,$params);
                    $task_key = $response['taskKey'];
                    
                    if(isset($task_key)){
                        $longTaskHeader = $em->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneLightByTaskKey($task_key);
                        if($longTaskHeader==null && $annee!=null) {
                            $em_bsltm = $this->getDataWellBsltmConnection('repository');
                            $longTaskHeader = $em_bsltm->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneLightByTaskKey($task_key);
                        }
                        $pool_export->addLongTaskHeader($longTaskHeader);
                    }
                    $em->flush();
                }
                $return = new JsonResponse($this->getUserExportLongTasks($pool_export->getId()));
                break;
            case 'job4':
                break;
            default:
                echo "aucun job ne correspond à la demande";
        }

        if(isset($array_column_name)){
            $response = new Response();
            $handle = fopen('php://output', 'w+');
            ob_start();
            fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($handle, $array_column_name, ';');

            foreach ($collectivite as $key => $value) {

                fputcsv($handle, $value, ';');
            }

            fclose($handle);
            $content = ob_get_clean();
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="'.$job.'.csv"');
            $response->setContent($content);

            return $response;
        }else{
            return $return;
        }
    }
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
function in_array_nested($needle, $haystack, $strict=false, $keys=array(), $depth=0){
    $key = array_search($depth,$keys);
    $temp_haystack = $haystack;
    if($key!==false){
        if(isset($haystack[$key])){
            $item = $haystack[$key];
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_nested($needle, $item, $strict, $keys, $depth+1)))
            {
                return true;
            }
        }
        return false;
    }else{
        foreach ($haystack as $key => $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_nested($needle, $item, $strict, $keys, $depth+1))) {
                return true;
            }
        }
        return false;
    }   
}
function array_search_nested($needle, $haystack, $strict=false, $keys=array(), $depth=0){
    $key = array_search($depth,$keys);
    $temp_haystack = $haystack;
    if($key!==false){
        if(isset($haystack[$key])){
            $item = $haystack[$key];
            if (($strict ? $item === $needle : $item == $needle)){
                return array($key);
            }else if(is_array($item)){
                $nested_key = array_search_nested($needle, $item, $strict, $keys, $depth+1);
                if($nested_key!==false){
                    return array_merge(array($key),$nested_key); 
                }
                
            }
        }
        return false;
    }else{
        foreach ($haystack as $key => $item) {
            if (($strict ? $item === $needle : $item == $needle)){
                return array($key);
            }else if(is_array($item)){
                $nested_key = array_search_nested($needle, $item, $strict, $keys, $depth+1);
                if($nested_key!==false){
                    return array_merge(array($key),$nested_key); 
                }
                
            }
        }
        return false;
    }
}