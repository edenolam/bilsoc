<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ParametrageAffichageCollectivite Repository
 */
class ParametrageAffichageCollectiviteRepository extends EntityRepository {

    public function getColonnes($id){
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('pac.blCdgColl','pac.blCollDgcl','pac.blCtCdg','pac.blSurclasDemo','pac.blCdInse','pac.blCdPost','pac.blChsct','pac.blDepa','pac.blLbVill','pac.blNmPopuInse','pac.blNmStratColl','pac.blSire','pac.blTypeColl','pac.blLibe','pac.blAffiCdg','pac.blNbAgenPerm','pac.blNbAgenTitu','pac.blNbAgenContPerm','pac.blNbAgenContNonPerm'))
                ->from($this->_entityName, 'pac')
                ->where('pac.idParaAffiColl = :id')
                ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

    public function getFiltres($id){
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('pac.filtres'))
                ->from($this->_entityName, 'pac')
                ->where('pac.idParaAffiColl = :id')
                ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

}
