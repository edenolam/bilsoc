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
 * Description of UtilisateurDroitsRepository
 *
 * @author djoncour
 */
class UtilisateurDroitsRepository extends EntityRepository {
    //put your code here
    
    public function getDroitByCdg($utilisateur) {
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $droit_read = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $droit = array($droit_read,$droit_write);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ud')
                ->from($this->_entityName, 'ud')
                ->join('ud.cdgDepartement', 'uc')
                ->addSelect('uc')
                ->where('ud.utilisateurCdg = :utilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)') //CONV(:mask,2,10)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter('utilisateur', $utilisateur)
                ->setParameter('droit', $droit);
        return $qb->getQuery()->getResult();
    }

}
