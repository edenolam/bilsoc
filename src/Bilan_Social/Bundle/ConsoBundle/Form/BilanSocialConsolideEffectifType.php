<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1101Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1102Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1103Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind111Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind112Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind113Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind114Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind121Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind122Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind123Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind124Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1311Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1312Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind132Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind141Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideEffectifType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('ind1101s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind1101Type::class
                        ))
                ->add('ind1102s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind1102Type::class
                        ))
                ->add('ind1103s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind1103Type::class
                        ))
                ->add('ind111s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind111Type::class
                        ))
                ->add('ind112s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind112Type::class
                        ))
                ->add('ind113s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind113Type::class
                        ))
                ->add('ind114s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind114Type::class
                        ))
                ->add('ind121s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind121Type::class
                        ))
                ->add('ind122s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind122Type::class
                        ))
                ->add('ind123s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind123Type::class
                        ))
                ->add('ind124s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind124Type::class
                        ))
                ->add('ind1311s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind1311Type::class
                        ))
                ->add('ind1312s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind1312Type::class
                        ))
                ->add('ind132s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind132Type::class
                        ))
                ->add('ind141s', CollectionType::class, array(
                        'required'   => false,
                        'entry_type' => Ind141Type::class
                        ))
                ->add('coherenceErrorJson', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('q132', ChoiceType::class, array(
                        'label' => 'Avez-vous eu recours à du personnel temporaire depuis une entreprise privé ou bien un CDG ? (Si oui, alors renseigné , si non ne pas défilé).?',
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'label_attr' => array('id' => 'labelq132'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
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
            'data_class' => BilanSocialConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bscForm';
    }


}

