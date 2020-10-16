<?php
/**
 * Created by PhpStorm.
 * User: mbusson
 * Date: 17/01/2019
 * Time: 14:07
 */

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement;
use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerType;
use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerImageType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\CallbackTransformer;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class ImportFileHIstorisationSiretType extends  AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('document', FileManagerType::class, array(
                'mapped'    => false,
                'required'  => false,
                'label' => 'Document',
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
        return 'bilan_social_bundle_import_historisation_siret';
    }

    public function getDefaultOptions()
    {

    }




}
