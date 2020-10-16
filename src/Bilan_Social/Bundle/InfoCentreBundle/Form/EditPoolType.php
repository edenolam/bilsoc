<?php

namespace Bilan_Social\Bundle\InfoCentreBundle\Form;

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

class EditPoolType extends AbstractType
{
 /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder/*->add('save', SubmitType::class, array(
				    'attr' => array('class' => 'save'),
				))*/->add('nom', PurifiedTextType::class, array(
                    'label_attr' => array(
                        'class' => ''
                    ),
                    'attr' => array(
                        'class' => '',
                        'maxlength'=>50
                    )
                ))->add('description', PurifiedTextareaType::class, array(
                    'required'=>false,
                    'label_attr' => array(
                        'class' => ''
                    ),
                    'attr' => array(
                        'class' => '',
                        'maxlength'=>200
                    )
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\InfoCentreBundle\Entity\Pool',
            'attr'=>['id'=>'infocentre_edit_pool']
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'infocentre_edit_pool';
    }
}
?>