<?php

namespace Bilan_Social\Bundle\InfoCentreBundle\Controller;

use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Bilan_Social\Bundle\CoreBundle\Model\ConfigDynamicClass;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\InfoCentreBundle\Form\FilterType;
use Bilan_Social\Bundle\LongTaskManagerBundle\Services\LongTaskManager;
use Bilan_Social\Bundle\LongTaskManagerBundle\Entity\LongTaskHeader;

class InfoCentreDepartementsController extends AbstractBSController
{
    protected $session;
    protected $container;
    private $export_available = array();
    private $current_pool = null;

    public function __construct($container){
        $this->container = $container;
        //$this->export_available = $this->getExportAvailable();
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
            $user = $this->getUser();
            $filters = $this->getFiltersObject();
            $form = $this->createForm(FilterType::class, $filters);
            $form->handleRequest($request);

            $export_admin = $this->getEntityManager()->getRepository('CoreBundle:exportAdmin')->findExportByType(20, $user);


            return $this->render('@InfoCentre/departement/index_departements.html.twig',
                array(
                    'form' =>  $form->createView(),
                    'tasks' => $this->getUserExportLongTasks(),
                    'export_admin' => $export_admin
                )
            );
        }catch(Exception $e){
            /*dump($e->getMessage());
            exit();*/
        }
    }

    function add_quotes($str) {
        return sprintf("'%s'", $str);
    }

    public function getDepartementDataToExportAction(Request $request){
        $em = $this->getEntityManager();
        $departements_array = $request->request->get('departements');
        $job = $request->request->get('job');

        switch ($job) {
            case 'job1':
                $fields = 'd.cdDepa, d.lbDepa, d.nbSIASP';
                $departements = $em->getRepository('CollectiviteBundle:Departement')->getDepartementById($departements_array,$fields);
                $array_column_name = array('Numéro de départements', 'Nom du département','SIASP');

                break;
            case 'job2':
                $fields = "d.cdDepa, d.lbDepa";
                $departements = $em->getRepository('CollectiviteBundle:Departement')->getDepartementById($departements_array, $fields);
                $array_column_name = array('Numéro de départements','Nom du département');
                break;
            case (LongTaskManager::BSLTM_APA_DEPA_TALENT_JOB):
            case (LongTaskManager::BSLTM_JOB3_DEPA_TALENT_JOB):
            case (LongTaskManager::BSLTM_JOB4_DEPA_TALENT_JOB):
            case (LongTaskManager::BSLTM_JOB5_DEPA_TALENT_JOB):
                $current_campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
                $current_annee = $current_campagne!==null ? $current_campagne->getNmAnne() : null;
                $bsltm_configs = $this->getFromConfigFile('data_weel_bsltm');
                $bsltm_config = $bsltm_configs['db_repository'];
                $em_annee = $current_annee!=null ? $this->getDataWellConnection($current_annee) : null;
                $bsltm = $this->get('long_task_manager');
                $bsltm->hydrate($bsltm_config,null,$em_annee);
                $fields = "d.idDepa";
                $departements = $em->getRepository('CollectiviteBundle:Departement')->getDepartementById($departements_array, $fields);
                $list_id_depa = array();
                foreach ($departements as $key => $depa) {
                    $list_id_depa[] = $depa['idDepa'];
                }
                 $params = array(
                    "ownerEmail" => $this->getUser()->getEmail(),
                    "ownerKey"   => $this->getUser()->getIdUtil(),
                    "idDepartementList" => $list_id_depa,
                    "idPoolCollectivites" => null,
                    //"refYear" => $current_annee,
                    "talendJobId" => $job//LongTaskManager::BSLTM_APA_DEPA_TALENT_JOB
                 );
                $response = $bsltm->run(LongTaskManager::BSLTM_TALENT_JOB,$params);
                $task_key = $response['taskKey'];
                
                $em_bsltm_repository = $this->getDataWellBsltmConnection("repository");
                $repo = $em_bsltm_repository->getRepository(LongTaskHeader::class);
                $lth = $repo->findOneLightByTaskKey($task_key);
                //$lth->hydrate($export);
                $lth->getStatusCode();
                $lth->getTaskTypeLibelle();
                /*$task = $bsltm->status(array(
                    "taskKey"=>$task_key
                ));
                $task->ficheView = $this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFiche', array('task' => $task))->getContent();*/
                //return new JsonResponse(array("task"=>$task,'runned'=>true));
                return new JsonResponse($lth);
                break;
            case 'job4':
                $array_column_name = array('vide');
                break;
            default:
                echo "aucun job ne correspond à la demande";
        }




        $response = new Response();
        $handle = fopen('php://output', 'w+');
        ob_start();
        fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
        fputcsv($handle, $array_column_name, ';');

        foreach ($departements as $key => $value) {

            fputcsv($handle, $value, ';');
        }

        fclose($handle);
        $content = ob_get_clean();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$job.'.csv"');
        $response->setContent($content);

        return $response;
    }

    public function getListTasksExportDepaAction(Request $request){
        $em_bsltm_repository = $this->getDataWellBsltmConnection("repository");
        $repo = $em_bsltm_repository->getRepository(LongTaskHeader::class);
        $list_export = $repo->findByOwnerAndType($this->getUser()->getIdUtil(),array(
            LongTaskHeader::TYPE_TASK_APA_DEPA_TALENT_JOB,
            LongTaskHeader::TYPE_TASK_JOB3_DEPA_TALENT_JOB
        ));
        $lth_list = array();
        foreach ($list_export as $key => $export) {
            $lth = new LongTaskHeader();
            $lth->hydrate($export);
            $lth->getStatusCode();
            $lth->getTaskTypeLibelle();
            $lth_list[] = $lth;
        }
        return new JsonResponse($lth_list);
    }
    public function getTaskExportDepaAction(Request $request){
        $task_key = $request->get('task_key');
        $em_bsltm_repository = $this->getDataWellBsltmConnection("repository");
        $repo = $em_bsltm_repository->getRepository(LongTaskHeader::class);
        $export = $repo->findByTaskKey($task_key);
        if(!empty($export)){
            $lth = new LongTaskHeader();
            $lth->hydrate($export[0]);
            $lth->getStatusCode();
            $lth->getTaskTypeLibelle();
            return new JsonResponse($lth);
        }else{
            return new JsonResponse(false);
        }
    }
    
    public function getFiltersObject(){
        $filters_obj_config = $this->get('info_centre_config_finder')->getConfig('filter_departement');
        $filters_obj = new ConfigDynamicClass(array($filters_obj_config));
        return $filters_obj;
    }

    public function getUserExportLongTasksAction(Request $request){
        $bsltm = $this->get('long_task_manager');
        $tasks = $bsltm->list(array(
          "ownerKey"=> $this->getUser()->getIdUtil(),
          "taskType"=> 0,
          "statusMask"=> 111
        ));
        return $tasks;
    }

    public function getUserTasksAction(Request $request){
        $tasks = $this->getUserExportLongTasks();
        //$tasks['task'] = $this->getUserExportLongTasks();
        $response = new JsonResponse($tasks);
        return $response;
    }
    public function getUserExportLongTasks(){
        $bsltm = $this->get('long_task_manager');
        $tasks = $bsltm->list(array(
          "ownerKey"=> $this->getUser()->getIdUtil(),
          "taskType"=> 0,
          "statusMask"=> 111
        ));
        return $tasks;
    }

    /*public function getListUserPools(Request $request){
        $utilisateur = $this->getUser();
        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
        $user_pools = $pool_repo->getByUser($utilisateur);
        $response = new JsonResponse();
        $response->setData(array('data'=>$user_pools));
        return $response;
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
        $current_filters = $this->getCurrentFilters();
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

            $filter_results = $SqlFilterParser->getFilterResult();
            $current_pool = $this->getCurrentPool();
            if(isset($current_pool) && $current_pool!=null){
                if(count($filter_results)>0){
                    foreach ($current_pool->getItems() as $key => $item) {
                        $key_in_result = array_search_nested($item->getCollectivite()->getIdColl(),$filter_results,false,array('idColl'=>1));
                        if($key_in_result!==false){
                            array_splice($filter_results,$key_in_result[0],1);
                        }
                    }
                }
            }
            $id_coll_list = array();
            $array_not_allow_coll = $em->getRepository('InfoCentreBundle:PoolItem')->getNonDroitsSurCollectiviteByCdg($id_util_cdg, $id_coll_list);
            foreach ($filter_results as $index => $a_result) {
                $anonyme =  $a_result['anonyme'];
                if($anonyme){
                    $filter_results[$index]['nomColl'] = "********";
                    $filter_results[$index]['siretColl'] = "********";
                    $filter_results[$index]['lbDepa'] = "Autre";
                    unset($filter_results[$index]['cdDepa']);
                }
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
        $response = new JsonResponse();
        $data_table = array();
        $id_coll_list = $current_pool->getItemsIdColl();
        $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
        $id_util_cdg = "-1";
        if($utilCdg!=null){
           $id_util_cdg=$utilCdg->getIdUtilisateurCdg();
        }
        $array_not_allow_coll = $em->getRepository('InfoCentreBundle:PoolItem')->getNonDroitsSurCollectiviteByCdg( $id_util_cdg, $id_coll_list);
        $return_params = array();
        if(isset($current_pool) && $current_pool!=null){
            if(count($current_pool->getItems())>0){
                foreach ($current_pool->getItems() as $key => $item) {
                    $anonyme =  $this->in_array_r($item->getCollectivite()->getIdColl(), $array_not_allow_coll) ? false : true;
                    if($anonyme){
                        $data_table[$key] = array(
                            'id_pool_item'=>$item->getId(),
                            'siret'=>"********",
                            'nom'=>"********",
                            'annee'=>$item->getEnquete()->getNmAnne(),
                            'departement'=>"Autre"
                        );
                    }else{
                        $data_table[$key] = array(
                            'id_pool_item'=>$item->getId(),
                            'siret'=>$item->getCollectivite()->getNmSire(),
                            'nom'=>$item->getCollectivite()->getLbColl(),
                            'annee'=>$item->getEnquete()->getNmAnne(),
                            'departement'=>$item->getCollectivite()->getDepartement()->getCdDepa().' - '.$item->getCollectivite()->getDepartement()->getLbDepa()
                        );
                    }
                }
                $is_secret_stat_ok = $em->getRepository('InfoCentreBundle:Pool')->isPoolOkForSecretStatistique($current_pool->getId(),$id_util_cdg);
                if($is_secret_stat_ok===false){
                    $return_params['error'] = $this->get('translator')->trans('infocentre.filter_results.include_to_pool.error.no_stat_secret');
                }
            }
        }
        $return_params['data']=$data_table;
        $response->setData($return_params);
        return $response;
    }

    public function runServices($data){
        $service_name = $data['name'];
        $service_method = $data['method'];
        $service_param = $data['param'];
        $service = $this->get($service_name);
        return call_user_func_array(array($service,$service_method), $service_param);
    }
    public function runLongTask($export_service_config,$request){
        $params = isset($export_service_config['param']) ? $export_service_config['param'] : null;
        if(is_callable($params)){
            $params = $params($request);
        }
        $data = array(
            'name'=>'long_task_manager',
            'method'=>'run',
            'param'=>$params
        );
        $response = $this->runServices($data);
        $task_key = $response['taskKey'];
        $bsltm = $this->get('long_task_manager');
        $task = $bsltm->status(array(
            "taskKey"=>$task_key
        ));
        $task->ficheView = $this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFiche', array('task' => $task))->getContent();
        return new JsonResponse(array("task"=>$task,'runned'=>true));
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
        /*$export_available = array(
            'listePool' => array(
                'name'   => $translator->trans('infocentre.export_pool.export_liste.libelle'),
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
                'label_logo' => array(
                    'src'=>$assert_manager->getUrl('/img/icone/BS_logo_HRG.png'),
                    'attr'=>array(
                        'alt'=>$translator->trans('logo Handitorial RASSTC GPEEC')
                    )
                ),
                //'forward' => 'AnalyseBundle:Default:callExportHRG',
                'redirect' => array(
                    'route' => 'call_export_hrg',
                    'slug'  => array('_format' => 'xls')
                ),
                'html_attr'=>array(
                    'title'=>$translator->trans('infocentre.export_pool.export_hrg.title')." <span class='export_logo_wrapper' ><img class='img-responsive' alt='".$translator->trans('infocentre.export_pool.export_hrg.logo_alt')."' src='".$assert_manager->getUrl('/img/icone/BS_logo_HRG.png')."'/></span>",
                    'data-toggle'=>"tooltip",
                    'data-html'=>"true",
                )
            ),
            'agentExport' => array(
                'name'     => $translator->trans('infocentre.export_pool.export_apa.libelle'),
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
                    'param'     => function($request) {
                        $list_id_coll = array();
                        $utilCdg = $this->getEntityManager()->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($this->getUser());
                        $id_util_cdg = $utilCdg->getIdUtilisateurCdg();
                        $pool_id = $export_pool_id = $request->get('export_pool_id');
                        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
                        $current_pool = $pool_repo->getById($pool_id);
                        foreach ($current_pool->getItems() as $key => $pool_item) {
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
                        );
                        return $param;
                    }
                ),
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
            /*'exportDGCLSimple' => array(
                'name' =>  $translator->trans('infocentre.export_pool.export_dgcl.libelle'),
                'forward'=> array(
                    "action"=>"ConsoBundle:BilanSocialConsolide:getImportTxtZippedFile",
                    "params"=> function($request){
                        $current_pool = $this->getCurrentPool();
                        $pool_items = $current_pool->getItems();
                        $params = array();
                        if(!empty($pool_items)){
                            $first_item = $pool_items->current();
                            $params['from_infocentre'] = true;
                            $params['id_coll'] = $first_item->getCollectivite()->getIdColl();
                            $params['id_enqu'] = $first_item->getEnquete()->getIdEnqu();
                        }
                        return $params;
                    }
                ),
                'condition'=>function($current_pool,$config_key,$config){
                    $nb_in_pool = count($current_pool->getItems());
                    $pool_items = $current_pool->getItems();
                    $bsc = null;
                    if(!empty($pool_items)){
                        $first_item = $pool_items->current();
                        $id_coll = $first_item->getCollectivite()->getIdColl();
                        $id_enqu = $first_item->getEnquete()->getIdEnqu();
                        $bsc = $this->getBilanSocialConsolide($id_coll,$id_enqu);
                    }
                    return $nb_in_pool==1 && $bsc != null; 
                }
            ),
            'consoDGCL' => array(
                'name'     => $translator->trans('infocentre.export_pool.export_aggr_dgcl.libelle'),
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
                    'param'  => function($request){
                        $list_pool_item = array();
                        $pool_id = $export_pool_id = $request->get('export_pool_id');
                        $pool_repo = $this->getEntityManager()->getRepository('InfoCentreBundle:Pool');
                        $current_pool = $pool_repo->getById($pool_id);
                        $annee_to_process = date('Y');
                        foreach ($current_pool->getItems() as $key => $pool_item) {
                            if($key == 0){
                                $annee_to_process = $pool_item->getEnquete()->getCampagne()->getNmAnne();
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
                        );
                        return $param;
                    }
                ),
                'html_attr'=>array(
                    'title'=>$translator->trans('infocentre.export_pool.export_aggr_dgcl.title_1')."<span class='export_logo_wrapper' ><img class='img-responsive' alt='".$translator->trans('infocentre.export_pool.export_aggr_dgcl.logo_alt')."' src='".$assert_manager->getUrl('/img/icone/agregate_dgcl.png')."'/></span><br/>".$translator->trans('infocentre.export_pool.export_aggr_dgcl.title_2')
                    ,
                    'data-toggle'=>"tooltip",
                    'data-html'=>"true",
                ),
                'condition'=>function($current_pool,$config_key,$config){
                    $nb_in_pool = count($current_pool->getItems());
                    return $nb_in_pool>1; 
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
    public function emptyCurrentParams($keep_pool=false){
        $this->emptyCurrentFilters();
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

    public function getFileFromBsfmAction(Request $request){
        $fileManager = $this->getBSFileManager();
        $file_key = $request->get('file_key');
        $fileInfo = $fileManager->getFileInfos($file_key);
    }

    public function getExportButtons(Request $request){
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
    }*/
}