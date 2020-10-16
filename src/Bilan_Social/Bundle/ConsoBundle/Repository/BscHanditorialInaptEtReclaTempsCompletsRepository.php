<?php

namespace Bilan_Social\Bundle\ConsoBundle\Repository;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;

class BscHanditorialInaptEtReclaTempsCompletsRepository extends AbstractRepository
{
	public function getResultsForExport($idsBsc) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('
        COALESCE(SUM(bsch.tempsCompletH),0) AS tempsCompletH, 
        COALESCE(SUM(bsch.tempsCompletF),0) AS tempsCompletF, 
        COALESCE(SUM(bsch.tempsNonCompletH),0) AS tempsNonCompletH, 
        COALESCE(SUM(bsch.tempsNonCompletF),0) AS tempsNonCompletF')
                ->from($this->_entityName, 'bsch')
                ->where('bsch.bilanSocialConsolide IN (:idsBsc)')
                ->setParameter('idsBsc', $idsBsc);
        try {
            $result = $qb->getQuery()->getSingleResult();
            $result = $this->utf8_encode($result);
        }
        catch (NoResultException $e) {
            // Pas de enquete active consolidé pour la collectivite
            $result = null;
        }

        return $result;
    }
}
