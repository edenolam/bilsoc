<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind6142;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifSanctionDisciplinaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind6142Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r61421', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR6142();changedDetect()',
                        )
                    ))

            ->add('r61422', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger',
                    'onChange'=> 'changedR6142();changedDetect()',
                )
            ))
                ->add('refMotifSanctionDisciplinaire',  EntityType::class, array(
                        'required' => true,
                        'class' => RefMotifSanctionDisciplinaire::class,
                        'choice_label' => 'lbMotiSancdisc',
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
            'data_class' => Ind6142::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind6142';
    }


}

