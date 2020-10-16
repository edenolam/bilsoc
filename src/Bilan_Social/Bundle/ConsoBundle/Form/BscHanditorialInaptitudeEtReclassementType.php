<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialInaptitudeEtReclassement;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorieBoeth;
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

class BscHanditorialInaptitudeEtReclassementType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

            
            
            $builder->add('qA511', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('qA512', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('qA513', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('rA9', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('rA91', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('qA521', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('rA101', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('qA522', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('qA523', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('qA62', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('qA72', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
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
            ->add('qA82', PurifiedNumberType::class, array(
                'label'    => false,
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BscHanditorialInaptitudeEtReclassement::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscHanditorialInaptitudeEtReclassement';
    }

}
