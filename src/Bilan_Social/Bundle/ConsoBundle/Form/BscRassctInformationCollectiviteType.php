<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscRassctInformationCollectivite;

class BscRassctInformationCollectiviteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rassctExistEvalRPS', ChoiceType::class, array(
            'label'       => 'Au sein de votre collectivité, existe-t-il une évaluation des risques psychosociaux par service ?',
            'choices' => array('Oui' => 1, 'Non' => 0),
            'expanded'    => true,
            'multiple'    => false,
            'placeholder' => false,
            'required'    => false,
        ))
            ->add('rassctMajEvalRPS', ChoiceType::class, array(
                'label'       => 'Si oui, est ce que cette évaluation a été mise à jour dans l\'année ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctDiagRPS', ChoiceType::class, array(
                'label'       => 'Votre collectivité dispose-t-elle d\'un diagnostic RPS ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctExistPrevActionSante', ChoiceType::class, array(
                'label'       => 'Au sein de votre collectivité, existe-t-il un programme annuel de prévention ou un un plan d\'action santé sécurité ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctActiMedecPrev', ChoiceType::class, array(
                'label'       => 'Disposez-vous du rapport d\'activités de la médecine préventive ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctDesiACFI', ChoiceType::class, array(
                'label'       => 'Votre collectivité a-t-elle désignée un Agent Chargé de la Fonction d\'Inspection (ACFI) ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctNbVisitACFI', PurifiedNumberType::class, array(
                'label'    => "Si oui, quel est le nombre de visite(s) de l'ACFI dans l'année ?",
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('rassctNbCtChsct', PurifiedNumberType::class, array(
                'label'    => "Quel est le nombre de saisines du CT/CHSCT pour l'exercie du droit d'alerte et de retrait dans l'année ?",
                'required' => false,
                'attr'     => array(
                    'class' => 'positiveInteger',
                )
            ))
            ->add('rassctExistPrevEntreExte', ChoiceType::class, array(
                'label'       => "Au sein de votre collectivité, existe-t-il un plan de prévention des entreprises extérieures établis dans l'année ?",
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctExistDiagPeniAnnex', ChoiceType::class, array(
                'label'       => 'Au sein de votre collectivité, existe-t-il un diagnostic de pénibilité annexé au document unique ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctNeceFicheSuiviFact', ChoiceType::class, array(
                'label'       => 'Avez-vous établi des fiches individuelles de suivi des facteurs de pénibilité ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctExistFicheExpoPeni', ChoiceType::class, array(
                'label'       => 'Au sein de votre collectivité, avez-vous mis en place des fiches d\'exposition à la pénibilité au cours de l\'année ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctNeceFicheAmiante', ChoiceType::class, array(
                'label'       => 'Avez-vous établi des fiches d\'exposition à l\'amiante ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctExistFicheAmiante', ChoiceType::class, array(
                'label'       => 'Au sein de votre collectivité, avez-vous mis en place des fiches d\'exposition à l\'amiante au cours de l\'année ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ))
            ->add('rassctExistFicheAmiante', ChoiceType::class, array(
                'label'       => 'Au sein de votre collectivité, avez-vous mis en place des fiches d\'exposition à l\'amiante au cours de l\'année ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded'    => true,
                'multiple'    => false,
                'placeholder' => false,
                'required'    => false,
            ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BscRassctInformationCollectivite::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_consobundle_bscrassctinformationcollectivite';
    }


}
