<?php
/*
*
*/
namespace Bilan_Social\Bundle\CoreBundle\Model;

Class ConfigDynamicClass extends DynamicClass{

    public function __construct(array $properties){
        parent::__construct($properties);
        foreach ($properties as $key => $prop_config) {
            $this->createPropertyFromConfig($prop_config);
        }
    }
}