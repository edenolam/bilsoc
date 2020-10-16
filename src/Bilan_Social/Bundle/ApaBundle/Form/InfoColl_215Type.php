<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class InfoColl_215Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('r2151', PurifiedNumberType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array(
                    'class' => "positiveInteger",
                ),
            ))
            ->add('r2152', PurifiedNumberType::class, array(
                'label' => false,
                'required' => false,
                'attr' => array(
                    'class' => "positiveInteger",
                ),
            ))
            ->add('refCategorie',  EntityType::class, array(
                'required' => true,
                'class' => RefCategorie::class,
                'choice_label' => 'lbCate',
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
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_215'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_infocoll_215';
    }

}
