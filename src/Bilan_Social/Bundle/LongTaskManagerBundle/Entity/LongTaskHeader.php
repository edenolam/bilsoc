<?php
namespace Bilan_Social\Bundle\LongTaskManagerBundle\Entity;

use Bilan_Social\Bundle\CoreBundle\Entity\AbstractEntity;

Class LongTaskHeader extends AbstractEntity{

	const CODE_FOR_STATUS = array(
		"5"=>"READY_TO_RUN",
    	"10"=>"RUNNING",
    	"20"=>"FINISHING",
    	"30"=>"FINISHED",
    	"90"=>"INIT_FAILED",
    	"95"=>"RUN_FAILED",
    	"99"=>"ABORTED"
	);

	const LIBELLE_FOR_TYPE = array(
		"1"=>"longtask.export.FULL_DGCL",
		"2"=>"longtask.export.AGGREGATE_DGCL",
		"3"=>"longtask.export.AGENT_PAR_AGENT",
		"4"=>"longtask.export.TALEND_JOB_AGENT_PAR_AGENT",
		"5"=>"longtask.export.TALEND_JOB_3",
	);

	const TYPE_TASK_APA_DEPA_TALENT_JOB = 4;
	const TYPE_TASK_JOB3_DEPA_TALENT_JOB = 5;

	protected $id;
	protected $poolExport;
	protected $owner_key;
	protected $task_type;
	protected $task_key;
	protected $start_date;
	protected $run_data;
	protected $external_ref_id;
	protected $details_count;
	protected $details_done_count;
	protected $details_error_count;
	protected $end_date;
	protected $status;
	protected $status_linked_data;
	protected $owner_email;

	protected $statusCode;
	protected $taskTypeLibelle;
	protected $refYear;

	public function __construct($data=null,$bsfm_host=null){
		//parent::__construct($data,$bsfm_host);
	}

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getTaskKey(){
		return $this->task_key;
	}
	public function setTaskKey($task_key){
		$this->task_key = $task_key;
	}
	public function getPoolExport(){
		return $this->poolExport;
	}
	public function setPoolExport($poolExport){
		$this->poolExport = $poolExport;
	}
	public function getOwnerKey(){
		return $this->owner_key;
	}
	public function setOwnerKey($owner_key){
		$this->owner_key = $owner_key;
	}
	public function getTaskType(){
		return $this->task_type;
	}
	public function setTaskType($task_type){
		$this->task_type = $task_type;
	}
	public function getStartDate(){
		return $this->start_date;
	}
	public function setStartDate($start_date){
		$this->start_date = $start_date;
	}
	public function getRunData($decoded = false){
		$run_data = $this->run_data;
		if($decoded===true){
			$run_data = json_decode($run_data,true);
		}
		return $run_data;
	}
	public function setRunData($run_data){
		$this->run_data = $run_data;
	}
	public function getExternalRefId(){
		return $this->external_ref_id;
	}
	public function setExternalRefId($external_ref_id){
		$this->external_ref_id = $external_ref_id;
	}
	public function getDetailsCount(){
		return $this->details_count;
	}
	public function setDetailsCount($details_count){
		$this->details_count = $details_count;
	}
	public function getDetailsCountDone(){
		return $this->details_done_count;
	}
	public function setDetailsCountDone($details_done_count){
		$this->details_done_count = $details_done_count;
	}
	public function getDetailsErrorCount(){
		return $this->details_error_count;
	}
	public function setDetailsErrorCount($details_error_count){
		$this->details_error_count = $details_error_count;
	}
	public function getEndDate(){
		return $this->end_date;
	}
	public function setEndDate($end_date){
		$this->end_date = $end_date;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setStatus($status){
		$this->status = $status;
	}
	public function getStatusLinkedData(){
		return $this->status_linked_data;
	}
	public function setStatusLinkedData($status_linked_data){
		$this->status_linked_data = $status_linked_data;
	}
	public function getOwnerEmail(){
		return $this->owner_email;
	}
	public function setOwnerEmail($owner_email){
		$this->owner_email = $owner_email;
	}

	public function getStatusCode(){
		if($this->statusCode==null){
			$statusCode = $this->getCodeFromStatus();
			$this->setStatusCode($statusCode);
		}	
		return $this->statusCode;
	}
	public function setStatusCode($statusCode){
		$this->statusCode = $statusCode;
	}

	public function getCodeFromStatus(){
		return self::statusCodeFromStatus($this->getStatus());
	}
	static public function statusCodeFromStatus($status){
		$statusCode;
		if($status!==null){
			if(isset(self::CODE_FOR_STATUS[$status])){
				$statusCode = self::CODE_FOR_STATUS[$status];
			}else{
				$statusCode = "UNKNOWN";
			}
		}else{
			$statusCode = "NULL_STATUS";
		}
		return $statusCode;
	}
	public function getStatusFromCode(){
		return self::numStatusFromCode($this->getStatusCode());
	}
	static public  function numStatusFromCode($status_code){
		$result_status;
		if($status_code!==null){
			foreach (self::CODE_FOR_STATUS as $status => $statusCode) {
				if($statusCode == $status_code){
					$result_status = $status;
					break;
				}
			}
			if($result_status===null){
				$result_status = null;
			}
		}else{
			$result_status = false;
		}
		return $result_status;
	}

	public function getTaskTypeLibelle(){
		if($this->taskTypeLibelle==null){
			$taskTypeLibelle = $this->getLibelleFromType();
			$this->setTaskTypeLibelle($taskTypeLibelle);
		}	
		return $this->taskTypeLibelle;
	}
	public function setTaskTypeLibelle($taskTypeLibelle){
		$this->taskTypeLibelle = $taskTypeLibelle;
	}

	public function getLibelleFromType(){
		return self::typeLibelleFromType($this->getTaskType());
	}

	static public function typeLibelleFromType($type){
		$libelleType;
		if($type!==null){
			if(isset(self::LIBELLE_FOR_TYPE[$type])){
				$libelleType = self::LIBELLE_FOR_TYPE[$type];
			}else{
				$libelleType = "UNKNOWN";
			}
		}else{
			$libelleType = "NULL_LIBELLE";
		}
		return $libelleType;
	}

	public function getRefYear(){
		if($this->refYear==null){
			$run_data = $this->getRunData(true);
			$this->refYear = isset($run_data['refYear']) ? $run_data['refYear'] : null;
		}
		return $this->refYear; 
	}

}