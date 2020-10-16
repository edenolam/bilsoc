<?php

namespace Bilan_Social\Bundle\BilanSocialBundle\Repository;

use Doctrine\ORM\EntityRepository;

class HistoriqueBilanSocialRepository extends EntityRepository {
    public function getLastHist($collectivite, $enquete){          
        $qb = $this->_em->createQueryBuilder();
        $qb->select("hbs")
                ->from($this->_entityName, 'hbs')
                ->where('hbs.enquete = :enquete')
                ->andWhere('hbs.collectivite = :collectivite')
                ->orderBy('hbs.idHistbilasoci','DESC')
                ->setMaxResults(1)
                ->setParameter('enquete', $enquete)
                ->setParameter('collectivite', $collectivite);

        return $qb->getQuery()->getOneOrNullResult();
    }
}