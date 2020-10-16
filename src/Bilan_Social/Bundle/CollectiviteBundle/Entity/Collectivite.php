<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

use Bilan_Social\Bundle\CollectiviteBundle\Repository\CollectiviteRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Bilan_Social\Bundle\CoreBundle\Entity\AbstractEntity;
/**
 * Collectivite
 * @UniqueEntity("nmSire", message="errorsiret.collectivite.flash")
 */
class Collectivite extends AbstractEntity
{
    /**
     * @var integer
     * @Assert\NotBlank(message = "collectivite.typecoll.not_blank",groups={"notNull"})
     */
    protected $refTypeCollectivite;
    
    protected $refTypeSurclassDemo;

    /**
     * @var integer
     */
    protected $categorie;
    
    
//    @Assert\NotBlank(message="collectivite.cdgDepartement.not_blank")

    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement
     * 
     */
    protected $cdgDepartement;

    /**
     * @var integer
     * @Assert\NotBlank(message="collectivite.departement.not_blank",groups={"notNull"})
     */
    protected $departement;

    /**
     * @var string
     * @Assert\NotBlank(message = "collectivite.nom.not_blank",groups={"notNull"})
     */
    protected $lbColl;

    /**
     * @var string
     */
    protected $lbAdre;

    /**
     * @var string
     * @Assert\NotBlank(message="collectivite.cdPost.not_blank",groups={"notNull"})
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "collectivite.cdPost.minWidth",
     *      maxMessage = "collectivite.cdPost.maxWidth",
     *      exactMessage = "collectivite.cdPost.exactWidth"
     * )
     */
    protected $cdPost;

    /**
     * @var string
     * @Assert\NotBlank(message = "collectivite.ville.not_blank",groups={"notNull"})
     */
    protected $lbVill;

    /**
     * @var string
     */
    protected $cdInse;

    /**
     * @var string
     * @Assert\NotBlank(message="collectivite.nmSire.not_blank",groups={"notNull"})
     * @Assert\Length(
     *      min = 14,
     *      max = 14,
     *      minMessage = "collectivite.nmSire.minWidth",
     *      maxMessage = "collectivite.nmSire.maxWidth",
     *      exactMessage = "collectivite.nmSire.exactWidth"
     * )
     */
    protected $nmSire;

    /**
     * @var string
     */
    protected $nmSireRata;

    /**
     * @var integer
     */
    protected $nmPopuInse;

    /**
     * @var \DateTime
     */
    protected $dtPopuInse;

    /**
     * @var boolean
     */
    protected $blTranBs;

    /**
     * @var boolean
     */
    protected $blSurclasDemo;

    /**
     * @var integer
     */
    protected $nmSurclasDemo;

    /**
     * @var integer
     */
    protected $nmStratColl;

    /**
     * @var boolean
     */
    protected $blCdgColl;

    /**
     * @var string
     */
    protected $lbContCdg;

    /**
     * @var boolean
     * @Assert\Type("bool")
     * @Assert\NotNull(message="collectivite.blAffiColl.not_blank",groups={"notNull"})
     */
    protected $blAffiColl;

    /**
     * @var boolean
     * @Assert\Type("bool")
     * @Assert\NotNull(message="collectivite.blctcdg.not_blank",groups={"notNull"})
     */
    protected $blCtCdg;

    /**
     * @var boolean
     */
    protected $blChsct;

    /**
     * @var boolean
     * @Assert\Type("bool")
     * @Assert\NotNull(message="collectivite.blCollDgcl.not_blank",groups={"notNull"})
     protected
     */
     protected $blCollDgcl;

    /**
     * @var string
     */
    protected $lbZoneEmplColl;

    /**
     * @var integer
     */
    protected $nmLogeOphlmOdhlm;

    /**
     * @var boolean
     */
    protected $blActi;

    /**
     * @var boolean
     */
    protected $blDiss;

    /**
     * @var \DateTime
     */
    protected $dtDiss;

    /**
     * @var boolean
     */
    protected $blFusi;

    /**
     * @var boolean
     */
    protected $blFirsconn;

    /**
     * @var \DateTime
     */
    protected $dtFusi;

