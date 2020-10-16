<?php

if (!function_exists('is_iterable')) {
    function is_iterable($obj)
    {
        return is_array($obj) || $obj instanceof \Traversable;
    }
}

function getFromOr($to_get,$from,$default=null){
    $value = $from;
    if(!empty($to_get)){
        $to_get = is_array($to_get) ? $to_get : array($to_get);
        $get_key = array_shift($to_get);
        if($get_key!=null){
            if(is_iterable($from) && isset($from[$get_key])){
                $value = $from[$get_key];
                if(!empty($to_get)){
                    $value = getFromOr($to_get,$value,$default);
                }
            }else{
                $value = $default;
            }
        }else{
            $value = $default;
        }
    }
    return $value;
}

function file_log_error($file,$msg,$options = array()){
	if($file!=null){
		$msg = is_array($msg) ? $msg : array($msg);
		$prefix = isset($options['prefix']) ? $options['prefix'].' - ' : '';
		$with_date = isset($options['with_date']) ? $options['with_date']==true : true;
		$date_format = isset($options['date_format']) ? $options['date_format'] : 'Y-m-dTh:i:s';
		if(is_array($file)){
			$file_tab = $file;
			$prefix = empty($prefix) && $file_tab['prefix'] ? $file_tab['prefix'].' - ' : $prefix;
			$with_date = empty($with_date) && $file_tab['with_date'] ? $file_tab['with_date']==true : $with_date;
			$date_format = empty($date_format) && $file_tab['date_format'] ? $file_tab['date_format'] : $date_format;	
			$file = $file_tab['log_file_full_name'] ? $file_tab['log_file_full_name'] : null;	
		}
		if($file!=null){
			$date = '';
			if($with_date){
				$date = getDateNow($date_format).' - ';
			}
			try{
				foreach($msg as $k => $txt){ 
					$last_log = error_log($prefix.$date.$txt."\n\r",3,$file);
					if(!$last_log){
						break;
					}
				}
				return $last_log;
			}catch(\Exception $e){
				throw $e;
			}
		}
	}
	return false;
}

function getDateNow($format='Y-m-dTh:i:s'){
	return date($format);
}

function isGetterOn($prop_name,$obj_on){
	$getter_name = 'get'.ucfirst($prop_name);
    if(method_exists($obj_on,$getter_name)){
    	return $getter_name;
    }else{
    	return false;
    }
}
function useGetterOnOr($prop_name,$obj_on,$default=null){
	if(($getter_name = isGetterOn($prop_name,$obj_on))!==false){
        return $obj_on->$getter_name();
    }else{
    	return $default;
    }
}

function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + $ru["ru_$index.tv_usec"]/1000)
     -  ($rus["ru_$index.tv_sec"]*1000 + $rus["ru_$index.tv_usec"]/1000);
}

function startRuUsage($msg = null){
	$msgs = array();
	if($msgs!==null) $msgs[] = $msg;
	exportHrgLog($msgs);
	$start_time = microtime(true);
	return $start_time;
}

function endRuUsage($msg,$ru_start){
	$msgs = array();
	$end_time = microtime(true);
	$delta_time = $end_time - $ru_start;
	if($msgs!==null) $msgs[] = $msg;
	$msgs[] = 'temps passé : '.$delta_time.' s';
	exportHrgLog($msgs);
}

function exportHrgLog($msg){
	$log_file = __DIR__.'/../var/logs/hrg_execution_time.txt';
	file_log_error($log_file, $msg);
}

function parseCsvToArray(string $string,$options = array()){
    $line_delimiter = getFromOr('line_delimiter',$options,"\n");
    $col_delimiter = getFromOr('col_delimiter',$options,",");
    $rows_data = explode($line_delimiter,trim($string));
    $data = array_map(function($line) use ($col_delimiter){
    	return str_getcsv($line,$col_delimiter);
	}	, $rows_data);
    return $data;
}

function reverseArrayBy($tab, $by_key){
	$reverse_tab = array();
	foreach ($tab as $key => $value){
		if($value!=null && is_object($value)){
			$getter = 'get'.ucfirst($by_key);
			if(method_exists($value,$getter)){
				$temp_key = $value->$getter();
				$reverse_tab[$temp_key]=$value;
			}
		}
	}
	return $reverse_tab;
}

?>
