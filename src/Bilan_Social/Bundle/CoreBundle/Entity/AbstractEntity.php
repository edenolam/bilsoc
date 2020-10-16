<?php

namespace Bilan_Social\Bundle\CoreBundle\Entity;

Class AbstractEntity implements \JsonSerializable {
	
	public function jsonSerialize() {
		$to_json = array();
        foreach ($this as $prop_key => $prop_value) {
	        if(is_string($prop_value)) $to_json[$prop_key]=utf8_encode($prop_value);
	        else $to_json[$prop_key]=$prop_value;
	    }
        return $to_json;
    }

    public function hydrate($data,$preserve=false){
    	if(is_array($data)){
	    	foreach ($data as $prop_key => $data_value) {
	    		$prop_value = $this->__getProp($prop_key);
	    		if(!$preserve || $prop_value===null){
	    			$this->__setProp($prop_key,$data_value);
	    		}
	    	}
	   }else{
	   		return false;
	   }
    }
    protected function __getProp($prop_key){
    	$getMethod = 'get'.ucfirst($prop_key);
    	if(method_exists($this, $getMethod)){
			return $this->$getMethod();
		}else if(property_exists(static::class, $prop_key)){
			return $this->$prop_key;
		}else{
			throw new \Exception('Le properiété '.$prop_key.' n\'existe pas ou n\'est pas accessible sur la classe '.static::class);
		}
    }
    protected function __setProp($prop_key,$prop_value){
    	$setMethod = 'set'.ucfirst($prop_key);
    	if(method_exists($this, $setMethod)){
			$this->$setMethod($prop_value);
		}else if(property_exists(static::class, $prop_key)){
			$this->$prop_key = $prop_value;
		}else{
			throw new \Exception('Le properiété '.$prop_key.' n\'existe pas ou n\'est pas accessible sur la classe '.static::class);
		}
		return true;
    }
    public function utf8Encode($data){
		if(is_array($data)){
			array_walk($data, function($entry){return $this->utf8Encode($entry);});
		}else if(is_string($data)){
			$data = mb_convert_encoding($data, "UTF-8", "UTF-8");//utf8_encode($data);
		}else if (is_object($data)) {
	        $vars = array_keys(get_object_vars($data));
	        foreach ($vars as $var) {
	            $this->utf8Encode($data->$var);
	        }
	    }
		return $data;
	}
}

?>