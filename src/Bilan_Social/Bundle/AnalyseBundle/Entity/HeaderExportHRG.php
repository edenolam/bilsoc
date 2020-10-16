<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Entity;

use Doctrine\Common\Collections\Collection;

class HeaderExportHRG implements \JsonSerializable
{
    
    protected $id;
    protected $pid;
    protected $status;
    protected $idUtil;
    protected $codeExport;
    protected $dateStart;
    protected $dateEnd;
    protected $fileKeys;
    protected $poolExport;
    
    public function __construct() {
        $this->dateStart = new \DateTime();
        $this->status = 0;
		$this->fileKeys = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    public function getPid()
    {
        return $this->pid;
    }

    function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getIdUtil()
    {
        return $this->idUtil;
    }

    public function setIdUtil($idUtil)
    {
        $this->idUtil = $idUtil;

        return $this;
    }

    public function getCodeExport()
    {
        return $this->codeExport;
    }

    public function setCodeExport($codeExport)
    {
        $this->codeExport = $codeExport;

        return $this;
    }

    public function getDateStart()
    {
        return $this->dateStart;
    }

    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function addFileKey($fileKey) {
        $this->getFileKeys()->add($fileKey);
    }

    public function removeFileKey($fileKey) {
        $this->getFileKeys()->removeElement($fileKey);
    }

    public function getFileKeys()
    {
        return $this->fileKeys;
    }

    public function setFileKeys($fileKey)
    {
        $this->fileKeys = $fileKey;

        return $this;
    }

    public function getPoolExport()
    {
        return $this->poolExport;
    }

    public function setPoolExport($poolExport)
    {
        $this->poolExport = $poolExport;

        return $this;
    }

    public function jsonSerialize(){
        $to_return = array();
        foreach($this as $key => $prop){
            if($prop instanceof Collection) {
                foreach($prop as $fileKey) {
                }
                $to_return['fileKeys'] = $prop != null ? $prop->getValues() : null;
            }
            if($key=="poolExport") {
                $to_return['pool_export_id'] = $prop!=null ? $prop->getId() : null;
            } else {
                $to_return[$key]=$prop;
            }
        }
        
        return $to_return;
   }
}
