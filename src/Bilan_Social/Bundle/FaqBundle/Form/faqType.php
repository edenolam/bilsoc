<?php

namespace Bilan_Social\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class faqType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('question')
                ->add('reponse', CKEditorType::class)
                ->add('profil', ChoiceType::class, array(
                    'label' => "Pour quel profil voulez vous diffuser cette FAQ ?",
                    'choices'  => array('Centre de gestion et collectivité' => 2,
                        'Centre de gestion' => 1,
                        'Collectivité' => 0,
                    ), 
                     'expanded' => true,
                    ))
                ->add('existCategorie', ChoiceType::class, array(
                    'label' => "Voulez vous selectionner une catégorie déjà existante?",
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'required' => true,
                    'mapped' => false,
                    'expanded' => true,
                    'multiple' => false,
                ))
                ->add('categorie', PurifiedTextType::class, array(
                    'label_attr' => array(
                        'class' => ''
                    ),
                    'attr' => array(
                        'class' => '',
                    )
                ));


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\FaqBundle\Entity\faq'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_faqbundle_faq';
    }


}
