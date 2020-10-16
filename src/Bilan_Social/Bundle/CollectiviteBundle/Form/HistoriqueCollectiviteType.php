<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;

use Bilan_Social\Bundle\CollectiviteBundle\Entity\importSiretHistorisation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureMAJ;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Bilan_Social\Bundle\CollectiviteBundle\Form\ImportFileHIstorisationSiretType;

class HistoriqueCollectiviteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('RefNatureMAJ', EntityType::class, array(
                    'class' => RefNatureMAJ::class,
                    'choice_label' => 'lbNatureMAJ',
                    'choice_value' => 'cdStat',
                    'required'     => false,
                    'label' => 'Nature de la mise a jour ?',
                    'query_builder' => function (EntityRepository $er) use ($options){
                        return $er->createQueryBuilder('u')
                            ->andWhere('u.blVali = :blVali')
                            ->andWhere('u.blCrea = :blCrea')
                            ->setParameter('blVali', '0')
                            ->setParameter('blCrea', $options['blCrea'])
                            ->setCacheable(true)
                            ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                            ->setCacheRegion('referentiel_entities')
                            ;
                    },
                ))
                ->add('nmNouvSire', PurifiedTextType::class, array(
                    'label' => 'Nouveau numéro de SIRET',
                    "label_attr" => array(
                        'class' => 'hidden nmNouvSire'
                    ),
                    'required' => false,
                    'attr' => array(
                        'maxlentgh' => 14,
                        'class' => 'positiveInteger hidden nmNouvSire',
                    ),
                ))
                ->add('nmSireAbso', PurifiedTextType::class, array(
                    'label' => 'Numéro de SIRET de la collectivité qui l\'a absorbée',
                    "label_attr" => array(
                        'class' => 'hidden nmSireAbso'
                    ),
                    'required' => false,
                    'attr' => array(
                        'maxlentgh' => 14,
                        'class' => 'positiveInteger hidden nmSireAbso',
                    ),
                ))
                ->add('dtArch', DateType::class, array(

                    'widget' => 'single_text',
                    'label' => 'Date',
                    'required' => false,
                    "label_attr" => array(
                        'class' => 'dtArch'
                    ),
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'input-date dtArch',
                    ),
                ))
                ->add('listColl', HiddenType::class, array(
                    'mapped' => false,
                    'required' => false
                ))
                 ->add('valider', SubmitType::class, array(
                    'attr' => array(
                        'class' => 'btn button-tableau pull-right',
                    ),
                ))
                ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite'
        ));
        $resolver->setRequired('blCrea');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'historiquecollectivite';
    }


}
