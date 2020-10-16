SELECT NB_DEPE, LB_DEPE, NM_POURDEPE
FROM(
	SELECT COALESCE(b_s_c.r_3451,0) NB_DEPE, "Budget du fonctionnement" LB_DEPE
	FROM bilan_social_consolide b_s_c
	WHERE ID_BILASOCICONS = 1
	UNION 
	SELECT COALESCE(b_s_c.r_3452,0) NB_DEPE, "Masse salariale" LB_DEPE
	FROM bilan_social_consolide b_s_c
	WHERE ID_BILASOCICONS = 1
) aggr_budget
JOIN (
	SELECT COALESCE(NM_MASSSALA*100/NM_BUDGFONC,0) NM_POURDEPE
	FROM(
		SELECT COALESCE(b_s_c.r_3451,0) NM_BUDGFONC, COALESCE(b_s_c.r_3452,0) NM_MASSSALA
		FROM bilan_social_consolide b_s_c
		WHERE ID_BILASOCICONS = 1
	) aggr_fonc_masse
) aggr_pour