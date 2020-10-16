DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind171
$$

CREATE PROCEDURE apa2cons_ind171(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

  DROP TEMPORARY TABLE IF EXISTS temp_genre;
  CREATE TEMPORARY TABLE temp_genre (fg_genre int)
    ENGINE = MEMORY
    ;
  insert into temp_genre  values (1);
  insert into temp_genre  values (2);
  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind171;
  CREATE TEMPORARY TABLE temp_apa2cons_ind171 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      SELECT        
        bsa.CD_SEXE AS Q1,
        rs.CD_STAT AS Q2,
		bsa.lb_datenais, 
		CASE WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) < 25 
				THEN 1
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) >= 25 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) <= 29
				THEN 2
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) >= 30
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) <= 34
				THEN 3
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) >= 35 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) <= 39
				THEN 4
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) >= 40 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) <= 44
				THEN 5
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) >= 45 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) <= 49
				THEN 6
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) >= 50 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) <= 54
				THEN 7
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) >= 55 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) <= 59
				THEN 8
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) >= 60 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING(bsa.lb_datenais, 1, 2), '-15'))), DATE ), CURDATE()) <= 64
				THEN 9
			 ELSE 10 END AS ID_TRANAGE		
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2        
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND bsa.BL_AGENREMU3112 = 1         # Q4.1        
		AND bsa.LB_DATENAIS IS NOT NULL
		
    );
	

  ### Remplissage 
  INSERT INTO ind_171 (ID_BILASOCICONS, ID_TRANAGE, FG_GENR, R_1711, R_1712, R_1713)
  SELECT idBilaSociCons, ta.ID_TRANAGE, CASE WHEN g.fg_genre = 1 THEN 'H' ELSE 'F' END as FG_GENR,
    SUM(CASE WHEN t.Q2 in ('TITU','STAG') THEN 1 ELSE 0 END) AS R_1711,
    SUM(CASE WHEN t.Q2 = 'CONTPERM' THEN 1 ELSE 0 END) AS R_1712,
	SUM(CASE WHEN t.Q2 = 'CONTNONPERM' THEN 1 ELSE 0 END) AS R_1713
  FROM ref_tranche_age ta  JOIN temp_genre g
  LEFT JOIN temp_apa2cons_ind171 t on t.ID_TRANAGE = ta.ID_TRANAGE AND g.fg_genre = t.Q1  
  GROUP BY idBilaSociCons, ta.ID_TRANAGE, g.fg_genre
  ORDER BY g.fg_genre, ta.ID_TRANAGE;
  
END
$$
