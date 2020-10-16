<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind7141Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind7142Type;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BilanSocialConsolideDroitInd714Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('qS7141', ChoiceType::class, array(
                        'label' => false,
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelqS7141'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('qS7142', ChoiceType::class, array(
                        'label' => false,
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelqS7142'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('qP7143', ChoiceType::class, array(
                        'label' => false,
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelqP7143'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('qP7144', ChoiceType::class, array(
                        'label' => false,
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelqP7144'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('ind7141s', CollectionType::class, array(
                        'label' => false,
                        'required' => false,
                        'entry_type' => Ind7141Type::class
                    ))
                ->add('ind7142s', CollectionType::class, array(
                        'label' => false,
                        'required' => false,
                        'entry_type' => Ind7142Type::class
                    ))
                ->add('r71411HC', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR7141(this); changedDetect();',
                        )
                    ))
                ->add('r71412HC', PurifiedTextType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR7141(this); changedDetect();',
                        )
                    ))
                ->add('r71421HC', PurifiedTextType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR7142(this); changedDetect();',
                        )
                    ))
                ->add('r71422HC', PurifiedTextType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR7142(this); changedDetect();',
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
