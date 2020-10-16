<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;

/**
 * Description of UtilisateurCdgRepository
 *
 * @author djoncour
 */
class UtilisateurCdgRepository extends EntityRepository {
    //put your code here
    function findOneByContactCdgDepartementByUtilisateur($idDepartement) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cd')
                ->from('CollectiviteBundle:CdgDepartement', 'cd')
                ->join('cd.cdg', 'c', 'c.idCdg = cd.idCdg')
                ->andWhere('cd.fgType = :fgType')
                ->andWhere('cd.departement = :idDepa')
                ->setParameter("fgType", "1")
                ->setParameter("idDepa", $idDepartement);
         try {
            $contactCdg = $qb->getQuery()->getOneOrNullResult();
        } catch (NoResultException $e) {
            return null;
        }

        return $contactCdg;
    }
    
    function findOneByCdgDepartementByUtilisateur($utilisateur) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cd')
                ->from($this->_entityName, 'uc')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'uc.idUtilisateurCdg = ud.utilisateurCdg')
                ->leftJoin('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->where('uc.utilisateur = :utilisateur')
                ->andWhere('cd.fgType = :fgType')
                ->setParameter('utilisateur', $utilisateur)
                ->setParameter("fgType", "");
        return $qb->getQuery()->getResult();
    }
}
