<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialInaptEtReclaCadreEmplois;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscHanditorialInaptEtReclaCadreEmploisType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('cadreEmploiH', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRCadreEmploi(this); changedDetect();',
                        )
                    ))
                ->add('cadreEmploiF', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRCadreEmploi(this); changedDetect();',
                        )
                    ))
                ->add('refCadreEmploi', EntityType::class, array(
                    'required' => true,
                        'class'        => RefCadreEmploi::class,
                    'choice_label' => 'lbCadrempl',
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
            'data_class'         => BscHanditorialInaptEtReclaCadreEmplois::class,
            'allow_extra_fields' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bscHanditorialInaptEtReclaCadreEmplois';
    }


}