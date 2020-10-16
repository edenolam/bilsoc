<?php

namespace Bilan_Social\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PurifiedNumberType extends AbstractType
{
    private $purifierTransformer;

    public function __construct(DataTransformerInterface $purifierTransformer)
    {
        $this->purifierTransformer = $purifierTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer($this->purifierTransformer);
    }

    public function getParent()
    {
        return NumberType::class;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'compound' => false,
        ));
    }

    public function getName()
    {
        return 'purified_integer';
    }
    
     /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'empty_data' => NULL,
        ));
    }
}