DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind121
$$

CREATE PROCEDURE apa2cons_ind121(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	  declare vAnnee int(11);
	  declare vDate DATETIME;
	  
	  select ca.nm_anne into vAnnee 
	  from campagne ca 
	  join enquete e on e.id_camp = ca.id_camp
	  where e.id_enqu = idEnqu;
	  
	  SET vDate = CONVERT (CONCAT(vAnnee, '-12-31'), DATETIME);
	  
	  
	  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind121;
  CREATE TEMPORARY TABLE temp_apa2cons_ind121 (INDEX(Q2_8))   
    ENGINE = MEMORY
    AS (
	
      SELECT
        bsa.ID_CADREMPL AS Q2_8,
		COALESCE(bsa.CD_SEXE, '-1') AS Q1,
		COALESCE(bsa.BL_CDI, -1) AS Q2_1,
		COALESCE(bsa.BL_TEMPCOMP, -1) AS Q11_1,		
		CASE WHEN bsa.dt_arristat is null THEN -1 ELSE TIMESTAMPDIFF(DAY, bsa.dt_arristat, vDate)  / 365.25  END AS NB_DIFF,			
        COALESCE(rtc.CD_TYPECDD, '-1') AS Q2ter   
      FROM bilan_social_agent AS bsa
        LEFT OUTER JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
        LEFT OUTER JOIN ref_Type_Cdd AS rtc ON bsa.ID_TYPECDD = rtc.ID_TYPECDD		
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu		
        AND bsa.BL_AGENREMU3112 = 1   # Q4.1
        AND rs.CD_STAT IN ('CONTPERM')  # Q2  
		AND bsa.ID_CADREMPL is not null
    );

  ### Remplissage de 1.2.1
  INSERT INTO ind_121 (ID_BILASOCICONS, ID_CADREMPL, R_1211, R_1212, R_1213, R_1214, R_1215, R_1216, R_1217, R_1218, R_12118, R_1219, R_12110, R_12111, R_12112, R_12113, R_12114, R_12115, R_12116, R_12117)
  SELECT idBilaSociCons, ce.ID_CADREMPL,
	SUM(CASE WHEN t.Q2ter = 'CDD001' THEN 1 ELSE 0 END) AS R_1211,
	SUM(CASE WHEN t.Q2ter = 'CDD002' THEN 1 ELSE 0 END) AS R_1212,
	SUM(CASE WHEN t.Q2ter = 'CDD003' THEN 1 ELSE 0 END) AS R_1213,
	SUM(CASE WHEN t.Q2ter = 'CDD004' THEN 1 ELSE 0 END) AS R_1214,
	SUM(CASE WHEN t.Q2ter = 'CDD005' THEN 1 ELSE 0 END) AS R_1215,
	SUM(CASE WHEN t.Q2ter = 'CDD006' THEN 1 ELSE 0 END) AS R_1216,
	SUM(CASE WHEN t.Q2ter = 'CDD007' THEN 1 ELSE 0 END) AS R_1217,
	SUM(CASE WHEN t.Q2ter = 'CDD008' THEN 1 ELSE 0 END) AS R_1218,
	SUM(CASE WHEN t.Q2_1 = 1  THEN 1 ELSE 0 END) AS R_12118,
	SUM(CASE WHEN t.Q11_1 = 1  THEN 1 ELSE 0 END) AS R_1219,
	SUM(CASE WHEN t.Q11_1 = 0  THEN 1 ELSE 0 END) AS R_12110,
	SUM(CASE WHEN t.NB_DIFF < 3 AND  t.NB_DIFF >= 0  THEN 1 ELSE 0 END) AS R_12111,
	SUM(CASE WHEN t.NB_DIFF < 6 AND  t.NB_DIFF >= 3  THEN 1 ELSE 0 END) AS R_12112,
	SUM(CASE WHEN t.NB_DIFF >= 6  THEN 1 ELSE 0 END) AS R_12113,
	SUM(CASE WHEN t.Q1 = 1 AND t.Q2_1 = 1 THEN 1 ELSE 0 END) AS R_12114,
	SUM(CASE WHEN t.Q1 = 2 AND t.Q2_1 = 1 THEN 1 ELSE 0 END) AS R_12115,
	SUM(CASE WHEN t.Q1 = 1 AND t.Q2_1 = 0 THEN 1 ELSE 0 END) AS R_12116,
	SUM(CASE WHEN t.Q1 = 2 AND t.Q2_1 = 0 THEN 1 ELSE 0 END) AS R_12117
  FROM ref_cadre_emploi ce 
  LEFT JOIN temp_apa2cons_ind121 t ON t.Q2_8 = ce.ID_CADREMPL
  WHERE ce.BL_VALI = 0
  GROUP BY idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;
  
END
$$
