DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind311_331
$$

CREATE PROCEDURE apa2cons_ind311_331(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    declare vQ3110 int(11);
    declare vQ3111 int(11);
    declare vRIFSEEP_CONTRACTUEL int(11);

	SELECT Q3110, Q3111, RIFSEEP_CONTRACTUEL
	INTO vQ3110, vQ3111, vRIFSEEP_CONTRACTUEL
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;

	UPDATE bilan_social_consolide SET Q_3110 = vQ3110, Q_3111 = vQ3111, RIFSEEP_CONTRACTUEL = vRIFSEEP_CONTRACTUEL
	WHERE ID_BILASOCICONS = idBilaSociCons;

     DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind311_321;
     CREATE TEMPORARY TABLE temp_apa2cons_ind311_321 (INDEX(Q1))
           ENGINE = MEMORY
           AS (
             SELECT
                   bsa.CD_SEXE AS Q1,
                   rs.CD_STAT AS Q2,
                   ra.ID_CATE AS Q3bis,
                   ra.ID_FILI AS Q13_1_N,
                   sum(ra.MT_TOTAL_REMUNERATION_BRUTE) AS M_BRUTE,
                   sum(ra.MT_PRIME) AS MT_PRIME,
                   sum(ra.MT_NBI) AS MT_NBI,
                   sum(ra.MT_HC_HS) AS MT_HC_HS,
                   sum(ra.MT_SFT) AS MT_SFT,
                   sum(ra.MT_IR) AS MT_IR
             FROM bilan_social_agent AS bsa			
                   JOIN remuneration_agent AS ra ON ra.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
                   JOIN ref_statut AS rs ON ra.ID_STAT = rs.ID_STAT  # Q2
             WHERE bsa.ID_COLL = idColl
                   AND bsa.ID_ENQU = idEnqu
                   AND rs.CD_STAT IN ('TITU', 'STAG', 'CONTPERM')     # Q2
                   AND ra.ID_CATE IS NOT NULL
                   AND ra.ID_FILI IS NOT NULL
             GROUP BY bsa.CD_SEXE, rs.CD_STAT, ra.ID_CATE, ra.ID_FILI
           );

           ### Remplissage 
           INSERT INTO ind_311 (ID_BILASOCICONS, ID_FILI, ID_CATE, R_3111, R_3112, R_3113, R_3114, R_3115, R_3116, R_3117, R_3118, R_3119, R_31110, R_31111, R_31112)
           SELECT idBilaSociCons, f.ID_FILI, c.ID_CATE,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN t.M_BRUTE ELSE 0 END) AS R_3111,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN t.M_BRUTE ELSE 0 END) AS R_3112,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN t.MT_PRIME ELSE 0 END) AS R_3113,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN t.MT_PRIME ELSE 0 END) AS R_3114,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN t.MT_NBI ELSE 0 END) AS R_3115,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN t.MT_NBI ELSE 0 END) AS R_3116,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN t.MT_HC_HS ELSE 0 END) AS R_3117,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN t.MT_HC_HS ELSE 0 END) AS R_3118,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN t.MT_SFT ELSE 0 END) AS R_3119,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN t.MT_SFT ELSE 0 END) AS R_31110,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN t.MT_IR ELSE 0 END) AS R_31111,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN t.MT_IR ELSE 0 END) AS R_31112
           FROM ref_filiere f
            JOIN ref_categorie c
                   LEFT JOIN temp_apa2cons_ind311_321 t ON t.Q3bis = c.ID_CATE and  t.Q13_1_N = f.ID_FILI
           WHERE f.BL_VALI = 0
           GROUP BY idBilaSociCons, f.ID_FILI, c.ID_CATE
           ORDER BY f.ID_FILI, c.ID_CATE;


           INSERT INTO ind_321 (ID_BILASOCICONS, ID_FILI, ID_CATE, R_3211, R_3212, R_3213, R_3214, R_3215, R_3216)
           SELECT idBilaSociCons, f.ID_FILI, c.ID_CATE,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 = 'CONTPERM' THEN t.M_BRUTE ELSE 0 END) AS R_3211,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 = 'CONTPERM' THEN t.M_BRUTE ELSE 0 END) AS R_3212,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 = 'CONTPERM' THEN t.MT_PRIME ELSE 0 END) AS R_3213,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 = 'CONTPERM' THEN t.MT_PRIME ELSE 0 END) AS R_3214,
                                   SUM(CASE WHEN t.Q1 = 1 AND t.Q2 = 'CONTPERM' THEN t.MT_HC_HS ELSE 0 END) AS R_3215,
                                   SUM(CASE WHEN t.Q1 = 2 AND t.Q2 = 'CONTPERM' THEN t.MT_HC_HS ELSE 0 END) AS R_3216
           FROM ref_filiere f
           JOIN ref_categorie c
                   LEFT JOIN temp_apa2cons_ind311_321 t ON t.Q3bis = c.ID_CATE and  t.Q13_1_N = f.ID_FILI
           WHERE f.BL_VALI = 0
           GROUP BY idBilaSociCons, f.ID_FILI, c.ID_CATE
           ORDER BY f.ID_FILI, c.ID_CATE;


           DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind331;
           CREATE TEMPORARY TABLE temp_apa2cons_ind331 (INDEX(Q1))
           ENGINE = MEMORY
           AS (
             SELECT
                   bsa.CD_SEXE AS Q1,
                   rs.CD_STAT AS Q2,
                   ra.ID_EMPLNONPERM AS Q13,
                   sum(ra.MT_TOTAL_REMUNERATION_BRUTE) AS M_BRUTE
             FROM bilan_social_agent AS bsa
                   JOIN remuneration_agent AS ra ON ra.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
                   JOIN ref_statut AS rs ON ra.ID_STAT = rs.ID_STAT  # Q2
             WHERE bsa.ID_COLL = idColl
                   AND bsa.ID_ENQU = idEnqu
                   AND rs.CD_STAT = 'CONTNONPERM'     # Q2
                   AND ra.ID_EMPLNONPERM IS NOT NULL
             GROUP BY bsa.CD_SEXE, rs.CD_STAT, ra.ID_EMPLNONPERM
           );

           INSERT INTO ind_331 (ID_BILASOCICONS, ID_EMPLNONPERM, R_3311, R_3312)
           SELECT idBilaSociCons, enp.ID_EMPLNONPERM, 
                                   SUM(CASE WHEN t.Q1 = 1 THEN t.M_BRUTE ELSE 0 END) AS R_3311,
                                   SUM(CASE WHEN t.Q1 = 2 THEN t.M_BRUTE ELSE 0 END) AS R_3312
           FROM ref_emploi_non_permanent AS enp
                   LEFT JOIN temp_apa2cons_ind331 t ON t.Q13 = enp.ID_EMPLNONPERM
           WHERE enp.BL_VALI = 0
           GROUP BY idBilaSociCons, enp.ID_EMPLNONPERM
           ORDER BY t.Q13;  #enp.ID_EMPLNONPERM;



END
$$
