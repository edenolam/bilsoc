<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\ReferencielBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;
/**
 * Description of RefStatutRepository
 *
 * @author mbusson
 */
class RefStatutRepository extends RefAbstractRepository {
//    public function findAllStatutArrivee($status) {
//
//        $qb = $this->_em->createQueryBuilder();
//        $qb->select('ma')
//                ->from($this->_entityName, 'ma')
//                ->innerJoin('ma.statut_motif_arrivee', 's')
//                ->where('s.statutMotifArrivees = :idstatut')
//                ->setParameter('idstatut', $status)
//
//        ;
//
//        try {
//            $ce = $qb->getQuery()->getResult();
//        } catch (NoResultException $e) {
//            return null;
//        }
//
//        return $ce;
//    }
//
//    public function findAllStatutDepart($status) {
//
//        $qb = $this->_em->createQueryBuilder();
//        $qb->select('ma')
//                ->from($this->_entityName, 'ma')
//                ->innerJoin('ma.refMotifArrivee', 's')
//                ->where('s.statutMotifArrivees = :idstatut')
//                ->setParameter('idstatut', $status)
//
//        ;
//
//        try {
//            $ce = $qb->getQuery()->getResult();
//        } catch (NoResultException $e) {
//            return null;
//        }
//
//        return $ce;
//    }



    public function findOneByInCdN4ds($cdN4ds) {
        $code = '%-'.$cdN4ds.'-%';
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s')
                ->from($this->_entityName, 's')
                ->where('s.blVali = 0')
                ->andWhere('concat(concat(\'-\', s.cdMotiN4ds), \'-\' ) LIKE :code')
                ->setParameter('code', $code)
                ;

        try {
            $statut = $qb->getQuery()->getSingleResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $statut;

    }

    public function findByAllWithOrder() {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('s')
                ->from($this->_entityName, 's')
                ->where('s.blVali = 0')
                ->andWhere('s.bl424 = 1')
                ->addOrderBy('s.idStat', 'ASC')
        ;

        try {
            $statut = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }

        return $statut;
    }

}
