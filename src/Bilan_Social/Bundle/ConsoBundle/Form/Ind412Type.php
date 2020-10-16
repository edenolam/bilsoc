<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind412;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind412Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('r4121', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveFloatRoundedIntegerUp',
                        'onChange' => 'changedR412(this);changedDetect()',
                    )
                ))
                ->add('r4122', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveInteger',
                        'onChange' => 'changedR412(this);changedDetect()',
                    )
                ))
                ->add('r4123', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveInteger',
                        'onChange' => 'changedR412(this);changedDetect()',
                    )
                ))
                ->add('refActionPrevention', EntityType::class, array(
                    'required'     => true,
                    'class'        => RefActionPrevention::class,
                    'choice_label' => 'lbActionprev',
                    'label_attr'   => array(
                        'class' => 'hidden'
                    ),
                    'attr'         => array(
                        'class' => 'selectEntity hidden'
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Ind412::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'ind412';
    }

}
