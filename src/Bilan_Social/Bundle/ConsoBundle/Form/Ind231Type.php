<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind231;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind231Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('r2311', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveInteger',
                        'onChange' => 'changedR231(this);changedDetect()',
                        'min'      => 0,
                    )
                ))
                ->add('r2312', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveInteger',
                        'onChange' => 'changedR231(this);changedDetect()',
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
            'data_class' => Ind231::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'ind231';
    }

}
