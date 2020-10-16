<?php

namespace Bilan_Social\Bundle\FileManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class FileManagerLogoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('image', FileType::class, array(
            'label' => 'Image',
            'constraints' => array(
                         new Image( array(
                            'minWidth' => 200,
                            'minHeight' => 150,
//                            'mimeTypesMessage' => "actualite.image.format",
//                            'maxSize' => "3M",
//                            'maxSizeMessage' => "actualite.image.maxSize",
//                            'notFoundMessage' => "actualite.image.notfound",
//                            'minWidthMessage' => "actualite.image.minWidth",
//                            'minHeightMessage' => "actualite.image.minHeight",
                            'mimeTypes'=> array(
                                   'image/jpeg',
                                   'image/png',
                                   'image/jpg',
                                   'image/gif',
                                  ),
                         ))
                  ),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\FileManagerBundle\Entity\File'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bundle_filemanagerbundle_file_image';
    }
}
