<?php

namespace Bilan_Social\Bundle\ConsoBundle\Repository;
use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;

/**
 * BscHanditorialAvisInaptitudesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BscHanditorialAvisInaptitudesAvantRepository extends AbstractRepository {

    public function getResultsForExport($idsBsc) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ref.lbInaptitudeboeth, SUM(bsch.avisInaptitudeAvantH) AS avisInaptitudeAvantH, SUM(bsch.avisInaptitudeAvantF) AS avisInaptitudeAvantF')
                ->from($this->_entityName, 'bsch')
                ->join('ReferencielBundle:RefInaptitudeBoeth', 'ref', 'WITH', 'bsch.refInaptitudeBoeth = ref.idInaptitudeboeth')
                ->where('bsch.bilanSocialConsolide IN (:idsBsc)')
                ->setParameter('idsBsc', $idsBsc)
                ->groupBy('bsch.refInaptitudeBoeth');
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