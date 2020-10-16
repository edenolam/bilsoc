<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind411;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeMissionPrevention;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind411Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r4111', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR411(this);changedDetect()',
                        )
                    ))
                ->add('refTypeMissionPrevention', EntityType::class, array(
                    'required' => true,
                        'class' => RefTypeMissionPrevention::class,
                        'choice_label' => 'lbTypemissprev',
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
            'data_class' => Ind411::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind411';
    }


}

