<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnqueteCollectiviteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('blBilasocivide')->add('blBilasoci')->add('blRast')->add('blHand')->add('blGepe')->add('blGpeecPlus')->add('blApa')->add('blCons')->add('blN4ds')->add('blBasecarr')->add('blDgcl');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\EnqueteBundle\Entity\EnqueteCollectivite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_enquetebundle_enquetecollectivite';
    }


}
