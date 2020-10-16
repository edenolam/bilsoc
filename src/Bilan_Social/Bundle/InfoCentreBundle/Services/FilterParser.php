<?php
/*
*
*/
namespace Bilan_Social\Bundle\InfoCentreBundle\Services;

class FilterParser{
    const FITLER_CONSTRUCT_FIELD_TYPE = "construct_select_expr";

    private $data;
    private $config_finder;
    private $filters_config;/* = array(
        array(
            array(
                'prop_name'=>'nomColl',
                'operator'=>'LIKE'
            ),array(
                'prop_name' => 'siretColl',
                'operator'=>'LIKE'
            ),array(
                'prop_name'=>'ville',
                'operator'=>'LIKE'
            ),array(
                'prop_name'=>'typeColl',
                'operator'=>'IN'
            ),array(
                'prop_name'=>'depaColl',
                'operator'=>'IN'
            )
        )
    );*/
    public function __construct($config_finder){
        $this->config_finder = $config_finder;
        $this->filters_config = $this->config_finder->getConfig('filters');
    }
    private function getFilterConfigParam($config,$param_name){
        $param = null;
        if(is_array($config) && isset($config[$param_name])){
            $param = $config[$param_name];
        }
        return $param;
    }

    public $filter_list = array();

    public function getFilterList(){
        return $this->filter_list;
    }
    public function setFilterList($filter_list){
        $this->filter_list = $filter_list;
    }

