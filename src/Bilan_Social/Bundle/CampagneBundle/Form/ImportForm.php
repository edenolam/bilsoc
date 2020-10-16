<?php

namespace Bilan_Social\Bundle\CampagneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ImportForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('blImport', ChoiceType::class, array(
                    'label' => 'Souhaitez-vous importer votre base INSEE / BANATIC ?',
                    'choices'  => array('Oui' => true,
                        'Non' => false,
                    ), 
                    'expanded' => true,
                    'multiple' => false,
                ));
    }

    public function getBlockPrefix() {
            return 'import';
    }

}

