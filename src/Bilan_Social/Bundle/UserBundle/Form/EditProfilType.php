<?php

namespace Bilan_Social\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;
use Bilan_Social\Bundle\CoreBundle\Form\DynamicFormType;

class EditProfilType extends AbstractType
{
 /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomProfil', PurifiedTextType::class, array(
                    'label_attr' => array(
                        'class' => ''
                    ),
                    'attr' => array(
                        'class' => '',
                        'maxlength'=>50
                    )
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\UserBundle\Entity\Profil',
            'attr'=>['id'=>'User_edit_profil']
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'user_edit_profil';
    }
}
?>