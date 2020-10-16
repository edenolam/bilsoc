<?php
/*
*	Service permettant de charger les différents fichier de l'InfoCentreBundle
*/
namespace Bilan_Social\Bundle\BilanSocialBundle\Services;

use Symfony\Component\Finder\Finder;

Class ConfigFinder {
    private $jsonFile = 'config_init.json';
    private $config_base_path = __DIR__.'/../Resources/data/';


    public function getJsonConfigfile(){
        $json = file_get_contents(  $this->config_base_path.$this->jsonFile);
        //Decode JSON
        $array = json_decode($json,true);
        return $array;
    }
}