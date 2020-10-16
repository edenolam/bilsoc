<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Bilan_Social\Bundle\ApaBundle\Entity\Traits;

use Symfony\Component\Finder\Finder;
/**
 * Description of BilanSociaLAgentTrait
 *
 * @author mbusson
 */
Trait BilanSociaLAgentTrait {
    public function __construct() {
        
        
    }
    
    public function getJsonContent(){
        
        $finder = new Finder();
        $finder->in(__DIR__."/../../Resources/config/data/")->files()->name('config_show_hide_bilan_social_agent.json');
        $this->finder = $finder;
        
        foreach ($finder as $file) {
            $contents = $file->getContents();
        }
        return json_decode($contents,true);
    }
}
