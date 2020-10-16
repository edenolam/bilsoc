<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class ModelMailInterneAppliType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('codeApp', PurifiedTextType::class, array(

        ))
                ->add('objet', PurifiedTextType::class, array(

                ) )
                ->add('body', CKEditorType::class, array(

                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailInterneAppli'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_modelmailbundle_modelmailinterneappli';
    }


}
