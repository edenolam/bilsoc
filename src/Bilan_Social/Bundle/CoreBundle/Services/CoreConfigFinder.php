<?php
/*
*	Service permettant de charger les différents fichier de l'InfoCentreBundle
*/
namespace Bilan_Social\Bundle\CoreBundle\Services;

//use Symfony\Component\Finder\Finder;

Class CoreConfigFinder extends BaseConfigFinder{
	//const __ITER_CONFIG__ = "__ITER_CONFIG__";
	//protected $finder;
	protected $config_base_path = __DIR__.'/../Resources/data/';
	protected $files_config = array(
		'data_weel_bsltm'=>array(
			'name'=>'data_weel_bsltm.json',
		)
	);
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
}