DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind1532
$$

CREATE PROCEDURE apa2cons_ind1532(idBilaSociCons INT, idColl INT, idEnqu INT)
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
	  
	  SET vDate = CONVERT (CONCAT(vAnnee, '-01-01'), DATETIME);

	  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1532;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1532 (INDEX(Q2_8))
    ENGINE = MEMORY
    AS (
      SELECT
        bsa.ID_CADREMPL AS Q2_8,
        bsa.CD_SEXE AS Q1,
        bsa.BL_TEMPCOMP AS Q11_1
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2        
		LEFT JOIN ref_mouvement_interne_annee mia ON mia.ID_MOUVINTEANNE = bsa.ID_MOUVINTEANNE
		LEFT JOIN ref_Type_Cdd tc ON tc.ID_TYPECDD = bsa.ID_TYPECDD
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu        
        AND rs.CD_STAT IN ('CONTPERM')  # Q2
		AND (bsa.ID_TYPECDD is null OR tc.CD_TYPECDD != 'CDD001')   # Q2ter
		AND bsa.BL_AGENARRIANNECOLL = 1  #Q5.1
		AND (bsa.DT_ARRISTAT is not null and  bsa.DT_ARRISTAT  >= vDate )
		AND (bsa.ID_MOUVINTEANNE is null OR mia.CD_MOUVINTEANNE = 'MI001' ) # Q5.3
        AND bsa.ID_CADREMPL IS NOT NULL
    );

  ### Remplissage de 1.5.2 
  INSERT INTO ind_1532 (ID_BILASOCICONS, ID_CADREMPL, R_15321, R_15322, R_15323, R_15324)
  SELECT idBilaSociCons, ce.ID_CADREMPL,
    SUM(CASE WHEN t.Q11_1 = 1 AND t.Q1 = 1 THEN 1 ELSE 0 END) AS R_15321,
	SUM(CASE WHEN t.Q11_1 = 1 AND t.Q1 = 2 THEN 1 ELSE 0 END) AS R_15322,
	SUM(CASE WHEN t.Q11_1 = 0 AND t.Q1 = 1 THEN 1 ELSE 0 END) AS R_15323,
	SUM(CASE WHEN t.Q11_1 = 0 AND t.Q1 = 2 THEN 1 ELSE 0 END) AS R_15324	
  FROM ref_cadre_emploi ce
  LEFT JOIN temp_apa2cons_ind1532 t on t.Q2_8 = ce.ID_CADREMPL
  WHERE ce.bl_vali = 0
  GROUP BY idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;
  
END
$$
