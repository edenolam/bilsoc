<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class InfoColl_132Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('r1321', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r1321'
                    ),
                ))
                ->add('refFiliere',  EntityType::class, array(
                    'required' => true,
                    'class' => RefFiliere::class,
                    'choice_label' => 'lbFili',
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'attr' => array(
                        'class' => 'selectEntity hidden'
                    )
                ))
                ->add('r1322', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r1322'
                    ),
                ))
                ->add('r1323', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r1323'
                    ),
                ))
                ->add('r1324', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r1324'
                    ),
        ));
//                ->add('createdAt')
//                ->add('cdUtilcrea')
//                ->add('updatedAt')
//                ->add('cdUtilmodi')
//                ->add('idInfocollagen');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_132'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_infocoll_132';
    }

}
