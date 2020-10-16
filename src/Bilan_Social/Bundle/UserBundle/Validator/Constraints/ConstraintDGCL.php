<?php

namespace Bilan_Social\Bundle\UserBundle\Validator\Constraints;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Symfony\Component\Validator\Constraint;
/**
 * Description of ConstraintDGCL
 *
 * @author mbusson
 */

/**
 * @Annotation
 */
class ConstraintDGCL  extends Constraint{
    public $message = 'Le mot de passe doit contenir au minimum 15 caractère';
    
//    public function validatedBy()
//    {
//        return 'dgcl_constraint_validator';
//    }
}
