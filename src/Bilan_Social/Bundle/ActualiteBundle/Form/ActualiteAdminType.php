<?php

namespace Bilan_Social\Bundle\ActualiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg;
use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerImageType;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\FormInterface;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class ActualiteAdminType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $new = $options['new'];

                if($new == true){
                    $builder->add('image', FileManagerImageType::class, array(
                        'mapped'    => false,
                        'required'  => false,
                        'constraints' => array(
                            new NotNull(
                                array('message' => 'actualite.image.notnull')
                            ),
                        ),
                    ));
                }else{
                    $builder->add('image', FileManagerImageType::class, array(
                        'mapped'    => false,
                        'required'  => false,
                    ));
                }
                 $builder->add('document', FileManagerType::class, array(
                'mapped'    => true,
                'required'  => false,
                'label' => 'Document',
                ))
                ->add('titreActu', PurifiedTextType::class, array(
                'label' => 'Titre',
                'required' => true,
                ))
                ->add('texteActu',  CKEditorType::class, array(
                'required' => true,
                'label' => "Corps de l'actualité",
                'config' => array(
                    'uiColor' => '#ffffff',
                    ))
                )

                 ->add('blPublish', ChoiceType::class, array(
                'label'    => "Publier ?",
                'placeholder' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0), 
                'attr' => array(
                    'class' => 'radio-inline'
                )
            ))
                ->add('DtDebut', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de début',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'input-date',
                    )
                ))
                ->add('DtFin', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de fin',
                    'required' => false,
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'input-date',
                    )

                ))

                 ->add('cdgs', EntityType::class, array(
                    'class' => Cdg::class,
                    'choice_label' => 'lbCdg',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => true,
                    'error_bubbling' => true,
                   
                    
                ))
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ActualiteBundle\Entity\Actualite',

             /* un groupe dateNoNull est définie sur la contrainte de la date de fin dans l'entité
             * ceci a pour but de bloquer une date de fin inferieur à la date de début.
             * si la date de fin est null elle n'applique pas la contrainte, si la date n'est pas null elle est soumise a la contrainte.
             */
            'validation_groups' => function (FormInterface $form){
                $data = $form->getData();

                if ($data->getDtFin() !== null) {
                    return array('Default','liste1', 'dateNoNull');
                }
                return array('Default','liste1'); 
                

            }
        ));
        $resolver->setRequired('user');
        $resolver->setRequired('new');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_actualitebundle_actualite';
    }




}
