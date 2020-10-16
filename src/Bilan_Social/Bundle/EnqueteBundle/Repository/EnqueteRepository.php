<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;

/**
 * EnqueteCollectivite Repository
 */
class EnqueteRepository extends EntityRepository {

    public function findEnqueteByCDG($utilisateur, $departements, $currentCampagne) {
        $droit = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(['e.lbEnqu','e.fgStat','e.idEnqu','e.cmDesc','d.lbDepa','d.cdDepa', 'cd.idCdgDepartement', 'ud.fgDroits','e.blReinitPassword'])
                ->from($this->_entityName, 'e')
                ->join('e.cdgDepartements', 'cd')
                ->join('cd.departement','d')
                ->join('cd.utilisateurDroits', 'ud')
                ->join('ud.utilisateurCdg', 'uc')
                ->where('uc.utilisateur = :utilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('e.idCamp = :currentCampagne')
                ->setParameter('mask', DroitsEnum::MASK_READ_ENQUETE)
                ->setParameter('utilisateur', $utilisateur)
                ->setParameter('currentCampagne', $currentCampagne)
                ->setParameter("droit", $droit);
        try {
            $enquetes = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enquetes;
    }
    
//    public function findEnqueteByDepartement($utilisateur, $departements, $currentCampagne) {
//        $droit = bindec(DroitsEnum::MASK_READ_ENQUETE);
//        $qb = $this->_em->createQueryBuilder();
//        $qb->select(['e.lbEnqu','e.fgStat','e.idEnqu','e.cmDesc','d.lbDepa','d.cdDepa', 'ud.fgDroits','e.blReinitPassword'])
//                ->from($this->_entityName, 'e')
//                ->join('e.departements', 'd')
////                ->join('cd.departement','d')
//                ->join('cd.utilisateurDroits', 'ud')
//                ->join('ud.utilisateurCdg', 'uc')
//                ->where('uc.utilisateur = :utilisateur')
//                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
//                ->andWhere('e.idCamp = :currentCampagne')
//                ->andWhere('e.enquete IN(:departements)')
//                ->setParameter('mask', DroitsEnum::MASK_READ_ENQUETE)
//                ->setParameter('utilisateur', $utilisateur)
//                ->setParameter('departements', $departements)
//                ->setParameter('currentCampagne', $currentCampagne)
//                ->setParameter("droit", $droit);
//        try {
//            $enquetes = $qb->getQuery()->getResult();
//        } catch (NoResultException $e) {
//            // Pas de bilan pour cette enquete et coll
//            return null;
//        }
//        return $enquetes;
//    }
    public function findEnqueteByCDGAndStatut($utilisateur, $departements, $currentCampagne) {
        $droit = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(['e.lbEnqu','e.fgStat','e.idEnqu','e.cmDesc','d.lbDepa','d.cdDepa, cd.idCdgDepartement, ud.fgDroits'])
                ->from($this->_entityName, 'e')
                ->join('e.cdgDepartements', 'cd')
                ->join('cd.departement','d')
                ->join('cd.utilisateurDroits', 'ud')
                ->join('ud.utilisateurCdg', 'uc')
                ->where('uc.utilisateur = :utilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('e.fgStat IN (:fgStat)')
                ->andWhere('e.idCamp = :currentCampagne')
                ->setParameter('mask', DroitsEnum::MASK_READ_ENQUETE)
                ->setParameter('utilisateur', $utilisateur)
                ->setParameter("droit", $droit)
                ->setParameter('fgStat', array('0', '1', '2'))
                ->setParameter('currentCampagne', $currentCampagne)
                ->groupBy('e.lbEnqu, e.fgStat, e.idEnqu, e.cmDesc, d.lbDepa, d.cdDepa, cd.idCdgDepartement');
        try {
            $enquetes = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enquetes;
    }

    public function findEnqueteLanceeByUtilisateurCDG($idCdgDepartement, $currentCampagne) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('e.cdgDepartements', 'cd')
                ->where('cd.idCdgDepartement IN (' . $idCdgDepartement . ')')
                ->andWhere('e.idCamp = :currentCampagne')
                ->andWhere('e.fgStat = 1')
//                ->setParameter('idCdgDepartement', $idCdgDepartement)
                ->setParameter('currentCampagne', $currentCampagne);

        try {
            $enquetes = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enquetes;
    }

    function findEnqueteLanceeByDepartement($departement, $currentCampagne) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('CollectiviteBundle:Departement', 'd')
                ->where(':departements MEMBER OF e.departements')
                ->andWhere('e.fgStat = 1')
                ->andWhere('e.idCamp = :currentCampagne')
                ->groupBy('e.idEnqu')
                ->setParameter('departements', $departement)
                ->setParameter('currentCampagne', $currentCampagne);

        try {
            $enquetes = $qb->getQuery()->getResult();
            //error_log('test1',0);
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            //error_log('test2',0);
            return null;
        } catch (NonUniqueResultException $e) {
            // Pas de bilan pour cette enquete et coll
            //error_log('test2',0);
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
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('e.departements', 'd')
                ->join('CollectiviteBundle:CdgDepartement', 'cd','WITH', 'd.idDepa = cd.departement')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
                ->join('ud.utilisateurCdg', 'ucdg')
                ->where('ucdg.utilisateur = :utilisateur')
                ->andWhere('cd.fgType = :fgtype')
                ->andWhere('e.fgStat = 1')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)') //CONV(:mask,2,10)
                ->setParameter('utilisateur', $user->getIdUtil())
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
    function findEnqueteByDepartement($departement, $currentCampagne) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('CollectiviteBundle:Departement', 'd')
                ->where(':departements MEMBER OF e.departements')
                ->andWhere('e.idCamp = :currentCampagne')
                ->andWhere('e.fgStat NOT IN (3)')
                ->setParameter('departements', $departement)
                ->setParameter('currentCampagne', $currentCampagne);

        try {
            $enquetes = $qb->getQuery()->getResult();
            //error_log('test1',0);
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            //error_log('test2',0);
            return null;
        } catch (NonUniqueResultException $e) {
            // Pas de bilan pour cette enquete et coll
            //error_log('test2',0);
            return null;

        }
        return $enquetes;
    }
    function findEnqueteOuverteByDepartement($departement, $currentCampagne) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('CollectiviteBundle:Departement', 'd')
                ->where(':departements MEMBER OF e.departements')
                ->andWhere('e.idCamp = :currentCampagne')
//                ->andWhere('e.fgStat IN (1)')
                ->setParameter('departements', $departement)
                ->setParameter('currentCampagne', $currentCampagne);

        try {
            $enquetes = $qb->getQuery()->getResult();
            //error_log('test1',0);
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            //error_log('test2',0);
            return null;
        } catch (NonUniqueResultException $e) {
            // Pas de bilan pour cette enquete et coll
            //error_log('test2',0);
            return null;

        }
        return $enquetes;
    }

    public function findEnqueteLanceeByUtilisateurCDGAndDepartements($utilisateur, $departements, $currentCampagne = null) {
        $droit = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('e.cdgDepartements', 'cd')
                ->join('cd.utilisateurDroits', 'ud')
                ->join('ud.utilisateurCdg', 'uc')
                ->where('uc.utilisateur = :utilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('e.fgStat = 1')
                ->andWhere('cd.departement IN (:departements)')
                ->andWhere('e.idCamp = :currentCampagne')
                ->setParameter('departements', $departements)
                ->setParameter('mask', DroitsEnum::MASK_READ_ENQUETE)
                ->setParameter('utilisateur', $utilisateur)
                ->setParameter("droit", $droit)
                ->setParameter('currentCampagne', $currentCampagne);

        try {
            $enquetes = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enquetes;
    }
    
    public function findEnqueteByCampagneAndCdg(array $parameters) {
        $utilisateur = $parameters['utilisateur'];
        $idCamp = $parameters['idCamp'];

        $droit = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('e.cdgDepartements', 'cd')
                ->join('cd.utilisateurDroits', 'ud')
                ->join('ud.utilisateurCdg', 'uc')
                ->where('uc.utilisateur = :utilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('e.fgStat = 1')
                ->andWhere('e.idCamp = :idCamp')
                ->setParameter('mask', DroitsEnum::MASK_READ_ENQUETE)
                ->setParameter('utilisateur', $utilisateur)
                ->setParameter("droit", $droit)
                ->setParameter('idCamp', $idCamp);


//
//                ->from($this->_entityName, 'e')
//                ->innerJoin('e.cdg', 'cdg', 'e.idCdg = cdg.idCdg')
//                ->where('e.idCamp = :idCamp')
//                ->andWhere('cdg.idCdg = :idCdg')
//                ->andWhere('e.fgStat = 0 OR e.fgStat = 1')
//                    ->setParameter('idCdg', $idCdg)
//                    ->setParameter('idCamp', $idCamp);
        try {
            $enquetes = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enquetes;
    }

    function getEnqueteByCdgAndCampagne(array $parameters) {
        $idCdg = $parameters['idCdg'];
        $idCamp = $parameters['idCamp'];

        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('e.cdgDepartements', 'cd')
                ->join('cd.cdg', 'c')
                ->andWhere('e.idCamp = :idCamp')
                ->andWhere('c.idCdg = :idCdg')
                ->setParameter('idCamp', $idCamp)
                ->setParameter('idCdg', $idCdg)
                ->groupBy('e.idEnqu');
        try {
            $enquetes = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enquetes;
    }

    public function getEnqueteActive($idColl, $idCamp) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'e MEMBER OF d.enquetes')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
//                ->Leftjoin('EnqueteBundle:EnqueteCollectivite', 'ec', 'WITH', 'e.idCamp = :idCamp')
                ->where('c.idColl = :collect')
                ->andWhere('e.dtClot is null')
                ->andWhere('e.fgStat = :ouvert')
                ->andWhere('e.idCamp = :idCamp')
                ->setParameter('collect', $idColl)
                ->setParameter('idCamp', $idCamp)
                
                ->setParameter('ouvert', '1');

        try {
            $enqueteActive = $qb->getQuery()->getOneOrNullResult();
            
        } catch (NoResultException $e) {
            // Pas de enquete active consolidé pour la collectivite
            return null;
        }
        return $enqueteActive;
    }
    public function getEnqueteActiveCDG($departements_string, $idCamp) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('e')
                ->from($this->_entityName, 'e')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'e MEMBER OF d.enquetes')
                ->where('d.idDepa IN(:departements)')
                ->andWhere('e.dtClot is null')
                ->andWhere('e.fgStat = :ouvert')
                ->andWhere('e.idCamp = :idCamp')
                ->setParameter('departements', $departements_string)
                ->setParameter('idCamp', $idCamp)
                
                ->setParameter('ouvert', '1');

        try {
            $enqueteActive = $qb->getQuery()->getOneOrNullResult();
            
        } catch (NoResultException $e) {
            // Pas de enquete active consolidé pour la collectivite
            return null;
        }
        return $enqueteActive;
    }

    public function isOwnedByCdg($enquete, $cdg) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('count(e) AS isOwned')
                ->from($this->_entityName, 'e')
                ->Leftjoin('CollectiviteBundle:cdgDepartement', 'cd', 'WITH', 'e MEMBER OF cd.enquetes')
                ->andWhere('e.idEnqu = :enquete')
                ->andWhere('e.dtClot is null')
                ->andWhere('e.fgStat = :ouvert')
                ->andWhere('cd.cdg = :cdg')
                ->setParameter('ouvert', '1')
                ->setParameter('enquete', $enquete)
                ->setParameter('cdg', $cdg);
        try {
            $ecArray = $qb->getQuery()->getResult();

            if ($ecArray == null)
                return null;

            if (count($ecArray) == 1) {

                return $ecArray[0];
            } else {
                return null;
            }
        } catch (NoResultException $e) {
            // Pas de enquete active consolidé pour la collectivite
            return null;
        }

        return $ec;
    }

    public function isOwnedByCollectivite($enquete, $collectivite) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('count(e) AS isOwned')
                ->from($this->_entityName, 'e')
                ->Leftjoin('EnqueteBundle:EnqueteCollectivite', 'ec', 'WITH', 'e MEMBER OF ec.enquetes')
                ->andWhere('e.idEnqu = :enquete')
                ->andWhere('e.dtClot is null')
                ->andWhere('e.fgStat = :ouvert')
                ->andWhere('ec.collectivite = :collectivite')
                ->setParameter('ouvert', '1')
                ->setParameter('enquete', $enquete)
                ->setParameter('collectivite', $collectivite);
        try {
            $ecArray = $qb->getQuery()->getResult();

            if ($ecArray == null)
                return null;

            if (count($ecArray) == 1) {

                return $ecArray[0];
            } else {
                return null;
            }
        } catch (NoResultException $e) {
            // Pas de enquete active consolidé pour la collectivite
            return null;
        }

        return $ec;
    }
}