    /**
     * @var boolean
     */
    protected $blAbso;

    /**
     * @var \DateTime
     */
    protected $dtAbso;

    /**
     * @var string
     */
    protected $cmInfoComp;

    /**
     * @var string
     */
    protected $cmMoti;

    /**
     * @var boolean
     */
    protected $change_request;

    /**
     * @var string
     */
    protected $cdUtilcrea;

    /**
     * @var \DateTime
     */
    protected $dtCrea;

    /**
     * @var string
     protected
     */
    protected $cdUtilmodi;

    /**
     * @var \DateTime
     */
    protected $dtModi;

    /**
     * @var integer
     */
    protected $idColl;

    /**
     * @var boolean
     */
    protected $cdg_is_authorized_by_collectivity;

    /**
     * @var boolean
     */
    protected $cdgGpeec;

    /**
     * @var boolean
     */
    protected $blAnalyseGpeec;

    /**
     * @var boolean
     */
    protected $cartoGpeec;

    /**
     * @var boolean
     */
    protected $convention;

    /**
     * @var boolean
     */
    protected $gpeecAcceder;

    /**
     * @var boolean
     */
    protected $gpeecAutoriserAccesCdg;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $contacts;

    /*
     * @var \Bilan_Social\Bundle\UserBundle\Entity\User
     */

    protected $utilisateurs;

    /*
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueEchange
     */

    protected $historiqueEchange;

    /*
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite
     */

    protected $historiqueCollectivite;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $demandeAnalyse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $modeleAnalyse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $fichiers;

    /**
    * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCourtier
    */
    protected $refCourtier;

