<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Bilan_Social\Bundle\FileManagerBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of FichierRepository
 *
 * @author djoncour
 */
class FichierRepository extends EntityRepository {
    function findFichiersByCdgAndCampagne($cdg, $targetYear, array $logicalFolders) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f')
                ->from($this->_entityName, 'f')
                ->join('f.cdgDepartements', 'cd')
                ->where('cd.cdg = :cdg')
                ->andWhere('f.targetYear = :anneeCampagne')
                ->andWhere('f.logicalFolder IN (:logicalFolders)')
                ->setParameter('cdg', $cdg)
                ->setParameter('anneeCampagne', $targetYear)
                ->setParameter('logicalFolders', $logicalFolders);

        try {
            $fichiers = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $fichiers;
    }
    
    function findFichiersByOwnerAndCampagne($owner, $targetYear, array $logicalFolders, $collectivite = null) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f');
        $qb->from($this->_entityName, 'f');
        
        if($collectivite !== null){
           $qb->join('f.collectivites', 'cf');
           $qb->addSelect('cf');
        }
                
        $qb->where('f.ownerKey = :ownerKey');
        $qb->andWhere('f.targetYear = :anneeCampagne')
        ->andWhere('f.logicalFolder IN (:logicalFolders)');
        if($collectivite !== null){
            $qb->andWhere('cf.idColl = :idColl');
            $qb->setParameter('idColl', $collectivite);
        }
        $qb->setParameter('ownerKey', $owner);

        $qb->setParameter('anneeCampagne', $targetYear)
        ->setParameter('logicalFolders', $logicalFolders);

        try {
            $fichiers = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $fichiers;
    }
    
    function findFichiersByCollectiviteAndCampagne($collectivite, $targetYear, array $logicalFolders) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f')
                ->from($this->_entityName, 'f')
                ->join('f.collectivites', 'c')
                ->where('c.idColl = :idColl')
                ->andWhere('f.targetYear = :anneeCampagne')
                ->andWhere('f.logicalFolder IN (:logicalFolders)')
                ->setParameter('idColl', $collectivite->getIdColl())
                ->setParameter('anneeCampagne', $targetYear)
                ->setParameter('logicalFolders', $logicalFolders);

//        return $qb->getQuery()->getResult();
        try {
            $fichiers = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $fichiers;
    }
    function findFichierAnalysePartageByCollectiviteAndCampagne($owner, $targetYear) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f')
                ->from($this->_entityName, 'f')
                
                ->where('f.ownerKey = :cdg')
                ->andWhere('f.targetYear = :anneeCampagne')
                ->andWhere('f.logicalFolder = :logicalFolder')
                ->setParameter('cdg', $owner)
                ->setParameter('anneeCampagne', $targetYear)
                ->setParameter('logicalFolder', "PARTA");

        try {
            $fichiers = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $fichiers;
    }
    function findFichierAnalysePersoByCollectiviteAndCampagne($owner, $targetYear) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f')
                ->from($this->_entityName, 'f')
                
                ->where('f.ownerKey = :cdg')
                ->andWhere('f.targetYear = :anneeCampagne')
                ->andWhere('f.logicalFolder = :logicalFolder')
                ->setParameter('cdg', $owner)
                ->setParameter('anneeCampagne', $targetYear)
                ->setParameter('logicalFolder', "PERSO");

        try {
            $fichiers = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $fichiers;
    }
    
     function findFichiersByOwner($idCdg) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f')
                ->from($this->_entityName, 'f')
                ->where('f.ownerKey = :ownerKey')
                ->andWhere('f.logicalFolder LIKE :aghire OR f.logicalFolder LIKE :ciril')
                ->setParameter('ciril', "CIRIL")
                ->setParameter('aghire', "AGIRHE")
                ->setParameter('ownerKey', "CDG-".$idCdg);

        try {
            $fichiers = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        
        return $fichiers;
    }
}
