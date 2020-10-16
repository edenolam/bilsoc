<?php

namespace Bilan_Social\Bundle\FileManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotNull;

class FileManagerImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('image', FileType::class, array(
            'label' => "Taille de l'image conseillée: largeur 750px et hauteur 230px",
            'constraints' => array(
                         new Image( array(
                            'minWidth' => 750,
                            'minHeight' => 230,
                            'mimeTypesMessage' => "actualite.image.format",
                            'maxSize' => "3M",
                            'maxSizeMessage' => "actualite.image.maxSize",
                            'notFoundMessage' => "actualite.image.notfound",
                            'minWidthMessage' => "actualite.image.minWidth",
                            'minHeightMessage' => "actualite.image.minHeight",
                            'mimeTypes'=> array(
                                   'image/jpeg',
                                   'image/png',
                                   'image/jpg',
                                   'image/gif',
                                  ),
                         )),
//                        new NotNull(array('message' => 'actualite.image.notnull')),
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
