<?php

namespace Bilan_Social\Bundle\InfoCentreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\DynamicFormType;
use Bilan_Social\Bundle\CoreBundle\Model\ClassMap;

class FilterType extends DynamicFormType
{
	protected $sql_filter_parser;
	
	public function __construct($sql_filter_parser){
		parent::__construct();
		$this->sql_filter_parser = $sql_filter_parser;
	}

	public function getFieldFormParams($field_name){
		extract(parent::getFieldFormParams($field_name));
		if($this->isSqlSrcType($field_name)){
			$src_config = $this->getFieldPropParam($field_name,'src');
			$choices = $this->sql_filter_parser->getFromSrcConfig($src_config);
			$form_options['choices']=$choices;
		}elseif($this->isRawManualSrcType($field_name)){
			$choices = $this->getFieldPropParam($field_name,'src');
			$form_options['choices']=$choices;
		}elseif($this->isBuildInSrcType($field_name)){

			$choices = ClassMap::getBuildInDataSrc($this->getFieldPropParam($field_name,'src'));
			$form_options['choices']=$choices;
		}
        return array('field_type'=>$field_type,'form_options'=>$form_options);
    }

    public function getBlockPrefix()
    {
        return 'infocentre_filter_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'attr' => ['id' => 'infocentre_filter_form']
        ]);
    }

}
?>