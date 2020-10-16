<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscGpeecNiveauDiplome;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscGpeecNiveauDiplomeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbHommes',PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'gpeec_niveau_diplome_homme positiveInteger',
                            'onChange'=> 'changedDetect()',
                        )
                    ))
                ->add('nbFemmes',PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'gpeec_niveau_diplome_femme positiveInteger',
                            'onChange'=> 'changedDetect()',
                        )
                    ))
                    
                ->add('refDomaineDiplome', EntityType::class, array(
                    'required' => true,
                        'class'        => RefDomaineDiplome::class,
                    'choice_label' => 'lbDomaineDiplome',
                    'label_attr' => array(
                            'class' => 'hidden'
                        ),
                        'attr' => array(
                            'class' => 'selectEntity hidden'
                        )
                    ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BscGpeecNiveauDiplome::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bscgpeecniveaudiplome';
    }


}
