<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class MessagePasswordType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        if ($options['messageByAdmin'] != null) {
            $messageByAdmin = $options['messageByAdmin']->getCmMessPass();
        }
        else {
            $messageByAdmin = 'Vous n\'avez pas défini d\'adresse email. Merci de vous rapprocher de votre centre de gestion pour qu\'il vous transmette vos informations de connexion.';
        }

        $builder->add('cmMessPass', CKEditorType::class, array(
            'label'      => 'Message à afficher',
            'empty_data' => $messageByAdmin,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CollectiviteBundle\Entity\MessagePassword'
        ));
        $resolver->setRequired('messageByAdmin');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_collectivitebundle_messagepassword';
    }

}
