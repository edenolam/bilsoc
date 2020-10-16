<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DgclType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('blJoursCarence', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                    'label'       => false,
                    'attr' => array(
                        'class' => 'dgcl',
                    ),
                ))
                ->add('nbJoursCarence', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger dgcl'
                    )
                ))
                ->add('nbMontantCarence', PurifiedNumberType::class, array(
                    'label' => "agent.nbMontantCarence.label",
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger dgcl'
                    )
                ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\Dgcl'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_apabundle_dgcl';
    }


}
