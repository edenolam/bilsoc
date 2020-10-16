<?php

namespace Bilan_Social\Bundle\InfoCentreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
/**
 * PoolItemRepository
 *
 */
class PoolItemRepository extends AbstractRepository {
    
    function getNonDroitsSurCollectiviteByInfoCentre($idDepa, $idColls) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idColl')
            ->from('CollectiviteBundle:Departement', 'd')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
            ->leftJoin('InfoCentreBundle:PoolItem', 'pi', 'WITH', 'pi.idCollectivite = c.idColl')
            ->where('c.idColl IN (:collectivites)')
            ->andWhere('d.idDepa IN (:departements)')
            ->setParameter('collectivites', $idColls)
            ->setParameter('departements', $idDepa);

        return $qb->getQuery()->getResult();
    }

    function getNonDroitsSurCollectiviteByCdg($cdg, $idColls ){
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idColl')
            ->from('UserBundle:UtilisateurDroits','ud')
            ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
            ->leftJoin('InfoCentreBundle:PoolItem', 'pi', 'WITH', 'pi.idCollectivite = c.idColl')
            ->where('ud.utilisateurCdg = :idUtilisateurCdg')
            ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit')
            ->andWhere('c.idColl IN (:collectivite)')
            ->setParameter('idUtilisateurCdg', $cdg)
            ->setParameter('collectivite', $idColls)
            ->setParameter("droit", $droit)
            ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
            
        return $qb->getQuery()->getResult();
    }

    function getDroitsReadSurCollectiviteByCdg($cdg, $idColls){
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idColl')
            ->from('UserBundle:UtilisateurDroits','ud')
            ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
            ->leftJoin('InfoCentreBundle:PoolItem', 'pi', 'WITH', 'pi.idCollectivite = c.idColl')
            ->where('ud.utilisateurCdg = :idUtilisateurCdg')
            ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) >= :droit')
            ->andWhere('c.idColl IN (:collectivite)')
            ->groupBy('c.idColl')
            ->setParameter('idUtilisateurCdg', $cdg)
            ->setParameter('collectivite', $idColls)
            ->setParameter("droit", $droit)
            ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE);
        return $qb->getQuery()->getScalarResult();
    }

    function getCollectiviteByIdPool($idPool, $fields){
       // $droit = bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select($fields)
            ->from('InfoCentreBundle:PoolItem', 'pi')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'pi.idCollectivite = c.idColl')
           /* ->from('UserBundle:UtilisateurDroits','ud')
            ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')*/
            //->join('InfoCentreBundle:PoolItem', 'pi', 'WITH', 'pi.collectivite = c.idColl')
            ->where('pi.pool = :idPool')
            //->where('ud.utilisateurCdg = :idUtilisateurCdg')
            //->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit')
            //->andWhere('c.idColl IN (:collectivite)')
            //->setParameter('idUtilisateurCdg', $cdg)
            ->setParameter('idPool', $idPool);
            //->setParameter("droit", $droit)
            //->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);

        return $qb->getQuery()->getResult();
    }


    
}