<?php

namespace Bilan_Social\Bundle\UserBundle\Form;

use Bilan_Social\Bundle\CampagneBundle\Entity\Campagne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerType;

class GestionFileExportDgclType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $year = $options['year'];

        $builder
                ->add('modele_dgcl', FileManagerType::class, array(
                    'mapped'   => false,
                    'required' => false,
                    'label'    => 'Modèle DGCL',
                ))
                ->add('pdf_aide', FileManagerType::class, array(
                    'mapped'   => false,
                    'required' => false,
                    'label'    => 'PDF d\'aide',
                ))
                ->add('year', TextType::class, array(
                    'mapped'   => false,
                    'required' => true,
                    'data'    => $year
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'gestion_file_export_dgcl';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'year' => '' // ne pas oublier de mettre une valeur par défaut
        ]);
    }

}
