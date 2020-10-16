<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class ModelMailShowCdgType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('object', PurifiedTextType::class, array(
                    'label' => 'Objet du mail',
                    'attr' => array(
                        'readonly' => true,
                    )
                ))
                ->add('body', CKEditorType::class, array(
                    'label' => "Contenu du mail",
                    'attr' => array(
                        'readonly' => true,
                        'class' => 'test',
                    ),
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailCdg'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_modelmailbundle_modelmailcdg';
    }


}
