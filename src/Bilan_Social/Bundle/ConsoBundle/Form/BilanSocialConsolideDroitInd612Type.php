<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BilanSocialConsolideDroitInd612Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('r6121', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6122', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6123', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6124', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6125', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6126', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
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
        return 'bscForm';
    }

}
