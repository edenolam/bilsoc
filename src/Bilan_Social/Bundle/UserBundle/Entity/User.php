<?php

namespace Bilan_Social\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Bilan_Social\Bundle\UserBundle\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Bilan_Social\Bundle\UserBundle\Validator\Constraints as DGCLAssert;

//  /**
//     * @var string
//     * @DGCLAssert\ConstraintDGCL
//     * @Assert\Regex(
//     *     pattern="/^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w])\S{8,}$/",
//     *     match=true,
//     *     message="erreur.constraint.weakPassword"
//     * )
//     */

/**
 * User
 */
class User extends AbstractUser implements UserInterface, AdvancedUserInterface, \Serializable {
    
    
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Wrong value for your current password", groups={"equal"}
     * )
     */
    private $oldPassword;
     
    /**
     * @var Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    private $collectivite;

    /**
     * @var string
     */
    private $username;

  
    private $password;

    /**
     * @var string
     */
    private $fgTypeutil;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var boolean
     */
    private $change_request;

    /**
     * @var boolean
     */
    private $can_valid_user_account;

    /**
     * @var boolean
     */
    private $can_view;

    /**
     * @var boolean
     */
    private $can_edit;

    /**
     * @var boolean
     */
    private $cdg_is_authorized_by_collectivity;
    protected $email;

    /**
     * @var string
     */
    private $postal_code;

    /**
     * @var string
     */
    protected $department;

    /**
     * @var \DateTime
     */
    private $dtLastconn;

    /**
     * @var integer
     */
    private $nmErreconn;

    /**
     * @var string
     */
    private $fgStat;

    /**
     * @var string
     */
    private $confirmCode;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $dtBlocage;

    /**
     * @var integer
     */
    private $idUtil;

    /**
     * @var integer
     */
    private $fgBlocage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $utilisateurDroits;
    
    /**
     *
     * @var boolean
     */
    private $droitMails;

    /**
     * @var boolean
     */
    private $blGpeec;


    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pools;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $utilisateurCdgs;
    
    private $profil;
    private $cdgs;

    private $profils;
    private $departements;
    private $campagnes;

    public function __construct() {
        $this->isActive = true;
        $this->changedRequest = false;
        $this->canValidUserAccount = false;
        $this->canView = false;
        $this->canEdit = false;
        $this->cdgIsAuthorizedByCollectivity = false;
        $this->utilisateurDroits = new \Doctrine\Common\Collections\ArrayCollection();
        $this->utilisateurCdgs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dtBlocage = new \DateTime();
        $this->departements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->campagnes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->blGpeec = false;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set fgTypeutil
     *
     * @param string $fgTypeutil
     * @return User
     */
    public function setFgTypeutil($fgTypeutil) {
        $this->fgTypeutil = $fgTypeutil;

        return $this;
    }

    /**
     * Get fgTypeutil
     *
     * @return string
     */
    public function getFgTypeutil() {
        return $this->fgTypeutil;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles() {
        $roles = $this->roles;
        // we need to make sure to have at least one role
        $roles[] = static::ROLE_DEFAULT;
        return array_unique($roles);
    }

    /**
     * {@inheritdoc}
     */
    public function setRoles(array $roles) {
        $this->roles = array();
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }

    /**
     * Set change_request
     *
     * @param boolean $changeRequest
     * @return User
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
    public function getChangeRequest() {
        return $this->change_request;
    }

    /**
     * Set can_valid_user_account
     *
     * @param boolean $canValidUserAccount
     * @return User
     */
    public function setCanValidUserAccount($canValidUserAccount) {
        $this->can_valid_user_account = $canValidUserAccount;

        return $this;
    }

    /**
     * Get can_valid_user_account
     *
     * @return boolean
     */
    public function getCanValidUserAccount() {
        return $this->can_valid_user_account;
    }

    /**
     * Set can_view
     *
     * @param boolean $canView
     * @return User
     */
    public function setCanView($canView) {
        $this->can_view = $canView;

        return $this;
    }

    /**
     * Get can_view
     *
     * @return boolean
     */
    public function getCanView() {
        return $this->can_view;
    }

    /**
     * Set can_edit
     *
     * @param boolean $canEdit
     * @return User
     */
    public function setCanEdit($canEdit) {
        $this->can_edit = $canEdit;

        return $this;
    }

    /**
     * Get can_edit
     *
     * @return boolean
     */
    public function getCanEdit() {
        return $this->can_edit;
    }

    /**
     * Set cdg_is_authorized_by_collectivity
     *
     * @param boolean $cdgIsAuthorizedByCollectivity
     * @return User
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set postal_code
     *
     * @param string $postalCode
     * @return User
     */
    public function setPostalCode($postalCode) {
        $this->postal_code = $postalCode;

        return $this;
    }

    /**
     * Get postal_code
     *
     * @return string
     */
    public function getPostalCode() {
        return $this->postal_code;
    }

    /**
     * Set department
     *
     * @param string $department
     * @return User
     */
    public function setDepartment($department) {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string
     */
    public function getDepartment() {
        return $this->department;
    }

    /**
     * Set dtLastconn
     *
     * @param \DateTime $dtLastconn
     * @return User
     */
    public function setDtLastconn($dtLastconn) {
        $this->dtLastconn = $dtLastconn;

        return $this;
    }

    /**
     * Get dtLastconn
     *
     * @return \DateTime
     */
    public function getDtLastconn() {
        return $this->dtLastconn;
    }

    /**
     * Set nmErreconn
     *
     * @param integer $nmErreconn
     * @return User
     */
    public function setNmErreconn($nmErreconn) {
        $this->nmErreconn = $nmErreconn;

        return $this;
    }

    /**
     * Get nmErreconn
     *
     * @return integer
     */
    public function getNmErreconn() {
        return $this->nmErreconn;
    }

     /**
     * Set fgStat
     *
     * @param string $fgStat
     *
     * @return Campagne
     */
    public function setFgStat($fgStat)
    {
        $this->fgStat = $fgStat;

        return $this;
    }

    /**
     * Get fgStat
     *
     * @return string
     */
    public function getFgStat()
    {
        return $this->fgStat;
    }

    /**
     * Set confirmCode
     *
     * @param bool $isNull
     *
     * @return User
     */
    public function setConfirmCode($isNull) {
        $this->confirmCode = $isNull ? null : bin2hex(random_bytes(16))
        ;

        return $this;
    }

    /**
     * Get confirmCode
     *
     * @return string
     */
    public function getConfirmCode() {
        return $this->confirmCode;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     * @return User
     */
    public function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    /**
     * Set blGpeec
     *
     * @param boolean $blGpeec
     * @return User
     */
    public function setBlGpeec($blGpeec) {
        $this->blGpeec = $blGpeec;

        return $this;
    }

    /**
     * Get blGpeec
     *
     * @return boolean
     */
    public function getBlGpeec() {
        return $this->blGpeec;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     * @return User
     */
    public function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Get idUtil
     *
     * @return integer
     */
    public function getIdUtil() {
        return $this->idUtil;
    }

    /**
     * {@inheritdoc}
     */
    public function addRole($role) {
        $role = strtoupper($role);
        if ($role === static::ROLE_DEFAULT) {
            return $this;
        }
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeRole($role) {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasRole($role) {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt() {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials() {

    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled() {
        return $this->isActive;
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->idUtil,
            $this->username,
            $this->password,
            $this->isActive,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
                $this->idUtil,
                $this->username,
                $this->password,
                $this->isActive,
                ) = unserialize($serialized);
    }

    /**
     * @return string
     */
    public function __toString() {
        return (string) $this->getUsername();
    }

    /**
     * @var string
     */
    private $lbPassTemp;

    /**
     * Set lbPassTemp
     *
     * @param string $lbPassTemp
     *
     * @return User
     */
    public function setLbPassTemp($lbPassTemp) {
        $this->lbPassTemp = $lbPassTemp;

        return $this;
    }

    /**
     * Get lbPassTemp
     *
     * @return string
     */
    public function getLbPassTemp() {
        return $this->lbPassTemp;
    }

    /**
     * Set collectivite
     *
     * @param Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     * @return collectivite
     */
    public function setCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * Get collectivite
     *
     * @return Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    public function getCollectivite() {
        return $this->collectivite;
    }

    /**
     * Add utilisateurDroit
     *
     *
     * @return Utilisateur
     */
    public function addUtilisateurDroit(\Bilan_Social\Bundle\UserBundle\Entity\UtilisateurDroits $utilisateurDroit) {
        $this->utilisateurDroits[] = $utilisateurDroit;

        return $this;
    }

    /**
     * Remove utilisateurDroit
     *
     */
    public function removeUtilisateurDroit(\Bilan_Social\Bundle\UserBundle\Entity\UtilisateurDroits $utilisateurDroit) {
        $this->utilisateurDroits->removeElement($utilisateurDroit);
    }

    /**
     * Get UtilisateurDroits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateurDroits() {
        return $this->utilisateurDroits;
    }

    /**
     * Add pool
     *
     *
     * @return Pool
     */
    public function addPool(\Bilan_Social\Bundle\InfoCentreBundle\Entity\Pool $pool) {
        $this->pools[] = $pool;

        return $this;
    }

    /**
     * Remove pool
     *
     */
    public function removePool(\Bilan_Social\Bundle\InfoCentreBundle\Entity\Pool $pool) {
        $this->pools->removeElement($pool);
    }

    /**
     * Get Pools
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPools() {
        return $this->pools;
    }

    /**
     * Add utilisateurCdg
     *
     *
     * @return Utilisateur
     */
    public function addUtilisateurCdg(\Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg $utilisateurCdg) {
        $this->utilisateurCdgs[] = $utilisateurCdg;

        return $this;
    }

    /**
     * Remove utilisateurCdg
     *
     */
    public function removeUtilisateurCdg(\Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg $utilisateurCdg) {
        $this->utilisateurCdgs->removeElement($utilisateurCdg);
    }

    /**
     * Get UtilisateurCdgs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateurCdgs() {
        return $this->utilisateurCdgs;
    }

    public function getDtBlocage(): \DateTime {
        return $this->dtBlocage;
    }

    public function setDtBlocage(\DateTime $dtBlocage = null) {
        $this->dtBlocage = $dtBlocage;
    }

    public function getFgBlocage() {
        return $this->fgBlocage;
    }

    public function setFgBlocage($fgBlocage) {
        $this->fgBlocage = $fgBlocage;
    }

    public function getProfil() {
        return $this->profil;
    }

    public function setProfil($profil) {
        $this->profil = $profil;
    }

    public function getCdgs() {
        return $this->cdgs;
    }

    public function setCdgs($cdgs) {
        $this->cdgs = $cdgs;
    }
    public function getOldPassword() {
        return $this->oldPassword;
    }

    public function setOldPassword($oldPassword) {
        $this->oldPassword = $oldPassword;
    }
    
    public function getDroitMails() {
        return $this->droitMails;
    }

    public function setDroitMails($droitMails) {
        $this->droitMails = $droitMails;
    }

    public function getProfils() {
        return $this->profils;
    }

    public function setProfils($profils) {
        $this->profils = $profils;
    }

    public function getDepartements(){
        return $this->departements;
    }

    public function setDepartements($departements) {
        $this->departements = $departements;
    }

    public function getCampagnes(){
        return $this->campagnes;
    }

    public function setCampagnes($campagnes) {
        $this->campagnes = $campagnes;
    }

    public function getIdDepaArray() {
        $idDepaArray = [];
        foreach($this->getDepartements() as $departement) {
            $idDepaArray[] = $departement->getIdDepa();
        }

        return $idDepaArray;
    }


}
