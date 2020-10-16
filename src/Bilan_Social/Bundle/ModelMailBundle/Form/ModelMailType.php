<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class ModelMailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('objet', PurifiedTextType::class, array(
                    'label' => 'Objet',
                    'required' => true,
                    'attr'     => array(
                        'placeholder' => "Saisir le titre de la page",
                    ),
                ))
                ->add('body', CKEditorType::class, array(
                    'label'    => "Contenu de la page",
                    'required' => true,
                ))
                ->add('blVali', CheckboxType::class, array(
                    'label' => 'Partager le modèle de mail ?',
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMail'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_modelmailbundle_modelmail';
    }


}
