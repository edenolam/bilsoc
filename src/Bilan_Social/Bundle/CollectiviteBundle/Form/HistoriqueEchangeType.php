<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class HistoriqueEchangeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lbIntiEcha', PurifiedTextType::class, array(
                    'label' => 'Intitulé',
                    'required' => true,
                ))
                ->add('lbTypeEcha', ChoiceType::class, array(
                    'label' => 'Type d\'échange',
                    'choices'  => array('Téléphone' => 'Téléphone',
                        'Email' => 'Email',
                        'Courrier' => 'Courrier',
                        'Rencontre' => 'Rencontre',
                    ),
                    'expanded' => false,
                    'multiple' => false,
                ))
                ->add('cmEcha', TextareaType::class, array(
                    'label' => 'Commentaire',
                    'required' => false,
                ))
                ->add('dtEcha', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de l\'échange',
                    'required' => true,
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'input-date',
                    )
                ))
                ->add('idHistEcha', HiddenType::class, array(
                    'attr' => array('class' => 'hidden'),
                ))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueEchange'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_collectivitebundle_historiqueechange';
    }


}
