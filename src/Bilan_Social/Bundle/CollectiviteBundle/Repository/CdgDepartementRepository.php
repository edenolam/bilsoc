<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\CollectiviteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;

/**
 * Description of CdgRepository
 *
 * @author mbusson
 */
class CdgDepartementRepository extends EntityRepository {
    public function getCdgByDepartement($dept){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cd')
                ->from($this->_entityName, 'cd')
                ->where('cd.departement = :dept')
                ->andWhere('cd.fgType = 1')
                ->setParameter('dept', $dept);

        return $qb->getQuery()->getResult();
    }
    public function getDepartementsByCdg($cdg){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cd')
                ->from($this->_entityName, 'cd')
                ->where('cd.cdg = :cdg')
                ->andWhere('cd.fgType != 1')
                ->setParameter('cdg', $cdg);

        return $qb->getQuery()->getResult();
    }

    public function getDepartementsByCdgUtilisateur($idUtil){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d.idDepa')
                ->from($this->_entityName, 'cd')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'cd.departement = d.idDepa')
                ->join('cd.cdg', 'cdg')
                ->join('cdg.cdgUtilisateurs', 'uc')
                ->where('uc.utilisateur = :idUtil')
                ->andWhere('cd.fgType != 1')
                ->setParameter('idUtil', $idUtil);

        return $qb->getQuery()->getResult();
    }
    
    public function getOriginDepartementsByCdgUtilisateur($idUtil){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d.idDepa')
                ->from($this->_entityName, 'cd')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'cd.departement = d.idDepa')
                ->join('cd.cdg', 'cdg')
                ->join('cdg.cdgUtilisateurs', 'uc')
                ->where('uc.utilisateur = :idUtil')
                ->andWhere('cd.fgType = 1')
                ->setParameter('idUtil', $idUtil);

        return $qb->getQuery()->getResult();
    }
    
    public function getDepartementsByUtilisateur($user){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d.lbDepa', 'd.cdDepa', 'd.idDepa', 'ud.fgDroits')
            ->from($this->_entityName, 'cd')
            ->join('cd.cdg', 'c')
            ->join('cd.departement','d')
            ->leftJoin('d.enquetes', 'e')
            ->join('c.cdgUtilisateurs', 'cu')
            ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
            ->where('cu.utilisateur = :utilisateur')
            ->andWhere('cd.fgType = :fgtype')
            ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit')
            ->setParameter('utilisateur', $user->getIdUtil())
            ->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_ENQUETE)
            ->setParameter("droit", bindec(DroitsEnum::MASK_READ_ENQUETE))
            ->groupBy('d.cdDepa');
        return $qb->getQuery()->getResult();
    }

    public function getDepartementsByUtilisateurModifierEnquete($user) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d.cdDepa', 'd.lbDepa', 'cd.idCdgDepartement', 'coll.idColl', 'e.idEnqu')
                ->from($this->_entityName, 'cd')
                ->join('cd.cdg', 'c')
                ->join('cd.departement', 'd')
                ->join('c.cdgUtilisateurs', 'cu')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('cd.enquetes', "e")
                ->leftJoin('EnqueteBundle:EnqueteCollectivite', 'ec', 'WITH', 'e.idEnqu = ec.enquete')
                ->join('ec.collectivite', 'coll')
                ->where('cu.utilisateur = :utilisateur')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit')
                ->andWhere('e.fgStat IN (:ouvert)')
                ->setParameter('ouvert', array('0', '1'))
                ->setParameter('utilisateur', $user->getIdUtil())
                ->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_ENQUETE)
                ->setParameter("droit", bindec(DroitsEnum::MASK_READ_ENQUETE))
                ->groupBy('coll.idColl');
        return $qb->getQuery()->getResult();
    }
    
    /* Requete utilisée pour le(s) departement(s) sur le(s) quel(s) un cdg a des droits pour la page d'accueil */ 
    public function getDepartementsByUtilisateurAndDroit($user = null){
      $qb = $this->_em->createQueryBuilder();
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $droit_read = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $droit = array($droit_read,$droit_write);
        $qb->select('cd, d')
                ->from($this->_entityName, 'cd')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('cd.departement', 'd')
                ->join('ud.utilisateurCdg', 'cu')
                ->where('cu.utilisateur = :utilisateur')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)'); //CONV(:mask,2,10)
                if($user == null){
                     $qb->setParameter('utilisateur', '91');
                }else{
                     $qb->setParameter('utilisateur', $user->getIdUtil());
                }
               
                $qb->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter("droit", $droit)
                ->groupBy('cd.idCdgDepartement');
               
        return $qb->getQuery()->getResult();
    }
    public function getDepartementsEnqueteWithByUtilisateurAndDroit($user = null){
      $qb = $this->_em->createQueryBuilder();
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $droit_read = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $droit = array($droit_read,$droit_write);
        $qb->select('cd, d, e')
                ->from($this->_entityName, 'cd')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('cd.departement', 'd')
                ->join('ud.utilisateurCdg', 'cu')
                ->join('d.enquetes', 'e')
                ->where('cu.utilisateur = :utilisateur')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('e.fgStat = 1')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)'); //CONV(:mask,2,10)
                if($user == null){
                     $qb->setParameter('utilisateur', '91');
                }else{
                     $qb->setParameter('utilisateur', $user->getIdUtil());
                }
               
                $qb->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter("droit", $droit)
                ->groupBy('cd.idCdgDepartement');
               
        return $qb->getQuery()->getResult();
    }
    
    public function getDepartementsWithOutEnqueteByUtilisateurAndDroit($user = null){
      $qb = $this->_em->createQueryBuilder();
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $droit_read = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $droit = array($droit_read,$droit_write);
        $qb->select('cd, d, e')
                ->from($this->_entityName, 'cd')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('cd.departement', 'd')
                ->join('ud.utilisateurCdg', 'cu')
                ->leftJoin('d.enquetes', 'e')
                ->where('cu.utilisateur = :utilisateur')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('e.fgStat IN(2,3) OR e.fgStat IS NULL')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)'); //CONV(:mask,2,10)
                if($user == null){
                     $qb->setParameter('utilisateur', '91');
                }else{
                     $qb->setParameter('utilisateur', $user->getIdUtil());
                }
               
                $qb->setParameter('fgtype', 0)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter("droit", $droit)
                ->groupBy('cd.idCdgDepartement');
               
        return $qb->getQuery()->getResult();
    }

}
