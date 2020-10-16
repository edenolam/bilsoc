<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1312;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind1312Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $q5 = $options['questionnaire']->getQ5();
        $q6 = $options['questionnaire']->getQ6();

        if($q6 == true){
//            $builder->add('r13121', PurifiedNumberType::class, array(
//                'required' => false,
//                'attr' => array(
//                    'class' => 'ind110 positiveFloat',
//                    'onChange'=> 'changedR1312(this);changedDetect()',
//                )
//            ))
//            ->add('r13122', PurifiedNumberType::class, array(
//                'required' => false,
//                'attr' => array(
//                    'class' => 'ind110 positiveFloat',
//                    'onChange'=> 'changedR1312(this);changedDetect()',
//                )
//            ));
        }
        if($q5 == true){
            $builder->add('r13123', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'ind110 positiveFloat',
                    'onChange'=> 'changedR1312(this);changedDetect()',
                )
            ))
            ->add('r13124', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'ind110 positiveFloat',
                    'onChange'=> 'changedR1312(this);changedDetect()',
                )
            ));
        }
        $builder->add('refEmploiNonPermanent',  EntityType::class, array(
            'required' => true,
            'class' => RefEmploiNonPermanent::class,
            'choice_label' => 'lbEmplnonperm',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ind1312::class
        ));
        $resolver->setRequired('questionnaire');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind1312';
    }


}