    public function getData(){

        return $this->data;
    }
    public function setData($data){
        $this->data = $data;
    }
    public function getFromData($prop_name){
        return $this->getData()->$prop_name;
    }
    public function setOnData($prop_name,$prop_value){
        return $this->getData()->$prop_name=$prop_value;
    }
    public function isOnData($prop_name){
        return isset($this->getData()->$prop_name);
    }
    public function isFilterOnData($filter_config){
        $filter_prop_name = $this->getFilterConfigParam($filter_config,'prop_name');
        return $this->isOnData($filter_prop_name);
    }
    public function addToFilterList($filter){
        if($filter!=null && !in_array($filter, $this->getFilterList())){
            $this->filter_list[] = $filter;
        }
    }
    public function processToFilterList(){
        if($this->data!=null){
            foreach ($this->filters_config as $key => $filter_group) {
                $filter;
                if(isset($filter_group[0])){
                   $filter = $this->processFilterGroup($filter_group);
                }else{
                    $filter = $this->processFilter($filter_group);
                }
                $this->addToFilterList($filter);
            }
        }
    }
    public function processFilter($filter_config){
        $filter = null;
        $filter_definition = $filter_config;
        if($this->ProcessFilterCondition($filter_config)){
            $filter = array();
            $filter_pre_logical_operator = $this->getFilterConfigParam($filter_definition,'pre_logical_operator');
            $next_group_logical_operator = $this->getFilterConfigParam($filter_definition,'next_group_logical_operator');
            $filter_prop_name = $this->getFilterConfigParam($filter_definition,'prop_name');
            $filter_field_name = $this->getFilterConfigParam($filter_definition,'field_name');
            $filter_operator = $this->getFilterConfigParam($filter_definition,'operator');
            $filter_type = $this->getFilterConfigParam($filter_definition,'type');
            #$filter_default_value = $this->getFilterConfigParam($filter_config,'value');
            $filter_data = $this->getFromData($filter_prop_name);
            /*if($filter_data===null && $filter_default_value!==null){
                $filter_data = $filter_default_value;
            }*/
            if($filter_pre_logical_operator!=null){
                $filter['pre_logical_operator'] = $filter_pre_logical_operator;
            }if($next_group_logical_operator!=null){
                $filter['next_group_logical_operator'] = $next_group_logical_operator;
            }
            $filter['prop_name'] = $filter_field_name!=null ? $filter_field_name : $filter_prop_name;
            $filter['operator'] = $filter_operator;
            $filter['value'] = $filter_operator = $this->getFilterConfigParam($filter_definition,'value')  !==null ? $filter_operator = $this->getFilterConfigParam($filter_definition,'value') : $filter_data;
            $is_data_empty = false;
            if(empty($filter_data) && $filter_data!==0 && $filter_data!=="0"){
                $is_data_empty = true;
            }else if(is_array($filter_data)){
                $filtered_data = array();
                foreach($filter_data as $k => $value){
                    if(!empty($value) || $value===0 || $value==="0"){
                        if(is_int($k)){
                            $filtered_data[]=$value;
                        }else{
                            $filtered_data[$k]=$value;
                        }
                    }
                }
                if(empty($filtered_data)){
                    $is_data_empty = true;
                }else{
                    $this->setOnData($filter_prop_name,$filtered_data);
                }
            }
            if(!$is_data_empty && $filter_type==self::FITLER_CONSTRUCT_FIELD_TYPE){
                $filter['construct'] = $this->getFilterConfigParam($filter_definition,'construct');
                $filter['fields'] = $this->ProcessConstructFilterFieldsGroup($this->getFilterConfigParam($filter_definition,'fields'));
                if(empty($filter['fields'])){
                    $filter = null;
                }
            }else if($is_data_empty){
                $filter = null;
            }
        }else{
            $filter = null;
        }
        return $filter;
    }
    public function processFilterGroup($filter_group){
        $filter_group_list = array();
        foreach ($filter_group as $key => $filter) {
            $temp_filter=null;
            if(isset($filter[0])){
                $temp_filter = $this->processFilterGroup($filter);
            }else if($this->isFilterOnData($filter)){
                $temp_filter = $this->processFilter($filter);
            }
            if($temp_filter!=null){
                $filter_group_list[] = $temp_filter;
            }
        }
        return $filter_group_list;
    }
    public function processConstructFilterField($field_config){
        $field = array();
        if($this->ProcessFilterCondition($field_config)){
            $field_prop_name = $this->getFilterConfigParam($field_config,'prop_name');
            $field_name = $this->getFilterConfigParam($field_config,'field_name');
            $field_construct = $this->getFilterConfigParam($field_config,'construct');
            $field['field_name'] = $field_name!=null ? $field_name : $field_prop_name;
            $field['construct'] = $field_construct;
        }else{
            $field = null;
        }
        return $field;
    }
    public function ProcessConstructFilterFieldsGroup($fields_group){
        $fields_group_list = array();
        foreach ($fields_group as $key => $field) {
            $temp_field=null;
            if(isset($field[0])){
                $temp_field = $this->ProcessConstructFilterFieldsGroup($field);
            }else{
                $temp_field = $this->processConstructFilterField($field);
            }
            if($temp_field!=null){
                $fields_group_list[] = $temp_field;
            }
        }
        return $fields_group_list;
    }
    public function ProcessFilterCondition($filter_config){
        $is_ok = true;
        $filter_condition = $this->getFilterConfigParam($filter_config,'condition');
        if($filter_condition!=null){
            $is_ok = false;
            $condition_on = $this->getFilterConfigParam($filter_condition,'on_field');
            $condition_on = $condition_on == null ? $this->getFilterConfigParam($filter_config,'prop_name') : $condition_on; 
            $condition_operator = $this->getFilterConfigParam($filter_condition,'operator');
            $condition_value = $this->getFilterConfigParam($filter_condition,'for_value'); 
            $if_field_empty = $this->getFilterConfigParam($filter_condition,'if_field_empty');
            $value_to_check = $this->getFromData($condition_on);
            if(!empty($value_to_check)){
                try{
                    if(is_callable($condition_operator) || function_exists($condition_operator) || method_exists($this,$condition_operator)){
                        switch ($condition_operator) {
                            case 'in_array':
                                $is_ok = in_array($condition_value, $value_to_check);
                                break;
                            default:
                                if(method_exists($condition_operator,$this)){
                                    $is_ok = $this->$condition_operator($condition_value,$value_to_check);
                                }else{
                                    $is_ok = call_user_func_array($condition_operator,array($condition_value,$value_to_check)); 
                                }
                                
                                break;
                        }
                    }else{
                        $to_eval = $value_to_check.' '.$condition_operator.' '.$condition_value;
                        $is_ok = eval($to_eval);
                    }
                }catch(Exception $e){
                    dump($e);
                    exit();
                }
            }else if($if_field_empty){
                $is_ok = true;
            }
        }
        return $is_ok;
    }
}
function firstInArray($needles,$haystack){
    $is_in_array = false;
    if(is_array($needles)){
        foreach ($needles as $key => $needle){
            $is_in_array = in_array($needle, $haystack);
            if($is_in_array){
                break;
            }
        }
    }else{
        $is_in_array($needles,$haystack);
    }
    return $is_in_array;
}