<?php
/*
*	Service permettant d'interagir avec le bsltm (Bilan Social Long Task Manager) de Fred
*/
namespace Bilan_Social\Bundle\LongTaskManagerBundle\Services;
use Bilan_Social\Bundle\LongTaskManagerBundle\Entity\LongTask;
use Exception;

class LongTaskManager{

    const BSLTM_TALENT_JOB = "talendJob";
    const BSLTM_COLL_DEPA_TALENT_JOB = 1;
    const BSLTM_APA_DEPA_TALENT_JOB = 2;
    const BSLTM_JOB3_DEPA_TALENT_JOB = 3;
    const BSLTM_JOB4_DEPA_TALENT_JOB = 4;
    const BSLTM_JOB5_DEPA_TALENT_JOB = 5;
    
	private $taskPile = array();

	public function getTaskPile(){
		return $this->$taskPile;
	}
	public function addToTaskPile($to_add){
		if(is_json($to_add)){
			$data_to_add = json_decode($to_add);
			$to_add = new LongTask($data_to_add,$this->bsfm_host, $this->bsfm);
		}else if(is_array($to_add)){
			$to_add = new LongTask($to_add,$this->bsfm_host, $this->bsfm);
		}
		if($to_add instanceof LongTask){
			$taskPile[] = $to_add;
		}
	}
	private $bsltm_config;
	private $bsltm_host;
	private $bsltm_base_url;
	private $bsfm_config;
	private $bsfm_host;
	private $bsfm;
    private $em;
    private $em_current;
    
    public function __construct($bsltm_config,$bsfm_config,$bsfm,$em){
        $this->bsltm_config = $bsltm_config;
        $this->bsltm_host = $bsltm_config['host'];
        $this->bsltm_base_url = $bsltm_config['base_url'];
        $this->bsfm_config = $bsfm_config;
        $this->bsfm_host = $bsfm_config['service_little_url'];
        $this->bsfm = $bsfm;
        $this->em = $em;
        $this->em_current = $em;
    }
    public function hydrate($bsltm_config,$bsfm_config,$em){
        $this->bsltm_config = $bsltm_config;
        if(isset($bsltm_config['host'])) $this->bsltm_host = $bsltm_config['host'];
        if(isset($bsltm_config['base_url'])) $this->bsltm_base_url = $bsltm_config['base_url'];
        /*$this->bsfm_config = $bsfm_config;
        $this->bsfm_host = $bsfm_config['service_little_url']);
        $this->bsfm = $bsfm;*/
        $this->em = $em;
    }

    public function makeRequest($url,$data="",$options=array()){
    	$response = array(
            'isOk' => false,
            'errCause' => null,
            'errMsg' => null,
            'fichier' => null,
        );
		$jsonResponse = array();
        $httpStatus = null;
        try {
            // On utilise curl pour réaliser les appels aux Webservices.
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            if(isset($options['post']) && $options['post']==true){
            	curl_setopt($curl, CURLOPT_POST, true);
            	/*if(!is_json($data))*/ $data = json_encode($data);
            	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            if (isset($options['delete']) && $options['delete'] == true) {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            $httpResponse = curl_exec($curl);
            
            $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpStatus === 0) {
                throw new Exception("Impossible de se connecter au serveur"); 
            }
            if ($httpStatus === 404) {
                throw new Exception("Impossible de recuperer la ressource demandée"); 
            }
            if ($httpStatus === 500) {
                throw new Exception("Une erreur est survenue. veuillez contacter votre administrateur"); 
            }
            curl_close($curl);
          
            $jsonResponse = json_decode($httpResponse, true);
        } catch (Exception $ex) {
            return  $jsonResponse['errMsg'] = $ex->getMessage();
        }
        return $jsonResponse;
    }
    public function run($task_name, $data=array()){

    	$url = $this->constructUrlRequest('run',array_merge($data,array('task_name'=>$task_name)));
    	$json_data = is_json($data) ? $data : json_encode($data);
    	$response =  $this->makeRequest($url,$json_data,array('post'=>true));
    	return $response;
    }
    public function list($data,$options=array()){
    	extract($options);
    	$url = $this->constructUrlRequest('list',$data);
    	$response =  $this->makeRequest($url);
    	$tasks = array();
    	if(is_array($response)){
	    	if(!isset($raw) || $raw==false){
				foreach ($response as $key => $task_data) {
					$temp_task = $this->createLongTask($task_data);
					$tasks[] = $temp_task;
				}
	    	}else{
		    	$tasks = $response;	
			}
		}
    	return $tasks;
    }
    public function status($data,$options=array()){
    	extract($options);
    	$url = $this->constructUrlRequest('status',$data);
    	$response =  $this->makeRequest($url);
    	
    	$task=null;
        if($response!="Impossible de recuperer la ressource demandée"){
        	if(!isset($raw) || $raw==false){
    			$task = $this->createLongTask($response);
        	}else{
    	    	$task = $response;	
    		}
        }
    	return $task;
    }
    public function cancel($data, $options = array()) {
        $url = $this->constructUrlRequest('cancel', $data);
        $response =  $this->makeRequest($url);
    	return $response;
    }
    public function delete($data,$options=array()){
    	$url = $this->constructUrlRequest('delete',$data);
    	$response =  $this->makeRequest($url,"",array('delete'=>true));
    	return $response;
    }
    public function getBaseUrl(){
    	return $this->bsltm_host.''.$this->bsltm_base_url;//"http://192.168.2.25:8090/bsltm/api/v1/";
    }
    public function constructUrlRequest($action, $params){
    	$url = $this->getBaseUrl();
    	switch ($action) {
            case 'run':
                $task_name = $params['task_name'];
                $url .= 'run/' . $task_name;
                break;
            case 'list':
                $user_id = $params['ownerKey'];
                $task_type = $params['taskType'];
                $status_mask = $params['statusMask'];
                $url .= 'list/' . $user_id . '/' . $task_type . '/' . $status_mask;
                break;
            case 'status':
            case 'cancel':
                $taskKey = $params['taskKey'];
                $url .= $action . '/' . $taskKey;
                break;
            case 'delete':
                $taskKey = $params['taskKey'];
                $url .= $action . '/' . $taskKey;
                break;
        }
        
        return $url;
    }
    public function createLongTask($raw_data){
    	$task = new LongTask($raw_data,$this->bsfm_host, $this->bsfm);
        $task_key = $task->getTaskKey();
        $bsltm_lth_repo = $this->em->getRepository('LongTaskManagerBundle:LongTaskHeader');
        $lth_away = $bsltm_lth_repo->findOneLightByTaskKey($task_key);
        $task->lth_away = $lth_away;
		if($task->getFileKey()!=null){
			$task->setFileInfos($this->bsfm->getFileInfos($task->getFileKey())['json_response']);
		}
        $poolExportRepo = $this->em_current->getRepository('InfoCentreBundle:PoolExport');
        $task->pool_export = $poolExportRepo->findOneByTaskKey($task->getTaskKey());
        //$task->ficheView = $this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFiche', array('task' => $task));
        
		return $task;
    }
}
function is_json($string,$return_data = false) {
    $data = @json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
}