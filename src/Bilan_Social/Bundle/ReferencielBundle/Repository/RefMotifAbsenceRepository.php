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
class RefMotifAbsenceRepository extends RefAbstractRepository {


    public function findOneByInCdN4ds($cdN4ds) {
        $code = '%-'.$cdN4ds.'-%';
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ma')
                ->from($this->_entityName, 'ma')
                ->where('ma.blVali = 0')
                ->andWhere('concat(concat(\'-\', ma.cdMotiN4ds), \'-\' ) LIKE :code')
                ->setParameter('code', $code)
                ;

        try {
            $ma = $qb->getQuery()->getSingleResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $ma;

    }



}
