<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DemandeAnalyse Repository
 */
class DemandeAnalyseRepository extends EntityRepository {
    
    public function getDemandeAnalyseByCdg($cdg){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('da, c, d')
                ->from($this->_entityName, 'da')
                ->join('da.collectivite','c')
                ->join('c.departement', 'd')
                ->where('da.cdg = :cdg')
//                ->andWhere($qb->expr()->eq('c.idColl', $id))
                ->setParameter('cdg', $cdg);
        return $qb->getQuery()->getArrayResult();
    }
}