<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1101;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;


class BscDgclJoursCarenceBaseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('nbJoursCarencePrelevesH', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbJoursCarencePrelevesF', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbSommeDelaiCarenceH', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbSommeDelaiCarenceF', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbTotalAgentRemuneresH', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbTotalAgentRemuneresF', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbTotalAgentJoursCarenceH', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbTotalAgentJoursCarenceF', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbArretMaladiesH', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ))
                ->add('nbArretMaladiesF', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'DgclJoursCarence positiveInteger toTotal',
                        )
                    ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        /*$resolver->setDefaults(array(
            'data_class' => Ind1101::class
        ));*/
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dgcljourscarencebase';
    }


}

