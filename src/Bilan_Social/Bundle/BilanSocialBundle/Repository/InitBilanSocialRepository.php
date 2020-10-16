<?php

namespace Bilan_Social\Bundle\BilanSocialBundle\Repository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\ORM\EntityRepository;

/**
 * Description of InitBilanSocialRepository
 *
 * @author mbusson
 */
class InitBilanSocialRepository extends EntityRepository {

    public function getCurrentInfoBilanSocial($idColl, $idEnqu) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select("i")
                ->from('BilanSocialBundle:InitBilanSocial', 'i')
                ->where('i.enquete = :enquete')
                ->andWhere('i.collectivite = :collectivite')
                ->setParameter('enquete', $idEnqu)
                ->setParameter('collectivite', $idColl);
                
        return $qb->getQuery()->getOneOrNullResult();
    }

}
