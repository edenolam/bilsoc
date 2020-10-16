<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind513;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefValidationExperience;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind513Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r5131', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR513(this);changedDetect()',
                        )
                    ))
                ->add('r5132', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR513(this);changedDetect()',
                        )
                    ))
                ->add('r5133', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR513(this);changedDetect()',
                        )
                    ))
                ->add('r5134', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR513(this);changedDetect()',
                        )
                    ))
                ->add('type', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('firstType', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('refValidationExperience',  EntityType::class, array(
                        'required'     => false,
                    'class' => RefValidationExperience::class,
                        'choice_label' => 'lbEbcf',
                        'label_attr' => array(
                            'class' => 'hidden'
                        ),
                        'attr' => array(
                            'class' => 'selectEntity hidden'
                        )
                    ))
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ind513::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind513';
    }


}

