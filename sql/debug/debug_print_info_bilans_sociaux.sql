/*
*	script résumant les informations relatives aux bilans sociaux et leurs initialisations
*/

SELECT * FROM
(
	SELECT c.LB_COLL, c.ID_COLL, c.NM_SIRE, e.ID_ENQU, COUNT(e.ID_ENQU) AS nb_enqu_active,
	ibs.INIT_SOURCE,
	 IF(ibs.BL_APA  IS NOT NULL AND ibs.BL_APA=1, 'oui', 'non') AS has_apa_in_init,
	 IF(bsa.ID_BILASOCIAGEN IS NOT NULL, COUNT(1), 'non') AS agents,
	 ibs.BL_CONS,
	 IF(ibs.BL_CONS IS NOT NULL AND ibs.BL_CONS=1, 'oui', 'non') AS has_conso_in_init,
	 IF(qcc.ID_QUESCOLLCONS IS NOT NULL, 'oui', 'non') AS has_quest_coll_cons_in_base,
	 IF(bsc.ID_BILASOCICONS IS NOT NULL, 'oui', 'non') AS has_bilan_soci_cons
	FROM collectivite c 
	JOIN enquete_collectivite ec ON ec.ID_COLL = c.ID_COLL
	JOIN enquete e ON e.ID_ENQU = ec.ID_ENQU
	JOIN init_bilan_social ibs ON ibs.ID_COLL = c.ID_COLL AND ibs.ID_ENQU = e.ID_ENQU
	LEFT JOIN question_collectivite_consolide qcc ON qcc.ID_COLL = c.ID_COLL AND qcc.ID_ENQU = e.ID_ENQU
	LEFT JOIN bilan_social_consolide bsc ON bsc.ID_COLL = c.ID_COLL AND bsc.ID_ENQU = e.ID_ENQU
	LEFT JOIN bilan_social_agent bsa ON bsa.ID_COLL = c.ID_COLL AND bsa.ID_ENQU = e.ID_ENQU
	WHERE e.FG_STAT = 1# AND has_quest_coll_cons_in_base = 'non' #AND 'has quest coll cons in base' =' oui'
	GROUP BY c.ID_COLL, e.ID_ENQU
) AS info
WHERE has_conso_in_init = 'non' AND (has_bilan_soci_cons = 'oui' OR has_quest_coll_cons_in_base = 'oui')# AND NM_SIRE = 21540214000010