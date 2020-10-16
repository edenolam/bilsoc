<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Bilan_Social\Bundle\ReferencielBundle\Services;

use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
/**
 * Description of CheckDroits
 *
 * @author mbusson
 */
class CheckDroits {
    public function checkDroitEcritureEnquete($fgDroit){
        $verif = false;
        
        if((($fgDroit & bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE)) === bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE))){
            $verif = true;
        }
        return $verif;
    }
}
