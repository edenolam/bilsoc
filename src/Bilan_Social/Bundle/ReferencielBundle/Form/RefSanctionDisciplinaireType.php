<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class RefSanctionDisciplinaireType extends RefAbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('cdSancdisc', PurifiedTextType::class, array(
                    'label' => 'Code',
                    'required' => true,
                ))
                ->add('lbSancdisc', PurifiedTextType::class, array(
                    'label' => 'libellé',
                    'required' => true,
                ))
                ->add('bl614G1', CheckboxType::class, array(
                    'label' => 'Sanctions du 1er groupe',
                    'required' => false,
                ))
                ->add('bl614G2', CheckboxType::class, array(
                    'label' => 'Sanctions du 2e groupe',
                    'required' => false,
                ))
                ->add('bl614G3', CheckboxType::class, array(
                    'label' => 'Sanctions du 3e groupe',
                    'required' => false,
                ))
                ->add('bl614G4', CheckboxType::class, array(
                    'label' => 'Sanctions du 4e groupe',
                    'required' => false,
                ))
                ->add('bl614G5', CheckboxType::class, array(
                    'label' => 'Sanctions fonctionnaire stagiaire',
                    'required' => false,
                ))
                ->add('bl614G6', CheckboxType::class, array(
                    'label' => 'Sanctions agent contractuel',
                    'required' => false,
                ))

                ->add('blVali', CheckboxType::class, array(
                    'label' => 'Archiver',
                    'required' => false,
        ));
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefSanctionDisciplinaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_referencielbundle_refsanctiondisciplinaire';
    }

}
