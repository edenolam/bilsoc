<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\ImportBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;


class ImportRepository extends EntityRepository {

    public function findOneByImport($idColl, $idEnqu, $nmAnnee) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i')
                ->from($this->_entityName, 'i')
                ->join('i.enquete', 'e')
                    ->addSelect('e')
                ->join('i.collectivite', 'c')
                    ->addSelect('c')
                ->where('c.idColl = :collect')
                    ->setParameter('collect', $idColl)
                ->andWhere('e.idEnqu = :idEnqu')
                    ->setParameter('idEnqu', $idEnqu)
                ->andWhere('i.nmAnnee = :nmAnnee')
                    ->setParameter('nmAnnee', $nmAnnee)
                ;

        try {
            $im = $qb->getQuery()->getSingleResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $im;
    }

    /*

    public function findOneByInCdN4ds($cdN4ds) {
        $code = '%-'.$cdN4ds.'-%';
        $qb = $this->_em->createQueryBuilder();
        $qb->select('md')
                ->from($this->_entityName, 'md')
                ->where('concat(concat(\'-\', md.cdMotiN4ds), \'-\' ) LIKE :code')
                    ->setParameter('code', $code)
                ;

        try {
            $md = $qb->getQuery()->getSingleResult();
        }
        catch (NoResultException $e) {
            return null;
        }

        return $md;

    }*/

}
