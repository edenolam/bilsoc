<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind114Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideEffectifInd114Type extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ind114sTemp', CollectionType::class, array(
                'label' => false,
                'required' => false,
                'entry_type' => Ind114Type::class
            ))
            ->add('valide', HiddenType::class, array(
                'mapped' => false
            ))
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                $filtered_data = array();
                foreach ($data->getInd114sTemp() as $key => $ind114) {
                    if ($ind114->getRefFiliere()->getCdFili() != "AN" || $ind114->getRefCategorie()->getCdCate() != "A") {
                        $filtered_data[] = $ind114;
                    }
                }
                $event->getForm()->get('ind114sTemp')->setData($filtered_data);
            });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bscForm114';
    }

}
