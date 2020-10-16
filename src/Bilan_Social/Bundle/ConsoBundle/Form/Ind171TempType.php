<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind171;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTrancheAge;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Ind171TempType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('fgGenr', HiddenType::class, array(
                        'required' => false
                    ))
                ->add('lastGenre', HiddenType::class, array(
                        'required' => false
                    ))
                ->add('nbRowspan', HiddenType::class, array(
                        'required' => false
                    ))
                ->add('refTrancheAge',  EntityType::class, array(
                        'required' => true,
                        'class' => RefTrancheAge::class,
                        'choice_label' => 'lbTranage',
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
            'data_class' => Ind171::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind171';
    }


}

