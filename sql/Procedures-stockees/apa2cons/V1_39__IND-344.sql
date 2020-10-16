DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind344
$$

CREATE PROCEDURE apa2cons_ind344(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare vQ3441 int(11);
	declare vQ3442 int(11);
	declare vQ344 int(11);
	
	SELECT BL_HEURSUPP, BL_HEURCOMP 
	INTO vQ3441, vQ3442
	FROM information_generale
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	
	set vQ344 = 0;
	
	if ((vQ3441 is not null and vQ3441 = 1) or (vQ3442 is not null and vQ3442 = 1)) then
		set vQ344 = 1;
		
	end if;
	
	UPDATE bilan_social_consolide SET Q_344 = vQ344
	WHERE ID_BILASOCICONS = idBilaSociCons; 
	
	
	if( vQ344 = 1) then
	
		### Remplissage
		  INSERT INTO ind_344 (ID_BILASOCICONS, ID_CADREMPL, R_3441, R_3442, R_3443, R_3444, R_3445, R_3446, R_3447, R_3448, R_3449, R_34410, R_34411, R_34412)
		  SELECT  idBilaSociCons, ce.ID_CADREMPL,
			SUM(CASE WHEN t.rtype = '344A' AND t.Q1 = 1 AND t.Q2 in ('TITU','STAG') AND t.Q11_1 = 1 THEN t.NB_HEUR ELSE 0 END) AS R_3441,
			SUM(CASE WHEN t.rtype = '344A' AND t.Q1 = 2 AND t.Q2 in ('TITU','STAG') AND t.Q11_1 = 1 THEN t.NB_HEUR ELSE 0 END) AS R_3442,
			SUM(CASE WHEN t.rtype = '344B' AND t.Q1 = 1 AND t.Q2 in ('TITU','STAG') AND t.Q11_1 = 1 THEN t.NB_HEUR ELSE 0 END) AS R_3443,
			SUM(CASE WHEN t.rtype = '344B' AND t.Q1 = 2 AND t.Q2 in ('TITU','STAG') AND t.Q11_1 = 1 THEN t.NB_HEUR ELSE 0 END) AS R_3444,
            SUM(CASE WHEN t.rtype = '344A' AND t.Q1 = 1 AND t.Q2 in ('TITU','STAG') AND t.Q11_1 = 0 THEN t.NB_HEUR ELSE 0 END) AS R_3445,
			SUM(CASE WHEN t.rtype = '344A' AND t.Q1 = 2 AND t.Q2 in ('TITU','STAG') AND t.Q11_1 = 0 THEN t.NB_HEUR ELSE 0 END) AS R_3446,
			SUM(CASE WHEN t.rtype = '344B' AND t.Q1 = 1 AND t.Q2 in ('TITU','STAG') AND t.Q11_1 = 0 THEN t.NB_HEUR ELSE 0 END) AS R_3447,
			SUM(CASE WHEN t.rtype = '344B' AND t.Q1 = 2 AND t.Q2 in ('TITU','STAG') AND t.Q11_1 = 0 THEN t.NB_HEUR ELSE 0 END) AS R_3448,
            SUM(CASE WHEN t.rtype = '344A' AND t.Q1 = 1 AND t.Q2 in ('CONTPERM','CONTNONPERM')  THEN t.NB_HEUR ELSE 0 END) AS R_3449,
			SUM(CASE WHEN t.rtype = '344A' AND t.Q1 = 2 AND t.Q2 in ('CONTPERM','CONTNONPERM')  THEN t.NB_HEUR ELSE 0 END) AS R_34410,
			SUM(CASE WHEN t.rtype = '344B' AND t.Q1 = 1 AND t.Q2 in ('CONTPERM','CONTNONPERM')  THEN t.NB_HEUR ELSE 0 END) AS R_34411,
			SUM(CASE WHEN t.rtype = '344B' AND t.Q1 = 2 AND t.Q2 in ('CONTPERM','CONTNONPERM')  THEN t.NB_HEUR ELSE 0 END) AS R_34412
        FROM ref_cadre_emploi ce
        LEFT OUTER JOIN
			(
                SELECT h.ID_CADREMPL AS Q2_8, '344A' AS rtype, COALESCE(bsa.CD_SEXE, '-1') AS Q1, h.NB_HEUR AS NB_HEUR, rs.CD_STAT AS Q2, bsa.BL_TEMPCOMP AS Q11_1
			  	FROM bilan_social_agent AS bsa
			  	JOIN heu_supp_rea_rem_agent h ON bsa.ID_BILASOCIAGEN = h.ID_BILASOCIAGEN
                JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
			  	WHERE bsa.ID_COLL = idColl
				AND bsa.ID_ENQU = idEnqu
				AND h.ID_CADREMPL is not null
			UNION ALL
				SELECT h.ID_CADREMPL AS Q2_8, '344B' AS rtype, COALESCE(bsa.CD_SEXE, '-1') AS Q1, h.NB_HEUR AS NB_HEUR, rs.CD_STAT AS Q2, bsa.BL_TEMPCOMP AS Q11_1
			  	FROM bilan_social_agent AS bsa
			  	JOIN heu_comp_rea_rem_agent h ON bsa.ID_BILASOCIAGEN = h.ID_BILASOCIAGEN
                JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
			  	WHERE bsa.ID_COLL = idColl
			  	AND bsa.ID_ENQU = idEnqu
			  	AND h.ID_CADREMPL is not null
			) t ON t.Q2_8 = ce.ID_CADREMPL
        WHERE ce.BL_VALI = 0
        GROUP BY ce.ID_CADREMPL
        ORDER BY ce.ID_CADREMPL;
	end if;
	
END
$$
