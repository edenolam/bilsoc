<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialDerniersDiplomes;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscHanditorialDerniersDiplomesType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('dernierDiplomeH', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'      => 0,
                        'onChange' => 'changedDetect();',
                    )
                ))
                ->add('dernierDiplomeF', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'      => 0,
                        'onChange' => 'changedDetect();',
                    )
                ))
                ->add('refDomaineDiplome', EntityType::class, array(
                    'required'     => true,
                    'class'        => RefDomaineDiplome::class,
                    'choice_label' => 'lbDomaineDiplome',
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
            'data_class' => BscHanditorialDerniersDiplomes::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscHanditorialDerniersDiplomes';
    }

}
