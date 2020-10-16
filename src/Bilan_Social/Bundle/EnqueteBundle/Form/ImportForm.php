<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ImportForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('blImport', ChoiceType::class, array(
                    'label' => 'Souhaitez-vous importer votre base carrière ?',
                    'choices'  => array(
                        'Oui' => true,
                        'Non' => false
                    ),
                    'expanded' => true,
                    'multiple' => false
                ));
    }

    public function getBlockPrefix() {
            return 'import';
    }

}

