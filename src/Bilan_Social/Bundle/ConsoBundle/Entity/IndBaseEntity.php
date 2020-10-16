<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class IndBaseEntity{

	public function getIndValuesAsArray($options=array()){
		$to_return = array();
		foreach($this as $prop_key => $prop_value){
			$to_return[$prop_key] = $prop_value;
		}
		return $to_return;
	}
}