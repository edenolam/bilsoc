<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BilanSocialConsolideDroitInd611Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

                ->add('r6111', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6112', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6117', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger',
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q6113', ChoiceType::class, array(
                        'label' => 'Disposez-vous d\'un comité d\'hygiène et de sécurité et condition de travail (CHSCT) au sein de votre collectivité?',
                        'required' => false,
                        'placeholder' => false,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2), 
                        'label_attr' => array('id' => 'labelq6113'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6113', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('q6114', ChoiceType::class, array(
                        'label' => 'Votre comité technique (CT) a-t-il siégé pour exercer les missions dévolues à un comité d\'hygiène et de sécurité et condition de travail (CHSCT) ?',
                        'required' => false,
                        'expanded' => true,
                        'multiple' => false,
                        'placeholder' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2), 
                        'label_attr' => array('id' => 'labelq6114'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r6114', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                ->add('r6115', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger',
                    )
                ))
                ->add('r6116', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger',
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
