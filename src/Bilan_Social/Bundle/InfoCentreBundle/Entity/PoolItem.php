<?php
/*
*	Entité représentant les échantillons (pools) pour l'InfoCentreBundle
*/
namespace Bilan_Social\Bundle\InfoCentreBundle\Entity;

use Bilan_Social\Bundle\CoreBundle\Entity\AbstractEntity;

Class PoolItem extends AbstractEntity{

	#public function __construct(){};

	private $id;
	private $idCollectivite;
	private $collectivite;
	private $idEnquete;
	private $enquete;
	private $anneeCampagne;
	/*
	*	Pool
	*/
	private $pool;

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}

    /**
     * @return mixed
     */
    public function getIdCollectivite()
    {
        return $this->idCollectivite;
    }

    /**
     * @param mixed $idCollectivite
     */
    public function setIdCollectivite($idCollectivite)
    {
        $this->idCollectivite = $idCollectivite;
    }



	public function getCollectivite(){
		return $this->collectivite;
	}
	public function setCollectivite($collectivite){
		$this->collectivite = $collectivite;
        $this->setIdCollectivite($collectivite->getIdColl());
	}

    /**
     * @return mixed
     */
    public function getIdEnquete()
    {
        return $this->idEnquete;
    }

    /**
     * @param mixed $idEnquete
     */
    public function setIdEnquete($idEnquete)
    {
        $this->idEnquete = $idEnquete;
    }

	public function getEnquete(){
		return $this->enquete;
	}
	public function setEnquete($enquete){
		$this->enquete = $enquete;
		$this->setIdEnquete($enquete->getIdEnqu());
	}

	public function getDescription(){
		return $this->enquete;
	}
	public function setDescription($enquete){
		$this->enquete = $enquete;
	}

	public function getPool(){
		return $this->pool;
	}
	public function setPool($pool){
		$this->pool = $pool;
	}

    /**
     * @return mixed
     */
    public function getAnneeCampagne()
    {
        return $this->anneeCampagne;
    }

    /**
     * @param mixed $anneeCampagne
     */
    public function setAnneeCampagne($anneeCampagne)
    {
        $this->anneeCampagne = $anneeCampagne;
    }


    public function initDependancy($em, $annee=null){
        $coll_repo = $em->getRepository('CollectiviteBundle:Collectivite');
        $enqu_repo = $em->getRepository('EnqueteBundle:Enquete');
        $temp_id_coll = $this->getIdCollectivite();
        $temp_coll = $coll_repo->findOneByIdColl($temp_id_coll);
        $this->setCollectivite($temp_coll);
        $temp_id_enqu = $this->getIdEnquete();
        $temp_enqu = $enqu_repo->findOneByIdEnqu($temp_id_enqu);
        $this->setEnquete($temp_enqu);
    }
}
?>
