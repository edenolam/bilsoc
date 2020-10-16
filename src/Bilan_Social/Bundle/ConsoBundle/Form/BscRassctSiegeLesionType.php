<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscRassctSiegeLesion;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSiegeLesion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscRassctSiegeLesionType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('rNbAccident', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveInteger rNbAccident',
                        'onChange' => 'changedR224(this);changedDetect()',
                        'min'      => 0,
                    )
                ))
                ->add('rNbJourArret', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveFloat rNbJourArret',
                        'onChange' => 'changedR224(this);changedDetect()',
                        'min'      => 0,
                    )
                ))
                ->add('refSiegeLesion', EntityType::class, array(
                    'required'     => true,
                    'class'        => RefSiegeLesion::class,
                    'choice_label' => 'lbSiegeLesi',
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
            'data_class' => BscRassctSiegeLesion::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscRassctSiegeLesion';
    }

}
