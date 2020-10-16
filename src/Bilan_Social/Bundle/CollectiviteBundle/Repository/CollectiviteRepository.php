<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Repository;

use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite;

/**
 * Collectivite Repository
 */
class CollectiviteRepository extends AbstractRepository {

    /**
     * Get infos collectivite
     *
     * @param string $idCdg
     * @return array
     */
    public function getCollectiviteByUtilisateur($utilisateur) {
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.idColl', 'c.lbColl', 'c.blChsct', 'd.lbDepa', 'd.cdDepa', 'c.cdPost', 'c.lbVill', 'c.cdInse', 'c.nmSire', 'c.nmPopuInse', 'c.blSurclasDemo', 'c.nmStratColl', 'c.blAffiColl', 'c.blCtCdg', 'c.blCollDgcl', 'c.blCdgColl', 'rtc.lbTypeColl', 'c.change_request', 'c.cdg_is_authorized_by_collectivity','ud.fgDroits', 'u.email', 'u.lbPassTemp', 'cc.lbMail'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.collectivite = c.idColl AND cc.blContactPrincipal = true')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->join('c.refTypeCollectivite', 'rtc')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('c.blActi = 1')
                ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
                ->setParameter('idUtilisateur', $utilisateur)
                ->setParameter("droit", $droit);
        /* ->from($this->_entityName, 'c')
          ->innerJoin('c.departement', 'd')
          ->join('c.refTypeCollectivite', 'rtc')
          ->where('c.cdg = :idCdg')
          ->orderBy('d.cdDepa', 'ASC')
          ->setParameter('idCdg', $idCdg); */
        return $qb->getQuery()->getResult();
    }
    /**
     * Get infos collectivite
     *
     * @param $utilisateur
     * @param $filtres ( facultatif )
     * @return array
     */
    public function getCollectiviteFiltered($utilisateur,array $tab_id_enq = null, array $filtres = null){
         $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.idColl', 'c.lbColl', 'c.blChsct', 'd.lbDepa', 'd.cdDepa',
            'c.lbAdre','c.cdPost', 'c.lbVill', 'c.cdInse', 'c.nmSire', 'c.nmPopuInse',
            'c.blSurclasDemo', 'c.nmStratColl', 'c.blAffiColl', 'c.blCtCdg', 'c.blCollDgcl',
            'c.blCdgColl', 'rtc.lbTypeColl', 'c.change_request', 'c.cdg_is_authorized_by_collectivity',
            'ud.fgDroits', 'u.email', 'u.lbPassTemp', 'cc.lbMail', 'cc.lbNom', 'cc.lbTele', 'ma.blAffi as select_affi',
            'b.nbAgentEmploiPermanent as NbAgenPerm', 'b.nbAgentTitulaire as NbAgenTitu',
            'b.nbAgentContractuelEmploiNonPermament as NbAgenContNonPerm',
                    'b.nbAgentContractuelEmploiPermanent as NbAgenContPerm', 'MAX(hbs.idHistbilasoci)','hbs.fgStat')
        )
                ->from('UserBundle:UtilisateurCdg', 'uc')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'uc.cdg = cd.cdg AND cd.fgType = 0')
                ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement AND CONV(:mask, 2, 10, ud.fgDroits) = :droit AND uc.idUtilisateurCdg = ud.utilisateurCdg')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CampagneBundle:Campagne', 'ca', 'WITH', 'ca.fgStat = 1')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->join('c.refTypeCollectivite', 'rtc', 'WITH', 'c.refTypeCollectivite = rtc.idTypeColl')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->leftJoin('EnqueteBundle:Enquete', 'e', 'WITH', 'd MEMBER OF e.departements AND e.idCamp = ca.idCamp')
                ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.collectivite = c.idColl AND cc.blContactPrincipal = true')
                ->leftJoin('EnqueteBundle:EnqueteCollectivite', 'ec', 'WITH', 'c.idColl = ec.collectivite AND e.idEnqu =  ec.enquete ')
                ->leftJoin('ConsoBundle:BilanSocialConsolide', 'b', 'WITH', 'b.collectivite = c.idColl AND e.idEnqu =  b.enquete')
                ->leftJoin('BilanSocialBundle:HistoriqueBilanSocial', 'hbs', 'WITH', 'b.enquete = hbs.enquete AND b.collectivite = hbs.collectivite')
                ->leftjoin('c.modeleAnalyse ', 'ma')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('c.blActi = 1');
        $qb = $this->applyFilters($qb, $filtres)
            ->groupBy('c.idColl')
            ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
            ->setParameter('droit', $droit)
            ->setParameter('idUtilisateur', $utilisateur);
        return $qb->getQuery()->getArrayResult();
    }

    /**
     * Get infos collectivite
     *
     * @param string $idCdg
     * @return array
     */
    public function getAllCollectivites(array $filtres = null) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.idColl', 'c.lbColl', 'c.blChsct', 'd.lbDepa', 'd.cdDepa', 'c.lbAdre','c.cdPost', 'c.lbVill', 'c.cdInse', 'c.nmSire', 'c.nmPopuInse', 'c.blSurclasDemo', 'c.nmStratColl', 'c.blAffiColl', 'c.blCtCdg', 'c.blCollDgcl', 'c.blCdgColl', 'rtc.lbTypeColl', 'c.change_request', 'c.cdg_is_authorized_by_collectivity','ud.fgDroits', 'u.email', 'u.lbPassTemp', 'cc.lbMail', 'cc.lbNom', 'cc.lbTele', 'ma.blAffi as select_affi', 'b.nbAgentEmploiPermanent as NbAgenPerm', 'b.nbAgentTitulaire as NbAgenTitu', 'b.nbAgentContractuelEmploiNonPermament as NbAgenContNonPerm',
                    'b.nbAgentContractuelEmploiPermanent as NbAgenContPerm'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'uc.cdg = cd.cdg')

                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin('EnqueteBundle:EnqueteCollectivite', 'ec', 'WITH', 'c.idColl = ec.collectivite')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->join('c.refTypeCollectivite', 'rtc')
                ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.collectivite = c.idColl AND cc.blContactPrincipal = true')
                ->leftjoin('c.modeleAnalyse ', 'ma')
                ->leftJoin('ConsoBundle:BilanSocialConsolide', 'b', 'WITH', 'b.collectivite = c.idColl AND ec.enquete = b.enquete')
                ->where('c.blActi = 1');
        $qb = $this->applyFilters($qb, $filtres);
        $qb->groupBy('c.idColl');
        return $qb->getQuery()->getResult();
    }

    public function getAllCollectivitesModifiees() {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->join('CollectiviteBundle:CollectiviteDraft', 'cdr', 'WITH', 'cdr.collectivite = c.idColl')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->join('c.refTypeCollectivite', 'rtc')
                ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.collectivite = c.idColl AND cc.blContactPrincipal = true')
                ->where('c.blActi = 1')
//                ->andWhere('c.change_request = 1')
                ->groupBy('c.idColl');
        return $qb->getQuery()->getResult();
    }

    public function getCollectiviteModifieesByCdg($utilisateur) {
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->join('CollectiviteBundle:CollectiviteDraft', 'cdr', 'WITH', 'cdr.collectivite = c.idColl')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->join('c.refTypeCollectivite', 'rtc')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
//                ->andWhere('c.change_request = 1')
                ->andWhere('c.blActi = 1')
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)
                ->setParameter('idUtilisateur', $utilisateur)
                ->setParameter("droit", $droit);
        return $qb->getQuery()->getResult();
    }

    public function getInfosCollectiviteByDepartement($dept) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.lbColl', 'bsc.fgStat'))
                ->from($this->_entityName, 'c')
                ->leftJoin('ConsoBundle:BilanSocialConsolide', 'bsc', 'WITH', 'bsc.collectivite = c.idColl')
                ->where('c.departement = :dept')
                ->andWhere('c.blActi = 1')
                ->setParameter('dept', $dept);

        return $qb->getQuery()->getResult();
    }

    /**
     * Get infos collectivite
     *
     * @param string $idCdg
     * @return array
     */
    public function getCollectiviteBloqueByCdg($utilisateur) {
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('u'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->join('c.refTypeCollectivite', 'rtc')
                ->join('UserBundle:User', 'u', 'WITH', 'c.nmSire = u.username')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('u.fgBlocage != :bloque') //CONV(:mask,2,10)
                ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
                ->setParameter('idUtilisateur', $utilisateur)
                ->setParameter('bloque', 0)
                ->setParameter("droit", $droit)
                ->orderBy('u.dtBlocage', 'ASC');
        /* ->from($this->_entityName, 'c')
          ->innerJoin('c.departement', 'd')
          ->join('c.refTypeCollectivite', 'rtc')
          ->where('c.cdg = :idCdg')
          ->orderBy('d.cdDepa', 'ASC')
          ->setParameter('idCdg', $idCdg); */
        return $qb->getQuery()->getResult();
    }

    /**
     * Get infos collectivite
     *
     * @param string $idCdg
     * @return array
     */
    public function getCollectiviteBloque() {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('u'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->join('c.refTypeCollectivite', 'rtc')
                ->join('UserBundle:User', 'u', 'WITH', 'c.nmSire = u.username')
                ->where('u.fgBlocage != :bloque') //CONV(:mask,2,10)
                ->setParameter('bloque', 0)
                ->orderBy('u.dtBlocage', 'ASC');
        return $qb->getQuery()->getResult();
    }

    function GetContactPrincipal($idCollectivite) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('contact')
                ->from('CollectiviteBundle:CollectiviteContact', 'contact')
                ->join($this->_entityName, 'coll', "WITH", "contact.collectivite = coll.idColl")
//                ->join('CollectiviteBundle:Cdg', 'cdg', 'WITH', 'uc.cdg = cdg.idCdg')
                ->where('contact.collectivite= :idcollectivite')
                ->andWhere('contact.blContactPrincipal = true')
                ->setParameter('idcollectivite', $idCollectivite);

        try {
            $collectivite = $qb->getQuery()->getOneOrNullResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $collectivite;
    }

    function getDroitsSurCollectivite($idCollectivite, $idUtilisateurCdg){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ud.fgDroits')
                ->from('UserBundle:UtilisateurDroits','ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->where('c.idColl = :idColl')
                ->andWhere('uc.idUtilisateurCdg = :idUtilisateurCdg')
                ->setParameter('idColl', $idCollectivite)
                ->setParameter('idUtilisateurCdg', $idUtilisateurCdg);
        return $qb->getQuery()->getOneOrNullResult();
    }

    function getDroitsSurPlusieursCollectivites($idCollectivite, $idUtilisateurCdg){
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ud')
                ->from('UserBundle:UtilisateurDroits','ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->where('ud.utilisateurCdg = :idUtilisateurCdg')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) != :droit')
                ->andWhere('c.idColl IN (:collectivite)')
                ->setParameter('idUtilisateurCdg', $idUtilisateurCdg)
                ->setParameter('collectivite', $idCollectivite)
                ->setParameter("droit", $droit)
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE);
        return $qb->getQuery()->getResult();
    }

    function getDroitsSurCollectiviteByCdg($cdg,$idColls ){
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idColl')
            ->from('UserBundle:UtilisateurDroits','ud')
            ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
            ->where('ud.utilisateurCdg = :idUtilisateurCdg')
            ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit')
            ->andWhere('c.idColl IN (:collectivite)')
            ->setParameter('idUtilisateurCdg', $cdg)
            ->setParameter('collectivite', $idColls)
            ->setParameter("droit", $droit)
            ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        return $qb->getQuery()->getResult();
    }

    function getNonDroitsSurCollectiviteByCdg($cdg,$idColls ){
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d.lbDepa')
            ->from('UserBundle:UtilisateurDroits','ud')
            ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
            ->where('ud.utilisateurCdg = :idUtilisateurCdg')
            ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) != :droit')
            ->andWhere('c.idColl IN (:collectivite)')
            ->groupBy('d.lbDepa')
            ->setParameter('idUtilisateurCdg', $cdg)
            ->setParameter('collectivite', $idColls)
            ->setParameter("droit", $droit)
            ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);

        return $qb->getQuery()->getArrayResult();
    }

    function getDepartementDroitsSurCollectiviteByCdg($cdg,$idColls ){
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('d.lbDepa')
            ->from('UserBundle:UtilisateurDroits','ud')
            ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
            ->where('ud.utilisateurCdg = :idUtilisateurCdg')
            ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit')
            ->andWhere('c.idColl IN (:collectivite)')
            ->groupBy('d.lbDepa')
            ->setParameter('idUtilisateurCdg', $cdg)
            ->setParameter('collectivite', $idColls)
            ->setParameter("droit", $droit)
            ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);

        return $qb->getQuery()->getArrayResult();
    }

    public function getCollectiviteByDepartement($departement) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
                ->from('CollectiviteBundle:Collectivite', 'c')
                ->where('c.departement = :idDepartement')
                ->andWhere('c.blActi = 1')
                ->setParameter('idDepartement', $departement)
               ;
        return $qb->getQuery()->getResult();
    }

     public function getCollectiviteEntityByUtilisateurAndCdgDepartement($utilisateur, $cdgDepartement,$options=null) {
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement AND cd.idCdgDepartement IN (:cdgDepartement)')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.collectivite = c.idColl AND cc.blContactPrincipal = true')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->join('c.refTypeCollectivite', 'rtc')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('c.blActi = 1')
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
                ->setParameter('idUtilisateur', $utilisateur)
                ->setParameter('cdgDepartement', $cdgDepartement)
                ->setParameter("droit", $droit);

        return $this->FetchAllDataQB($qb,$options);//$qb->getQuery()->getResult();
    }

    /**
     * Get infos collectivite
     *
     * @param string $idCdg
     * @return array
     */
    public function getCollectiviteByUtilisateurForUpdateMdp($utilisateur) {
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.collectivite = c.idColl AND cc.blContactPrincipal = true')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->join('c.refTypeCollectivite', 'rtc')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('c.blActi = 1')
                ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
                ->setParameter('idUtilisateur', $utilisateur)
                ->setParameter("droit", $droit);

        return $qb->getQuery()->getResult();
    }

    public function getCollectiviteByUtilisateurAnalyse($utilisateur) {
        $droit = bindec(DroitsEnum::MASK_ESPACE_ANALYSE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.idColl', 'c.lbColl', 'c.blChsct', 'd.lbDepa', 'd.cdDepa', 'c.cdPost', 'c.lbVill', 'c.cdInse', 'c.nmSire', 'c.nmPopuInse', 'c.blSurclasDemo', 'c.nmStratColl', 'c.blAffiColl', 'c.blCtCdg', 'c.blCollDgcl', 'c.blCdgColl', 'rtc.lbTypeColl', 'c.change_request', 'c.cdg_is_authorized_by_collectivity','ud.fgDroits', 'u.email', 'u.lbPassTemp', 'cc.lbMail'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.collectivite = c.idColl AND cc.blContactPrincipal = true')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->join('c.refTypeCollectivite', 'rtc')
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('c.blActi = 1')
                ->setParameter('mask', DroitsEnum::MASK_ESPACE_ANALYSE)
                ->setParameter('idUtilisateur', $utilisateur)
                ->setParameter("droit", $droit);
        /* ->from($this->_entityName, 'c')
          ->innerJoin('c.departement', 'd')
          ->join('c.refTypeCollectivite', 'rtc')
          ->where('c.cdg = :idCdg')
          ->orderBy('d.cdDepa', 'ASC')
          ->setParameter('idCdg', $idCdg); */
        return $qb->getQuery()->getResult();
    }

    public function getCollectiviteById($idColl){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('CollectiviteBundle:Collectivite','c')
            ->where('c.idColl = :idColl ')
            ->setParameter('idColl', $idColl);

        return $qb->getQuery()->getResult();
    }
    public function getCollectiviteByIds($idColls){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from('CollectiviteBundle:Collectivite','c')
            ->where('c.idColl IN (:idColls) ')
            ->setParameter('idColls', $idColls);

        return $qb->getQuery()->getResult();
    }
    public function FetchAllDataQB($qb,$options=null){
        $result = array();
        if(isset($options)){
            if(isset($options['as_entity']) && $options['as_entity']==true){
                $result = $qb->getQuery()->getResult();
            }else{
                $result = $qb->getQuery()->getArrayResult();
            }
        }else{
            $result = $qb->getQuery()->getArrayResult();
        }
        return $result;
    }
    public function getCollectiviteInfoForCsv($idColls,$array_fields){
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $qb = $this->_em->createQueryBuilder();

        $qb->select($array_fields)
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.collectivite = c.idColl AND cc.blContactPrincipal = true')
                ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
                ->join('c.refTypeCollectivite', 'rtc')
                ->where('c.idColl IN (:idColls) ')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('c.blActi = 1')
                ->setParameter('mask', DroitsEnum::MASK_ESPACE_ANALYSE)
                ->setParameter('idColls', $idColls)
                ->groupBy('c.idColl');
               return $qb->getQuery()->getSql();

    }

    public function getCollectiviteForExportDGCLByCdg($utilisateur) {
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->join('ConsoBundle:BilanSocialConsolide', 'bsc', 'WITH', 'bsc.collectivite = c.idColl')
                ->join('EnqueteBundle:Enquete', 'e', 'WITH', 'bsc.enquete = e.idEnqu')
                ->leftJoin('ConsoBundle:Ind111', 'ind111', 'WITH', 'ind111.bilanSocialConsolide = bsc.idBilasocicons')
                ->leftJoin('ConsoBundle:Ind121', 'ind121', 'WITH', 'ind121.bilanSocialConsolide = bsc.idBilasocicons')
                ->leftJoin('ConsoBundle:Ind1311', 'ind1311', 'WITH', 'ind1311.bilanSocialConsolide = bsc.idBilasocicons')
                ->leftJoin('ConsoBundle:Ind1312', 'ind1312', 'WITH', 'ind1312.bilanSocialConsolide = bsc.idBilasocicons' )
                ->where('uc.utilisateur = :idUtilisateur')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->andWhere('c.blActi = 1')
                ->andWhere('e.nmAnne = :anneecampagne')
                ->andWhere('bsc.fgStat = 2')
                ->groupBy('c.idColl')
//                ->having('(SUM(ind111.r1115) + SUM(ind111.r1116) + SUM(ind121.r1215) + SUM(ind121.r1216) + SUM(ind121.r1217) + SUM(ind121.r1218) + SUM(ind1311.r13111) + SUM(ind1311.r13112) + SUM(ind1311.r13113) + SUM(ind1311.r13114) + SUM(ind1312.r13121) + SUM(ind1312.r13122)) < 50')
                ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)
                ->setParameter('idUtilisateur', $utilisateur)
                ->setParameter('anneecampagne', '2017')
                ->setParameter("droit", $droit);

        return $qb->getQuery()->getResult();
    }

    public function getNbCollByTypeColl(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('tc.lbTypeColl AS typeColl, COALESCE(count(c),0) AS nbColl')
                ->from($this->_entityName, 'c')
                ->join('ReferencielBundle:RefTypeCollectivite', 'tc', 'WITH', 'tc.idTypeColl = c.refTypeCollectivite')
                ->join('ConsoBundle:BilanSocialConsolide', 'bsc', 'WITH', 'bsc.collectivite = c.idColl')
                ->join('EnqueteBundle:Enquete','e', 'WITH', 'bsc.enquete = e.idEnqu')
                ->join('CampagneBundle:Campagne', 'ca', 'WITH', 'ca.idCamp = e.idCamp')
                ->where('bsc.fgStat = 2')
                ->andWhere('ca.fgStat = 1')
                ->groupBy('tc.idTypeColl');
             $result = $qb->getQuery()->getResult();
        return $result;
    }

    public function getCollectiviteHistorisationFiltered($utilisateur, $blPresent, array $filtres = null){
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.lbColl','d.lbDepa', 'd.cdDepa',
                'c.lbAdre', 'c.lbVill','c.ancienSiret','c.nmSire',
                'ud.fgDroits')
        )
            ->from('UserBundle:UtilisateurCdg', 'uc')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'uc.cdg = cd.cdg AND cd.fgType = 0')
            ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement AND CONV(:mask, 2, 10, ud.fgDroits) = :droit AND uc.idUtilisateurCdg = ud.utilisateurCdg')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CampagneBundle:Campagne', 'ca', 'WITH', 'ca.fgStat = 1')
            ->join('CollectiviteBundle:importSiretHistorisation', 'c', 'WITH', 'c.idDepa = d.idDepa')
            /*->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')*/
            ->where('uc.utilisateur = :idUtilisateur')
            ->andWhere('c.blPresent = :blPresent')
            ->andWhere('c.blConfirmed = 0');
        $qb = $this->applyFilters($qb, $filtres)
            /*->groupBy('c.idColl')*/
            ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
            ->setParameter('droit', $droit)
            ->setParameter('blPresent', $blPresent)

            ->setParameter('idUtilisateur', $utilisateur);

        return $qb->getQuery()->getArrayResult();
    }
    public function getCollectiviteHistorisation($utilisateur, $blPresent){
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.lbColl','d.lbDepa', 'd.cdDepa',
                'c.lbAdre', 'c.lbVill','c.ancienSiret','c.nmSire',
                'ud.fgDroits')
        )
            ->from('UserBundle:UtilisateurCdg', 'uc')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'uc.cdg = cd.cdg AND cd.fgType = 0')
            ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement AND CONV(:mask, 2, 10, ud.fgDroits) = :droit AND uc.idUtilisateurCdg = ud.utilisateurCdg')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CampagneBundle:Campagne', 'ca', 'WITH', 'ca.fgStat = 1')
            ->join('CollectiviteBundle:importSiretHistorisation', 'c', 'WITH', 'c.idDepa = d.idDepa')
            ->where('uc.utilisateur = :idUtilisateur')
            ->andWhere('c.blPresent = :blPresent')
            ->andWhere('c.blConfirmed = 0')
            ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
            ->setParameter('droit', $droit)
            ->setParameter('blPresent', $blPresent)

            ->setParameter('idUtilisateur', $utilisateur);

        return $qb->getQuery()->getArrayResult();
    }


    public function getAllCollectiviteHistorisation($blPresent, array $filtres = null){
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.lbColl','d.lbDepa', 'd.cdDepa',
                'c.lbAdre', 'c.lbVill','c.ancienSiret','c.nmSire'
                )
        )
            ->from('CollectiviteBundle:importSiretHistorisation', 'c')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'c.idDepa = d.idDepa')
            ->where('c.blPresent = :blPresent')
            ->andWhere('c.blConfirmed = 0')
            /*->groupBy('c.idColl')*/


            ->setParameter('blPresent', $blPresent)

            ;
        $qb = $this->applyFilters($qb, $filtres);
        return $qb->getQuery()->getArrayResult();
    }


    public function getCollectiviteHistorisationErreur(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.idColl', 'c.lbColl', 'c.idDepa',
                'c.lbAdre', 'c.lbVill','c.ancienSiret','c.nmSire','c.lbErreur'
                //, 'ud.fgDroits'
                    )
                )
            ->distinct(true)
            ->from('CollectiviteBundle:importSiretHistorisation', 'c');


        $qb->where('c.blErreur = 1');
        return $qb->getQuery()->getArrayResult();
    }


    public function getCollectiviteHistorisationMotif($utilisateur, $blArchi, $motif, $admin){
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.lbColl','d.lbDepa', 'd.cdDepa',
                'c.lbAdre', 'c.lbVill','c.ancienSiret','c.nmSire'
                //, 'ud.fgDroits'
                    )
                )
            ->distinct(true)
            ->from('CollectiviteBundle:importSiretHistorisation', 'c')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.cdDepa = c.idDepa')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'cd.departement = d AND cd.fgType = 0')
            ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'uc.cdg = cd.cdg');

        if($admin == 0) {
            $qb->join('UserBundle:UtilisateurDroits', 'ud', 'WITH',
                'cd.idCdgDepartement = ud.cdgDepartement AND CONV(:mask, 2, 10, ud.fgDroits) = :droit AND uc.idUtilisateurCdg = ud.utilisateurCdg');
        }

        $qb->where('c.blErreur = 0');
        if($admin == 0) {
            $qb->andWhere('c.blArchi = :blArchi')
                ->andWhere('c.motif = :motif')
                ->andWhere('uc.utilisateur = :idUtilisateur');

            $qb->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
                ->setParameter('droit', $droit)
                ->setParameter('motif', $motif)
                ->setParameter('blArchi', $blArchi)
                ->setParameter('idUtilisateur', $utilisateur);
        }

        return $qb->getQuery()->getArrayResult();
    }

    public function getCollectiviteHistorisationPossibleFusion($utilisateur,$admin){        
        if($admin){
            $sql = "CALL get_collectivite_gestion_siret()";
            $stmt = $this->_em->getConnection()->prepare($sql);
        }else{
            $id_util = $utilisateur->getIdUtil();
            $sql = "CALL get_collectivite_gestion_siret_cdg(:id_util)";
            $stmt = $this->_em->getConnection()->prepare($sql);
            $stmt->bindParam('id_util', $id_util, \PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function getCollectiviteHistorisationAbsorption($utilisateur, $admin){
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.lbAdre, c.nmSire, c.lbVill, c.lbColl, d.lbDepa, d.cdDepa')
            ->distinct(true)
            ->from('CollectiviteBundle:Collectivite', 'c')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd = c.departement')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'cd.departement = d AND cd.fgType = 0')
            ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'uc.cdg = cd.cdg');

        if($admin == 0) {
            $qb->join('UserBundle:UtilisateurDroits', 'ud', 'WITH',
                'cd.idCdgDepartement = ud.cdgDepartement AND CONV(:mask, 2, 10, ud.fgDroits) = :droit AND uc.idUtilisateurCdg = ud.utilisateurCdg');
        }

        $qb->where('c.blActi = 1');

        if($admin == 0) {
            $qb->andWhere('uc.utilisateur = :idUtilisateur');
        }

        if($admin == 0) {
            $qb->setParameter('mask', DroitsEnum::MASK_READ_WRITE_COLLECTIVITE)
                ->setParameter('droit', $droit);
        }

        if($admin == 0) {
            $qb->setParameter('idUtilisateur', $utilisateur);
        }

        return $qb->getQuery()->getArrayResult();
    }


    public function getCollHistoByNewSiret($siret){
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('c.lbColl','d.lbDepa', 'd.cdDepa',
                'c.lbAdre', 'c.lbVill','c.ancienSiret','c.majSiret')
        )
            ->from('CollectiviteBundle:importSiretHistorisation', 'c')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = c.idDepa')
            ->where('c.blPresent = 0')
            ->andWhere('c.majSiret = :siret')
            ->setParameter('siret', $siret);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
