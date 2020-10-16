<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialQuestionsBoethsType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialNatureHandicapsType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialAvisInaptitudesType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialMesureInaptitudesType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialAvisInaptitudesAvantType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialMesureInaptitudesAvantType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialAncienneteAgentsType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialStatutAgentsType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialArticlesType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialModeSortiesTitulaireType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialModeSortiesNonTitulaireType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialDerniersDiplomesType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialModeEntreesType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BilanSocialConsolideHanditorialBscHanditorialQuestionsBoethsType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('bscHanditorialQuestionsBoeths', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialQuestionsBoethsType::class
                ))
                ->add('bscHanditorialNatureHandicaps', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialNatureHandicapsType::class
                ))
                ->add('bscHanditorialModeEntrees', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialModeEntreesType::class
                ))
                /*->add('bscHanditorialStatutAgents', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialStatutAgentsType::class
                ))*/
                ->add('qHandiB41A', ChoiceType::class, array(
                    'label'      => false,
                    'required'    => false,
                    'placeholder' => false,
                    'expanded'   => true,
                    'multiple'   => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'labelqHandiB41A'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('qHandiB41B', ChoiceType::class, array(
                    'label'      => false,
                    'required'    => false,
                    'placeholder' => false,
                    'expanded'   => true,
                    'multiple'   => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'labelqHandiB41B'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('bscHanditorialArticles', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialArticlesType::class
                ))
                ->add('bscHanditorialModeSortiesTitulaire', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialModeSortiesTitulaireType::class
                ))
                ->add('bscHanditorialModeSortiesNonTitulaire', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialModeSortiesNonTitulaireType::class
                ))
                ->add('bscHanditorialDerniersDiplomes', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialDerniersDiplomesType::class
                ))
                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscFormHanditorialQuestionsBoeths';
    }

}
