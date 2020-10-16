<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ModificationCollectiviteForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('blModi', ChoiceType::class, array(
                    'label' => 'Souhaitez-vous importer en masse les infos de vos collectivités ?',
                    'choices'  => array('Oui' => true, 'Non' => false),
                    'expanded' => true,
                    'multiple' => false,
                ));
    }

    public function getBlockPrefix() {
            return 'modificationCollectivite';
    }

}

