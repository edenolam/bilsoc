<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

use JsonSerializable;

use DateTime;

class RefAbstractEntity implements JsonSerializable {

	/**
     * @var boolean
     */
    protected $blExclutotal;

    /**
     * @var boolean
     */
    protected $blVali;

    /**
     * @var integer
     */
    protected $nmOrdre;

	/**
     * Set blExclutotal
     *
     * @param boolean $blExclutotal
     *
     * @return boolean
     */
    public function setBlExclutotal($blExclutotal) {
        $this->blExclutotal = $blExclutotal;

        return $this;
    }

    /**
     * Get blExclutotal
     *
     * @return boolean
     */
    public function getBlExclutotal() {
        return $this->blExclutotal;
    }
    /**
     * Set nmOrdre
     *
     * @param integer $nmOrdre
     *
     * @return integer
     */
    public function setNmOrdre($nmOrdre) {
        $this->nmOrdre = $nmOrdre;

        return $this;
    }

    /**
     * Get nmOrdre
     *
     * @return integer
     */
    public function getNmOrdre() {
        return $this->nmOrdre;
    }


    public function jsonSerialize() {
        $vars = get_object_vars($this);
        $result = array();
        foreach ($vars as $var_name => $var_val) {
            $result[$var_name] = $var_val;
        }
        return $result;
    }

    public function utf8_encode(){
        foreach ($this as $key => &$value) {
            if(is_object($value)){
                if(method_exists($value, "utf8_encode")){
                    $value = $value->utf8_encode();
                }
            }else if(is_array($value)){
                array_walk_recursive($value, function(&$v){
                    if(is_object($v)){
                        if(method_exists($v, "utf8_encode")){
                            $v = $v->utf8_encode();
                        }
                    }else if(!mb_check_encoding($v,"UTF-8")){
                        $v = utf8_encode($v);
                    }
                });
            }else if(!mb_check_encoding($value,"UTF-8")){
                $value = utf8_encode($value);
            }
        }
        return $this;
    }

    /**
     * Set blVali
     *
     * @param boolean $blVali
     *
     * @return RefAbstractEntity
     */
    public function setBlVali($blVali)
    {
        $this->blVali = $blVali;

        return $this;
    }

    /**
     * Get blVali
     *
     * @return boolean
     */
    public function getBlVali()
    {
        return $this->blVali;
    }

    public function setCreatedAtValue()
    {
        return new \DateTime();
    }


    public function setUpdateDateValue()
    {
        return new \DateTime();
    }
}
