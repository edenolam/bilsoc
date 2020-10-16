<?php

namespace Bilan_Social\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class importExcelFaqType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('document', FileManagerType::class, array(
                    'mapped'   => false,
                    'required' => false,
                    'label'    => 'Document'))
                ->add('importer', SubmitType::class, array(
                    'label' => 'Importer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_faqbundle_import_excel_faq';
    }


}
