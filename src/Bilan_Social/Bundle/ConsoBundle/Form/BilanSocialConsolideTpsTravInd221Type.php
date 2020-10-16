<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind221Type;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideTpsTravInd221Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('q221', ChoiceType::class, array(
            'label'      => false,
            'required'   => true,
            'expanded'   => true,
            'multiple'   => false,
            'choices'    => array('Oui' => 1, 'Non' => 0),
            'label_attr' => array('id' => 'labelq221'),
            'attr'       => array(
                'onchange' => 'changedDetect()',
            )
        ))
            ->add('ind2211Cycle', PurifiedNumberType::class, array(
                'label'      => false,
                'required'   => true,
                'label_attr' => array('id' => 'ind2211Cycle'),
                'attr'       => array(
                    'class'    => 'ind110 positiveFloat025Rounded',
                    'onchange' => 'changedDetect()',
                )
            ))
            ->add('ind2212Cycle', PurifiedNumberType::class, array(
                'label'      => false,
                'required'   => true,
                'label_attr' => array('id' => 'ind2212Cycle'),
                'attr'       => array(
                    'class'    => 'ind110 positiveFloat025Rounded',
                    'onchange' => 'changedDetect()',
                )
            ))
                ->add('ind221s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind221Type::class
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
        return 'bscForm221';
    }

}
