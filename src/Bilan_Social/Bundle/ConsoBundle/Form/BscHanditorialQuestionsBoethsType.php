<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialQuestionsBoeths;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorieBoeth;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscHanditorialQuestionsBoethsType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('categorieH', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveInteger',
                        'onChange' => 'changedR224(this);changedDetect();',
                        'min'      => 0,
                    )
                ))
                ->add('categorieF', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'ind110 positiveInteger',
                        'onChange' => 'changedR224(this);changedDetect();',
                        'min'      => 0,
                    )
                ))
                ->add('refCategorieBoeth', EntityType::class, array(
                    'required'     => true,
                    'class'        => RefCategorieBoeth::class,
                    'choice_label' => 'lbCategorieboeth',
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
            'data_class' => BscHanditorialQuestionsBoeths::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscHanditorialQuestionsBoeths';
    }

}
