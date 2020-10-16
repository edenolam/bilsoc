<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BscDgclJoursCarenceTitulaire;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BscDgclJoursCarenceTitulaireType extends BscDgclJoursCarenceBaseType
{
	/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BscDgclJoursCarenceTitulaire::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dgcljourscarencetitulairer';
    }
}