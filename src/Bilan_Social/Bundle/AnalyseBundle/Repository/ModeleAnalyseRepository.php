<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ModeleAnalyse Repository
 */
class ModeleAnalyseRepository extends EntityRepository {
    
    public function checkIfShowAnalyseLink($cdg,$idColl, $campagne){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ma')
            ->from($this->_entityName, 'ma')
            ->join('ma.collectivites', 'c')
            ->where('ma.campagne = :campagne')
            ->andWhere('c.idColl = :idColl')
            ->andWhere('ma.cdg = :cdg')
            ->setParameter('campagne', $campagne)
            ->setParameter('cdg', $cdg)
            ->setParameter('idColl', $idColl);
       
        return $qb->getQuery()->getOneOrNullResult();
    }
    
    public function checkIfCdgAutoriseAnalyse($idUtilisateurCdg){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ud.fgDroits')
                ->from('UserBundle:UtilisateurDroits','ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
//                ->where('c.idColl = :idColl')
                ->where('uc.idUtilisateurCdg = :idUtilisateurCdg')
//                ->setParameter('idColl', $idCollectivite)
                ->setParameter('idUtilisateurCdg', $idUtilisateurCdg);
        return $qb->getQuery()->getResult();
    }
}