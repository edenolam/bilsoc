<?php

namespace Bilan_Social\Bundle\CampagneBundle\Repository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\ORM\EntityRepository;

/**
 * Description of CampagneRepository
 *
 * @author mbusson
 */
class CampagneRepository extends EntityRepository {

    public function GetCurrentCampagne() {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
                ->from($this->_entityName, 'c')
                ->where('c.fgStat = :statut')
                ->setParameter('statut', '1');

        $campagne = $qb->getQuery()->getOneOrNullResult();

        return $campagne;
    }

}
