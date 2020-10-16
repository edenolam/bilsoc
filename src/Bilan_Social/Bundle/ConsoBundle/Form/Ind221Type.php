<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind221;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCycleTravail;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind221Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r2211', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR221(this);changedDetect()',
                        )
                    ))
                ->add('r2212', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR221(this);changedDetect()',
                        )
                    ))
                ->add('newGroupe', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('lastGroupe', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('refCycleTravail',  EntityType::class, array(
                        'required' => true,
                        'class' => RefCycleTravail::class,
                        'choice_label' => 'lbCycltrav',
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
            'data_class' => Ind221::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind221';
    }


}