    /**
     * Constructor
     */
    public function __construct() {
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fichiers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modeleAnalyse = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getRefTypeCollectivite() {
        return $this->refTypeCollectivite;
    }

    function setRefTypeCollectivite($refTypeCollectivite) {
        $this->refTypeCollectivite = $refTypeCollectivite;
    }
    
    function getRefTypeSurclassDemo() {
        return $this->refTypeSurclassDemo;
    }

    function setRefTypeSurclassDemo($refTypeSurclassDemo) {
        $this->refTypeSurclassDemo = $refTypeSurclassDemo;
    }

    
    /**
     * Get cdgDepartement
     *
     * @return \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement cdgDepartement
     */
    function getCdgDepartement() {
        return $this->cdgDepartement;
    }

    /**
     * Set cdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement
     *
     * @return Collectivite
     */
    function setCdgDepartement($cdgDepartement) {
        $this->cdgDepartement = $cdgDepartement;
    }

    function getDepartement() {
        return $this->departement;
    }

    function setDepartement($departement) {
        $this->departement = $departement;
    }

    function getCategorie() {
        return $this->categorie;
    }

    function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    function getBlChsct() {
        return $this->blChsct;
    }

    function setBlchsct($blchsct) {
        $this->blChsct = $blchsct;
    }

    function getDtPopuInse() {
        return $this->dtPopuInse;
    }

    function setDtPopuInse($dtPopuInse) {
        $this->dtPopuInse = $dtPopuInse;
    }


    /**
     * Set lbColl
     *
     * @param string $lbColl
     *
     * @return Collectivite
     */
    public function setLbColl($lbColl)
    {
        $this->lbColl = $lbColl;

        return $this;
    }

    /**
     * Get lbColl
     *
     * @return string
     */
    public function getLbColl()
    {
        return $this->lbColl;
    }

    /**
     * Set lbAdre
     *
     * @param string $lbAdre
     *
     * @return Collectivite
     */
    public function setLbAdre($lbAdre)
    {
        $this->lbAdre = $lbAdre;

        return $this;
    }

    /**
     * Get lbAdre
     *
     * @return string
     */
    public function getLbAdre()
    {
        return $this->lbAdre;
    }

    /**
     * Set cdPost
     *
     * @param string $cdPost
     *
     * @return Collectivite
     */
    public function setCdPost($cdPost)
    {
        $this->cdPost = $cdPost;

        return $this;
    }

    /**
     * Get cdPost
     *
     * @return string
     */
    public function getCdPost()
    {
        return $this->cdPost;
    }

    /**
     * Set lbVill
     *
     * @param string $lbVill
     *
     * @return Collectivite
     */
    public function setLbVill($lbVill)
    {
        $this->lbVill = $lbVill;

        return $this;
    }

    /**
     * Get lbVill
     *
     * @return string
     */
    public function getLbVill()
    {
        return $this->lbVill;
    }

    /**
     * Set cdInse
     *
     * @param string $cdInse
     *
     * @return Collectivite
     */
    public function setCdInse($cdInse)
    {
        $this->cdInse = $cdInse;

        return $this;
    }

    /**
     * Get cdInse
     *
     * @return string
     */
    public function getCdInse()
    {
        return $this->cdInse;
    }

    /**
     * Set nmSire
     *
     * @param string $nmSire
     *
     * @return Collectivite
     */
    public function setNmSire($nmSire)
    {
        $this->nmSire = $nmSire;

        return $this;
    }

    /**
     * Get nmSire
     *
     * @return string
     */
    public function getNmSire()
    {
        return $this->nmSire;
    }

    /**
     * Set nmSireRata
     *
     * @param string $nmSireRata
     *
     * @return Collectivite
     */
    public function setNmSireRata($nmSireRata)
    {
        $this->nmSireRata = $nmSireRata;

        return $this;
    }

    /**
     * Get nmSireRata
     *
     * @return string
     */
    public function getNmSireRata()
    {
        return $this->nmSireRata;
    }

    /**
     * Set nmPopuInse
     *
     * @param integer $nmPopuInse
     *
     * @return Collectivite
     */
    public function setNmPopuInse($nmPopuInse)
    {
        $this->nmPopuInse = $nmPopuInse;

        return $this;
    }

    /**
     * Get nmPopuInse
     *
     * @return integer
     */
    public function getNmPopuInse()
    {
        return $this->nmPopuInse;
    }

    /**
     * Set blTranBs
     *
     * @param boolean $blTranBs
     *
     * @return Collectivite
     */
    public function setBlTranBs($blTranBs)
    {
        $this->blTranBs = $blTranBs;

        return $this;
    }

    /**
     * Get blTranBs
     *
     * @return boolean
     */
    public function getBlTranBs()
    {
        return $this->blTranBs;
    }

    /**
     * Set blSurclasDemo
     *
     * @param boolean $blSurclasDemo
     *
     * @return Collectivite
     */
    public function setBlSurclasDemo($blSurclasDemo)
    {
        $this->blSurclasDemo = $blSurclasDemo;

        return $this;
    }

    /**
     * Get blSurclasDemo
     *
     * @return boolean
     */
    public function getBlSurclasDemo()
    {
        return $this->blSurclasDemo;
    }

    /**
     * Set nmSurclasDemo
     *
     * @param integer $nmSurclasDemo
     *
     * @return Collectivite
     */
    public function setNmSurclasDemo($nmSurclasDemo)
    {
        $this->nmSurclasDemo = $nmSurclasDemo;

        return $this;
    }

    /**
     * Get nmSurclasDemo
     *
     * @return integer
     */
    public function getNmSurclasDemo()
    {
        return $this->nmSurclasDemo;
    }

    /**
     * Set nmStratColl
     *
     * @param integer $nmStratColl
     *
     * @return Collectivite
     */
    public function setNmStratColl($nmStratColl)
    {
        $this->nmStratColl = $nmStratColl;

        return $this;
    }

    /**
     * Get nmStratColl
     *
     * @return integer
     */
    public function getNmStratColl()
    {
        return $this->nmStratColl;
    }

    /**
     * Set blCdgColl
     *
     * @param boolean $blCdgColl
     *
     * @return Collectivite
     */
    public function setBlCdgColl($blCdgColl)
    {
        $this->blCdgColl = $blCdgColl;

        return $this;
    }

    /**
     * Get blCdgColl
     *
     * @return boolean
     */
    public function getBlCdgColl()
    {
        return $this->blCdgColl;
    }

    /**
     * Set lbContCdg
     *
     * @param string $lbContCdg
     *
     * @return Collectivite
     */
    public function setLbContCdg($lbContCdg)
    {
        $this->lbContCdg = $lbContCdg;

        return $this;
    }

    /**
     * Get lbContCdg
     *
     * @return string
     */
    public function getLbContCdg()
    {
        return $this->lbContCdg;
    }

    /**
     * Set blAffiColl
     *
     * @param boolean $blAffiColl
     *
     * @return Collectivite
     */
    public function setBlAffiColl($blAffiColl)
    {
        $this->blAffiColl = $blAffiColl;

        return $this;
    }

    /**
     * Get blAffiColl
     *
     * @return boolean
     */
    public function getBlAffiColl()
    {
        return $this->blAffiColl;
    }

    /**
     * Set blCtCdg
     *
     * @param boolean $blCtCdg
     *
     * @return Collectivite
     */
    public function setBlCtCdg($blCtCdg)
    {
        $this->blCtCdg = $blCtCdg;

        return $this;
    }

    /**
     * Get blCtCdg
     *
     * @return boolean
     */
    public function getBlCtCdg()
    {
        return $this->blCtCdg;
    }

    /**
     * Set blCollDgcl
     *
     * @param boolean $blCollDgcl
     *
     * @return Collectivite
     */
    public function setBlCollDgcl($blCollDgcl)
    {
        $this->blCollDgcl = $blCollDgcl;

        return $this;
    }

    /**
     * Get blCollDgcl
     *
     * @return boolean
     */
    public function getBlCollDgcl()
    {
        return $this->blCollDgcl;
    }

    /**
     * Set lbZoneEmplColl
     *
     * @param string $lbZoneEmplColl
     *
     * @return Collectivite
     */
    public function setLbZoneEmplColl($lbZoneEmplColl)
    {
        $this->lbZoneEmplColl = $lbZoneEmplColl;

        return $this;
    }

    /**
     * Get lbZoneEmplColl
     *
     * @return string
     */
    public function getLbZoneEmplColl()
    {
        return $this->lbZoneEmplColl;
    }

    /**
     * Set nmLogeOphlmOdhlm
     *
     * @param integer $nmLogeOphlmOdhlm
     *
     * @return Collectivite
     */
    public function setNmLogeOphlmOdhlm($nmLogeOphlmOdhlm)
    {
        $this->nmLogeOphlmOdhlm = $nmLogeOphlmOdhlm;

        return $this;
    }

    /**
     * Get nmLogeOphlmOdhlm
     *
     * @return integer
     */
    public function getNmLogeOphlmOdhlm()
    {
        return $this->nmLogeOphlmOdhlm;
    }

    /**
     * Set blActi
     *
     * @param boolean $blActi
     *
     * @return Collectivite
     */
    public function setBlActi($blActi)
    {
        $this->blActi = $blActi;

        return $this;
    }

    /**
     * Get blActi
     *
     * @return boolean
     */
    public function getBlActi()
    {
        return $this->blActi;
    }

    /**
     * Set blDiss
     *
     * @param boolean $blDiss
     *
     * @return Collectivite
     */
    public function setBlDiss($blDiss)
    {
        $this->blDiss = $blDiss;

        return $this;
    }

    /**
     * Get blDiss
     *
     * @return boolean
     */
    public function getBlDiss()
    {
        return $this->blDiss;
    }

    /**
     * Set dtDiss
     *
     * @param \DateTime $dtDiss
     *
     * @return Collectivite
     */
    public function setDtDiss($dtDiss)
    {
        $this->dtDiss = $dtDiss;

        return $this;
    }

    /**
     * Get dtDiss
     *
     * @return \DateTime
     */
    public function getDtDiss()
    {
        return $this->dtDiss;
    }

    /**
     * Set blFusi
     *
     * @param boolean $blFusi
     *
     * @return Collectivite
     */
    public function setBlFusi($blFusi)
    {
        $this->blFusi = $blFusi;

        return $this;
    }

    /**
     * Get blFusi
     *
     * @return boolean
     */
    public function getBlFusi()
    {
        return $this->blFusi;
    }

    /**
     * Set blFirsconn
     *
     * @param boolean $blFirsconn
     *
     * @return Collectivite
     */
    public function setBlFirsconn($blFirsconn)
    {
        $this->blFirsconn = $blFirsconn;

        return $this;
    }

    /**
     * Get blFirsconn
     *
     * @return boolean
     */
    public function getBlFirsconn()
    {
        return $this->blFirsconn;
    }

    /**
     * Set dtFusi
     *
     * @param \DateTime $dtFusi
     *
     * @return Collectivite
     */
    public function setDtFusi($dtFusi)
    {
        $this->dtFusi = $dtFusi;

        return $this;
    }

    /**
     * Get dtFusi
     *
     * @return \DateTime
     */
    public function getDtFusi()
    {
        return $this->dtFusi;
    }

    /**
     * Set blAbso
     *
     * @param boolean $blAbso
     *
     * @return Collectivite
     */
    public function setBlAbso($blAbso)
    {
        $this->blAbso = $blAbso;

        return $this;
    }

    /**
     * Get blAbso
     *
     * @return boolean
     */
    public function getBlAbso()
    {
        return $this->blAbso;
    }

    /**
     * Set dtAbso
     *
     * @param \DateTime $dtAbso
     *
     * @return Collectivite
     */
    public function setDtAbso($dtAbso)
    {
        $this->dtAbso = $dtAbso;

        return $this;
    }

    /**
     * Get dtAbso
     *
     * @return \DateTime
     */
    public function getDtAbso()
    {
        return $this->dtAbso;
    }

    /**
     * Set cmInfoComp
     *
     * @param string $cmInfoComp
     *
     * @return CollectiviteDraft
     */
    public function setCmInfoComp($cmInfoComp)
    {
        $this->cmInfoComp = $cmInfoComp;

        return $this;
    }

    /**
     * Get cmInfoComp
     *
     * @return string
     */
    public function getCmInfoComp()
    {
        return $this->cmInfoComp;
    }

    /**
     * Set cmMoti
     *
     * @param string $cmMoti
     *
     * @return CollectiviteDraft
     */
    public function setCmMoti($cmMoti)
    {
        $this->cmMoti = $cmMoti;

        return $this;
    }

    /**
     * Get cmMoti
     *
     * @return string
     */
    public function getCmMoti()
    {
        return $this->cmMoti;
    }

    /**
     * Set change_request
     *
     * @param boolean $changeRequest
     * @return Collectivite
     */
    public function setChangeRequest($changeRequest) {
        $this->change_request = $changeRequest;

        return $this;
    }

    /**
     * Get change_request
     *
     * @return boolean
     */
    public function getchange_request() {
        return $this->change_request;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return Collectivite
     */
    public function setCdUtilcrea($cdUtilcrea)
    {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea()
    {
        return $this->cdUtilcrea;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return Collectivite
     */
    public function setDtCrea($dtCrea)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea()
    {
        return $this->dtCrea;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return Collectivite
     */
    public function setCdUtilmodi($cdUtilmodi)
    {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi()
    {
        return $this->cdUtilmodi;
    }

    /**
     * Set dtModi
     *
     * @param \DateTime $dtModi
     *
     * @return Collectivite
     */
    public function setDtModi($dtModi)
    {
        $this->dtModi = $dtModi;

        return $this;
    }

    /**
     * Get dtModi
     *
     * @return \DateTime
     */
    public function getDtModi()
    {
        return $this->dtModi;
    }

    /**
     * Get idColl
     *
     * @return integer
     */
    public function getIdColl()
    {
        return $this->idColl;
    }

    /**
     * Set cdg_is_authorized_by_collectivity
     *
     * @param boolean $cdgIsAuthorizedByCollectivity
     * @return CollectiviteDraft
     */
    public function setCdgIsAuthorizedByCollectivity($cdgIsAuthorizedByCollectivity) {
        $this->cdg_is_authorized_by_collectivity = $cdgIsAuthorizedByCollectivity;

        return $this;
    }

    /**
     * Get cdg_is_authorized_by_collectivity
     *
     * @return boolean
     */
    public function getCdgIsAuthorizedByCollectivity() {
        return $this->cdg_is_authorized_by_collectivity;
    }

    /**
     * Set cdgGpeec
     *
     * @param boolean $cdgGpeec
     * @return User
     */
    public function setCdgGpeec($cdgGpeec) {
        $this->cdgGpeec = $cdgGpeec;

        return $this;
    }

    /**
     * Get cdgGpeec
     *
     * @return boolean
     */
    public function getCdgGpeec() {
        return $this->cdgGpeec;
    }

    /**
     * Set blAnalyseGpeec
     *
     * @param boolean $blAnalyseGpeec
     * @return User
     */
    public function setBlAnalyseGpeec($blAnalyseGpeec) {
        $this->blAnalyseGpeec = $blAnalyseGpeec;

        return $this;
    }

    /**
     * Get blAnalyseGpeec
     *
     * @return boolean
     */
    public function getBlAnalyseGpeec() {
        return $this->blAnalyseGpeec;
    }

    /**
     * Set cartoGpeec
     *
     * @param boolean $cartoGpeec
     * @return User
     */
    public function setCartoGpeec($cartoGpeec) {
        $this->cartoGpeec = $cartoGpeec;

        return $this;
    }

    /**
     * Get cartoGpeec
     *
     * @return boolean
     */
    public function getCartoGpeec() {
        return $this->cartoGpeec;
    }

    /**
     * Set convention
     *
     * @param boolean $convention
     * @return User
     */
    public function setConvention($convention) {
        $this->convention = $convention;

        return $this;
    }

    /**
     * Get convention
     *
     * @return boolean
     */
    public function getConvention() {
        return $this->convention;
    }

    /**
     * Set gpeecAcceder
     *
     * @param boolean $gpeecAcceder
     * @return self
     */
    public function setGpeecAcceder($gpeecAcceder) {
        $this->gpeecAcceder = $gpeecAcceder;

        return $this;
    }

    /**
     * Get gpeecAcceder
     *
     * @return boolean
     */
    public function getGpeecAcceder() {
        return $this->gpeecAcceder;
    }

    /**
     * Set gpeecAutoriserAccesCdg
     *
     * @param boolean $gpeecAutoriserAccesCdg
     * @return self
     */
    public function setGpeecAutoriserAccesCdg($gpeecAutoriserAccesCdg) {
        $this->gpeecAutoriserAccesCdg = $gpeecAutoriserAccesCdg;

        return $this;
    }

    /**
     * Get gpeecAutoriserAccesCdg
     *
     * @return boolean
     */
    public function getGpeecAutoriserAccesCdg() {
        return $this->gpeecAutoriserAccesCdg;
    }

    /**
     * Add contact
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CollectiviteContact $contact
     *
     * @return Retourne la liste des contacts d'un CDG
     */
    public function addContact(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CollectiviteContact $contact) {
        $this->contacts[] = $contact;
        return $this;
    }

    /*
     * Remove contact
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CollectiviteContact $contact
     */
    public function removeContact(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CollectiviteContact $contact) {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get enquetes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts() {
        return $this->contacts;

    }
    function getUtilisateurs() {
        return $this->utilisateurs;
    }

    function setUtilisateurs($utilisateurs) {
        $this->utilisateurs = $utilisateurs;
    }
    function getHistoriqueEchange() {
        return $this->historiqueEchange;
    }

    function setHistoriqueEchange($historiqueEchange) {
        $this->historiqueEchange = $historiqueEchange;
    }
    function getHistoriqueCollectivite() {
        return $this->historiqueCollectivite;
    }

    function setHistoriqueCollectivite($historiqueCollectivite) {
        $this->historiqueCollectivite = $historiqueCollectivite;
    }
    function getDemandeAnalyse() {
        return $this->demandeAnalyse;
    }

    function setDemandeAnalyse($demandeAnalyse) {
        $this->demandeAnalyse = $demandeAnalyse;
    }
    
    

    /**
     * Add fichier
     *
     * param \Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier $fichiers
     *
     */
    public function addFichier(\Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier $fichiers) {
        $this->fichiers[] = $fichiers;

        return $this;
    }

    /**
     * Remove fichier
     *
     * @param \Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier $fichiers
     */
    public function removeFichier(\Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier $fichiers) {
        $this->fichiers->removeElement($fichiers);
    }

    /**
     * Get fichiers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFichiers() {
        return $this->fichiers;
    }
    

    /**
     * Add modeleAnalyse
     *
     * param \Bilan_Social\Bundle\AnalyseBundle\Entity\ModeleAnalyse $modeleAnalyse
     *
     */
    public function addModeleAnalyse(\Bilan_Social\Bundle\AnalyseBundle\Entity\ModeleAnalyse $modeleAnalyse) {
        $this->modeleAnalyse[] = $modeleAnalyse;

        return $this;
    }

    /**
     * Remove modeleAnalyse
     *
     * @param \Bilan_Social\Bundle\AnalyseBundle\Entity\ModeleAnalyse $modeleAnalyse
     */
    public function removeModeleAnalyse(\Bilan_Social\Bundle\AnalyseBundle\Entity\ModeleAnalyse $modeleAnalyse) {
        $this->modeleAnalyse->removeElement($modeleAnalyse);
    }

    /**
     * Get modeleAnalyse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModeleAnalyse() {
        return $this->modeleAnalyse;
    }



    /**
     * Get changeRequest
     *
     * @return boolean
     */
    public function getChangeRequest()
    {
        return $this->change_request;
    }

    /**
     * Add utilisateur
     *
     * @param \Bilan_Social\Bundle\UserBundle\Entity\User $utilisateur
     *
     * @return Collectivite
     */
    public function addUtilisateur(\Bilan_Social\Bundle\UserBundle\Entity\User $utilisateur)
    {
        $this->utilisateurs[] = $utilisateur;

        return $this;
    }

    /**
     * Remove utilisateur
     *
     * @param \Bilan_Social\Bundle\UserBundle\Entity\User $utilisateur
     */
    public function removeUtilisateur(\Bilan_Social\Bundle\UserBundle\Entity\User $utilisateur)
    {
        $this->utilisateurs->removeElement($utilisateur);
    }

    /**
     * Add historiqueEchange
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueEchange $historiqueEchange
     *
     * @return Collectivite
     */
    public function addHistoriqueEchange(\Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueEchange $historiqueEchange)
    {
        $this->historiqueEchange[] = $historiqueEchange;

        return $this;
    }

    /**
     * Remove historiqueEchange
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueEchange $historiqueEchange
     */
    public function removeHistoriqueEchange(\Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueEchange $historiqueEchange)
    {
        $this->historiqueEchange->removeElement($historiqueEchange);
    }

    /**
     * Add historiqueCollectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivite
     *
     * @return Collectivite
     */
    public function addHistoriqueCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivite)
    {
        $this->historiqueCollectivite[] = $historiqueCollectivite;

        return $this;
    }

    /**
     * Remove historiqueCollectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivite
     */
    public function removeHistoriqueCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivite)
    {
        $this->historiqueCollectivite->removeElement($historiqueCollectivite);
    }

    /**
     * Add demandeAnalyse
     *
     * @param \Bilan_Social\Bundle\AnalyseBundle\Entity\DemandeAnalyse $demandeAnalyse
     *
     * @return Collectivite
     */
    public function addDemandeAnalyse(\Bilan_Social\Bundle\AnalyseBundle\Entity\DemandeAnalyse $demandeAnalyse)
    {
        $this->demandeAnalyse[] = $demandeAnalyse;

        return $this;
    }

    /**
     * Remove demandeAnalyse
     *
     * @param \Bilan_Social\Bundle\AnalyseBundle\Entity\DemandeAnalyse $demandeAnalyse
     */
    public function removeDemandeAnalyse(\Bilan_Social\Bundle\AnalyseBundle\Entity\DemandeAnalyse $demandeAnalyse)
    {
        $this->demandeAnalyse->removeElement($demandeAnalyse);
    }

    /**
     * Set refCourtier
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCourtier $refCourtier
     *
     * @return Collectivite
     */
    public function setRefCourtier(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCourtier $refCourtier = null)
    {
        $this->refCourtier = $refCourtier;

        return $this;
    }

    /**
     * Get refCourtier
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCourtier
     */
    public function getRefCourtier()
    {
        return $this->refCourtier;
    }
}
