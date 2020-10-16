<?php

namespace Bilan_Social\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;

class QuestionNewCdgType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sujet', PurifiedTextType::class, array(
//            'required' => false,
        ))
                ->add('question', PurifiedTextareaType::class, array(
//            'required' => false,
        ));

                if(!empty($options['CdgReferent']) && $options['CdgReferent'] !== null){
                    $builder->add('listeCDG', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        'label' => 'Liste des centres de gestion référents',
                        'class' => 'CollectiviteBundle:Cdg',
                        'choices' => $options['CdgReferent'],
                        'choice_label' => 'lbCdg',
                        'mapped' => false,
                ));
                }

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
                ->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\FaqBundle\Entity\Question'
        ))
                ->setRequired('CdgReferent')
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_faqbundle_question';
    }


}
