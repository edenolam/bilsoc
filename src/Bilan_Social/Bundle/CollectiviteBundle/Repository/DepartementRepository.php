<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\CollectiviteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement;
use PDO;
/**
 * Description of CdgRepository
 *
 * @author mbusson
 */
class DepartementRepository extends EntityRepository {
 
    public function getDepartementsWithoutEnqueteByUtilisateurAndDroitFormStatement($idUtil){

        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $mask = DroitsEnum::MASK_READ_WRITE_ENQUETE;

        $sql = 'SELECT d.ID_DEPA
		FROM departement d
		JOIN cdg_departement cdgd ON d.ID_DEPA = cdgd.ID_DEPA  
		JOIN utilisateur_droits ud ON ud.ID_CDG_DEPARTEMENT = cdgd.ID_CDG_DEPARTEMENT
		JOIN utilisateur_cdg uc ON uc.ID_UTILISATEUR_CDG = ud.ID_UTILISATEUR_CDG
		LEFT JOIN departements_enquetes de ON de.ID_DEPA = d.ID_DEPA
		LEFT JOIN enquete e ON e.ID_ENQU = de.ID_ENQU
		LEFT JOIN  departements_groups dg ON dg.ID_DEPA = d.ID_DEPA
		
		WHERE 
		d.ID_DEPA NOT IN (
			SELECT ID_DEPA 
			FROM departements_enquetes de
			JOIN enquete e ON e.ID_ENQU = de.ID_ENQU
			JOIN campagne c ON c.ID_CAMP = e.ID_CAMP
			WHERE c.FG_STAT = 1 AND e.FG_STAT NOT IN (3)
		)
		AND
		 CONV(:mask,2,10) & ud.FG_DROITS IN (:droit) 
		AND uc.ID_UTIL = :idUtil ;';


        $stmt =  $this->_em->getConnection()->prepare($sql);
        $stmt->bindParam('idUtil', $idUtil, PDO::PARAM_INT);
        $stmt->bindParam('mask', $mask , PDO::PARAM_INT);
        $stmt->bindParam('droit', $droit_write, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
}
    public function getDepartementsWithEnqueteByUtilisateurAndDroitFormStatement($idUtil){

        $droit_write = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $mask = DroitsEnum::MASK_READ_ENQUETE;
        $sql = 'SELECT e.ID_ENQU as idEnqu, ud.FG_DROITS as fgDroits, d.CD_DEPA as cdDepa,
              e.FG_STAT as fgStat, d.LB_DEPA as lbDepa, e.BL_REINIT_PASSWORD as blReinitPassword, e.LB_ENQU as lbEnqu, e.CM_DESC as cmDesc, e.BL_CLOTURE as blCloture
		FROM departement d
		JOIN cdg_departement cdgd ON d.ID_DEPA = cdgd.ID_DEPA  
		JOIN departements_enquetes de ON de.ID_DEPA = d.ID_DEPA
		JOIN enquete e ON e.ID_ENQU = de.ID_ENQU
		JOIN utilisateur_droits ud ON ud.ID_CDG_DEPARTEMENT = cdgd.ID_CDG_DEPARTEMENT
		JOIN utilisateur_cdg uc ON uc.ID_UTILISATEUR_CDG = ud.ID_UTILISATEUR_CDG
		JOIN campagne c ON c.ID_CAMP = e.ID_CAMP
		LEFT JOIN  departements_groups dg ON dg.ID_DEPA = d.ID_DEPA
		WHERE d.ID_DEPA IN (
			SELECT ID_DEPA 
			FROM departements_enquetes de
			JOIN enquete e ON e.ID_ENQU = de.ID_ENQU
			JOIN campagne c ON c.ID_CAMP = e.ID_CAMP
			WHERE c.FG_STAT = 1
		)
		AND e.FG_STAT IN (0,1,2,3)
		AND c.FG_STAT = 1
		AND CONV(:mask,2,10) & ud.FG_DROITS IN (:droit) 
		AND uc.ID_UTIL = :idUtil ;';


        $stmt =  $this->_em->getConnection()->prepare($sql);
        $stmt->bindParam('idUtil', $idUtil, PDO::PARAM_INT);
        $stmt->bindParam('mask', $mask , PDO::PARAM_INT);
        $stmt->bindParam('droit', $droit_write, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    /* utilisé dans le form type de l info enqueteType*/
    public function getDepartementsWithoutEnqueteByUtilisateurAndDroitForm($user){
        $stmt = $this->getDepartementsWithoutEnqueteByUtilisateurAndDroitFormStatement($user);
        return $stmt->fetchAll();
    }
    public function getDepartementsWithoutEnqueteByUtilisateurAndDroitSQLForm($user){
        $stmt = $this->getDepartementsWithoutEnqueteByUtilisateurAndDroitFormStatement($user);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    public function getDepartementsWithoutEnqueteByUtilisateurAndDroit($user){
         $qb = $this->_em->createQueryBuilder();
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
       $qb->select('d, e')
                ->from($this->_entityName, 'd')
                ->join('CollectiviteBundle:CdgDepartement', 'cd','WITH', 'd.idDepa = cd.departement')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('ud.utilisateurCdg', 'cu')
                ->leftJoin('d.groups','dg', 'WITH', 'd.idDepa = dg.departement')
                ->leftJoin('d.enquetes', 'e')
                ->where('cu.utilisateur = :utilisateur')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('e.fgStat NOT IN(1,0,2) OR e.fgStat IS NULL')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)') //CONV(:mask,2,10)
                ->setParameter('utilisateur', $user->getIdUtil())
                ->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter("droit", $droit_write)
                ->groupBy('cd.idCdgDepartement');
        $enquetes = $qb->getQuery()->getResult();
        return $enquetes;
    }
    
    public function getEnquetesByDepartementsAndUtilisateurAndDroit($idCdg = null){


        $qb = $this->_em->createQueryBuilder();
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $droit_read = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $droit = array($droit_read,$droit_write);
//        $qb->select(array('d'))
        $qb->select('e.idEnqu, e.lbEnqu,e.fgStat, d.idDepa, d.cdDepa, d.lbDepa,e.blReinitPassword, ud.fgDroits, e.cmDesc, e.blCloture, e.dtDebu, cdg.lbCdg')
                ->from($this->_entityName, 'd')
                ->join('CollectiviteBundle:CdgDepartement', 'cd','WITH', 'd.idDepa = cd.departement')

                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('ud.utilisateurCdg', 'ucdg' ,'WITH', 'ucdg.cdg = ud.utilisateurCdg')
                ->join('CollectiviteBundle:Cdg', 'cdg', 'WITH', 'ucdg.cdg = cdg.idCdg')
                ->join('d.enquetes', 'e')
                ->join('CampagneBundle:Campagne', 'c', 'WITH', 'e.idCamp = c.idCamp')
                ->where('ucdg.cdg = :idCdg')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('c.fgStat = 1')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)') //CONV(:mask,2,10)
                ->setParameter('idCdg', $idCdg)
                ->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter("droit", $droit);
        try {
            $enquetes = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enquetes;
    }
    public function getEnquetesOuverteByDepartementsAndUtilisateurAndDroit($user){
        $qb = $this->_em->createQueryBuilder();
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $droit_read = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $droit = array($droit_read,$droit_write);
//        $qb->select(array('d'))
        $qb->select('d')
                ->from($this->_entityName, 'd')
                ->join('CollectiviteBundle:CdgDepartement', 'cd','WITH', 'd.idDepa = cd.departement')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('ud.utilisateurCdg', 'ucdg' ,'WITH', 'ucdg.cdg = ud.utilisateurCdg')
                ->join('d.enquetes', 'e')
                ->join('CampagneBundle:Campagne', 'c', 'WITH', 'e.idCamp = c.idCamp')
                ->addSelect('e')
                ->where('ucdg.cdg = :utilisateur')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('e.fgStat = 1')
                ->andWhere('c.fgStat = 1')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)') //CONV(:mask,2,10)
                ->setParameter('utilisateur', $user)
                ->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter("droit", $droit);
        try {
            $enquetes = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enquetes;
    }
    
    public function getEnquetesByDepartementsAndUtilisateurAndDroitForm($user){
        $qb = $this->_em->createQueryBuilder();
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $droit_read = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $droit = array($droit_read,$droit_write);
        return $qb->select('d, e')
                ->from($this->_entityName, 'd')
                ->join('CollectiviteBundle:CdgDepartement', 'cd','WITH', 'd.idDepa = cd.departement')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('ud.utilisateurCdg', 'cu')
                ->leftJoin('d.enquetes', 'e')
                ->where('cu.utilisateur = :utilisateur')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('e.fgStat IN(1,0)')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)') //CONV(:mask,2,10)
                ->setParameter('utilisateur', $user->getIdUtil())
                ->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter("droit", $droit)
                ->groupBy('cd.idCdgDepartement');
    }
    
    public function getDepartementByGroups($nmGroup){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d')
                ->from($this->_entityName, 'd')
                ->join('CollectiviteBundle:DepartementsGroups', 'dg','WITH', 'dg.departement = d.idDepa')
                ->where('dg.nmGroup = :nmGroup')
                ->setParameter('nmGroup', $nmGroup)
                ;
        try {
            $departements = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            return null;
        }
        return $departements;
    }
    
    public function getDepartementByIdStr($idDepaStr){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d')
                ->from($this->_entityName, 'd')
                ->leftjoin('CollectiviteBundle:DepartementsGroups', 'dg','WITH', 'dg.departement = d.idDepa')
                ->where('d.idDepa IN(:idDepaStr)')
                ->setParameter('idDepaStr', $idDepaStr)
                ;
        try {
            $departements = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            return null;
        }
        return $departements;
    }

    public function getContactCdgByCdDepa($cdDepa){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d')
            ->from($this->_entityName, 'd')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'cd.departement = d.idDepa')

            ->join('CollectiviteBundle:CdgContact', 'cdgc', 'WITH', 'cdgc.cdg = cd.cdg')

            ->where('d.cdDepa = :cdDepa')
            ->setParameter('cdDepa', $cdDepa);
        ;
        try {
            $contact = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            return null;
        }
        return $contact;
    }

    public function getDepartementById($departement, $fields){

        $qb = $this->_em->createQueryBuilder();
        $qb->select($fields)
            ->from($this->_entityName, 'd')
            ->where('d.idDepa IN(:departement)')
            ->setParameter('departement', $departement)
        ;
        try {
            $departements = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            return null;
        }
        return $departements;
    }

}