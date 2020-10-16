<?php
/*
*	Service permettant de charger les différents fichier de l'InfoCentreBundle
*/
namespace Bilan_Social\Bundle\CoreBundle\Services;

use Symfony\Component\Finder\Finder;

Class BaseConfigFinder {
	const __ITER_CONFIG__ = "__ITER_CONFIG__";
	protected $finder;
	protected $config_base_path = __DIR__.'/../Resources/data/';
	protected $files_config = array();
	/*
		exemple
		array(
			'config_key_1'=>array(
				'name'=>'path_to_file_1.json',
			),
			'config_key_2'=>array(
				'name'=>'path_to_file_2.json',
			),
			...
		);
	*/
	public function getConfigBasePath(){
		return $this->config_base_path;
	}
	public function setConfigBasePath($path){
		$this->config_base_path = $path;
	}
	public function getConfigList(){
		return $this->files_config;
	}
	public function addConfigFile($config_key,$file_path=null){
		$current_config = $this->getConfigList();
		if($file_path==null){
			if(is_array($config_key)){
				foreach ($config_key as $c_key => $config_path) {
					$this->addConfigFile($c_key,$config_path);
				}
			}
		}else{
			if(is_array($file_path)){
				$current_config[$config_key]=$file_path;
			}else{
				$current_config[$config_key]=array('name'=>$file_path);
			}
		}
		$this->files_config = $current_config;
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
	protected $loaded_config = array();

	public function __construct(){
		$this->finder = new Finder();
		$this->loadAllConfig();
	}

	/*
	*
	*
	*/
	protected function addLoadedConfig($config_name,$config_loaded,$force=false){
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
				$config = getFromNestedConfig($config,$sub_config_name);
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
	public function extractToPlainArray($config_name,$prop_key_to_plain,$sub_config_name=null,$options=array()){
		$config = getConfig($config_name,$sub_config_name);
		$plainData = array();
		$options['distinct'] = isset($options['distinct']) ? $options['distinct'] : false;
		if(is_iterable($config)){
			foreach ($config as $key => $value) {
				if(isset($value[$prop_key_to_plain])){
					$current_value_to_plain = $value[$prop_key_to_plain];
					if(!in_array($current_value_to_plain, $plainData) || !$options['distinct']){
						array_push($plainData, $current_value_to_plain);
					}
				}
			}
		}
		return $plainData;
	}
	public function extractToReverseArray($config_name,$prop_key_to_plain,$sub_config_name=null,$options=array()){
		$config = getConfig($config_name,$sub_config_name);
		$reverseData = array();
		$options['preserve_first'] = isset($options['preserve_first']) ? $options['preserve_first'] : false;
		if(is_iterable($config)){
			foreach ($config as $key => $value) {
				if(isset($value[$prop_key_to_plain])){
					$current_value_to_plain = $value[$prop_key_to_plain];
					if(!in_array($current_value_to_plain, $plainData) || !$options['preserve_first']){
						$reverseData[$current_value_to_plain] = $value;
					}
				}
			}
		}
		return $reverseData;
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
            }else if($next_config==BaseConfigFinder::__ITER_CONFIG__){
            	$config_to_return = getFromIterConfig($config_root,$configs_name);
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
function getFromIterConfig($config_root,$configs_name){
		$configs = array();
		if(is_iterable($config_root)){
			foreach ($config_root as $key => $config){
				$current_config = getFromNestedConfig($configs_name);
				array_push($configs, $current_config);
			}
		}
		return $current_config;
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