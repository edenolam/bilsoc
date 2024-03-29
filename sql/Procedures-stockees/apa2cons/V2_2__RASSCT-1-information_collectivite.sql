DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_rassct_information_collectivite
$$

CREATE PROCEDURE apa2cons_rassct_information_collectivite(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare vRASSCT_EXIST_EVAL_RPS tinyint(1);
	declare vRASSCT_MAJ_EVAL_RPS tinyint(1);
	declare vRRASSCT_DIAG_RPS tinyint(1);
	declare vRASSCT_EXIST_PREV_ACTION_SANTE tinyint(1);
	declare vRASSCT_ACTI_MEDEC_PREV tinyint(1);
	declare vRASSCT_DESI_ACFI tinyint(1);
	declare vRASSCT_NB_VISIT_ACFI int(25);
	declare vRASSCT_NB_CT_CHSCT int(25);
	declare vRASSCT_EXIST_PREV_ENTRE_EXTE tinyint(1);
	declare vRASSCT_EXIST_DIAG_PENI_ANNEX tinyint(1);
	declare vRASSCT_NECE_FICHE_SUIVI_FACT tinyint(1);
	declare vRASSCT_EXIST_FICHE_EXPO_PENI tinyint(1);
	declare vRASSCT_NECE_FICHE_AMIANTE tinyint(1);
	declare vRASSCT_EXIST_FICHE_AMIANTE tinyint(1);

	SELECT RASSCT_EXIST_EVAL_RPS,RASSCT_MAJ_EVAL_RPS,RASSCT_DIAG_RPS,RASSCT_EXIST_PREV_ACTION_SANTE,RASSCT_ACTI_MEDEC_PREV,RASSCT_DESI_ACFI,RASSCT_NB_VISIT_ACFI,RASSCT_NB_CT_CHSCT,RASSCT_EXIST_PREV_ENTRE_EXTE,RASSCT_EXIST_DIAG_PENI_ANNEX,RASSCT_NECE_FICHE_SUIVI_FACT,RASSCT_EXIST_FICHE_EXPO_PENI,RASSCT_NECE_FICHE_AMIANTE,RASSCT_EXIST_FICHE_AMIANTE
	INTO vRASSCT_EXIST_EVAL_RPS, vRASSCT_MAJ_EVAL_RPS, vRRASSCT_DIAG_RPS, vRASSCT_EXIST_PREV_ACTION_SANTE, vRASSCT_ACTI_MEDEC_PREV, vRASSCT_DESI_ACFI, vRASSCT_NB_VISIT_ACFI, vRASSCT_NB_CT_CHSCT, vRASSCT_EXIST_PREV_ENTRE_EXTE, vRASSCT_EXIST_DIAG_PENI_ANNEX, vRASSCT_NECE_FICHE_SUIVI_FACT,vRASSCT_EXIST_FICHE_EXPO_PENI,vRASSCT_NECE_FICHE_AMIANTE,vRASSCT_EXIST_FICHE_AMIANTE
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;

	INSERT INTO bsc_rassct_information_collectivite (RASSCT_EXIST_EVAL_RPS,RASSCT_MAJ_EVAL_RPS,RASSCT_DIAG_RPS,RASSCT_EXIST_PREV_ACTION_SANTE,RASSCT_ACTI_MEDEC_PREV,RASSCT_DESI_ACFI,RASSCT_NB_VISIT_ACFI,RASSCT_NB_CT_CHSCT,RASSCT_EXIST_PREV_ENTRE_EXTE,RASSCT_EXIST_DIAG_PENI_ANNEX,RASSCT_NECE_FICHE_SUIVI_FACT,RASSCT_EXIST_FICHE_EXPO_PENI,RASSCT_NECE_FICHE_AMIANTE,RASSCT_EXIST_FICHE_AMIANTE, ID_BILASOCICONS)
	VALUES (vRASSCT_EXIST_EVAL_RPS, vRASSCT_MAJ_EVAL_RPS, vRRASSCT_DIAG_RPS, vRASSCT_EXIST_PREV_ACTION_SANTE, vRASSCT_ACTI_MEDEC_PREV, vRASSCT_DESI_ACFI, vRASSCT_NB_VISIT_ACFI, vRASSCT_NB_CT_CHSCT, vRASSCT_EXIST_PREV_ENTRE_EXTE, vRASSCT_EXIST_DIAG_PENI_ANNEX, vRASSCT_NECE_FICHE_SUIVI_FACT,vRASSCT_EXIST_FICHE_EXPO_PENI,vRASSCT_NECE_FICHE_AMIANTE,vRASSCT_EXIST_FICHE_AMIANTE,idBilaSociCons);
	
        SELECT vRASSCT_EXIST_EVAL_RPS, vRASSCT_MAJ_EVAL_RPS, vRRASSCT_DIAG_RPS, vRASSCT_EXIST_PREV_ACTION_SANTE, vRASSCT_ACTI_MEDEC_PREV, vRASSCT_DESI_ACFI, vRASSCT_NB_VISIT_ACFI, vRASSCT_NB_CT_CHSCT, vRASSCT_EXIST_PREV_ENTRE_EXTE, vRASSCT_EXIST_DIAG_PENI_ANNEX, vRASSCT_NECE_FICHE_SUIVI_FACT,vRASSCT_EXIST_FICHE_EXPO_PENI,vRASSCT_NECE_FICHE_AMIANTE,vRASSCT_EXIST_FICHE_AMIANTE;
		
    IF vRASSCT_EXIST_EVAL_RPS IS NOT NULL OR 
	 vRASSCT_EXIST_EVAL_RPS IS NOT NULL OR 
	 vRASSCT_MAJ_EVAL_RPS IS NOT NULL OR 
	 vRRASSCT_DIAG_RPS IS NOT NULL OR 
	 vRASSCT_EXIST_PREV_ACTION_SANTE IS NOT NULL OR 
	 vRASSCT_ACTI_MEDEC_PREV IS NOT NULL OR 
	 vRASSCT_DESI_ACFI IS NOT NULL OR 
	 vRASSCT_NB_VISIT_ACFI IS NOT NULL OR 
	 vRASSCT_NB_CT_CHSCT IS NOT NULL OR 
	 vRASSCT_EXIST_PREV_ENTRE_EXTE IS NOT NULL OR 
	 vRASSCT_EXIST_DIAG_PENI_ANNEX IS NOT NULL OR 
	 vRASSCT_NECE_FICHE_SUIVI_FACT IS NOT NULL OR 
	 vRASSCT_EXIST_FICHE_EXPO_PENI IS NOT NULL OR 
	 vRASSCT_NECE_FICHE_AMIANTE IS NOT NULL OR 
	 vRASSCT_EXIST_FICHE_AMIANTE IS NOT NULL
	THEN
            UPDATE bilan_social_consolide SET BL_INCO_RASSCT_INFORMATION_COLLECTIVITE = '4', MOYENNE_RASSCT_INFORMATION_COLLECTIVITE = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
    END IF;


END
$$
