<?php

namespace Bilan_Social\Bundle\CampagneBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreateCampagneFlow extends FormFlow {

	protected $allowDynamicStepNavigation = true;

	protected function loadStepsConfig() {
		return array(
			array(
				'label' => 'Etape 1<br>Import de la base',
				'form_type' => 'Bilan_Social\Bundle\CampagneBundle\Form\ImportForm',
			),
			array(
				'label' => 'Etape 2<br>Validation des référentiels',
			),
			array(
				'label' => 'Etape 3<br>Informations de la campagne',
				'form_type' => 'Bilan_Social\Bundle\CampagneBundle\Form\CampagneType',
			),
		);
	}

}