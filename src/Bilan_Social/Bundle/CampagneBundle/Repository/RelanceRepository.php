<?php

namespace Bilan_Social\Bundle\CampagneBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RelanceRepository extends EntityRepository {
    public function getLastRelance($params){
        if(isset($params['collectivite']))
            $collectivite = $params['collectivite'];
        else
            $collectivite = null;
        
        if(isset($params['enquete']))
            $enquete = $params['enquete'];
        else
            $enquete = null;
        
        if(isset($params['cdg']))
            $cdg = $params['cdg'];
        else
            $cdg = null;
        
        if(isset($params['campagne']))
            $campagne = $params['campagne'];
        else
            $campagne = null;
        
        $qb = $this->_em->createQueryBuilder();
        if(null != $collectivite && null != $enquete){
            $qb->select("r")
                ->from($this->_entityName, 'r')
                ->where('r.enquete = :enquete')
                ->andWhere('r.collectivite = :collectivite')
                ->orderBy('r.dtDernrela','DESC')
                ->setMaxResults(1)
                ->setParameter('enquete', $enquete)
                ->setParameter('collectivite', $collectivite);
        }elseif(null != $campagne && null != $cdg){
            $qb->select("r")
                ->from($this->_entityName, 'r')
                ->where('r.campagne = :campagne')
                ->andWhere('r.cdg = :cdg')
                ->orderBy('r.dtDernrela','DESC')
                ->setMaxResults(1)
                ->setParameter('campagne', $campagne)
                ->setParameter('cdg', $cdg);
        }
        return $qb->getQuery()->getResult();
    }
}