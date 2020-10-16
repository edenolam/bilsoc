<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscRassctPredictionsAutresMesures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class BscRassctPredictionsAutresMesuresType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('mesuresTechniques', PurifiedTextType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'ind110',
                        'onChange' => 'changedR224(this);changedDetect()',
                        'min'      => 0,
                    )
                ))
                ->add('mesuresOrgani', PurifiedTextType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class'    => 'ind110',
                        'onChange' => 'changedR224(this);changedDetect()',
                        'min'      => 0,
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BscRassctPredictionsAutresMesures::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscRassctPredictionsAutresMesures';
    }

}
