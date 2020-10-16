<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialQuestionsGenerales;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscHanditorialQuestionsGeneralesType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

            /* Apa handMailCorres */
            $builder->add('qA17', EmailType::class, array(
                'label'    => false,
                'required' => false,
            ))
            /* Apa handNbAvisInapTempo */
            /*->add('qA511', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
            /* Apa handNbAvisInapDef */
            /*->add('qA512', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
            /* Apa handNbAvisInapDefToutesFonctions */
            /*->add('qA513', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
            /* Apa handNbRecla */
            /*->add('qA521', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
            /* Apa handNbRetraiteInval */
            /*->add('qA522', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
            /* Apa handNbLicencInapPhysi */
            /*->add('qA523', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
            /* Apa handNbMesureAmenaPosteCondTravBoeth */
            /*->add('qA62', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
                /* Apa handNbMesureChangAffecBoeth */
            /*->add('qA72', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
            /* Apa handNbDispoOfficeBoeth */
            /*->add('qA82', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))*/
            ->add('qA3', ChoiceType::class, array(
                    'label'      => false,
                    'required'   => true,
                    'expanded'   => true,
                    'multiple'   => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'qA3'),
                    'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                ))
                /*->add('qA6', ChoiceType::class, array(
                    'label'      => false,
                    'required'   => true,
                    'expanded'   => true,
                    'multiple'   => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'qA6'),
                    'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                ))
                ->add('rA61', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required' => true,
                    'attr'       => array(
                        'class' => 'ind110 positiveInteger',
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('qA7', ChoiceType::class, array(
                    'label'      => false,
                    'required'   => true,
                    'expanded'   => true,
                    'multiple'   => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'qA7'),
                    'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                ))
                ->add('rA71', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required' => true,
                    'attr'       => array(
                        'class' => 'ind110 positiveInteger'
                    )
                ))
                ->add('qA8', ChoiceType::class, array(
                    'label'      => false,
                    'required'   => true,
                    'expanded'   => true,
                    'multiple'   => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'qA8'),
                    'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                ))
                ->add('rA81', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required' => true,
                    'attr'       => array(
                        'class' => 'ind110 positiveInteger',
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('rA9', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required' => true,
                    'attr'       => array(
                        'class' => 'ind110 positiveInteger',
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('rA91', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required' => true,
                    'attr'       => array(
                        'class' => 'ind110 positiveInteger',
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('rA10', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required' => true,
                    'attr'       => array(
                        'class' => 'ind110 positiveInteger',
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('rA101', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required' => true,
                    'attr'       => array(
                        'class' => 'ind110 positiveInteger',
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))*/
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BscHanditorialQuestionsGenerales::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscHanditorialQuestionsGenerales';
    }

}
