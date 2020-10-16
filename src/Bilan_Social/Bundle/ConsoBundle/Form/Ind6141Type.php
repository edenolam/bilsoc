<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind6141;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSanctionDisciplinaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind6141Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r61411', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR6141();changedDetect()',
                        )
                    ))
                ->add('r61412', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR6141();changedDetect()',
                        )
                    ))
                ->add('groupe', HiddenType::class, array(
                        'required' => false,
                    ))
                ->add('firstGroupe1', HiddenType::class, array(
                        'required' => false,
                    ))
                ->add('firstGroupe2', HiddenType::class, array(
                        'required' => false,
                    ))
                ->add('firstGroupe3', HiddenType::class, array(
                        'required' => false,
                    ))
                ->add('firstGroupe4', HiddenType::class, array(
                        'required' => false,
                    ))
                ->add('firstGroupe5', HiddenType::class, array(
                        'required' => false,
                    ))
                ->add('firstGroupe6', HiddenType::class, array(
                        'required' => false,
                    ))
                ->add('refSanctionDisciplinaire',  EntityType::class, array(
                        'required' => true,
                        'class' => RefSanctionDisciplinaire::class,
                        'choice_label' => 'lbSancdisc',
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
            'data_class' => Ind6141::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind6141';
    }


}

