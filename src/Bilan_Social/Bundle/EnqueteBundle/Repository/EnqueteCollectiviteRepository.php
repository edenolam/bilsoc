<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Repository;

use Bilan_Social\Bundle\CoreBundle\Repository\AbstractRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;

/**
 * EnqueteCollectivite Repository
 */
class EnqueteCollectiviteRepository extends AbstractRepository {

    /**
     * Get enquete collectivite
     *
     * @param string $idEnqu
     * @param string $idCdg
     * @return array
     */
    public function getEnqueteCollectivite($idEnqu, $utilisateur, array $filtres = null) {
        //get all coll associées à ce cdg
        //joindre table enqueteCollectivite
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('ec.idEnqucoll', 'ec.blBilasoci', 'ec.blRast', 'ec.blHand', 'ec.blGepe', 'ec.blApa', 'ec.blCons', 'ec.blN4ds', 'ec.blBasecarr', 'ec.blDgcl', 'ec.blBilasocivide', 'c.idColl', 'c.lbColl', 'd.lbDepa', 'd.cdDepa', 'c.cdPost', 'c.lbVill', 'c.cdInse', 'c.nmSire', 'c.nmPopuInse', 'c.blSurclasDemo', 'c.nmStratColl', 'c.blAffiColl', 'c.blCtCdg', 'c.blChsct', 'c.blCollDgcl', 'c.cdg_is_authorized_by_collectivity', 'rtc.lbTypeColl'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin($this->_entityName, 'ec', 'WITH', 'c.idColl = ec.collectivite AND ec.enquete = :idEnqu')
                ->join('c.refTypeCollectivite', 'rtc')
                ->where('uc.utilisateur = :utilisateur')
                ->andWhere('c.blActi = 1')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
                ->setParameter('idEnqu', $idEnqu)
                ->setParameter('utilisateur', $utilisateur)
                ->setParameter("droit", $droit);


        try {

            $enqueteColl = $qb->getQuery()->getResult();
        }
        catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enqueteColl;
    }

    public function getEnqueteCollectiviteByCdg($idEnqu, $cdgDepartementIds) {
        //get all coll associées à ce cdg
        //joindre table enqueteCollectivite
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('ec.idEnqucoll', 'ec.blBilasoci', 'ec.blRast', 'ec.blHand', 'ec.blGepe', 'ec.blApa', 'ec.blCons', 'ec.blN4ds', 'ec.blBasecarr', 'ec.blDgcl', 'ec.blBilasocivide', 'c.idColl', 'c.lbColl', 'd.lbDepa', 'd.cdDepa', 'c.cdPost', 'c.lbVill', 'c.cdInse', 'c.nmSire', 'c.nmPopuInse', 'c.blSurclasDemo', 'c.nmStratColl', 'c.blAffiColl', 'c.blCtCdg', 'c.blCollDgcl', 'c.cdg_is_authorized_by_collectivity', 'rtc.lbTypeColl'))
                ->from('UserBundle:UtilisateurDroits', 'ud')
                ->join('UserBundle:UtilisateurCdg', 'uc', 'WITH', 'ud.utilisateurCdg = uc.idUtilisateurCdg')
                ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'ud.cdgDepartement = cd.idCdgDepartement')
                ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
                ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
                ->leftJoin($this->_entityName, 'ec', 'WITH', 'c.idColl = ec.collectivite AND ec.enquete = :idEnqu')
                ->join('c.refTypeCollectivite', 'rtc')
                ->where('cd.idCdgDepartement IN (:ids)')
                ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) = :droit') //CONV(:mask,2,10)
                ->setParameter('mask', DroitsEnum::MASK_READ_COLLECTIVITE)
                ->setParameter('idEnqu', $idEnqu)
                ->setParameter('ids', $cdgDepartementIds)
                ->setParameter("droit", $droit);
        try {
            $enqueteCollCdg = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enqueteCollCdg;
    }

    public function getEnqueteCollectiviteActive($idColl, $currentCampagne, $enquete = null) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ec')
                ->from($this->_entityName, 'ec')
                ->join('ec.enquete', 'e')
                ->addSelect('e')
                ->join('ec.collectivite', 'c')
                ->addSelect('c')
                ->where('c.idColl = :collect')
                ->andWhere('e.idCamp = :currentCampagne')
                ->andWhere('e.idEnqu = :enquete')
                ->setParameter('collect', $idColl)
                ->setParameter('enquete', $enquete)
                ->andWhere('e.dtClot is null')
                ->andWhere('e.fgStat = :ouvert')
                ->setParameter('ouvert', '1')
                ->setParameter('currentCampagne', $currentCampagne);

        try {
            $enqueteColl = $qb->getQuery()->getOneOrNullResult();
        } catch (NoResultException $e) {
            // Pas de enquete active consolidé pour la collectivite
            $enqueteColl = null;
        }

        return $enqueteColl;
    }

    public function getEnqueteCollectiviteParameter($idColl) {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('ec')
                ->from($this->_entityName, 'ec')
                ->where('ec.collectivite = :idColl')
                ->setParameter('idColl', $idColl);

        try {
            $enqueteCollParameter = $qb->getQuery()->getOneOrNullResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $enqueteCollParameter;
    }

    public function getSuiviCollectivite($idEnqu, $utilisateur, array $filtres = null) {
        $droit_write = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $droit_read = bindec(DroitsEnum::MASK_READ_ENQUETE);
        $droit = array($droit_read,$droit_write);
        $qb = $this->_em->createQueryBuilder();
        $qb_analyse = $this->_em->createQueryBuilder();
        $qb_analyse->select('mda_coll.idColl')
            ->from('CollectiviteBundle:Collectivite','coll')
            ->join('coll.modeleAnalyse', 'mda_coll')
            ->where('coll.idColl = c.idColl');
        // ,'CASE WHEN mda.collectivites IS NULL THEN 0 ELSE 1'
        $qb->select(
            array('enq.fgStat AS fgStat, e.idEnqu', 'ec.idEnqucoll', 'ec.blBilasoci','ec.blGpeecPlus','cc.lbNom', 'cc.lbTele', 'ec.blRast', 'ec.blHand', 'ec.blGepe', 'ec.blApa', 'ec.blCons', 'ec.blN4ds',
                    'ec.blBasecarr', 'ec.blDgcl', 'ec.blBilasocivide', 'c.idColl', 'c.lbColl', 'i.blApa AS initApa', 'i.blCons AS initCons', 'd.idDepa', 'd.lbDepa', 'd.cdDepa', 'c.cdPost', 'c.lbVill',
                    'c.cdInse', 'c.nmSire', 'c.nmPopuInse', 'c.lbAdre', 'c.blSurclasDemo', 'c.nmStratColl', 'c.blAffiColl', 'c.blCtCdg', 'c.blChsct', 'c.blCollDgcl',
                    'c.cdg_is_authorized_by_collectivity', 'rtc.lbTypeColl', 'u.dtLastconn', 'c.cdg_is_authorized_by_collectivity', 'u.idUtil', 
                    'b.nbAgentEmploiPermanent as NbAgenPerm', 'b.nbAgentTitulaire as NbAgenTitu', 'b.nbAgentContractuelEmploiNonPermament as NbAgenContNonPerm', 
                    'b.nbAgentContractuelEmploiPermanent as NbAgenContPerm', 'cc.lbMail as email',
                    'cr.dtDernrela as lastRelance', "i.initSource", 'rc.libelle as courtier',
                "SUM((
                        COALESCE(b.moyenneHanditorialQuestionsGenerales,0) + 
                        COALESCE(b.moyenneHanditorialQuestionsBoeths,0) + 
                        COALESCE(b.moyenneHanditorialCadreEmplois,0) + 
                        COALESCE(b.moyenneHanditorialMetiers,0) + 
                        COALESCE(b.moyenneHanditorialTempsComplets,0)) / 5) as nb_pc_hand",
                    "SUM((
                        COALESCE(b.moyenneGpeecNbAgentsTituEmpPermaParFoncEtAge,0) + 
                        COALESCE(CASE WHEN ec.blGpeecPlus = 1 THEN b.moyenneGpeecPlusNbAgentsParSpeEtAge ELSE 0 END, 0) + 
                        COALESCE(b.moyenneGpeecNiveauDiplome,0)
                        ) / CASE WHEN ec.blGpeecPlus = 1 THEN 3 ELSE 2 END as nb_pc_gpeec",
                    "SUM((
                        COALESCE(b.moyenneRassctAccidentTravail,0) + 
                        COALESCE(b.moyenneRassctPrevisionFormationSanteTravail,0) + 
                        COALESCE(b.moyenneRassctAutresMesures,0) +
                        COALESCE(b.moyenneRassctRealisationFormationSanteTravail,0) +
                        COALESCE(b.moyenneRassctPredictionsAutresMesures,0) + 
                        COALESCE(b.moyenneRassctNbAccidentTravail,0) + 
                        COALESCE(b.moyenneRassctNatureLesion,0) + 
                        COALESCE(b.moyenneRassctSiegeLesion,0) + 
                        COALESCE(b.moyenneRassctElementMateriel,0) + 
                        COALESCE(b.moyenneRassctMaladieProCaracPro,0) 
                        ) / 10) as nb_pc_rassct",
                    "SUM((
                       COALESCE(b.moyenneInd110,0) + 
                        COALESCE(b.moyenneInd714,0) + 
                        COALESCE(b.moyenneInd713,0) +
                        COALESCE(b.moyenneInd712,0) +
                        COALESCE(b.moyenneInd614,0) + 
                        COALESCE(b.moyenneInd711,0) + 
                        COALESCE(b.moyenneInd613,0) + 
                        COALESCE(b.moyenneInd612,0) + 
                        COALESCE(CASE WHEN (c.refTypeCollectivite = 18) OR (c.blCtCdg<> 1 AND ((ec.blBilasoci = 0  AND ec.blRast = 1) OR ec.blBilasoci = 1)) THEN b.moyenneInd611 ELSE 0 END, 0) +
                        COALESCE(b.moyenneInd514,0) + 
                        COALESCE(b.moyenneInd513,0) +
                        COALESCE(b.moyenneInd512,0) +
                        COALESCE(b.moyenneInd5113,0) +
                        COALESCE(b.moyenneInd5112,0) +
                        COALESCE(b.moyenneInd5111,0) +
                        COALESCE(b.moyenneInd344,0) +
                        COALESCE(b.moyenneInd343,0) +
                        COALESCE(b.moyenneInd342,0) +
                        COALESCE(b.moyenneInd341,0) +
                        COALESCE(b.moyenneInd331,0) +
                        COALESCE(b.moyenneInd321,0) +
                        COALESCE(b.moyenneInd311,0) +
                        COALESCE(b.moyenneInd431,0) +
                        COALESCE(b.moyenneInd424,0) +
                        COALESCE(b.moyenneInd423,0) +
                        COALESCE(b.moyenneInd422,0) +
                        COALESCE(b.moyenneInd421,0) +
                        COALESCE(b.moyenneInd414,0) +
                        COALESCE(b.moyenneInd413,0) +
                        COALESCE(b.moyenneInd411,0) +
                        COALESCE(b.moyenneInd231,0) +
                        COALESCE(b.moyenneInd225,0) +
                        COALESCE(b.moyenneInd224,0) +
                        COALESCE(b.moyenneInd223,0) +
                        COALESCE(b.moyenneInd222,0) +
                        COALESCE(b.moyenneInd221,0) +
                        COALESCE(b.moyenneInd215,0) +
                        COALESCE(b.moyenneInd214,0) +
                        COALESCE(b.moyenneInd213,0) +
                        COALESCE(b.moyenneInd212,0) +
                        COALESCE(b.moyenneInd211,0) +
                        COALESCE(b.moyenneInd210,0) +
                        COALESCE(b.moyenneInd171,0) +
                        COALESCE(b.moyenneInd162,0) +
                        COALESCE(b.moyenneInd161,0) +
                        COALESCE(b.moyenneInd158,0) +
                        COALESCE(b.moyenneInd154,0) +
                        COALESCE(b.moyenneInd1532,0) +
                        COALESCE(b.moyenneInd1531,0) +
                        COALESCE(b.moyenneInd152,0) +
                        COALESCE(b.moyenneInd151,0) +
                        COALESCE(b.moyenneInd150,0) +
                        COALESCE(b.moyenneInd140,0) +
                        COALESCE(b.moyenneInd132,0) +
                        COALESCE(b.moyenneInd131,0) +
                        COALESCE(b.moyenneInd124,0) +
                        COALESCE(b.moyenneInd123,0) +
                        COALESCE(b.moyenneInd122,0) +
                        COALESCE(b.moyenneInd121,0) +
                        COALESCE(b.moyenneInd114,0) +
                        COALESCE(b.moyenneInd113,0) +
                        COALESCE(b.moyenneInd112,0) +
                        COALESCE(b.moyenneInd111,0)
                        ) / CASE WHEN (c.refTypeCollectivite = 18) OR (c.blCtCdg<> 1 AND ((ec.blBilasoci = 0  AND ec.blRast = 1) OR ec.blBilasoci = 1)) THEN 63 ELSE 62 END as nb_pc_bsc"
                        ), 'ud.dtLastconn'
        )
            //   COALESCE(b.moyenneRassctInformationCollectivite,0) +
            ->addSelect('(SELECT MAX(mda_coll.idModeleAnalyse) 
                FROM CollectiviteBundle:Collectivite coll 
                JOIN coll.modeleAnalyse mda_coll 
                JOIN mda_coll.campagne camp
                
                WHERE coll.idColl = c.idColl
                GROUP BY coll.idColl)  as mdaId ')
            /*JOIN (
                    SELECT MAX(eq.ID_ENQU) AS maxEq
                    FROM EnqueteBundle:EnqueteCollectivite eq
                    WHERE c.idColl = eq.idColl
                ) eqc 
                JOIN EnqueteBundle:EnqueteCollectivite ec
                ON eqc.maxEq = ec.idEnqu AND ec.idColl = coll.idColl*/
            //->addSelect('(SELECT 1 FROM CollectiviteBundle:Collectivite)  as mdaId ')
            ->from('UserBundle:UtilisateurCdg', 'uc')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'uc.cdg = cd.cdg ')//AND cd.fgType = 0
            ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement')
            //->join('uc.cdg','cdg')
            //->leftJoin('cdg.modeleAnalyse','mda')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CampagneBundle:Campagne', 'ca', 'WITH', 'ca.fgStat = 1')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
            //->leftJoin('mda.collectivites','mda_coll','WITH', 'mda_coll.idColl = c.idColl ')
            ->join('c.refTypeCollectivite', 'rtc', 'WITH', 'c.refTypeCollectivite = rtc.idTypeColl')
            ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
            ->join('EnqueteBundle:Enquete', 'e', 'WITH', 'd MEMBER OF e.departements AND e.idCamp = ca.idCamp')
            ->join('EnqueteBundle:EnqueteCollectivite', 'ec', 'WITH', 'c.idColl = ec.collectivite AND e.idEnqu =  ec.enquete ')
            ->leftJoin('BilanSocialBundle:InitBilanSocial', 'i', 'WITH', 'i.collectivite = c.idColl AND e.idEnqu IN(:enquete) AND i.idInitBs = (SELECT MAX(i2.idInitBs) FROM BilanSocialBundle:InitBilanSocial as i2 WHERE i2.collectivite = c.idColl AND i2.enquete IN(:enquete) AND i.enquete = ec.enquete)')
            ->leftJoin('CollectiviteBundle:CollectiviteContact', 'cc', 'WITH', 'cc.idCollCont = (SELECT MAX(cc2.idCollCont) FROM CollectiviteBundle:CollectiviteContact as cc2 WHERE cc2.collectivite = c.idColl)')
                ->leftJoin('ConsoBundle:BilanSocialConsolide', 'b', 'WITH', 'b.collectivite = c.idColl AND e.idEnqu =  b.enquete')
            ->leftJoin('BilanSocialBundle:HistoriqueBilanSocial', 'enq', 'WITH', 'enq.collectivite = c.idColl AND enq.enquete IN(:enquete) AND enq.dtChgt = (SELECT MAX(enq2.dtChgt) FROM BilanSocialBundle:HistoriqueBilanSocial as enq2 WHERE enq2.collectivite = c.idColl AND enq2.enquete IN(:enquete))')
            ->leftJoin('CampagneBundle:Relance', 'cr', 'WITH', 'cr.collectivite = c.idColl AND cr.enquete IN(:enquete) AND cr.dtDernrela = (SELECT MAX(cr2.dtDernrela) FROM CampagneBundle:Relance as cr2 WHERE cr2.collectivite = c.idColl AND cr2.enquete IN(:enquete))')
            ->leftJoin('ReferencielBundle:RefCourtier','rc', 'WITH', 'c.refCourtier = rc.id')
            ->where('uc.utilisateur = :idUtilisateur')
            ->andWhere('e.idEnqu IN( :enquete )')
            ->andWhere('c.blActi = 1')
            ->andWhere('CONV(:mask, 2, 10, ud.fgDroits) IN(:droit)')
            ->andWhere('uc.idUtilisateurCdg = ud.utilisateurCdg')
            ->groupBy('c.idColl')
            ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
            ->setParameter('droit', $droit)
            ->setParameter('enquete', $idEnqu)
            ->setParameter('idUtilisateur', $utilisateur)
        ;

        $qb = $this->applyFilters($qb, $filtres);
        //$qb->groupBy('c.idColl');
        try {

            $suiviCollectivite = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }
        return $suiviCollectivite;
    }

    /**
     * Get enquete collectivite
     *
     * @param string $idEnqu
     * @param string $idCdg
     * @return array
     */
    public function getEnqueteCollectiviteModifier($enquete, $utilisateur, array $filtres = null) {
        //get all coll associées à ce cdg
        //joindre table enqueteCollectivite
        $droit = bindec(DroitsEnum::MASK_READ_WRITE_ENQUETE);
        $qb = $this->_em->createQueryBuilder();
        $qb->select( array(
                'ec.idEnqucoll', 'ec.blBilasoci', 'ec.blRast', 'ec.blHand', 'ec.blGepe', 'ec.blGpeecPlus', 'ec.blApa', 'ec.blCons',
                    'ec.blN4ds', 'ec.blBasecarr', 'ec.blDgcl', 'ec.blBilasocivide', 'c.idColl', 'c.lbColl', 'd.lbDepa', 'd.cdDepa',
                    'c.cdPost', 'c.lbVill', 'c.cdInse', 'c.nmSire', 'c.lbAdre', 'c.nmPopuInse', 'c.blSurclasDemo', 'c.nmStratColl', 'c.blAffiColl',
                    'c.blCtCdg', 'c.blChsct', 'c.blCollDgcl', 'c.cdg_is_authorized_by_collectivity', 'rtc.lbTypeColl','b.nbAgentEmploiPermanent as NbAgenPerm', 'b.nbAgentTitulaire as NbAgenTitu', 'b.nbAgentContractuelEmploiNonPermament as NbAgenContNonPerm', 
                    'b.nbAgentContractuelEmploiPermanent as NbAgenContPerm','rc.libelle as courtier')
        )
            ->from('UserBundle:UtilisateurCdg', 'uc')
            ->join('CollectiviteBundle:CdgDepartement', 'cd', 'WITH', 'uc.cdg = cd.cdg AND cd.fgType = 0')
            ->join('UserBundle:UtilisateurDroits', 'ud', 'WITH', 'cd.idCdgDepartement = ud.cdgDepartement AND CONV(:mask, 2, 10, ud.fgDroits) = :droit AND uc.idUtilisateurCdg = ud.utilisateurCdg')
            ->join('CollectiviteBundle:Departement', 'd', 'WITH', 'd.idDepa = cd.departement')
            ->join('CampagneBundle:Campagne', 'ca', 'WITH', 'ca.fgStat = 1')
            ->join('CollectiviteBundle:Collectivite', 'c', 'WITH', 'c.departement = d.idDepa')
            ->join('c.refTypeCollectivite', 'rtc', 'WITH', 'c.refTypeCollectivite = rtc.idTypeColl')
            ->join('UserBundle:User', 'u', 'WITH', 'u.collectivite = c.idColl')
            ->join('EnqueteBundle:Enquete', 'e', 'WITH', 'd MEMBER OF e.departements AND e.idCamp = ca.idCamp')

            ->join('EnqueteBundle:EnqueteCollectivite', 'ec', 'WITH', 'c.idColl = ec.collectivite AND e.idEnqu =  ec.enquete ')
            ->leftJoin('ConsoBundle:BilanSocialConsolide', 'b', 'WITH', 'b.collectivite = c.idColl AND e.idEnqu =  b.enquete')
            ->leftJoin('ReferencielBundle:RefCourtier','rc', 'WITH', 'c.refCourtier = rc.id')
            ->where('uc.utilisateur = :idUtilisateur')
            ->andWhere('e.idEnqu = :enquete')
            ->andWhere('c.blActi = 1');
        $qb = $this->applyFilters($qb, $filtres)
            ->setParameter('mask', DroitsEnum::MASK_READ_WRITE_ENQUETE)
            ->setParameter('droit', $droit)
            ->setParameter('enquete', $enquete)
            ->setParameter('idUtilisateur', $utilisateur);
        try {
            $enqueteColl = $qb->getQuery()->getScalarResult();
           

        }
        catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            return null;
        }

        return $enqueteColl;
    }

    public function findHasParamCollectiviteEnqueteLancee($collectivite, $enquete) {
        $qb = $this->_em->createQueryBuilder();
        $qb->Select("ec")
                ->from($this->_entityName, 'ec')
                ->where('ec.collectivite = :collectivite')
                ->andWhere('ec.enquete = :enquete')
                ->setParameter('collectivite', $collectivite)
                ->setParameter('enquete', $enquete);

        try {
            $enquetes = $qb->getQuery()->getOneOrNullResult();
            //error_log('test1',0);
        } catch (NoResultException $e) {
            // Pas de bilan pour cette enquete et coll
            //error_log('test2',0);
            return null;
        } catch (NonUniqueResultException $e) {
            // Pas de bilan pour cette enquete et coll
            //error_log('test2',0);
            return null;

        }
        return $enquetes;
    }
}
