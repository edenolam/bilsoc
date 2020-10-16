<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class RefAbstractType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('blExclutotal', CheckboxType::class, array(
                'label' => 'Exclure des totaux',
                'required' => false,
            ))
            ->add('nmOrdre', PurifiedNumberType::class, array(
                'label' => 'Ordre d\'affichage',
                'required' => true,
            ))
            /*->add('blVali', CheckboxType::class, array(
                    'label' => 'Archiver',
                    'required' => false,
            ))*/
        ;
    }

}