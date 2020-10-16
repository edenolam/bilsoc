<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg;

class CdgDepartementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cdg', EntityType::class, array(
                    'class' => Cdg::class,
                    'choice_label' => 'lbCdg',
                    'label' => 'Centre de gestion',
                    'expanded' => false,
                    'multiple' => true,
                ));
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $cdg = $event->getData();
            $form = $event->getForm();

            // check if the Product object is "new"
            // If no data is passed to the form, the data is "null".
            // This should be considered a new "Product"
            if (!$cdg || null === $cdg->getId()) {
                $form->add('departement', EntityType::class, array(
                    'class' => Departement::class,
                    'choice_label' => 'lbDepa',
                    'label' => 'Département',
                    'expanded' => false,
                    'multiple' => true,
                ));
            }
        });
                
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_collectivitebundle_cdgdepartement';
    }


}
