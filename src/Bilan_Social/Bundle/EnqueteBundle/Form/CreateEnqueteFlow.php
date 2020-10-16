<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreateEnqueteFlow extends FormFlow {
        
	protected $allowDynamicStepNavigation = true;
        
         private $currentUser;
         private $departements;
         private $em;

        public function __construct($em, $tokenStorage)
        {
            $this->em = $em;
            $this->currentUser = $tokenStorage->getToken()->getUser();
            $this->departements = $this->getDepartements();
            
        }
	protected function loadStepsConfig() {
		return array(
                        array(
				'label' => "Etape 1<br>Création de l'enquête",
				'form_type' => 'Bilan_Social\Bundle\EnqueteBundle\Form\InfosEnqueteType',
                                'form_options' => array(
                                    'departements' => $this->departements,
                                    'user' => $this->currentUser,
                                    'status' => 'edit'
                                )
			),
			array(
				'label' => 'Etape 2<br>Modification des collectivités',
				'form_type' => 'Bilan_Social\Bundle\EnqueteBundle\Form\ModificationCollectiviteForm',
			),
			/*array(
				'label' => 'Etape 3<br>??',
				'form_type' => 'Bilan_Social\Bundle\EnqueteBundle\Form\ModificationCollectiviteForm',
			),*/
//			array(
//				'label' => 'Etape 3<br>Informations de l\'enquête',
//				'form_type' => 'Bilan_Social\Bundle\EnqueteBundle\Form\InfosEnqueteForm',
//			),
			array(
				'label' => 'Etape 3<br>Paramétrage de l\'enquête',
				'form_type' => 'Bilan_Social\Bundle\EnqueteBundle\Form\ParametrageEnqueteForm',
			),
		);
	}
        
        public function getDepartements(){
           
            $departements = $this->em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByUtilisateur($this->currentUser);
            return $departements;
        }
}