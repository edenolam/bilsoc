<?php
/*
*   Modèle de mapping de Class, utilisé pour les DynamicClass 
*/
namespace Bilan_Social\Bundle\CoreBundle\Model;

Class ClassMap{
    /*
    *   constante représentant les types de sources de données :
    *       SQL_DATA_SRC -> d'un requête mysql => le paramètre src doit être un tableau conteneant les paramètre de la requête
    *       BUILD_IN_DATA_SRC -> d'une source de données comprise dans la ClassMap => le paramètre src doit être la constante représentant la source de données
    *       RAW_MANUAL_DATA_SRC -> source de données brutes => le paramètre src sera utilisé tel-quel 
    */
    const SQL_DATA_SRC = 'SQL_DATA_SRC';
    const BUILD_IN_DATA_SRC = 'BUILD_IN_DATA_SRC';
    const RAW_MANUAL_DATA_SRC = 'RAW_MANUAL_DATA_SRC';

    /*
    *   source de données build in, sera utilisé comme une RAW_MANUAL_DATA_SRC 
    */
    const YES_NO_DATA_SRC = 'YES_NO_DATA_SRC';
    const TYPE_INIT_BILAN_DATA_SRC = 'TYPE_INIT_BILAN_DATA_SRC';
    const TYPE_ENQU_COLL_DATA_SRC = 'TYPE_ENQU_COLL_DATA_SRC';
    const STATUT_BILAN_DATA_SRC = 'STATUT_BILAN_DATA_SRC';
    const ANNEE_CAMP_PUIT_DE_DONNEE_DATA_SRC = 'ANNEE_CAMP_PUIT_DE_DONNEE_DATA_SRC';

    private static $build_in_data_src_pile_static = array(
        self::YES_NO_DATA_SRC=>array('oui'=>1,'non'=>0),

        /*
        *   Tableau a augmenter tout les ans, a chaque fois qu'une base de donnée est crée pour le puit de donnée pour les rendre disponibles dans l'infocentre
        */
        self::ANNEE_CAMP_PUIT_DE_DONNEE_DATA_SRC=> array(
            "2018" => 2018,
            "2017" => 2017
        ),
        self::TYPE_INIT_BILAN_DATA_SRC=>array(
            'Manuelle'=>'manu',
            'DGCL'=>'bs-dgcl',
            'N4DS'=>'n4ds',
            'Base Carrière'=>'basecarr',
            'Bilan à vide'=>'bs-vide'
        ),
        self::STATUT_BILAN_DATA_SRC=>array(
            'En cours de saisie'=>0,
            'Transmis'=>1,
            'Validé'=>2,
            'Non validé'=>3,
            'En cours de saisie suite à non validation'=>4,
            'Nouvelle transmission en attente de validation'=>5,
            'Non connecté'=>6,
            'Non saisi'=>7,
            'Saisie réinitialisée'=>8,
        ),
        self::TYPE_ENQU_COLL_DATA_SRC=>array(
            'GPEEC'=>0,
            'RASST'=>1,
            'Handitorial'=>2,
        ),

    );
    #private $build_in_data_src_pile = self::$build_in_data_src_pile_static;

    public static function getBuildInDataSrc($build_in_data_src_key){
        $data_src = array();
        if(isset(self::$build_in_data_src_pile_static[constant('self::'.$build_in_data_src_key)])){
            $data_src = self::$build_in_data_src_pile_static[constant('self::'.$build_in_data_src_key)];
        }
        return $data_src;
    }
    /*public function getBuildInDataSrc($build_in_data_src_key){
        $data_src = array();
        if(isset($this->build_in_data_src_pile[self::$build_in_data_src_key])){
            $data_src = $this->build_in_data_src_pile[self::$build_in_data_src_key];
        }
        return $data_src;
    }*/

    protected $raw_config = array();
    protected $properties_map = array();
    protected $raw_config_default_values = array(
        'private'=>false,
        'form_field'=>true,
        'data_type'=>'string',
        'form_options'=>array(
            'required'=>false,
        ),
        'active'=>true,
    );
    public function __construct($class_config){
        $this->raw_config = $class_config;
        $this->ProcessRawMap();
    }

    public function ProcessRawMap($raw_map=null){
        $raw_map = isset($raw_map) ? $raw_map : $this->raw_config;
        $prop_map=array();
        foreach ($raw_map as $key => $config) {
            $prop_name = isset($config['name']) ? $config['name'] : null;
            $prop_is_active = isset($config['active']) ? $config['active'] : true;
            if($prop_name!=null && $prop_is_active){
                foreach ($this->raw_config_default_values as $config_key => $config_value) {
                    if(!isset($config[$config_key])){
                        $config[$config_key]=$config_value;
                    }else if(is_array($config_value)){
                        $config[$config_key]=$this->processNestedDefaultConfig($config_value,$config[$config_key]);
                    }
                }
                $raw_map[$key]=$config;
                $prop_map[$prop_name]=$config;
                
            }
        }
        $this->properties_map = $prop_map;
    }
    public function processNestedDefaultConfig($config_to_process,$current_config){
        foreach ($config_to_process as $config_key => $config_value) {
            if(!isset($current_config[$config_key])){
                $current_config[$config_key]=$config_value;
            }else if(is_array($config_value)){
                $current_config[$config_key]=$this->processNestedDefaultConfig($config_value,$current_config[$config_key]);
            }
        }
        return $current_config;
    }
    public function getPropertiesMap(){
        return $this->properties_map;
    }
    public function getPropConfig($prop_name){
        return isset($this->properties_map[$prop_name]) ? $this->properties_map[$prop_name] : null;
    }
    public function getPropParam($prop_name,$param_name){
        $prop_config = $this->getPropConfig($prop_name);
        return $prop_config!=null && isset($prop_config[$param_name]) ? $prop_config[$param_name] : null; 
    }
    public function isPropPrivate($prop_name){
        return $this->getPropParam($prop_name,'private')==true;
    }
    public function isPropForForm($prop_name){
        return $this->getPropParam($prop_name,'form_field')==true;
    }
}