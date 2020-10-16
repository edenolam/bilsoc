<?php
/*
*
*/
namespace Bilan_Social\Bundle\InfoCentreBundle\Services;
use PDO;
use Symfony\Component\HttpFoundation\Session\Session;

Class SqlFilterParser{
    private $servicebdd;
    private $bddMap;/* = array(
        'collectivite'=>array(
            'name'=>'collectivite',
            'alias'=>'c',
            'primary'=>'idColl',
            'fields'=>array(
                'idColl'=>'ID_COLL',
                'siretColl'=>array(
                    'name'=>'NM_SIRE',
                    #'alias'=>'siret'
                ),
                'nomColl'=>array(
                    'name'=>'LB_COLL',
                    #'alias'=>'Nom collectivité'
                ),
                'ville'=>'LB_VILL',
                'typeColl'=>array(
                    'join'=>'typeCollectivite',
                    'fieldOn'=>'idTypeColl',
                    'selectOn'=>'lbTypeColl',
                    'name'=>'ID_TYPE_COLL'
                ),
                'depaColl'=>array(
                    #'alias'=>'département',
                    'join'=>'departement',
                    'fieldOn'=>'idDepa',
                    'name'=>'ID_DEPA',
                    'selectOn'=>'lbDepa',
                ),
                'enqueteColl'=>array(
                    #'alias'=>'département',
                    'join'=>'enqueteCollectivite',
                    'fieldOn'=>'idCollEnquColl',
                    'name'=>'ID_COLL',
                    #'selectOn'=>'lbDepa',
                )
            )
        ),
        'enqueteCollectivite'=>array(
            'name'=>'enquete_collectivite',
            'alias'=>'ec',
            'primary'=>'idEnquColl',
            'fields'=>array(
                'idEnquColl'=>array(
                    'name'=>'ID_ENQUCOLL',
                ),
                'idCollEnquColl'=>array(
                    'name'=>'ID_COLL',
                    #'alias'=>'Type de collectivité',
                ),
                'enqueteEnquColl'=>array(
                    'join'=>'enquete',
                    'fieldOn'=>'idEnqu',
                    'name'=>'ID_ENQU',
                    'select_on'=>'idEnqu'
                ),
            ),
            'backRef'=>'enqueteColl' // array('collectivite'=>'typeColl')
        ),
        'typeCollectivite'=>array(
            'name'=>'ref_type_collectivite',
            'alias'=>'rfc',
            'primary'=>'idTypeColl',
            'fields'=>array(
                'idTypeColl'=>array(
                    'name'=>'ID_TYPE_COLL',
                    'backRef'=>'typeColl'
                ),
                'lbTypeColl'=>array(
                    'name'=>'LB_TYPE_COLL',
                    #'alias'=>'Type de collectivité',
                ),
                'cdTypeColl'=>'CD_TYPE_COLL',
            ),
            'backRef'=>'typeColl' // array('collectivite'=>'typeColl')
        ),
        'departement'=>array(
            'name'=>'departement',
            'alias'=>'depa',
            'primary'=>'idDepa',
            'fields'=>array(
                'idDepa'=>array(
                    'name'=>'ID_DEPA',
                    //'backRef'=>'depaColl'
                ),
                'lbDepa'=>array(
                    'name'=>'LB_DEPA',
                    'select_expr'=>array(
                        'expr'=>'CONCAT(@field_1,-,$@field_2)',
                        'expr_field'=>array('cdDepa','lbDepa')
                    )
                ),
                'cdDepa'=>'CD_DEPA',
            ),
            'backRef'=>'depaColl' // array('collectivite'=>'typeColl')
        ),
        'campagne'=>array(
            'name'=>'campagne',
            'alias'=>'camp',
            'primary'=>'idCamp',
            'fields'=>array(
                'idCamp'=>array(
                    'name'=>'ID_CAMP',
                    //
                ),
                'anneeCamp'=>array(
                    'name'=>'NM_ANNE',
                    'backRef'=>'campagneEnqu'#'alias'=>'Année campagne'
                ),
                'statusCamp'=>array(
                    'name'=>'FG_STAT',
                )
            ),
            'backRef'=>'campagneEnqu' // array('collectivite'=>'typeColl')
        ),
        'enquete'=>array(
            'name'=>'enquete',
            'alias'=>'enqu',
            'primary'=>'idEnqu',
            'fields'=>array(
                'idEnqu'=>array(
                    'name'=>'ID_ENQU',
                    'backRef'=>'enqueteEnquColl'
                ),
                'statusEnqu'=>array(
                    'name'=>'FG_STAT',
                    #'alias'=>'Année campagne'
                ),
                'campagneEnqu'=>array(
                    #'alias'=>'département',
                    'join'=>'campagne',
                    'fieldOn'=>'idCamp',
                    'name'=>'ID_CAMP',
                    'selectOn'=>'anneeCamp',
                )
            ),
            'backRef'=>'enqueteEnquColl'
        )
    );*/

    public function getBddMap(){
        return $this->bddMap;
    }
    public function extendBddMapField($field_key,$key_to_add,$to_add){
        $config = $this->getFieldConfigFromReverse($field_key);
        $config['field'][$key_to_add]=$to_add;
    }
    private $id_user_cdg;
    public function setUserCdg($id_user_cdg){
        $this->id_user_cdg = $id_user_cdg;
    }
    public function getUserCdg(){
        return $this->id_user_cdg;
    }
    private $reverseBddMap;

    private $field_default_config_values = array(
        'joinType'=>'join',
    );

    public function getReverseBddMap(){
        return $this->reverseBddMap;
    }
    private function setReverseBddMap($reverseBddMap){
        $this->reverseBddMap = $reverseBddMap;
    }
    private function setDefaultFieldConfigOn(&$field_config){
        if(is_array($field_config)){
            foreach ($this->field_default_config_values as $config_key => $config_value) {
                $set_ok = true;
                if($config_key=='joinType' && !isset($field_config['join'])){
                    $set_ok = false;
                }else if(isset($field_config[$config_key])){
                    $set_ok = false;
                }
                if($set_ok){
                   $field_config[$config_key]=$config_value; 
                }
            }
        }
    }
    private function loadReverseBddMap($reset=false){
        if($this->reverseBddMap==null || $reset){
            $reverseBddMap = array();
            foreach ($this->bddMap as $table_key => $table_config){
                $fields = $table_config['fields'];
                foreach ($fields as $field_key => $field){
                    $temp_field = array(
                        'table'=>&$this->bddMap[$table_key],
                        'field'=>&$this->bddMap[$table_key]['fields'][$field_key]
                    );
                    $temp_field['table']['key']=$table_key;
                    if(!isset($temp_field['table']['alias'])){
                        $temp_field['table']['alias']=$table_key;
                    }
                    $reverseBddMap[$field_key]=$temp_field;
                    $this->setDefaultFieldConfigOn($temp_field['field']);
                }
            }
            $this->setReverseBddMap($reverseBddMap);
        }
    }
    private function setDefaultFieldConfig($field_key){
        $field_config = $this->getFieldConfig($field_key);
        $this->setDefaultFieldConfigOn($field_config);
    }
    private function setDefaultFieldConfigToAll(){
        foreach(array_keys($this->getReverseBddMap()) as $field_key){
            $this->setDefaultFieldConfig($field_key);
        }
    }
    
    private $em;

    private function getEm(){
        return $this->em;
    }
    private $sessionManager;

    public function __construct($em, $config_finder, $bddConnectionPreparator,Session $session){
        $this->config_finder = $config_finder;
        $this->sessionManager = $session;
        $this->servicebdd = $bddConnectionPreparator;
        $this->bddMap = $this->config_finder->getConfig('bddMap');
        $this->loadReverseBddMap();
        $this->em = $em;
        
        //$this->setFilterList($filter_list);
    } 

    public $filterList;

    public function getFilterList(){
        return $this->filterList;
    }
    public function setFilterList($filter_list){
        $this->filterList = $filter_list;
    }

    public function getTableConfig($table_key,$config_name=null){
        $table_config = isset($this->getBddMap()[$table_key]) ? $this->getBddMap()[$table_key] : null;
        if($table_config != null && $config_name!=null){
            $table_config = isset($table_config[$config_name]) ? $table_config[$config_name] : null;      
        }
        return $table_config;
    }
    public function getFromNestedConfig($config,$configs_name){
        $config_to_return=null;
       
        if($config != null && $configs_name!=null){
            if(is_array($configs_name)){
                $next_config = $configs_name[0];
                array_splice($configs_name,0,1);
                if($next_config==null){
                    $config_to_return = $config;
                }else if(count($configs_name)==0){
                    $config_to_return = isset($config[$next_config]) ? $config[$next_config] : null;
                }else if(isset($config[$next_config])){
                    $config_to_return = $this->getFromNestedConfig($config[$next_config],$configs_name);
                }

            }else{
                $config_to_return = isset($config[$configs_name]) ? $config[$configs_name] : null;      
            }
        }
        return $config_to_return;
    }
    public function getFieldConfigFromReverse($field_key,$config_name=null){
        $field_reverse_config = is_string($field_key) && isset($this->getReverseBddMap()[$field_key]) ? $this->getReverseBddMap()[$field_key] : null;
        if($field_reverse_config != null && $config_name!=null){
            $field_reverse_config = $this->getFromNestedConfig($field_reverse_config,$config_name);//isset($field_reverse_config[$config_name]) ? $field_reverse_config[$config_name] : null;      
        }
        return $field_reverse_config;
    }
    public function getFieldConfig($field_key,$config_name=null){
        $field_config = $this->getFieldConfigFromReverse($field_key,'field');
        if($field_config != null && $config_name!=null){
            if($config_name=='name' && !is_array($field_config)){
            }else{
                $field_config = $this->getFromNestedConfig($field_config,$config_name);//isset($field_config[$config_name]) ? $field_config[$config_name] : null;      
            }
        }
        return $field_config;
    }
    public function getFieldTableConfig($field_key,$config_name=null){
        $table_config = $this->getFieldConfigFromReverse($field_key,'table');
        if($table_config != null && $config_name!=null){
            $table_config = $this->getFromNestedConfig($table_config,$config_name);//isset($table_config[$config_name]) ? $table_config[$config_name] : null;
        }
        return $table_config;
    }
    private $selectBase = array('idColl','siretColl','nomColl','typeColl','depaColl','cdDepa','idEnqu','anneeCamp','idBilanSociCons');
    private $fromDefault = 'collectivite';
    private $whereBase = array(
        array(
            'prop_name'=>'statutCamp',
            'operator'=>'=',
            'value'=>1
        ),
        array(
            'prop_name'=>'statutEnqu',
            'operator'=>'=',
            'value'=>1
        )
    );

    private $selectPile = array();
    private $joinPile = array();
    private $wherePile = array();  
    private $outerWherePile = array();  

    private function getPilePropNameByKey($pile_key){
        $pile_prop_name = null;
        switch ($pile_key) {
            case 'select':
                $pile_prop_name = 'selectPile';
                break;
            case 'join':
                $pile_prop_name = 'joinPile';
                break;
            case 'where':
                $pile_prop_name = 'wherePile';
                break;
            case 'outer_where':
            case 'outerWhere':
            case 'outerwhere':
                $pile_prop_name = 'outerWherePile';
                break;
        }
        return $pile_prop_name;
    }
    private function &getPilePropByKey($pile_key){
        $pile_prop_name = $this->getPilePropNameByKey($pile_key);
        if($pile_prop_name!=null && isset($this->$pile_prop_name)){
            return $this->$pile_prop_name;
        }else{
            return null;
        }
    }
    private function isInPile($pile_key,$to_check){
        $is_in_pile = false;
        $pile = $this->getPilePropByKey($pile_key);
        if(in_array($to_check,$pile)){
            $is_in_pile = true;
        }
        return $is_in_pile;
    }
    private function addToPile($pile_key,$to_add){
        $pile_prop_name = null;
        if($to_add!=null){
            /*switch ($pile_key) {
                case 'select':
                    $pile_prop_name = 'selectPile';
                    break;
                case 'join':
                    $pile_prop_name = 'joinPile';
                    break;
                case 'where':
                    $pile_prop_name = 'wherePile';
                    break;
                case 'outer_where':
                case 'outerWhere':
                case 'outerwhere':
                    $pile_prop_name = 'outerWherePile';
                    break;
            }
            if($pile_prop_name){*/
                $pile_to_add = &$this->getPilePropByKey($pile_key);
                $pile_prop_name = $this->getPilePropNameByKey($pile_key);
                //if(isset($this->$pile_prop_name) && !in_array($to_add,$this->$pile_prop_name)){
                if($pile_to_add!==null && !$this->isInPile($pile_key,$to_add)){
                    //switch ($pile_key){
                    switch ($pile_prop_name) {
                        //case 'join':
                        case 'joinPile':
                            if(key($to_add)!=$this->fromDefault){
                                //$this->$pile_prop_name[]=$to_add;
                                $pile_to_add[]=$to_add;
                            }
                            break;
                        case 'select':
                        case 'selectPile':
                            /*$select_on = $this->getFieldConfig($to_add,array('selectOn'));
                            dump($select_on);
                            if($select_on!=null){
                                if(is_array($select_on)){
                                    $this->$pile_prop_name = array_merge($this->$pile_prop_name,$select_on);
                                }else{
                                    $this->$pile_prop_name[]=$select_on;
                                }
                                
                            }else{*/
                                //$this->$pile_prop_name[]=$to_add;
                                $pile_to_add[]=$to_add;
                            //}
                            break;
                        case 'wherePile':
                            if($this->isWhereGroupForOuter($to_add)){
                                if(!isset($to_add[0])){
                                    $this->addToPile('outerWhere',$to_add);
                                }else{
                                    $to_where = $this->getInnerFromWhereGroup($to_add);//array();
                                    $to_outer_where = $this->getOuterFromWhereGroup($to_add);//array();
                                    /*foreach ($to_add as $key => $a_to_add) {
                                        dump($a_to_add);
                                        if($this->isWhereForOuter($a_to_add)){
                                            $to_outer_where[]=$a_to_add;
                                        }else{
                                            $to_where[]=$a_to_add;
                                        }
                                    }*/
                                    $pile_to_add[]=$to_where;
                                    $this->addToPile('outerWhere',$to_outer_where);
                                }
                            }else{
                                $pile_to_add[]=$to_add;
                            }
                            break;
                        case 'outerWherePile':
                            if(!$this->isWhereGroupForOuter($to_add)){
                                $this->addToPile('where',$to_add);
                            }else{
                                $pile_to_add[]=$to_add;
                            }
                            break;
                        default:
                            //$this->$pile_prop_name[]=$to_add;
                            $pile_to_add[]=$to_add;
                            break;
                    }
                }
            //}
        }
    }
    public function addToSelectPile($to_add){
        $this->addToPile('select',$to_add);
        $select_expr = $this->getFieldConfig($to_add,'select_expr');
        $construct_select_expr = $this->getFieldConfig($to_add,'construct_select_expr');
        if($select_expr!==null || $construct_select_expr!==null){
            $processed_select_expr = $select_expr!=null ? $select_expr : $construct_select_expr;
            $expr_fields = isset($processed_select_expr['expr_fields']) ? $processed_select_expr['expr_fields'] : array();
            foreach ($expr_fields as $key => $expr_field){
                $this->addToJoinPile($this->getJoinForPile($expr_field));
                $this->addFieldExprToJoinPile($expr_field);
            }
        }   
    }
    public function getSelectPile(){
        return $this->selectPile;
    }
    public function addFieldExprToJoinPile($field_key){
        $select_expr = $this->getFieldConfig($field_key,'select_expr');
        $construct_select_expr = $this->getFieldConfig($field_key,'construct_select_expr');
        if($select_expr!==null || $construct_select_expr!==null){
            $processed_select_expr = $select_expr!=null ? $select_expr : $construct_select_expr;
            $expr_fields = isset($processed_select_expr['expr_fields']) ? $processed_select_expr['expr_fields'] : array();
            foreach ($expr_fields as $key => $expr_field){
                if($expr_field!=$field_key){
                    $this->addToJoinPile($this->getJoinForPile($expr_field));
                    //$this->addFieldExprToJoinPile($expr_field);
                }
            }
        }
    }
    public function addToJoinPile($to_add){
        try{
            if($to_add!=null && !$this->isInPile('join',$to_add)){
                $this->addToPile('join',$to_add);
                $this->addSelectOnToPile(reset($to_add));
            }
        }catch(Exception $e){
            dump($e);
            exit();
        }  
    }
    public function getJoinPile(){
        return $this->joinPile;
    }
    public function addToWherePile($to_add){
        if(!empty($to_add)){
            $this->addToPile('where',$to_add);
        }
    }
    public function getWherePile(){
        return $this->wherePile;
    }
    public function addToOuterWherePile($to_add){
        if(!empty($to_add)){
            $this->addToPile('outerWhere',$to_add);
        }
    }
    public function getOuterWherePile(){
        return $this->outerWherePile;
    }
    public function isWhereGroupForOuter($where_group){
        $is_for_outer = false;
        if(isset($where_group[0])){
            foreach ($where_group as $group_key => $group) {
                $is_for_outer = $this->isWhereGroupForOuter($group);
                if($is_for_outer){
                    break;
                }
            }
        }else{
            $is_for_outer = $this->isWhereForOuter($where_group);
        }
        return $is_for_outer;
    }
    public function isWhereForOuter($where){
        $is_for_outer = false;
        if(isset($where['prop_name'])){
            $field_key =  $where['prop_name'];
            $select_expr = $this->getFieldConfig($field_key,'select_expr') !== null ? $this->getFieldConfig($field_key,'select_expr') : $this->getFieldConfig($field_key,'construct_select_expr');
            $is_for_outer = $select_expr!=null;
        }
        return $is_for_outer;
    }
    public function getOuterFromWhereGroup($where_group){
        $to_outer_where = array();
        if(isset($where_group[0])){
           foreach ($where_group as $key => $where) {
                $temp_where_group = $this->getOuterFromWhereGroup($where);
                if(!empty($temp_where_group)){
                    $to_outer_where[]=$temp_where_group;
                }
            }
        }else{
            if($this->isWhereForOuter($where_group)){
                $to_outer_where[]=$where_group;
            }
        }
        return $to_outer_where;        
    }
    public function getInnerFromWhereGroup($where_group){
        $to_inner_where = array();
        if(isset($where_group[0])){
           foreach ($where_group as $key => $where) {
                $temp_where_group = $this->getInnerFromWhereGroup($where);
                if(!empty($temp_where_group)){
                    $to_inner_where[]=$temp_where_group;
                }
            }
        }else if(!empty($where_group)){
            if(!$this->isWhereForOuter($where_group)){
                $to_inner_where=$where_group;
            }
        }
        return $to_inner_where;        
    }
    public function addNeededForConstruct($filter){
        $construct_select_expr = getFromNestedConfig($filter,'construct');
        if($construct_select_expr!==null){
            $construct_select_expr_to_add = array();
            $field_key = isset($filter['field_name']) ? $filter['field_name'] : $filter['prop_name'] ;
            $this->extendBddMapField($field_key,'construct',$construct_select_expr);
            $construct_filter_fields = $this->getFromNestedConfig($filter,"fields");
            $fields_to_construct = array();
            foreach ($construct_filter_fields as $key => $construct_filter_field) {
                $field_construct_select_expr = $this->getFromNestedConfig($construct_filter_field,'construct');
                $construct_field_key = $this->getFromNestedConfig($construct_filter_field,'field_name');
                if($construct_field_key!==null){
                    $fields_to_construct[]=$construct_field_key;
                    //$this->addToJoinPile($this->getJoinForPile($construct_field_key));
                    if($field_construct_select_expr!==null){
                        $this->extendBddMapField($construct_field_key,'construct',$field_construct_select_expr);
                    }
                }
            }
            $construct_select_expr_to_add['construct']=$construct_select_expr;
            $construct_select_expr_to_add['expr_fields']=$fields_to_construct;
            $this->extendBddMapField($field_key,'construct_select_expr',$construct_select_expr_to_add);
        }
    }
    public function filtersToPiles(){
        $filter_list = $this->whereBase;

        if($this->getFilterList()!=null){
            $filter_list = array_merge($filter_list,$this->getFilterList());
        }

        if(isset($filter_list) && $filter_list!=null && count($filter_list)>0){
            foreach($filter_list as  $key => $filter) {
                if(isset($filter[0])){
                   $this->filterGroupToPiles($filter);
                }else{
                    $this->filterToPile($filter);
                }
                $this->addToWherePile($filter);
            }
        }
    }
    public function filterGroupToPiles($filter_group){
        foreach ($filter_group as $key => $filter) {
            if(isset($filter[0])){
               $this->filterGroupToPiles($filter);
            }else{
                $this->filterToPile($filter);
            }
        }
    }
    public function filterToPile($filter){
        $field_key = $filter['prop_name'];
        $field_join = $this->getFieldConfig($field_key,'join');
        
        $field_table_key = $this->getFieldTableConfig($field_key,'key');
        $this->addToSelectPile($field_key);
        
        $this->addNeededForConstruct($filter);
        $this->addToJoinPile($this->getJoinForPile($field_key));
        $this->addSelectOnToPile($field_key);
    }
    public function addSelectOnToPile($field_key){
        $select_on = $this->getFieldConfig($field_key,array('selectOn'));
        if($select_on!=null){
            $select_on = is_array($select_on) ? $select_on : array($select_on);
            foreach ($select_on as $key => $select_on_field_key) {
                $this->addToSelectPile($select_on_field_key);
                $this->addToJoinPile($this->getJoinForPile($select_on_field_key));
            }
        }
    }
    public function processToPiles(){
        try{
        foreach ($this->selectBase as $key => $field_key) {
            $field_table_key = $this->getFieldTableConfig($field_key,'key');
            //if($field_table_key!=$this->fromDefault){
                $this->addToJoinPile($this->getJoinForPile($field_key));
                $this->addSelectOnToPile($field_key);
            //}
           $this->addToSelectPile($field_key);
        }
        $this->filtersToPiles();
        }catch(Exception $e){
            dump($e);
            exit();
        }
    }
    private $processed_field_pile = array();
    public function getJoinForPile($field_key){
        $field_join = $this->getFieldConfig($field_key,'join');
        $field_back_ref = $this->getFieldConfig($field_key,'backRef');
        $field_table_key = $this->getFieldTableConfig($field_key,'key');
        $field_table_back_ref = $this->getFieldTableConfig($field_key,'backRef');
        $join_for_pile = null;
        $field_join_key = null;
        if($field_join!=null){
            $field_join_key = $field_key;
            $field_join_on = $this->getFieldConfig($field_key,'fieldOn');
            $field_join_on = is_array($field_join_on) ? $field_join_on : array($field_join_on);
            foreach ($field_join_on as $key => $a_field_join_on) {
                if(!in_array($a_field_join_on,$this->processed_field_pile)){
                    $this->processed_field_pile[] = $a_field_join_on;
                    $field_table_key = $this->getFieldTableConfig($a_field_join_on,'key');
                    $field_on_table_back_ref = $this->getFieldTableConfig($a_field_join_on,'backRef');
                    if($field_on_table_back_ref!=null && $field_on_table_back_ref!=$field_key){
                        $this->addToJoinPile($this->getJoinForPile($field_on_table_back_ref));
                    }
                }
            }
            
        }
        if($field_back_ref!=null  && $field_back_ref!=$field_key){
            if(!in_array($field_back_ref,$this->processed_field_pile)){
                $field_join_key = $field_back_ref;
                $this->processed_field_pile[] = $field_back_ref;
                $this->addToJoinPile($this->getJoinForPile($field_back_ref));
            }
        }else if($field_table_back_ref!=null  && $field_table_back_ref!=$field_key){
            #$field_join_key = $field_table_back_ref;
            if(!in_array($field_table_back_ref,$this->processed_field_pile)){
                $this->processed_field_pile[] = $field_table_back_ref;
                $this->addToJoinPile($this->getJoinForPile($field_table_back_ref));
            }
        }
        if($field_join_key!=null){
            $field_join_table_key = $this->getFieldTableConfig($field_join_key,'key');
            if($field_table_key!=$field_join_table_key){
            //if(!in_array($field_join_key,$this->processed_field_pile)){
                $this->processed_field_pile[] = $field_join_key;
                $join_for_pile = array($field_table_key=>$field_join_key);
            }
        }
        return $join_for_pile;
    }
    private function getSqlStrField($field_key,$join_num=''){
        $field_name = $this->getSqlStrFieldName($field_key,$join_num);
        $table_alias = $this->getSqlStrTableAliasByField($field_key,$join_num);
        $join_num = !empty($join_num) ? '_'.$join_num : '';
        $field_sql = $table_alias.'.'.$field_name;
        return $field_sql;
    }
    private function getSqlStrTableFullByField($field_key,$join_num=''){
        $table = $this->getFieldTableConfig($field_key);
        $table_name = isset($table['name']) ? $table['name'] : $table['key'];
        $table_alias = $this->getSqlStrTableAliasByField($field_key,$join_num);
        $table_full_sql = $table_name.' AS '.$table_alias;
        return $table_full_sql;
    }
    private function getSqlStrTableFull($table_key,$join_num=''){
        $table = $this->getTableConfig($table_key);
        $table_name = isset($table['name']) ? $table['name'] : $table['key'];
        $table_alias = $this->getSqlStrTableAlias($table_key,$join_num);
        $table_full_sql = $table_name.' AS '.$table_alias;
        return $table_full_sql;
    }
    private function getSqlStrTableAliasByField($field_key,$join_num=''){
        $table = $this->getFieldTableConfig($field_key);
        $table_alias = isset($table['alias']) ? $table['alias'] : $table['key'];
        $join_num = !empty($join_num) ? '_'.$join_num : '';
        $table_alias_sql = $table_alias.''.$join_num;
        return $table_alias_sql;
    }
    private function getSqlStrTableAlias($table_key,$join_num=''){
        $table = $this->getTableConfig($table_key);
        $table_alias = isset($table['alias']) ? $table['alias'] : $table['key'];
        $join_num = !empty($join_num) ? '_'.$join_num : '';
        $table_alias_sql = $table_alias.''.$join_num;
        return $table_alias_sql;
    }
    private function getSqlStrFieldAlias($field_key,$join_num=''){
        $field_alias = $field_key;
        $field = $this->getFieldConfig($field_key);
        if(is_array($field)){
            $field_alias = isset($field['alias']) ? $field['alias'] : $field_key;
        }
        $join_num = !empty($join_num) ? '_'.$join_num : '';
        $field_alias .= $join_num;
        return $field_alias;
    }
    private function getSqlStrFieldName($field_key){
        $field = $this->getFieldConfig($field_key);
        $field_name = $field;
        if(is_array($field)){
            $field_name = isset($field['name']) ? $field['name'] : $field_key;
        }
        return $field_name;
    }
    private function getSqlStrSelectField($field_key,$join_num=''){
        $field_expr_obj = $this->getFieldConfig($field_key,'select_expr');
        $field_construct_expr_obj = $this->getFieldConfig($field_key,'construct_select_expr');
        $field_alias = $this->getSqlStrFieldAlias($field_key,$join_num);
        $field_select_sql = '';

       /* if($field_expr_obj!=null){
            $field_expr = isset($field_expr_obj['expr']) ? $field_expr_obj['expr'] : null;
            $field_expr_params = isset($field_expr_obj['expr_params']) ? $field_expr_obj['expr_params'] : array();
            $field_expr_fields = isset($field_expr_obj['expr_fields']) ? $field_expr_obj['expr_fields'] : array();
            foreach($field_expr_fields as $field_index => $field_key){
                $temp_field_key = "@field".$field_index;
                if(!is_int($field_index)){
                    $temp_field_key = $field_index;
                }
                $field_sql = $this->getSqlStrField($field_key,$join_num);
                $field_expr = str_replace($temp_field_key, $field_sql, $field_expr);
            }
            foreach($field_expr_params as $param_key => $param_value){
                $temp_param_key = "@param".$param_key;
                if(!is_int($param_key)){
                    $temp_param_key = $param_key;
                }
                $field_expr = str_replace($temp_param_key, $param_value, $field_expr);
            }
            $field_select_sql = '('.$field_expr.') AS "'.$field_alias.'"';
        }else if($field_construct_expr_obj!=null){
            $field_expr_fields = isset($field_construct_expr_obj['expr_fields']) ? $field_expr_obj['expr_fields'] : array();
            $base_contruct = $this->getFieldConfig($field_key,'construct');
            foreach ($field_expr_fields as $key => $field_expr_field_key) {
                $field_construct = $this->getFieldConfig($field_expr_field_key,'construct');
                $current_between = isset($field_construct['between']) ? : $field_construct['between'] : $base_contruct['between'];
                $field_sql_str .= $key>0 ? ' ' : ' '.$current_between.' ';
                if($this->getFieldConfig($field_expr_field_key,'select_expr') || $this->getFieldConfig($field_expr_field_key,'construct_select_expr')){
                    $field_sql_str . = $this
                }
            }
        }*/
       
        if($field_expr_obj!=null || $field_construct_expr_obj!=null){
            $field_select_sql = $this->getSqlStrExprSelectField($field_key,$join_num);
            $field_select_sql = '('.$field_select_sql.') AS "'.$field_alias.'"';
        }else{
            
            $field_sql_str = $this->getSqlStrField($field_key);
            $field_select_sql = $field_sql_str.' AS "'.$field_alias.'"';
        }
        
        return $field_select_sql;
    }
    private function getSqlStrExprSelectField($field_key,$join_num=''){
        $field_expr_obj = $this->getFieldConfig($field_key,'select_expr');
        $field_construct_expr_obj = $this->getFieldConfig($field_key,'construct_select_expr');
        $field_alias = $this->getSqlStrFieldAlias($field_key,$join_num);
        $field_expr_select_sql = '';
       
        if($field_expr_obj!=null){
            $field_expr_select_sql = isset($field_expr_obj['expr']) ? $field_expr_obj['expr'] : null;
            $field_expr_params = isset($field_expr_obj['expr_params']) ? $field_expr_obj['expr_params'] : array();
            $field_expr_fields = isset($field_expr_obj['expr_fields']) ? $field_expr_obj['expr_fields'] : array();
            $nb_binded = 0;
            $nb_param = count($field_expr_fields);
            foreach($field_expr_fields as $field_index => $field_key){
                $temp_field_key = "@field".$field_index.'(?!\d)';
                if(!is_int($field_index)){
                    $temp_field_key = $field_index;
                }
                $field_sql = $this->getSqlStrField($field_key,$join_num);
                $is_binded = 0;
                $field_expr_select_sql = preg_replace('/'.$temp_field_key.'/', $field_sql, $field_expr_select_sql,-1,$is_binded);
                if($is_binded>0){
                    $nb_binded++;
                }
            }
            $field_expr_select_sql = str_replace('@nb_binded', $nb_binded, $field_expr_select_sql);
            $field_expr_select_sql = str_replace('@nb_param', $nb_param, $field_expr_select_sql);
            foreach($field_expr_params as $param_key => $param_value){
                $temp_param_key = "@param".$param_key.'(?!\d)';
                if(!is_int($param_key)){
                    $temp_param_key = $param_key;
                }
                $field_expr_select_sql = preg_replace ('/'.$temp_param_key.'/', $param_value, $field_expr_select_sql);
            }
        }else if($field_construct_expr_obj!=null){
            $field_expr_fields = isset($field_construct_expr_obj['expr_fields']) ? $field_construct_expr_obj['expr_fields'] : array();
            $base_contruct = $this->getFromNestedConfig($field_construct_expr_obj,'construct');
            $field_expr = '';
            foreach ($field_expr_fields as $key => $field_expr_field_key) {
                $field_construct = $this->getFieldConfig($field_expr_field_key,'construct');
                $current_between = isset($field_construct['between']) ? $field_construct['between'] : $base_contruct['between'];
                $field_expr_select_sql .= $key==0 ? ' ' : ' '.$current_between.' ';
                if($this->getFieldConfig($field_expr_field_key,'select_expr') || $this->getFieldConfig($field_expr_field_key,'construct_select_expr')){
                    $field_expr_select_sql .= $this->getSqlStrExprSelectField($field_expr_field_key,$join_num);
                }
            }
        }
        return $field_expr_select_sql;
    }
    private function getSqlStrFieldFromTableAlias($field_key,$join_num=''){
        $field_sql_str = $this->getSqlStrFieldName($field_key);
        $table_alias = $this->getSqlStrTableAliasByField($field_key,$join_num);
        $field_from_table_alias_sql = $table_alias.'.'.$field_sql_str;
        return $field_from_table_alias_sql;
    }

    private $next_group_logical_operator = "AND";
    private function getNextGroupLogicalOperator(){
        return $this->next_group_logical_operator;
    }
    private function setNextGroupLogicalOperator($logical_operator){
        $this->next_group_logical_operator = $logical_operator;
    }
    private function isOnlySoloWhereGroup($where_group){
        $is_group = isset($where_group[0]);
        if($is_group){

        }
    }
    private function processWherePileGroup($where_group ,$depth = 0, $first = true){
        $nb_in_group = count($where_group);
        $where_sql = $depth == 0 || $first ? '' : ' '.$this->getNextGroupLogicalOperator().' ';
        $where_sql .= $nb_in_group==1 ? ' ' : '(';
        foreach ($where_group as $key => $where) {
            if(isset($where[0])){
                $sub_group = $where;//$where[0];

                while(count($sub_group)==1){
                    $sub_group = $sub_group[0];
                }
                if(isset($sub_group[0])){
                    $where_sql .= $this->processWherePileGroup($sub_group,$depth+1,$key == 0);
                }else{
                    if($key>0 && $key<$nb_in_group){
                        $pre_logical_operator = isset($where['pre_logical_operator']) ? $where['pre_logical_operator'] : 'AND';
                        $where_sql .= ' '.$pre_logical_operator.' ';
                    }
                    $where_sql .= $this->processWhere($sub_group);
                }
            }else{
                if($key>0 && $key<$nb_in_group && !empty($where)){
                    $pre_logical_operator = isset($where['pre_logical_operator']) ? $where['pre_logical_operator'] : 'AND';
                    $where_sql .= ' '.$pre_logical_operator.' ';
                }
                $where_sql .= $this->processWhere($where);
            }
        }
        $where_sql .= $nb_in_group==1 ? ' ' : ')';
        return $where_sql;
    }
    public function processWhere($where){
        $where_sql = "";
        if(!empty($where)){
            $field_key = $where['prop_name'];
            $field_name = $this->getFieldConfig($field_key,'name');
            $field_alias = $this->getFieldConfig($field_key,'alias');
            $field_alias = $field_alias!=null ? $field_alias : $field_key;//$this->getFieldConfig($field_key,'alias');
            $field_as_expr = $this->getFieldConfig($field_key,'select_expr')!==null || $this->getFieldConfig($field_key,'construct_select_expr')!==null; 
            if($field_as_expr){

            }
            $table_alias = $this->getFieldTableConfig($field_key,'alias');
            $where_operator = $where['operator'];
            $pre_where_value = $where['value'];
            $next_group_logical_operator = isset($where['next_group_logical_operator']) ? $where['next_group_logical_operator'] : 'AND' ;
            $this->setNextGroupLogicalOperator($next_group_logical_operator);
            $where_value = '';

            if(is_object($pre_where_value)){
                if(get_class($pre_where_value) == 'DateTime') {
                    $pre_where_value = $pre_where_value->format('Y-m-d');
                }
            }
            if(strtoupper($where_operator)=='IN'){
                $where_value_tab = is_array($pre_where_value) ? $pre_where_value : array($pre_where_value);
                $where_value .= '(';
                foreach ($where_value_tab as $key => $value) {
                    $where_value .= $key>0 ? ',' : '';
                    $where_value .= "'".$value."'";
                }
                $where_value .= ')';
            }else if(strtoupper($where_operator)=='LIKE'){
                $where_value .='"%'.$pre_where_value.'%"';
            }else if(strtoupper($where_operator)=='START'){
                $where_operator = 'LIKE';
                $where_value .='"'.$pre_where_value.'%"';
            }else if(strtoupper($where_operator)=='END'){
                $where_operator = 'LIKE';
                $where_value .='"%'.$pre_where_value.'"';
            }else{
                $where_value .= "'".$pre_where_value."'";
            }
            if($field_as_expr){
                $where_sql = $field_alias;
            }else{
                $where_sql = $table_alias.'.'.$field_name;
            }
            $where_sql .= ' '.$where_operator.' '.$where_value.'';
        }
        return $where_sql;
    }
    public function processPilesToSql($user = null){
        $select_sql = "SELECT ";
        $at_least_a_field_in_select = false;
        foreach ($this->getSelectPile() as $key => $field_key) {
            $field = $this->getFieldConfig($field_key);

            if($field!=null){
                $field_sql = $key>0 ? ', ' : '';
                $field_sql .= $this->getSqlStrSelectField($field_key);
                $select_sql .= $field_sql;
                $at_least_a_field_in_select = true;
            }
            
        }
        $select_sql .= $at_least_a_field_in_select ? ',' : '';
        if ($user instanceof \Bilan_Social\Bundle\UserBundle\Entity\User && $user->hasRole('ROLE_INFOCENTRE')) {
            $idsDepa = $user->getIdDepaArray();
            $idsDepaStr = implode(', ', $idsDepa);
            $select_sql .= 'IF((SELECT
              c0_.ID_COLL AS ID_COLL_0
            FROM
              departement d3_
              INNER JOIN departements_enquetes de_ ON de_.ID_DEPA = d3_.ID_DEPA
              INNER JOIN collectivite c0_ ON (c0_.ID_DEPA = d3_.ID_DEPA)
              LEFT JOIN pool_item p5_ ON (p5_.ID_COLL = c0_.ID_COLL)
            WHERE
              c0_.ID_COLL IN (c.ID_COLL)
              AND de_.ID_ENQU IN (enqu.ID_ENQU)
              AND d3_.ID_DEPA IN ('. $idsDepaStr .')
            GROUP BY c0_.ID_COLL) IS NULL, true, false) AS anonyme ';
            // $select_sql .= 'IF((SELECT
            //   c0_.ID_COLL AS ID_COLL_0
            // FROM
            //   utilisateur u1_
            //   INNER JOIN user_departement u2_ ON (
            //     u1_.ID_UTIL = u2_.ID_UTIL
            //   )
            //   INNER JOIN departement d3_ ON (d3_.ID_DEPA = u2_.ID_DEPA)
            //   INNER JOIN departements_enquetes de_ ON de_.ID_DEPA = d3_.ID_DEPA
            //   INNER JOIN collectivite c0_ ON (c0_.ID_DEPA = d3_.ID_DEPA)
            //   LEFT JOIN pool_item p5_ ON (p5_.ID_COLL = c0_.ID_COLL)
            // WHERE
            //   c0_.ID_COLL IN (c.ID_COLL)
            //   AND de_.ID_ENQU IN (enqu.ID_ENQU)
            // GROUP BY c0_.ID_COLL) IS NULL, true, false) AS anonyme ';
        } else {
            $select_sql .= ' IF((SELECT 
              c0_.ID_COLL AS ID_COLL_0 
            FROM 
              utilisateur_droits u1_ 
              INNER JOIN utilisateur_cdg u2_ ON (
                u1_.ID_UTILISATEUR_CDG = u2_.ID_UTILISATEUR_CDG
              ) 
              INNER JOIN cdg_departement c3_ ON (
                u1_.ID_CDG_DEPARTEMENT = c3_.ID_CDG_DEPARTEMENT
              )
              INNER JOIN cdg_departements_enquetes cde ON cde.ID_CDG_DEPARTEMENT = c3_.ID_CDG_DEPARTEMENT
              INNER JOIN departement d4_ ON (d4_.ID_DEPA = c3_.ID_DEPA) 
              INNER JOIN departements_enquetes de_ ON de_.ID_DEPA = d4_.ID_DEPA
              INNER JOIN collectivite c0_ ON (c0_.ID_DEPA = d4_.ID_DEPA) 
              LEFT JOIN pool_item p5_ ON (p5_.ID_COLL = c0_.ID_COLL) 
            WHERE 
              u1_.ID_UTILISATEUR_CDG = '.$this->getUserCdg().' 
              AND CONV("1100000", 2, 10) & u1_.FG_DROITS = 96 
              AND c0_.ID_COLL IN (c.ID_COLL) 
              AND de_.ID_ENQU IN (enqu.ID_ENQU)
             GROUP BY c0_.ID_COLL) IS NULL,true,false) AS anonyme ';
        }
        $from = $this->getTableConfig($this->fromDefault,'name');
        $from_alias = $this->getTableConfig($this->fromDefault,'alias');
        $from_sql = 'FROM '.$from.' '.$from_alias;
        $join_sql = '';
        foreach ($this->getJoinPile() as $table_iterator => $table_join) {
            $table_join_key = key($table_join);
            $join_on_field_key = $table_join[$table_join_key];
            $table = $this->getTableConfig($table_join_key);
            if($table!=null){
                $join_on_table_key = $this->getFieldTableConfig($join_on_field_key,'key');
                $table_join_on_field_key = $this->getFieldConfig($join_on_field_key,'fieldOn');
                $table_join_on_field_key = is_array($table_join_on_field_key) ? $table_join_on_field_key : array($table_join_on_field_key);
                $table_join_type = $this->getFieldConfig($join_on_field_key,'joinType');
                $table_join_name = $this->getTableConfig($table_join_key,'name');
                $table_join_alias = $this->getTableConfig($table_join_key,'alias');
                $join_sql .= $table_join_type.' '.$table_join_name.' AS '.$table_join_alias.'
                     ON ';
                foreach ($table_join_on_field_key as $key => $a_table_join_on_field_key){
                    $is_raw_join_on = false;
                    if(is_array($a_table_join_on_field_key)){
                        $is_raw_join_on = true;
                        $raw_join_on = $a_table_join_on_field_key['raw'];
                    }else{
                        $table_join_field_name = $this->getFieldConfig($a_table_join_on_field_key,'name');
                        $table_join_field_back_ref = $this->getFieldConfig($a_table_join_on_field_key,'backRef');
                        if(isset($table_join_field_back_ref) && $table_join_field_back_ref!=null){
                            $join_on_table_alias = $this->getFieldTableConfig($table_join_field_back_ref,'alias');
                            $join_on_table_name = $this->getFieldTableConfig($table_join_field_back_ref,'name');
                            $join_on_field_name = $this->getFieldConfig($table_join_field_back_ref,'name');
                        }else{
                            $join_on_table_alias = $this->getTableConfig($join_on_table_key,'alias');
                            $join_on_table_name = $this->getTableConfig($join_on_table_key,'name');
                            $join_on_field_name = $this->getFieldConfig($join_on_field_key,'name');
                        }
                    }
                    
                    $join_sql.= $key>0 ? ' AND ' : ' ';
                    if($is_raw_join_on){
                        $join_sql .= ' '.$raw_join_on.' ';
                    }else {
                        $join_sql .= $table_join_alias . '.' . $table_join_field_name . ' = ' . $join_on_table_alias . '.' . $join_on_field_name . ' ';
                    }
                }
                
            }
        }
        $where_sql = ' ';
        $nb_in_top_group = count($this->getWherePile());
        if($nb_in_top_group>0){
            $where_sql .= 'WHERE '.$this->processWherePileGroup($this->getWherePile());
        }      
        $outer_where_sql = ' ';
        $nb_in_top_outer_group = count($this->getOuterWherePile());
        $wrapping_main_query = false;
        if($nb_in_top_outer_group>0){
            $wrapping_main_query=true;
            $outer_where_sql .= 'WHERE '.$this->processWherePileGroup($this->getOuterWherePile());
        }
        /*if($nb_in_top_group>0){
            $where_sql = 'WHERE ';
            foreach ($this->getWherePile() as $key => $where_group) {
                if($key>0 && $key<$nb_in_group){
                    $pre_logical_operator = isset($where['pre_logical_operator']) ? $where['pre_logical_operator'] : 'AND';
                    $where_sql .= ' '.$pre_logical_operator.' ';
                }
                if(isset($where_group[0])){
                    $where_sql .= $this->processWherePileGroup($where_group, $key);
                }else{
                    $where_sql .= $this->processWhere($where_group);
                }
                
            }
        }*/
        $query = $select_sql.' '.$from_sql.' '.$join_sql.' '.$where_sql.' GROUP BY c.ID_COLL, enqu.ID_ENQU';
        if($wrapping_main_query){
            $query = 'SELECT * FROM ('.$query.') AS main_query '.$outer_where_sql;
        }

        return $query;
    }
    
    public function executeQuery($query_str,$pdo_fecth_options=array(),$boolAnneeCamp = false){


        $anne_camp = $this->sessionManager->get("anneeCamp");
        $current_annee_campagne = $this->sessionManager->get('current_annee_campagne');
        if(isset($anne_camp) and !empty($anne_camp)){
            $array_result = array();
            foreach ($anne_camp as $key => $value){
                $base_key = $current_annee_campagne == $value ? 'bs' : $value;
                $connection_other_bdd = $this->servicebdd->getPdoConnection($base_key);
                $query = $connection_other_bdd->prepare($query_str);
                $query->execute();
                extract($pdo_fecth_options);

                $array_result_temp = $query->fetchAll(PDO::FETCH_ASSOC);
                $array_result  = array_merge($array_result, $array_result_temp);



            }

            $this->sessionManager->remove("anneeCamp");

            return $array_result;

        }else{
            $query = $this->em->getConnection()->prepare($query_str);
            $query->execute();
            extract($pdo_fecth_options);
            $pdo_fetch_style = isset($pdo_fetch_style) ? $pdo_fetch_style : PDO::FETCH_ASSOC;
            $pdo_fecth_args = isset($pdo_fecth_args) ? $pdo_fecth_args : null;
            return $query->fetchAll($pdo_fetch_style, $pdo_fecth_args);
        }




    }
    public function getAllFromTable($table_key,$fields_key=null,$options=null){
        //$table_name = $this->getTableConfig($table_key,'name');
        $table_name = $this->getSqlStrTableFull($table_key);
        $sql = "SELECT ";
        if(is_array($options)) extract($options);
        if($fields_key!==null){
            $fields_key = is_array($fields_key) ? $fields_key : array($fields_key);
            foreach ($fields_key as $key => $field_key) {
                $sql .= $key>0 ? ', ' : '';
                $field_with_alias_sql = $this->getSqlStrSelectField($field_key);
                $field_sql = $this->getSqlStrFieldFromTableAlias($field_key);
                if(isset($distinct_field)){
                    if(is_array($distinct_field) && in_array($field_key, $distinct_field)){
                        $sql .= " DISTINCT ";
                    }
                }
                $sql .= " ".$field_sql." ";
            }
        }else{
            if(isset($distinct_field)){
                $sql .= " DISTINCT ";
            }
            $sql .= " * ";
        }
        $sql .= "FROM ".$table_name;
        if(isset($group_by)){
            $field_with_alias_sql = $this->getSqlStrSelectField($group_by);
            $sql .= ' GROUP BY '.$field_with_alias_sql.' ';
        }
        if(isset($order_by_field)){
            $order_by = isset($order_by) ? $order_by : 'ASC';
            $field_with_alias_sql = $this->getSqlStrSelectField($order_by_field);
            $sql .= " ORDER BY ".$field_with_alias_sql.' '.$order_by;
        }
        if(isset($limit)){
            $sql .= " LIMIT ".$limit;
        }
        return $sql;
    }
    public function getFieldListAsRef($field_key,$field_value,$options=null){
        $table_name = $this->getSqlStrTableFullByField($field_key);
        $field_with_alias_sql = $this->getSqlStrSelectField($field_key);
        $field_sql = $this->getSqlStrField($field_key);
        $order_by = null;
        $sql = "SELECT DISTINCT ".$field_with_alias_sql." FROM ".$table_name." WHERE ".$field_sql." LIKE \"".$field_value."%\"";
        if(isset($options)){
            extract($options);
            if(isset($group_by)){
                $sql .= ' GROUP BY '.$field_with_alias_sql.' ';
            }
            if(isset($order_by_field)){
                $order_by = isset($order_by) ? $order_by : 'ASC';
                $field_with_alias_sql = $this->getSqlStrSelectField($order_by_field);
                $sql .= " ORDER BY ".$field_with_alias_sql.' '.$order_by;
            }
            if(isset($limit)){
                $sql .= ' LIMIT '.$limit;
            }
        }
        //return $sql;
        return $this->executeQuery($sql,array('pdo_fetch_style'=>\PDO::FETCH_COLUMN,'pdo_fecth_args'=>0),true);
    }
    public function getFromSrcConfig($src_config){
        try{
            $to_get = array();
            $table_key = $src_config['table'];
            $map_by = isset($src_config['map_by_key']) ? $src_config['map_by_key'] : null;
            $options = array();
            if(isset($src_config['group_by'])) $option['group_by'] = $src_config['group_by'];
            if(isset($src_config['limit'])) $option['group_by'] = $src_config['group_by'];
            $option['distinct_field'] = $map_by;
            $option['order_by_field'] = $map_by;
            if(isset($src_config['order_by'])) $option['group_by'] = $src_config['group_by'];
            $fields_to_select = null;
            $to_get_values = null;
            if(!is_array($map_by)){
                $fields_to_select = array($map_by);
                $to_get_values = isset($src_config['get_values']) ? $src_config['get_values'] : null;
                if(isset($to_get_values)) $fields_to_select[] = $to_get_values;
            }else{
                $to_get_values = isset($src_config['get_values']) ? $src_config['get_values'] : null;
            }
            $query_result = $this->executeQuery($this->getAllFromTable($table_key,$fields_to_select,$options));


            
            $nb_to_get_values;
            
            if($map_by!=null || $to_get_values!=null){
                if($to_get_values!=null){
                    $to_get_values = is_array($to_get_values) ? $to_get_values : array($to_get_values);
                    $nb_to_get_values = count($to_get_values);
                }
                foreach($query_result as $row_key => $row){
                    $map_by_value = '';
                    if(is_array($map_by)){
                        $to_call = isset($map_by['call']) ? $map_by['call'] : null;
                        $with_params = isset($map_by['with_params']) ? $map_by['with_params'] : null;
                        $temp_real_key = $row_key;
                        if(is_callable($to_call)){
                            array_unshift($with_params,$row);
                            $temp_real_key = call_user_func_array($to_call,$with_params);
                        }else if(method_exists($this, $to_call)){
                            $temp_real_key = $this->$to_call($row,$with_params);
                        }
                        $map_by_value = $temp_real_key;
                    }else{
                        $temp_key = $map_by!=null ? $this->getFieldConfig($map_by,'name') : $row_key;
                        $map_by_value = $row[$temp_key];
                    }
                    if($to_get_values!=null){
                        $temp_row = array();
                        foreach ($to_get_values as $key => $to_get_key) {
                            $to_get_field_name = $this->getFieldConfig($to_get_key,'name');
                            if($nb_to_get_values==1){
                                $temp_row=$row[$to_get_field_name];
                                break;
                            }else{
                                $temp_row[]=$row[$to_get_field_name];
                            }
                        }
                        $to_get[$map_by_value]=$temp_row;
                    }
                }
            }else{
                $to_get = $query_result;
            }
        }catch(Exception $e){
            dump($e->getMessage());
        }
        return $to_get;
    }
    public function getFilterResult($user = null){
        $sql = $this->processPilesToSql($user);
        return $this->executeQuery($sql);
    }

    /*
    *   fonctions build in pour le get from source
    */
    public function concatRowData($row_data,$to_concat){
        $str_concat = '';
        foreach ($to_concat as $key => $maybe_field_key) {
            $temp_concat = '';
            if($this->getFieldConfig($maybe_field_key)!=null){
                $field_name = $this->getFieldConfig($maybe_field_key,'name');
                $field_alias = $this->getFieldConfig($maybe_field_key,'alias');
                if(isset($row_data[$field_name])){
                    $temp_concat = $row_data[$field_name];
                }else if(isset($row_data[$field_alias])){
                    $temp_concat = $row_data[$field_alias];
                }
            }else if(is_string($maybe_field_key)){
                $temp_concat = $maybe_field_key;
            }
            $str_concat .= $temp_concat;
        }
        return $str_concat;
    }


    /*
    *   fonction retournant la liste des champs allant être renvoyer par le select
    */
    public function getSelectField(){
        $this->processToPiles();
        return $this->getSelectPile();
    }
}