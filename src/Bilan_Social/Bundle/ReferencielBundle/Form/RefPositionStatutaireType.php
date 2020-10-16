<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefGroupePositionStatutaire;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class RefPositionStatutaireType extends RefAbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('cdPosistat', PurifiedTextType::class, array(
                    'label' => 'Code',
                    'required' => true,
                ))
                ->add('lbPosistat', PurifiedTextType::class, array(
                    'label' => 'Libellé',
                    'required' => true,
                ))
                ->add('lbCompl', PurifiedTextType::class, array(
                    'label' => 'Libellé complémentaire',
                    'required' => true,
                ))
                ->add('lbComm', PurifiedTextType::class, array(
                    'label' => 'Commentaire',
                    'required' => true,
                ))
                ->add('refGroupePositionStatutaire', EntityType::class, array(
                    'class' => RefGroupePositionStatutaire::class,
                    'required' => false,
                    'choice_label' => 'lbGrouPosistat',
                    'label' => 'Groupe',
                ))
                ->add('statutPositionStatutaires', EntityType::class, array(
                    'class' => RefStatut::class,
                    'label' => "Liste des status auquels appliquer cette position statutaire particulière",
                    'choice_label' => 'lbStat',
                    'expanded' => true, // todo a voir ce qui est le mieux
                    'multiple' => true,
                ))
                ->add('blCdg', CheckboxType::class, array(
                    'label' => 'Réserver CDG',
                    'required' => false,))
                ->add('blInd142', CheckboxType::class, array(
                    'label' => 'Indicateur 1.4.2',
                    'required' => false,))
                ->add('blInd143', CheckboxType::class, array(
                    'label' => 'Indicateur 1.4.3',
                    'required' => false,))
                ->add('blInd144', CheckboxType::class, array(
                    'label' => 'Indicateur 1.4.4',
                    'required' => false,))
                ->add('cdMotiN4ds', PurifiedTextType::class, array(
                    'label' => 'Code N4DS',
                    'required' => true,
                ))
                ->add('blVali', CheckboxType::class, array(
                    'label' => 'Archiver',
                    'required' => false,))

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_referencielbundle_refpositionstatutaire';
    }

}
