<?php
/*
*	Service permettant de charger les différents fichier de l'InfoCentreBundle
*/
namespace Bilan_Social\Bundle\InfoCentreBundle\Services;

use Symfony\Component\Finder\Finder;

Class ConfigFinder {
	private $finder;
	private $config_base_path = __DIR__.'/../Resources/data/';
	private $files_config = array(
		'filters'=>array(
			'name'=>'filters_config.json',
		),
		'filters_object'=>array(
			'name'=>'filters_object_config.json'
		),
		'filterFormView'=>array(
			'name'=>'filter_form_view.json'
		),
		'bddMap'=>array(
			'name'=>'bdd_map.json'
		),
        'filter_departement'=>array(
			'name'=>'filters_departement_config.json'
		),
        'filter_departement_form_view'=>array(
			'name'=>'filter_departement_form_view.json'
		)
	);
	public function getConfigBasePath(){
		return $this->config_base_path;
	}
	public function getRawFilesConfig($config_name=null){
		$files_config = $this->files_config;
		if(isset($config_name)){
			$files_config = getFromNestedConfig($files_config,$config_name);
		}
		return $files_config;
	}
	public function getConfigFileConfig($config_name,$sub_config_name=null){
		$params = $config_name;
		if(isset($sub_config_name) && $sub_config_name){
			$params = mergeIntoFlatArray(array($config_name,$sub_config_name));
		}
		$config = $this->getRawFilesConfig($params);
		return $config;
	}
	private $loaded_config = array();

	public function __construct(){
		$this->finder = new Finder();
		$this->loadAllConfig();
	}

	/*
	*
	*
	*/
	private function addLoadedConfig($config_name,$config_loaded,$force=false){
		$force = $force===true ? true : false;
		if($config_loaded!=null && (!$this->isConfigInLoaded($config_name) || $force)){
			$this->loaded_config[$config_name] = $config_loaded;
		}
	}
	public function loadConfig($config_name,$options=false){
		$force = !is_bool($options) ? getBooleanFromArrayKey($options,'force',false,false) : $options;
		$save_loaded = getBooleanFromArrayKey($options,'save_loaded',false,true);
		if(!$this->isConfigInLoaded($config_name) || $force){
			$config_file_name = $this->getConfigFileConfig($config_name,'name');
			$config_file_path = $this->getConfigFileConfig($config_name,'path');
			if($config_file_path!=null){
				$this->finder->in($config_file_path);
			}else{
				$this->finder->in($this->getConfigBasePath());
			}
			$this->finder->files()->name($config_file_name);
			$loaded_config = readOneFileFromFinder($this->finder, $config_file_name, 'json');
            $this->addLoadedConfig($config_name, $loaded_config);
		}
	}
	public function loadAllConfig(){
		foreach ($this->getRawFilesConfig() as $config_name => $config) {
			$this->loadConfig($config_name);
		}
	}
	public function isConfigInLoaded($config_name){
		return isset($this->loaded_config[$config_name]);
	}
	public function getConfigFromLoaded($config_name,$sub_config_name=null){
		$config=null;
		if($this->isConfigInLoaded($config_name)){
			$config = $this->loaded_config[$config_name];
			if(isset($sub_config_name)){
				$files_config = getFromNestedConfig($config,$sub_config_name);
			}
		}
		return $config;
	}
	public function getConfig($config_name,$sub_config_name=null){
		$config = null;
		if(!$this->isConfigInLoaded($config_name)){
			$this->loadConfig($config_name);
		}
		$config = $this->getConfigFromLoaded($config_name,$sub_config_name);
		return $config;
	}
}

function getBooleanFromArrayKey($tab,$key,$strict=false,$default=false){
	$bool_result;
	$take_default = false;
	if(is_array($tab)){
		if(isset($tab[$key])){
			$bool_result = (($tab[$key]===true && $strict) || $tab[$key]==true);
		}else{
			$take_default = true;
		}
	}else{
		$take_default = true;
	}
	if($take_default){
		$bool_result = $default;
	}
	//$bool_result = is_array($tab) && isset($tab[$key]) && (($tab[$key]===true && $strict) || $tab[$key]==true) ? true : $tab[$key]===true ? true : false;
	return $bool_result;
}
function getFromNestedConfig($config_root,$configs_name){
    $config_to_return=null;
   
    if($config_root != null && $configs_name!=null){
        if(is_array($configs_name)){
            $next_config = $configs_name[0];
            array_splice($configs_name,0,1);
            if($next_config==null){
                $config_to_return = $config_root;
            }else if(count($configs_name)==0){
                $config_to_return = isset($config_root[$next_config]) ? $config_root[$next_config] : null;
            }else if(isset($config_root[$next_config])){
                $config_to_return = getFromNestedConfig($config_root[$next_config],$configs_name);
            }

        }else{
            $config_to_return = isset($config_root[$configs_name]) ? $config_root[$configs_name] : null;      
        }
    }
    return $config_to_return;
}
function mergeIntoFlatArray($params){
	$params_to_return = array();
	foreach ($params as $key => $param){
		if(is_array($param)){
			$params_to_return = array_merge($params_to_return, $param);
		}else{
			array_push($params_to_return, $param);
		}
	}
	return $params_to_return;
}
/*
*   fonction récupérant le premier fichier trouvé par un Finder
*       applique optionnellement un fonction de décodage
            - string : "json" => json_decode()
            - function : appel de la fonction avec le contenu du fichier en paramètre
                @param string $files_content, le contenu du fichier
                @return string, le contenu du fichier traité
*/
function readOneFileFromFinder($finder, $file_name = null, $decode = false)
{
    $file_content = null;
    foreach ($finder as $key => $file) {
        $files_content = $file->getContents();
        if ($decode == 'json') {
            $file_content = json_decode($files_content, true);
        } else if (is_callable($decode)) {
            $file_content = $decode($files_content);
        }
        if ($file_name != null) {
            if ($file_name == $file->getFileName()) {
                break;
            } else {
                $file_content = null;
            }
        } else {
            break;
        }
    }
    return $file_content;
}
?>