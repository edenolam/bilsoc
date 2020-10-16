<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind161Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1612Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideEffectifInd161Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind161s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind161Type::class
                ))
                ->add('ind1612s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind1612Type::class
                ))
                ->add('q161', ChoiceType::class, array(
                    'label' => 'Y a-t-il parmi les agents de votre collectivité, des agents bénéficiant de l\'obligation d\'emploi - travailleurs handicapés (BOETH, loi de 2005), y compris reclassés ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq161'),
                    'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                ))
                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))
                ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
                    $data = $event->getData();
                    $form = $event->getForm();
                    $filtered_data = array();
                    foreach ($data->getInd161s() as $key => $ind161) {
                        if ($ind161->getRefCategorie()->getCdCate() != "H" && $ind161->getRefCategorie()->getCdCate() != "HH") {
                            $filtered_data[] = $ind161;
                        }
                    }
                    $event->getForm()->get('ind161s')->setData($filtered_data);
                })

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscForm161';
    }

}
