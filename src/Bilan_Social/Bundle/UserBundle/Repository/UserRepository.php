<?php

namespace Bilan_Social\Bundle\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\UserBundle\Entity\User;

/**
 * User Repository
 */
class UserRepository extends EntityRepository {

    /**
     * @param string $roles
     *
     * @return array
     */
    public function findByRoles($role) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
                ->where('u.roles LIKE :roles')
                ->setParameter('roles', '%"' . $role . '"%');

        return $qb->getQuery()->getResult();
    }

    /**
     * Get collectivities by department
     *
     * @param string $department
     * @return array
     */
    public function getCollectivitiesByDepartment($department) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
                ->where('u.roles LIKE :roles')
                ->andWhere('u.department = :department')
                ->setParameter('roles', '%"' . USER::ROLE_COLLECTIVITY . '"%')
                ->setParameter('department', $department);

        return $qb->getQuery()->getResult();
    }

    /**
     * Get departement by utilisateur
     *
     * @param string $idUtil
     * @return array
     */
     public function getDepartmentByUtilisateur($idUtil) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('d'))
        ->from($this->_entityName, 'u')
        ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'u.idUtil = ud.idUtil')
        ->join('CollectiviteBundle:Departement','d', 'WITH', 'ud.idDepa = d.idDepa')
        ->where('ud.idUtil = :idUtil')
        ->setParameter('idUtil', $idUtil);

        return $qb->getQuery()->getResult();
    }

        /**
     * @param string $username Méthode permettant de savoir si l'utilisateur connecté est de type CDG ou CNFPT
     * 
     * @return boolean Retourne True si l'utilisateur est de type CDG ou CNFPT sinon False
     */
    public function findOneByCdgCnfptByUsername($username) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
                ->innerJoin('u.collectivite', 'c', 'c.idColl = u.idColl')
                ->addSelect('c')
                ->innerJoin('c.refTypeCollectivite', 't', 't.idTypeColl = c.idTypeColl')
                ->addSelect('t')
                ->where('u.username = :username')
                ->andWhere('t.cdTypecoll IN (:typeColl)')
                ->setParameter('username', $username)
                ->setParameter('typeColl', array('CDG', 'CNFPT'));

        $userCdg = $qb->getQuery()->getResult();
        $blCdg = false;
        if(!empty($userCdg)) {
            $blCdg = true;
        }
        return $blCdg;
    }
    
    public function getPasswordTemporaire($ids){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u.lbPassTemp,c.lbColl')
                ->from($this->_entityName, 'u')
                ->innerJoin('u.collectivite', 'c', 'c.idColl = u.idColl')
                ->where('u.collectivite IN (:idsColl)')
                ->andWhere('u.lbPassTemp IS NOT NULL')
                ->setParameter('idsColl',$ids);
        
        return $qb->getQuery()->getResult();
    }
    
    public function listeUtilisateursCdg(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
                ->where("u.roles LIKE '%ROLE_CDG%'")
                ->orWhere("u.roles LIKE '%ROLE_INFOCENTRE%'");
        
        return $qb->getQuery()->getResult();
    }
    
    public function listeUtilisateursInfoCentre(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
                ->where("u.roles LIKE '%ROLE_INFOCENTRE%'");
        
        return $qb->getQuery()->getResult();
    }
    
    public function getLastUsername($username) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u.username')
                ->from($this->_entityName, 'u')
                ->where('u.username LIKE :username')
                ->orderBy('u.username','DESC')
                ->setMaxResults(1)
                ->setParameter('username', $username.'\_%');

        return $qb->getQuery()->getResult();
    }
    
    public function isOwnedByCdg($user,$cdg){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('count(u) as isOwned')
        ->from($this->_entityName, 'u')
        ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', ' u MEMBER OF c.utilisateurs')
        ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'c MEMBER OF cd.collectivites ')
        ->where('u.idUtil = :user')
        ->andwhere('cd.cdg = :cdg')
        ->setParameter('user', array($user))
        ->setParameter('cdg', $cdg);
        try {
            $query = $qb->getQuery();
            $is_owned = $query->getSingleResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return false;
        }
        return $is_owned['isOwned'];
    }
     public function checkFgStat($collectivite){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from($this->_entityName, 'u')
//                ->Leftjoin('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.idColl = u.IdColl')
                ->where('u.collectivite IN(:collectivite)')
                ->andWhere('u.dtLastconn IS NOT NULL')
                ->setParameter('collectivite', $collectivite);

        try {
            $ecArray = $qb->getQuery()->getResult();
            if ($ecArray == null){
                return true;
            }else{
                return false;
            }
        } catch (NoResultException $e) {
            // Pas de enquete active consolidé pour la collectivite
            return null;
        }
    }
}
