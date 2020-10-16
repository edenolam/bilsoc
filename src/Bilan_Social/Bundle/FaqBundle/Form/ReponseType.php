<?php

namespace Bilan_Social\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;

class ReponseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reponse', PurifiedTextareaType::class, array(
                    'label' => 'Réponse : ',
                    'required' => false
                ))
                ->add('send', SubmitType::class, array(
                    'label' => 'Envoyer',
                    'attr' => array('class'=>'btn-primary')
                ))
                ->add('send_without_response', SubmitType::class, array(
                    'label' => 'Réponse fournie',
                    'attr' => array('class'=>'btn-primary')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\FaqBundle\Entity\Question'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_faqbundle_question';
    }


}
