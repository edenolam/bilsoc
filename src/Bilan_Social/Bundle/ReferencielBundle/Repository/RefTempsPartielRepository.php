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
 * Description of RefTempsPartielRepository
 *
 * @author mbusson
 */
class RefTempsPartielRepository extends RefAbstractRepository {

    public function findOneByInCdN4ds($cdN4ds) {
        $code = '%-'.$cdN4ds.'-%';
        $qb = $this->_em->createQueryBuilder();
        $qb->select('tp')
                ->from($this->_entityName, 'tp')
                ->where('tp.blVali = 0')
                ->andWhere('concat(concat(\'-\', tp.cdModaN4ds), \'-\' ) LIKE :code')
                ->setParameter('code', $code)
                ;

        try {
            $tp = $qb->getQuery()->getSingleResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $tp;

    }
    public function findByExcludePARTAUTO() {
     
        $qb = $this->_em->createQueryBuilder();
        $qb->select('tp')
                ->from($this->_entityName, 'tp')
                ->where('tp.blVali = 0')
                ->andWhere('tp.cdTemppart != :CdTemppart')
                ->setParameter('CdTemppart', 'PARTAUTO')
                ;

        try {
            $tp = $qb->getQuery()->getResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $tp;

    }

}
