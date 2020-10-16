<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind162Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BilanSocialConsolideEffectifInd162Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('r16211', PurifiedNumberType::class, array(
                        'label' => false,
                        'required' => true,
                        'label_attr' => array('id' => 'r16211'),
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR162(); changedDetect();',
                        )
                    ))
                ->add('r16212', PurifiedNumberType::class, array(
                        'label' => false,
                        'required' => true,
                        'label_attr' => array('id' => 'r16212'),
                        'attr' => array(
                                'class' => 'ind110 positiveInteger',
                                'onChange'=> 'changedR162(); changedDetect();',
                            )
                    ))
                ->add('r16213', PurifiedNumberType::class, array(
                        'label' => false,
                        'required' => true,
                        'label_attr' => array('id' => 'r16213'),
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR162(); changedDetect();',
                        )
                    ))
                ->add('r16214', PurifiedNumberType::class, array(
                        'label' => false,
                        'required' => true,
                        'label_attr' => array('id' => 'r16214'),
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR162(); changedDetect();',
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
        return 'bscForm162';
    }

}
