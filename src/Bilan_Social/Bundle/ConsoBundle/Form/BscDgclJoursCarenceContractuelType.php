<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BscDgclJoursCarenceContractuel;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BscDgclJoursCarenceContractuelType extends BscDgclJoursCarenceBaseType
{
	/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BscDgclJoursCarenceContractuel::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dgcljourscarencecontractuel';
    }
}