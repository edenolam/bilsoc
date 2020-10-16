<?php
/*
*
*/
namespace Bilan_Social\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormEvents;

class DynamicFormType extends AbstractType{
    private $class_map;
    
    public function __construct(){

    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function($event){
            $form = $form = $event->getForm();
            $data = $event->getData();
            $class_map = $data->getClassMap();
            $this->class_map = $class_map;
            $props_map = $class_map->getPropertiesMap();
            foreach ($props_map as $prop_name => $value) {
                $form = $this->buildField($form,$prop_name);
            }
        });
    }/**
     * {@inheritdoc}
     */
    /*public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }*/
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'DynamicFormType';
    }

    public function getFieldPropParam($field_name,$param_name=null){
    	$param = $this->class_map->getPropParam($field_name,$param_name);
    	return $param;
    }
    public function getFieldFormParams($field_name){
    	$field_type = $this->getCorrespondanceType($field_name);
    	
        $form_options = $this->getFieldPropParam($field_name,'form_options');
        return array('field_type'=>$field_type,'form_options'=>$form_options);
    }
    public function buildField(&$builder,$field_name){
        if($this->class_map->isPropForForm($field_name)){            
            extract($this->getFieldFormParams($field_name));
            $builder->add($field_name,$field_type,$form_options);  
        }
        return $builder;
    }

    public function getCorrespondanceType($field_name){
        $prop_type = $this->class_map->getPropParam($field_name,'form_type');
        $prop_type = $prop_type == null ? $this->class_map->getPropParam($field_name,'data_type') : $prop_type;
        $field_type = null;
        switch ($prop_type) {
            case 'string':
                $field_type = PurifiedTextType::class;
                break;
            case 'textarea':
                $field_type = PurifiedTextareaType::class;
                break;
            case 'number':
                $field_type = PurifiedNumberType::class;
                break;
            case 'date':
                $field_type = DateType::class;
                break;
            case 'range':
                $field_type = RangeType::class;
                break;
            case 'choice':
            case 'choices':
                $field_type = ChoiceType::class;
                break;
            case 'list':
            case 'collection':
                $field_type = CollectionType::class;
                break;
            default:
                $field_type = PurifiedTextType::class;
                break;
        }
        return $field_type;
    }

    public function isSqlSrcType($field_name){
    	return $this->getFieldPropParam($field_name,'src_type') === $this->class_map::SQL_DATA_SRC;
    }
    public function isBuildInSrcType($field_name){
    	return $this->getFieldPropParam($field_name,'src_type') === $this->class_map::BUILD_IN_DATA_SRC;
    }
    public function isRawManualSrcType($field_name){
    	return $this->getFieldPropParam($field_name,'src_type') === $this->class_map::RAW_MANUAL_DATA_SRC;
    }
}