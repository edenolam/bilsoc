<?php
/*
*
*
*/
namespace Bilan_Social\Bundle\LongTaskManagerBundle\Entity;

use Bilan_Social\Bundle\CoreBundle\Entity\AbstractEntity;

Class LongTask extends AbstractEntity{
	const FILE_KEY_PATTERN = '/^\/api\/v1\/(?:fileInfos|publicContent)\/((?:\w|-)*)(?:\/.*)?/';

	private $raw_data;
	public $taskKey;
	public $startDate;
	public $detailsCount;
	public $detailsDoneCount;
	public $detailsErrorCount;
	public $endDate;
	public $status;
	public $statusLinkedData;
	public $uriPile = array();
	private $bsfm_host;
	private $fileKey;
	private $fileInfos;
	private $bsfm_service;
	public $ficheView;
	public $pool_export;

	public function __construct($data=null,$bsfm_host, $serviceBSFM){
		$this->bsfm_host = $bsfm_host;
		$this->bsfm_service = $serviceBSFM;
		if($data!=null){
			$this->setRawData($data);
			$this->processRawData();
		}
	}

	public function getRawData(){
		return $this->raw_data;
	}
	public function setRawData($raw_data){
		$this->raw_data = $raw_data;
	}
	public function processRawData(){
		$raw_data = $this->raw_data;
		foreach ($raw_data as $key_data => $temp_data){
			$get_method_name = 'get'.ucfirst($key_data);
			$set_method_name = 'set'.ucfirst($key_data);
			$this->$key_data = $temp_data;
			$this->$get_method_name = function(){return $this->$key_data;};
			$this->$set_method_name = function($data_to_set){$this->$key_data=$data_to_set;};
			if($key_data=='statusLinkedData'){
				$this->uriPile = json_decode($temp_data,true);
				if(is_array($this->uriPile)){
				    $first = true;
					foreach ($this->uriPile as $uri_key => &$uri) {

						if($first){
							$fileKey;
                            $first = false;
							preg_match(self::FILE_KEY_PATTERN, $uri, $fileKey);
							$fileKey = isset($fileKey[1]) ? $fileKey[1] : null;
							$this->setFileKey($fileKey);

						}
						switch ($uri_key){
                            case 'contentUri':
                                $uri = $this->bsfm_service->getPublicFileUrl($this->getFileKey());
                                break;
                            case 'infosUri':
                                $uri = $this->bsfm_host.''.$uri;
                                break;
                            default :
                                $uri = $this->bsfm_host.''.$uri;
                        }
					}

				}
			}
		}
	}
	public function getUriPile(){
		return $this->uriPile;
	}
	public function getFromUriPile($uri_key){
		$uri = isset($this->uriPile[$uri_key]) ? $this->uriPile[$uri_key] : null;
		return $uri;
	}
	public function setOnUriPile($uri_key, $uri, $force=false){
		if($this->getFromUriPile($uri_key)!=null){
			if($force){
				$this->uriPile[$uri_key] = $uri;
			}
		}else{
			$this->uriPile[$uri_key] = $uri;
		}
	}

	public function getUri($uri_name){
		$uri = null;
		switch ($uri_name) {
			case 'content':
			case 'contentUri':
				$uri = $this->getFromUriPile('contentUri');
				break;
			case 'infos':
			case 'infosUri':
				$uri = $this->getFromUriPile('infosUri');
				break;
		}
		return $uri;
	}
	public function getFileKey(){
		return $this->fileKey;
	}
	public function setFileKey($file_key){
		$this->fileKey = $file_key;
	}
	public function getTaskKey(){
		return $this->taskKey;
	}
	public function setTaskKey($taskKey){
		$this->taskKey = $taskKey;
	}
	public function getPoolExport(){
		return $this->pool_export;
	}
	public function setPoolExport($pool_export){
		$this->pool_export = $pool_export;
	}
	public function getFileInfos(){
		return $this->fileInfos;
	}
	public function setFileInfos($file_infos){
		$this->fileInfos = $file_infos;
	}
	public function getFicheView(){
		return $this->ficheView;
	}
	public function setFicheView($ficheView){
		$this->ficheView = $ficheView;
	}
}