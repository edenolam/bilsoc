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
 * Description of RefEmploiNonPermanentRepository
 *
 * @author mbusson
 */
class RefEmploiNonPermanentRepository extends RefAbstractRepository {

    public function findOneByInCdN4ds($cdN4ds) {
        $code = '%-'.$cdN4ds.'-%';
        $qb = $this->_em->createQueryBuilder();
        $qb->select('enp')
                ->from($this->_entityName, 'enp')
                ->where('concat(concat(\'-\', enp.cdMotiN4ds), \'-\' ) LIKE :code')
                ->andWhere('enp.blVali = 0')
                ->setParameter('code', $code)
                ;

        try {
            $enp = $qb->getQuery()->getSingleResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $enp;

    }

}
