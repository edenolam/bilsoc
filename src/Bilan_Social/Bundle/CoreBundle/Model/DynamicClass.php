<?php
/*
*
*/
namespace Bilan_Social\Bundle\CoreBundle\Model;

Class DynamicClass{

    protected $data = array();
    protected $simpleProperties;
    protected $classMap;

    public function getSimpleProperties(){
        return $this->simpleProperties;
    }
    public function setSimpleProperties(array $properties){
        if($properties!=null){
            $this->simpleProperties = $properties;
        }
    }
    public function getClassMap(){
        return $this->classMap;
    }
    public function setClassMap($class_map){
        if($class_map!=null){
            $this->classMap = $class_map instanceof ClassMap ? $class_map : new ClassMap($class_map);
        }
    }
    public function __call($method,$args){
        if(property_exists($this, $method)) {
           if(is_callable($this->$method)) {
               return call_user_func_array($this->$method, $args);
           }
       }
    }

    public function __set($name, $value) {
        if($this->classMap!=null && $this->classMap->isPropPrivate($name)){
            $this->data[$name] = $value;
        }else{
            $this->$name = $value;
        }
    }

    public function __get($name) {
      if (array_key_exists($name, $this->data)) {
         return $this->data[$name];
      }
      return null;
    }

    public function __isset($name) {
      return isset($this->data[$name]);
    }

    public function __unset($name) {
        unset($this->data[$name]);
    }

    public function __construct($class_config=null){
        if($class_config!=null){
            $this->setClassMap($class_config);
        }
    }

    protected function createSimpleProperty($prop_name,$prop_value){
        $this->__set($prop_name,$prop_value);
        $getter_name = "get".ucfirst($prop_name);
        $setter_name = "set".ucfirst($prop_name);
        $this->$getter_name = function() use ($prop_name){
            return $this->$prop_name;
        };
        $this->$setter_name = function($to_set) use ($prop_name){
            return $this->$prop_name = $to_set;
        };
    }

    protected function createPropertyFromConfig($prop_config){
        $prop_is_active = isset($prop_config['active']) ? $prop_config['active'] : true;
        if($prop_is_active){
            $prop_name = $prop_config['name'];
            $prop_value = isset($prop_config['value']) ? $prop_config['value'] : null;
            $prop_is_private = isset($prop_config['private']) ? $prop_config['private'] : false;
            $prop_is_active = isset($prop_config['active']) ? $prop_config['active'] : true;
            $prop_has_getter = isset($prop_config['getter']) ? $prop_config['getter'] : true;
            $prop_has_setter = isset($prop_config['setter']) ? $prop_config['setter'] : true;
            $this->$prop_name = $prop_value;
            if($prop_has_getter){
                $getter_name = "get".ucfirst($prop_name);
                $this->$getter_name = function() use ($prop_name){
                    return $this->$prop_name;
                };
            }
            if($prop_has_setter){
                $setter_name = "set".ucfirst($prop_name);   
                $this->$setter_name = function($to_set) use ($prop_name){
                    return $this->$prop_name = $to_set;
                };
            }
        }
    }
}