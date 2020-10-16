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
 * Description of RefDefaultRepository
 *
 * @author mbusson
 */
class RefDefaultRepository extends RefAbstractRepository{

    public function AllRefEntities() {

        $qb = $this->_em->createQueryBuilder();

        $qb->select('ref')
                ->from('User', 'ref')
                ->where('u.id = ?1')
                ->orderBy('u.name', 'ASC');

        try {
            $grade = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
// Pas de bilan pour cette enquete et coll
            return null;
        }

        return $grade;
    }

}
