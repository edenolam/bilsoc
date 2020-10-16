<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\CollectiviteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of CdgRepository
 *
 * @author mbusson
 */
class CdgRepository extends EntityRepository {
    function findOneByCdgByUtilisateur($utilisateur) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cdg')
                ->from('UserBundle:UtilisateurCdg', 'uc')
                ->join('CollectiviteBundle:Cdg', 'cdg', 'WITH', 'uc.cdg = cdg.idCdg')
                ->where('uc.utilisateur = :utilisateur')
                ->setParameter('utilisateur', $utilisateur);

        try {
            $cdg = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $cdg;
    }

    function findOneCdgByUtilisateur($utilisateur) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cdg')
                ->from('UserBundle:UtilisateurCdg', 'uc')
                ->join('CollectiviteBundle:Cdg', 'cdg', 'WITH', 'uc.cdg = cdg.idCdg')
                ->where('uc.utilisateur = :utilisateur')
                ->setParameter('utilisateur', $utilisateur);

        try {
            $cdg = $qb->getQuery()->getOneOrNullResult();
        }
        catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $cdg;
    }

    function GetContactPrincipal($idCdg) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('cdgContact')
                ->from('CollectiviteBundle:CdgContact', 'cdgContact')
//                ->join('cdgContact.cdg', 'cdg')
//                ->join('cdg.cdgUtilisateurs', 'cdgUtil')
                ->where('cdgContact.cdg IN(:idCdg)')
                ->andWhere('cdgContact.blContactPrincipal = true')
                ->setParameter('idCdg', $idCdg);

        try {
            $cdgContact = $qb->getQuery()->getOneOrNullResult();

        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $cdgContact;
    }

    function getCdgReferent($cdg,$departement){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from($this->_entityName, 'c')
            ->leftJoin('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'uc.cdg = c.idCdg')
            ->leftJoin('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
            ->leftJoin('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
            ->where('cd.cdg <> :cdg')
            ->andWhere('cd.departement = :departement')
            ->setParameter('cdg', $cdg)
            ->setParameter('departement', $departement);
        return $qb->getQuery()->getResult();
    }

    function GetReferentFormulaireCdg($tabCdgs, array $departementIds) {
         $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from($this->_entityName, 'c')
            ->leftJoin('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'uc.cdg = c.idCdg')
            ->leftJoin('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->leftJoin('CollectiviteBundle:CdgDepartement', 'cdgDep', 'WITH', 'cdgDep.idCdgDepartement = ud.cdgDepartement')
                ->where('cdgDep.cdg NOT IN ( :cdg )')
                ->andWhere('cdgDep.departement IN (:departementIds)')
            ->setParameter('cdg', $tabCdgs)
            ->setParameter('departementIds', $departementIds);

        try {
            $cdg = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $cdg;
    }
     function findCDGByUtilisateur($utilisateur) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cdg')
                ->from('UserBundle:UtilisateurCdg', 'uc')
                ->join('CollectiviteBundle:Cdg', 'cdg', 'WITH', 'uc.cdg = cdg.idCdg')
                ->where('uc.utilisateur = :utilisateur')
                ->setParameter('utilisateur', $utilisateur);

        try {
            $cdg = $qb->getQuery()->getOneOrNullResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $cdg;
    }

    public function getEffectifsTransmis($utilisateur){
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('SUM(ind111.r1115) AS val1','SUM(ind111.r1116) AS val2','SUM(ind121.r1215) AS val3','SUM(ind121.r1216) AS val4','SUM(ind121.r1217) AS val5','SUM(ind121.r1218) AS val6'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->join('ConsoBundle:BilanSocialConsolide', 'bcs', 'WITH', 'bcs.collectivite = c.idColl AND bcs.fgStat = 1')
                ->leftJoin('ConsoBundle:Ind111', 'ind111', 'WITH', 'ind111.bilanSocialConsolide = bcs.idBilasocicons')
                ->leftJoin('ConsoBundle:Ind121', 'ind121', 'WITH', 'ind121.bilanSocialConsolide = bcs.idBilasocicons')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('c.blActi = 1')
                ->setParameter('idUtilisateur', $utilisateur);

        return $qb->getQuery()->getResult();
    }

    public function getEffectifsTransmisByDepartements($utilisateur,$departements){
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('SUM(ind111.r1115) AS val1','SUM(ind111.r1116) AS val2','SUM(ind121.r1215) AS val3','SUM(ind121.r1216) AS val4','SUM(ind121.r1217) AS val5','SUM(ind121.r1218) AS val6'))
//        $qb->select(array('bcs.idBilasocicons'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin('ConsoBundle:BilanSocialConsolide', 'bcs', 'WITH', 'bcs.collectivite = c.idColl')
                ->leftJoin('ConsoBundle:Ind111', 'ind111', 'WITH', 'ind111.bilanSocialConsolide = bcs.idBilasocicons')
                ->leftJoin('ConsoBundle:Ind121', 'ind121', 'WITH', 'ind121.bilanSocialConsolide = bcs.idBilasocicons')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('cd.departement IN (:departements)')
                ->andWhere('c.blActi = 1')
                ->setParameter('idUtilisateur', $utilisateur)
                ->setParameter('departements', $departements);

        return $qb->getQuery()->getResult();
    }

    function findCdgByCollectivite($utilisateur) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cdg')
                ->from('UserBundle:User', 'u')
                ->join('CollectiviteBundle:Collectivite', 'coll', 'WITH', 'u.collectivite = coll.idColl')
                ->join('CollectiviteBundle:CdgDepartement', 'cdgDepa', 'WITH', 'coll.cdgDepartement = cdgDepa.idCdgDepartement')
                ->join('CollectiviteBundle:Cdg', 'cdg' ,'WITH', 'cdgDepa.cdg = cdg.idCdg' )
                ->where('u = :utilisateur')
                ->setParameter('utilisateur', $utilisateur);

        try {
            $cdg = $qb->getQuery()->getOneOrNullResult();

        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $cdg;
    }


}
