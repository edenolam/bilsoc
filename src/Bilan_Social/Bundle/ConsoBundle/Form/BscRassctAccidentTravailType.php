<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscRassctAccidentTravail;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscRassctAccidentTravailType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('rAccident_1', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'accidentTravailN1 positiveInteger',
                        'onChange' => 'changedR224(this);changedDetect()',
                        'min'      => 0,
                    )
                ))
                ->add('rAccident_2', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'accidentTravailN positiveInteger',
                        'onChange' => 'changedR224(this);changedDetect()',
                        'min'      => 0,
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BscRassctAccidentTravail::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscRassctAccidentTravail';
    }

}
