DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind421
$$

CREATE PROCEDURE apa2cons_ind421(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	  declare vAnnee int(11);
	  declare vDate DATETIME;
	  declare vQ421  int(11);
	  
	  select ca.nm_anne into vAnnee 
	  from campagne ca 
	  join enquete e on e.id_camp = ca.id_camp
	  where e.id_enqu = idEnqu;
	  
	  SET vDate = CONVERT (CONCAT(vAnnee, '-12-31'), DATETIME);

	  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind421;
  CREATE TEMPORARY TABLE temp_apa2cons_ind421 (INDEX(Q2_8))   
    ENGINE = MEMORY
    AS (	
      SELECT
        bsa.ID_CADREMPL AS Q2_8,
		COALESCE(bsa.CD_SEXE, '-1') AS Q1,
		ma.CD_MOTIABSE as CD_MOTIABSE,									
		sum((CASE WHEN COALESCE(aaa.ANNEE_EVENEMENT, 0) = vAnnee  THEN COALESCE(aaa.NB_ARRE, 1) ELSE 0 END)) AS NB_ARRE,
		sum((CASE WHEN COALESCE(aaa.ACCIDENT_AVEC_ARRET, 0) = 0 and COALESCE(aaa.ANNEE_EVENEMENT, 0) = vAnnee  THEN COALESCE(aaa.NB_ARRE, 1) ELSE 0 END)) AS NB_ARRE_SANS,
		sum(COALESCE(aaa.NB_JOURABSE, 0)) AS NB_JOURABSE		
      FROM bilan_social_agent AS bsa        
		JOIN absence_arret_agent AS aaa ON aaa.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN		
        JOIN ref_motif_absence AS ma ON aaa.ID_MOTIABSE = ma.ID_MOTIABSE		
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu		
		AND bsa.ID_CADREMPL is not null
		AND ma.CD_MOTIABSE in ('ABS003','ABS004')
	  GROUP BY Q1, Q2_8, ma.CD_MOTIABSE
    );
		
	SELECT count(*) INTO vQ421
	FROM temp_apa2cons_ind421;
	
	if vQ421 > 0 then
	
		  SET vQ421 = 1;
	
		  UPDATE bilan_social_consolide set Q_421 = vQ421
		  where ID_BILASOCICONS = idBilaSociCons;
	
		  ### Remplissage
		  INSERT INTO ind_421 (ID_BILASOCICONS, ID_CADREMPL, R_4211, R_4212, R_4213, R_4214, R_4215, R_4216, R_4217, R_4218, R_4219, R_42110, R_42111, R_42112)
		  SELECT idBilaSociCons, ce.ID_CADREMPL,
			SUM(CASE WHEN t.Q1 = 1 AND  t.CD_MOTIABSE = 'ABS003' THEN t.NB_ARRE ELSE 0 END) AS R_4211,
			SUM(CASE WHEN t.Q1 = 2 AND  t.CD_MOTIABSE = 'ABS003' THEN t.NB_ARRE ELSE 0 END) AS R_4212,
			SUM(CASE WHEN t.Q1 = 1 AND  t.CD_MOTIABSE = 'ABS003' THEN t.NB_ARRE_SANS ELSE 0 END) AS R_4213, 
			SUM(CASE WHEN t.Q1 = 2 AND  t.CD_MOTIABSE = 'ABS003' THEN t.NB_ARRE_SANS ELSE 0 END) AS R_4214, 
			SUM(CASE WHEN t.Q1 = 1 AND  t.CD_MOTIABSE = 'ABS004' THEN t.NB_ARRE ELSE 0 END) AS R_4215,
			SUM(CASE WHEN t.Q1 = 2 AND  t.CD_MOTIABSE = 'ABS004' THEN t.NB_ARRE ELSE 0 END) AS R_4216,
			SUM(CASE WHEN t.Q1 = 1 AND  t.CD_MOTIABSE = 'ABS004' THEN t.NB_ARRE_SANS ELSE 0 END) AS R_4217, 
			SUM(CASE WHEN t.Q1 = 2 AND  t.CD_MOTIABSE = 'ABS004' THEN t.NB_ARRE_SANS ELSE 0 END) AS R_4218, 
			SUM(CASE WHEN t.Q1 = 1 AND  t.CD_MOTIABSE = 'ABS003' THEN t.NB_JOURABSE ELSE 0 END) AS R_4219,
			SUM(CASE WHEN t.Q1 = 2 AND  t.CD_MOTIABSE = 'ABS003' THEN t.NB_JOURABSE ELSE 0 END) AS R_42110,
			SUM(CASE WHEN t.Q1 = 1 AND  t.CD_MOTIABSE = 'ABS004' THEN t.NB_JOURABSE ELSE 0 END) AS R_42111,
			SUM(CASE WHEN t.Q1 = 2 AND  t.CD_MOTIABSE = 'ABS004' THEN t.NB_JOURABSE ELSE 0 END) AS R_42112
		  FROM ref_cadre_emploi ce 
		  LEFT JOIN temp_apa2cons_ind421 t ON t.Q2_8 = ce.ID_CADREMPL
		  WHERE ce.BL_VALI = 0
		  GROUP BY idBilaSociCons, ce.ID_CADREMPL
		  ORDER BY ce.ID_CADREMPL;
	else 
                SET vQ421 = 0;
		UPDATE bilan_social_consolide set Q_421 = vQ421
		where ID_BILASOCICONS = idBilaSociCons;	  
	end if;
  
END
$$
