<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class RefGroupePositionStatutaireType extends RefAbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('cdGrouPosistat', PurifiedTextType::class, array(
                    'label' => 'Code',
                    'required' => true,
                ))
                ->add('lbGrouPosistat', PurifiedTextType::class, array(
                    'label' => 'Libellé principal ( ex: Détachés dans une autre structure )',
                    'required' => true,
                ))
                ->add('lbGrouCompl', PurifiedTextType::class, array(
                    'label' => 'Texte complémentaire ( ex: (article 64) )',
                    'required' => true,
                ))
                ->add('lbGrouComm', PurifiedTextType::class, array(
                    'label' => 'Commentaire ( ex: Fonctionnaires uniquement )',
                    'required' => true,
                ))
                ->add('blVali', CheckboxType::class, array(
                    'label' => 'Archiver',
                    'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefGroupePositionStatutaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_referencielbundle_refgroupepositionstatutaire';
    }

}
