<?php
/*
*	Entité représentant les échantillons (pools) pour l'InfoCentreBundle
*/
namespace Bilan_Social\Bundle\InfoCentreBundle\Entity;

use Bilan_Social\Bundle\CoreBundle\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

Class Pool extends AbstractEntity{

	#public function __construct(){};

	protected $id;
	private $dateCreation;
	/**
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "Le Nom ne peut pas dépasser {{ limit }} caractères"
     * )
     */
	private $nom;
	private $description;
	private $utilisateur;
	protected $poolExports;
	protected $blAct;
	/*
	*	ArrayCollection de PoolItem
	*/
	private $items;
        
        public function __construct() {
            $this->items = new \Doctrine\Common\Collections\ArrayCollection();
			$this->blAct=1;
        }
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}

	public function getDateCreation(){
		return $this->dateCreation;
	}
	public function setDateCreation($dateCreation){
		$this->dateCreation = $dateCreation;
	}

	public function getNom(){
		return $this->nom;
	}
	public function setNom($nom){
		$this->nom = $nom;
	}

	public function getDescription(){
		return $this->description;
	}
	public function setDescription($description){
		$this->description = $description;
	}

	public function getUtilisateur(){
		return $this->utilisateur;
	}
	public function setUtilisateur($utilisateur){
		$this->utilisateur = $utilisateur;
	}

	public function getItems(){
		return $this->items;
	}
	public function setItems($items){
		$this->items = $items;
	}
	public function addItem(\Bilan_Social\Bundle\InfoCentreBundle\Entity\PoolItem $item){
		if(!$this->items->contains($item)){
			$this->items[] = $item;
		}
	}
	public function removeItem(\Bilan_Social\Bundle\InfoCentreBundle\Entity\PoolItem $item){
		$this->items->removeElement($item);
	}
	public function replaceItem(\Bilan_Social\Bundle\InfoCentreBundle\Entity\PoolItem $item){
		$this->removeItem($item);
		$this->addItem($item);
	}
	public function getItemsIdColl(){
		$id_coll_list = array();
		foreach ($this->getItems() as $key => $item) {
            array_push($id_coll_list, $item->getIdCollectivite());
        }
        return $id_coll_list;
	}
	public function getItemsIdCollByAnnee($annee=null){
		$id_coll_list = array();
		foreach ($this->getItems() as $key => $item) {
			$annee_key = $item->getAnneeCampagne();
			if($annee==null){
				if(!isset($id_coll_list[$annee_key])) $id_coll_list[$annee_key] = array();
				array_push($id_coll_list[$annee_key], $item->getIdCollectivite());
			}else if($annee_key == $annee){
            	array_push($id_coll_list, $item->getIdCollectivite());
            }
        }
        return $id_coll_list;
	}
	public function getPoolExports(){
		return $this->poolExports;
	}
	public function setPollExports($poolExports){
		$this->poolExports = $poolExports;
	}
	public function getBlAct(){
		return $this->blAct;
	}
	public function setBlAct($blAct){
		$this->blAct = $blAct;
	}

	public function initDependancy($em, $annee){
		$coll_repo = $em->getRepository('CollectiviteBundle:Collectivite');
		$enqu_repo = $em->getRepository('EnqueteBundle:Enquete');
		foreach ($this->getItems() as $key => &$item) {
			if($item->getAnneeCamp()==$annee){
				$temp_id_coll = $item->getIdCollectivite();
				$temp_coll = $coll_repo->findOneByIdColl($temp_id_coll);
				$item->setCollectivite($temp_coll);
				$temp_id_enqu = $item->getIdEnquete();
				$temp_enqu = $enqu_repo->findOneByIdEnqu($temp_id_enqu);
				$item->setEnquete($temp_enqu);
			}
		}	
	}

	protected $listAnnee = null;
	public function getListAnnee(){
		if(empty($this->listAnnee)){
			$list_annee = array();
			foreach ($this->getItems() as $key => $item) {
				$temp_annee = $item->getAnneeCampagne();
				if(!in_array($temp_annee, $list_annee)) $list_annee[] = $temp_annee;
			}
			$this->listAnnee = $list_annee;
		}
		return $this->listAnnee;
	}

	protected $groupsAnnee = null;
	public function getGroupsAnnee(){
		if(empty($this->groupsAnnee)){
			$groups = array();
			foreach ($this->getItems() as $key => $item) {
				$temp_annee = $item->getAnneeCampagne();
				if(!isset($groups[$temp_annee])) $groups[$temp_annee] = array();
				$groups[$temp_annee][] = $item;
			}
			$this->groupsAnnee = $groups;
		}
		return $this->groupsAnnee;
	}
}
?>
