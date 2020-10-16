<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1102;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind1102Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r1101', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1102', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1103', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1104', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1105', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1106', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1107', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1108', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1109', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('r1110', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1102(this);changedDetect()',
                        )
                    ))
                ->add('refEmploiFonctionnel',  EntityType::class, array(
                        'required' => true,
                        'class' => RefEmploiFonctionnel::class,
                        'choice_label' => 'lbEmplfonc',
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
            'data_class' => Ind1102::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind1102';
    }


}

