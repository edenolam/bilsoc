SELECT *
FROM(
	SELECT COALESCE(SUM(COALESCE(R_3113,0) + COALESCE(R_3114,0) + COALESCE(R_3115,0) + COALESCE(R_3116,0)),0) NB_TYPE, "Fonctionnaires" LB_TYPE, COALESCE(SUM(COALESCE(R_3111,0) + COALESCE(R_3112,0)),0) NB_TOTAL
	FROM ind_311 
	WHERE ID_BILASOCICONS = 1
	UNION
	SELECT COALESCE(SUM(COALESCE(R_3213,0) + COALESCE(R_3214,0)),0) NB_TYPE, "Contractuels sur emploi permanents" LB_TYPE, COALESCE(SUM(COALESCE(R_3211,0) + COALESCE(R_3212,0)),0) NB_TOTAL
	FROM ind_321 
	WHERE ID_BILASOCICONS = 1
	UNION
	SELECT SUM(NB_TYPE) NB_TYPE, "Ensemble" LB_TYPE, SUM(NB_TOTAL) NB_TOTAL
	FROM (
		SELECT COALESCE(SUM(COALESCE(R_3113,0) + COALESCE(R_3114,0) + COALESCE(R_3115,0) + COALESCE(R_3116,0)),0) NB_TYPE, "Fonctionnaires" LB_TYPE, COALESCE(SUM(COALESCE(R_3111,0) + COALESCE(R_3112,0)),0) NB_TOTAL
		FROM ind_311 
		WHERE ID_BILASOCICONS = 1
		UNION
		SELECT COALESCE(SUM(COALESCE(R_3213,0) + COALESCE(R_3214,0)),0) NB_TYPE, "Contractuels sur emploi permanents" LB_TYPE, COALESCE(SUM(COALESCE(R_3211,0) + COALESCE(R_3212,0)),0) NB_TOTAL
		FROM ind_321 
		WHERE ID_BILASOCICONS = 1
	) aggr_remuneration_fonctionnaire_contratuel
) aggr_remuneration_type
#WHERE NB_TYPE > 0 