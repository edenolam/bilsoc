<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BilanSocialConsolideConditionsInd413Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('r4131', PurifiedNumberType::class, array(
                        'label' => false,
                        'required' => true,
                        'label_attr' => array('id' => 'r4131'),
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR413(this); changedDetect();',
                        )
                    ))
                ->add('r4132', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => true,
                    'label_attr' => array('id' => 'r4132'),
                    'attr' => array(
                        'class' => 'ind110 positiveInteger',
                        'onChange'=> 'changedR413(this); changedDetect();',
                    )
                ))                
                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))
                
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscForm413';
    }

}
