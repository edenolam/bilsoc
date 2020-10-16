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
 * Description of RefmotifArriveeRepository
 *
 * @author mbusson
 */
class RefMotifArriveeRepository extends RefAbstractRepository {

    public function findAllMotifArriveeByStatut($status) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('ma')
                ->from($this->_entityName, 'ma')
                ->innerJoin('ma.statutMotifArrivees', 's', 'ma.statutMotifArrivees = s.idStat')
                ->where('ma.blVali = 0')
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

}
