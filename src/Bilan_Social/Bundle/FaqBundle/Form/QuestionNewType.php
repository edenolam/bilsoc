<?php

namespace Bilan_Social\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;

class QuestionNewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sujet', PurifiedTextareaType::class, array(
//            'required' => false,
        ))
                ->add('question', PurifiedTextareaType::class, array(
//            'required' => false,
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
