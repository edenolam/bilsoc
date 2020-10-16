<?php
/*
*	Entité représentant les exports d'échantillons (pools) pour l'InfoCentreBundle
*/
namespace Bilan_Social\Bundle\InfoCentreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Bilan_Social\Bundle\CoreBundle\Entity\AbstractEntity;

Class PoolExport extends AbstractEntity implements \JsonSerializable{

	#public function __construct(){};
	protected $id;
	protected $pool;
	protected $exportType;
	protected $longTaskHeader;

	protected $longTaskHeaders;

	protected $headerExportHRG;
	
	public function __construct(){
		$this->longTaskHeaders = new ArrayCollection();
	}
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}

	public function getPool(){
		return $this->pool;
	}
	public function setPool($pool){
		$this->pool = $pool;
	}

	public function getExportType(){
		return $this->exportType;
	}
	public function setExportType($exportType){
		$this->exportType = $exportType;
	}

	public function getLongTaskHeader(){
		return $this->longTaskHeader;
	}
	public function setLongTaskHeader($longTaskHeader){
		$this->longTaskHeader = $longTaskHeader;
	}

	public function getLongTaskHeaders(){
		return $this->longTaskHeaders;
	}
	public function setLongTaskHeaders($longTaskHeaders){
		$this->longTaskHeaders = $longTaskHeaders;
		return $this;
	}
	public function addLongTaskHeader($longTaskHeader){
		return $this->getLongTaskHeaders()->add($longTaskHeader);
	}
	public function removeLongTaskHeader($longTaskHeader){
		$this->getLongTaskHeaders()->removeElement($longTaskHeader);
	}

	public function getHeaderExportHRG(){
		return $this->headerExportHRG;
	}
	public function setHeaderExportHRG($headerExportHRG){
		$this->headerExportHRG = $headerExportHRG;
	}

	public function jsonSerialize(){
	 	$to_json = array(
	 		'id',
	 		'exportType',
	 		'longTaskHeaders',
	 		array('pool','id'),
	 		array('pool','nom'),
	 		array('longTaskHeader','id'),
			array('longTaskHeader','taskKey'),
			'headerExportHRG' 
	 	);
	 	$to_exclude = array(
	 		'longTaskHeader'=>array('pool_export')
	 	);
	 	$to_return = array();
	 	$this->fillArrayByPropKey($to_return,$to_json);
	 	return $to_return;
    }
    private function fillArrayByPropKey(&$to_fill,$current_keys,$options=array()){
    	$to_fill = is_array($to_fill) ? $to_fill : array();
    	$to_exclude = isset($options) && isset($options['exclude']) ? $options['exclude'] : array();
    	if($current_keys=='SELF'){
    		$current_keys = get_object_vars ($this);
    	}
    	foreach ($current_keys as $iter => $prop_key) {
	 		if(is_array($prop_key)){
	 			$neested_keys = $prop_key;
	 			$temp_value = $this;
	 			$prop_key_str = "";
	 			$prop_excluded = false;
	 			$nb_level = count($neested_keys);
	 			$cpt_level = 0;
	 			foreach ($neested_keys as $iter_neested => $prop_key_neested) {
	 				$cpt_level++;
	 				$prop_key_str .= $iter_neested==0 ? "" : "_";
	 				$prop_key_str .= $prop_key_neested;
					 $getMethod = "get".ucfirst($prop_key_neested);
					//  dump($getMethod);
	 				$temp_value = $temp_value!=null ? $temp_value->$getMethod() : $temp_value;
	 			}
	 			$to_fill[$prop_key_str] = $temp_value;
	 			//fillArrayByPropKey(,$prop_key)
	 		}else{
	 			if(!in_array($prop_key, $to_exclude)){
	 				$getMethod = "get".ucfirst($prop_key);
					 $value = $this->$getMethod();
					//  dump($getMethod);
	 				if($value instanceof Collection){
	 					$to_fill[$prop_key] = array();
	 					foreach ($value as $key => $temp_iter_value) {
	 						/*
	 						*	patch pour récupérer le statusCode dans le json
	 						*/
	 						if($prop_key == "longTaskHeaders"){
	 							$temp_iter_value->getStatusCode();
	 							$temp_iter_value->getTaskTypeLibelle();
							 }
							//  dump($temp_iter_value);
	 						$to_fill[$prop_key][] = $temp_iter_value;
	 					}
	 				}else{
						//  dump($this->$getMethod());
	 					$to_fill[$prop_key] = $this->$getMethod();
	 				}
	 			}
	 		}
		 }
		//  dump($to_fill);
	 	return $to_fill;
    }
}
?>
