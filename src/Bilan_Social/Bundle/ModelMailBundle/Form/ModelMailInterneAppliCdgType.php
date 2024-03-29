<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class ModelMailInterneAppliCdgType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('objet', PurifiedTextType::class, array(
                    'required' => false,
                    'label' => 'Objet du mail',
                ))
                ->add('body', CKEditorType::class, array(
                    'required' => false,
                    'label' => "Contenu du mail",
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailInterneAppliCdg'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_modelmailbundle_modelmailinterneapplicdg';
    }


}
