<?php

namespace Bilan_Social\Bundle\UserBundle\Validator\Constraints;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Description of ConstraintDGCL
 *
 * @author mbusson
 * 
 * appel a cette contrainte mis en commentaire dans l'entité, problème de token a null pour la reinitialisation du mot de passe
 * 
 */
class ConstraintDGCLValidator  extends ConstraintValidator {
    
     /** @var TokenStorageInterface|SecurityContextInterface */
    protected $tokenStorage;

    /** @param TokenStorageInterface|SecurityContextInterface $token_storage */
    public function __construct(TokenStorageInterface $token_storage)
    {
        $this->tokenStorage = $token_storage;
    }
    
    public function validate($value, Constraint $constraint)
    {
       
        $currentUser = $this->tokenStorage->getToken()->getUser();
       
        if($currentUser->hasRole('ROLE_DGCL')){
            
            if (strlen($value) < 15) {
                $this->context->buildViolation($constraint->message)
                ->addViolation();
            }
        }
       
    }
}
