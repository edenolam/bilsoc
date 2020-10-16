<?php

namespace Bilan_Social\Bundle\ConsoBundle\Repository;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;

class BscHanditorialNatureHandicapsRepository extends AbstractRepository {

    public function getResultsForExport($idsBsc) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ref.lbNathandiboeth, SUM(bsch.natureHandicapH) AS natureHandicapH, SUM(bsch.natureHandicapF) AS natureHandicapF')
                ->from($this->_entityName, 'bsch')
                ->join('ReferencielBundle:RefNatureHandicapBoeth', 'ref', 'WITH', 'bsch.refNatureHandicapBoeth = ref.idNathandiboeth')
                ->where('bsch.bilanSocialConsolide IN (:idsBsc)')
                ->setParameter('idsBsc', $idsBsc)
                ->groupBy('bsch.refNatureHandicapBoeth');
        try {
            $result = $qb->getQuery()->getResult();
            $result = $this->utf8_encode($result);
        }
        catch (NoResultException $e) {
            // Pas de enquete active consolidé pour la collectivite
            $result = null;
        }

        return $result;
    }

}
