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
 * Description of RefMotifDepartRepository
 *
 * @author mbusson
 */
class RefMotifDepartRepository extends RefAbstractRepository {

    public function findAllMotifDepartByStatut($status) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('md')
                ->from($this->_entityName, 'md')
                ->innerJoin('md.statutMotifDeparts', 's', 'md.statutMotifDeparts = s.idStat')
                ->where('md.blVali = 0')
                ->andWhere('s.idStat = :idstatut')
                ->setParameter('idstatut', $status)

        ;

        try {
            $ce = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            return null;
        }

        return $ce;
    }

    public function findAllMotifDepartByStatutAndByTemp($status, $temp) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('md')
                ->from($this->_entityName, 'md')
                ->innerJoin('md.statutMotifDeparts', 's', 'md.statutMotifDeparts = s.idStat')
                ->where('md.blVali = 0');
                if($temp === '2'){
                     $qb->andWhere('md.blDepatempRemu = 1');
                }
                $qb->andWhere('s.idStat = :idstatut')
                ->setParameter('idstatut', $status)
        ;
        try {
            $ce = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            return null;
        }

        return $ce;
    }

    public function findMotifDepartByCodeDCD($idMotidepa) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('md')
                ->from($this->_entityName, 'md')
                ->where('md.blVali = 0')
                ->andWhere('md.idMotidepa = :idMotidepa')
                ->andWhere('md.cdMotidepa = :cdMotidepa')
                ->setParameter('idMotidepa', $idMotidepa)
                ->setParameter("cdMotidepa", "DCD");

        $blDCD = false;
        try {
            $st = $qb->getQuery()->getResult();
            if (!empty($st)) {
                $blDCD = true;
            }
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $blDCD;
    }

    public function findOneByInCdN4ds($cdN4ds) {
        $code = '%-'.$cdN4ds.'-%';
        $qb = $this->_em->createQueryBuilder();
        $qb->select('md')
                ->from($this->_entityName, 'md')
                ->where('md.blVali = 0')
                ->andWhere('concat(concat(\'-\', md.cdMotiN4ds), \'-\' ) LIKE :code')
                ->setParameter('code', $code)
                ;

        try {
            $md = $qb->getQuery()->getSingleResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $md;

    }

    public function findByAllWithOrder() {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('md')
                ->from($this->_entityName, 'md')
                ->where('md.blVali = 0')
                ->addOrderBy('md.blDepadefi', 'ASC')
        ;

        try {
            $md = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }

        return $md;
    }

    public function findAllMotifDepartForFoncStagWithOrder() {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('md')
                ->from($this->_entityName, 'md')
                ->innerJoin('md.statutMotifDeparts', 's', 'md.statutMotifDeparts = s.idStat')
                ->where('md.blVali = 0')
                ->andWhere('s.idStat in (1,2)')
                ->addOrderBy('md.blDepatemp', 'DESC')
        ;

        try {
            $md = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }

        return $md;
    }

    public function findAllMotifDepartForContWithOrder() {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('md')
                ->from($this->_entityName, 'md')
                ->innerJoin('md.statutMotifDeparts', 's', 'md.statutMotifDeparts = s.idStat')
                ->where('md.blVali = 0')
                ->andWhere('s.idStat = 3')
                ->addOrderBy('md.blDepatemp', 'DESC')
        ;

        try {
            $md = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }

        return $md;
    }



}
