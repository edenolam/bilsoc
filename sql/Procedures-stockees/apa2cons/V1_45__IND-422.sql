DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind422
$$

CREATE PROCEDURE apa2cons_ind422(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	  declare vAnnee int(11);
	  declare vAnneeMoins1 int(11);
	  declare vDate DATETIME;
	  declare vQ422  int(11);
	  
	  select ca.nm_anne into vAnnee 
	  from campagne ca 
	  join enquete e on e.id_camp = ca.id_camp
	  where e.id_enqu = idEnqu;
	  
	  SET vAnneeMoins1 = vAnnee - 1;
	  
	  SET vDate = CONVERT (CONCAT(vAnnee, '-12-31'), DATETIME);
	  
	  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind422;
  CREATE TEMPORARY TABLE temp_apa2cons_ind422 (INDEX(Q2_8))   
    ENGINE = MEMORY
    AS (	
      SELECT
        bsa.ID_CADREMPL AS Q2_8, 
		COALESCE(bsa.CD_SEXE, '-1') AS Q1,
		COUNT(*) AS NB,	
		aaa.ANNEE_EVENEMENT AS AN_EV,		
		sum(COALESCE(aaa.NB_JOURABSE, 0)) AS NB_JOURABSE 
      FROM bilan_social_agent AS bsa        
		JOIN absence_arret_agent AS aaa ON aaa.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN		
        JOIN ref_motif_absence AS ma ON aaa.ID_MOTIABSE = ma.ID_MOTIABSE		
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu		
		AND bsa.ID_CADREMPL is not null
		AND ma.CD_MOTIABSE in ('ABS005')   # maladie prof
		AND aaa.ANNEE_EVENEMENT is not null
	  GROUP BY Q1, Q2_8, aaa.ANNEE_EVENEMENT
    );
	
	SELECT count(*) INTO vQ422
	FROM temp_apa2cons_ind422;
	
	if vQ422 > 0 then
	
		SET vQ422 = 1;
		
		UPDATE bilan_social_consolide set Q_422 = vQ422
		where ID_BILASOCICONS = idBilaSociCons;

		  ### Remplissage
		  INSERT INTO ind_422 (ID_BILASOCICONS, ID_CADREMPL, R_4221, R_4222, R_4223, R_4224, R_4225, R_4226, R_4227, R_4228)
		  SELECT idBilaSociCons, ce.ID_CADREMPL,
			SUM(CASE WHEN t.Q1 = 1 AND t.AN_EV = vAnnee THEN t.NB ELSE 0 END) AS R_4221,
			SUM(CASE WHEN t.Q1 = 2 AND t.AN_EV = vAnnee THEN t.NB ELSE 0 END) AS R_4222,
			SUM(CASE WHEN t.Q1 = 1 AND t.AN_EV = vAnneeMoins1 THEN t.NB ELSE 0 END) AS R_4223, 
			SUM(CASE WHEN t.Q1 = 2 AND t.AN_EV = vAnneeMoins1 THEN t.NB ELSE 0 END) AS R_4224, 
			SUM(CASE WHEN t.Q1 = 1 AND t.AN_EV = vAnnee THEN t.NB_JOURABSE ELSE 0 END) AS R_4225,
			SUM(CASE WHEN t.Q1 = 2 AND t.AN_EV = vAnnee THEN t.NB_JOURABSE ELSE 0 END) AS R_4226,
			SUM(CASE WHEN t.Q1 = 1 AND t.AN_EV = vAnneeMoins1 THEN t.NB_JOURABSE ELSE 0 END) AS R_4227, 
			SUM(CASE WHEN t.Q1 = 2 AND t.AN_EV = vAnneeMoins1 THEN t.NB_JOURABSE ELSE 0 END) AS R_4228	
		  FROM ref_cadre_emploi ce 
		  LEFT JOIN temp_apa2cons_ind422 t ON t.Q2_8 = ce.ID_CADREMPL
		  WHERE ce.BL_VALI = 0
		  GROUP BY idBilaSociCons, ce.ID_CADREMPL
		  ORDER BY ce.ID_CADREMPL;
        else 
                SET vQ422 = 0;
		UPDATE bilan_social_consolide set Q_422 = vQ422
		where ID_BILASOCICONS = idBilaSociCons;
	end if;
  
END
$$
