<?php
/*
*
*/
namespace Bilan_Social\Bundle\CoreBundle\Model;

Class SimpleDynamicClass extends DynamicClass{
    
    public function __construct($properties=null){
        $this->dynamicConstruct($properties);        
    }
    public function dynamicConstruct($properties=null){
        $this->setSimpleProperties($properties);
        if(is_array($this->getSimpleProperties())){
            foreach ($this->getSimpleProperties() as $prop_name => $prop_value) {
                $this->createSimpleProperty($prop_name,$prop_value);
            }
        }
    }
}