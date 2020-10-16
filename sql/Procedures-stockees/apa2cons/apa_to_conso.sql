DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons
$$

CREATE PROCEDURE apa2cons(idColl INT, idEnqu INT, blAffiColl BOOLEAN)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare idQuesCollCons  int(11);
	declare idBilaSociCons  int(11);
	
	declare vblGepeec  int(11);
	declare vblHandi  int(11);
	declare vblRassct  int(11);
	declare vblBilan  int(11);
	declare vblCollDgcl  int(11);

	CALL  consolide_delete_value (idColl, idEnqu);

	insert into question_collectivite_consolide(CD_UTILCREA,created_at,ID_COLL,ID_ENQU,Q1,Q10,Q11,Q12,Q13,Q14,Q2,Q3,Q4,Q5,Q6,Q7,Q8,Q9)
	values ('SYSTEM', CURRENT_TIMESTAMP, idColl, idEnqu, 1,1,1,1,1,1,1,1,1,1,1,1,1,1);

	set idQuesCollCons = LAST_INSERT_ID();
	
	
	
	SELECT BL_BILASOCI, BL_HAND, BL_RAST, BL_GEPE, c.BL_COLL_DGCL
		INTO vblBilan, vblHandi, vblRassct, vblGepeec, vblCollDgcl
	FROM enquete_collectivite ec
	JOIN collectivite c ON c.ID_COLL = ec.ID_COLL
	WHERE ec.id_coll = idColl
		AND ec.id_enqu = idEnqu;
	

	insert into bilan_social_consolide(BL_VALI, CD_UTILCREA, DT_CREA, FG_STAT, ID_COLL, ID_ENQU, ID_QUESCOLLCONS,
										MOYENNE_IND110,MOYENNE_IND140,
			MOYENNE_IND150,MOYENNE_IND151,MOYENNE_IND1531,MOYENNE_IND1532,MOYENNE_IND158,MOYENNE_IND162,MOYENNE_IND171,MOYENNE_IND210,MOYENNE_IND214,
			MOYENNE_IND215,MOYENNE_IND216,MOYENNE_IND221,MOYENNE_IND222,MOYENNE_IND223,MOYENNE_IND224,MOYENNE_IND225,MOYENNE_IND231,MOYENNE_IND311,MOYENNE_IND341,
			MOYENNE_IND342,MOYENNE_IND343, MOYENNE_IND344,MOYENNE_IND413,MOYENNE_IND414,MOYENNE_IND422,MOYENNE_IND423,MOYENNE_IND613,
			MOYENNE_IND614,MOYENNE_IND711,MOYENNE_IND712,MOYENNE_IND713,MOYENNE_IND513,	MOYENNE_IND217)
	values(0, 'SYSTEM', CURRENT_TIMESTAMP, 0, idColl, idEnqu, idQuesCollCons,
										100, 100,
			100,100,100,100,100,100,100,100,100,
			100,100,100,100,100,100,100,100,100,100,
			100, 100,100,100,100,100,100,100,100,100,
			100,100,100, 100);

	set idBilaSociCons = LAST_INSERT_ID();

    IF blAffiColl = 1 THEN
    UPDATE bilan_social_consolide
      SET MOYENNE_IND611 = 0, MOYENNE_IND612 = 100, BL_UPDATED = 0
      WHERE ID_BILASOCICONS = idBilaSociCons;
    ELSEIF blAffiColl = 0 THEN
    UPDATE bilan_social_consolide
      SET MOYENNE_IND611 = 100, MOYENNE_IND612 = 0, BL_UPDATED = 0
      WHERE ID_BILASOCICONS = idBilaSociCons;
    END IF;
	
	IF vblBilan = 1 THEN 
   
		CALL  apa2cons_ind110 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind111 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind112 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind113 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind114 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind121 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind122 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind123 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind124 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind131 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind132 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind141 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind142 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind143 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind150 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind151 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind152 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind1531 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind1532 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind154 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind155 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind156 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind157 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind161 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind162 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind171 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind210 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind211 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind212 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind213 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind214 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind215 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind216 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind217 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind221 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind222 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind223 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind224 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind225 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind226 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind227 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind231 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind311_331	( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind341_342 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind343 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind344 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind345 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind411_412 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind413 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind414_417 ( idBilaSociCons,  idColl, idEnqu);
        CALL  apa2cons_ind421 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind422 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind423 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind424 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind425 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind431 ( idBilaSociCons, idColl, idEnqu);
		CALL  apa2cons_ind511 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind512 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind513 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind514 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind611_613 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind614 ( idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_ind711_714 ( idBilaSociCons,  idColl, idEnqu);


		# GPEEC
		CALL  apa2cons_gpeec( idBilaSociCons, idColl, idEnqu);

		# Handitorial
		CALL  apa2cons_handitorial( idBilaSociCons, idColl, idEnqu);


		# RASSCT
		CALL apa2cons_rassct_accident_travail(idBilaSociCons,  idColl, idEnqu);
		CALL apa2cons_rassct_maladie_pro_carac_pro(idBilaSociCons,  idColl, idEnqu);
		CALL apa2cons_rassct_maladie_pro_reconnue(idBilaSociCons,  idColl, idEnqu);
		CALL apa2cons_rassct_accident_by_types(idBilaSociCons,  idColl, idEnqu);
		CALL  apa2cons_rassct_information_collectivite( idBilaSociCons,  idColl, idEnqu);


	ELSE 
		IF vblRassct = 1 THEN 
			CALL  apa2cons_ind114 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind124 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind211 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind212 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind213 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind214 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind215 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind216 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind217 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind225 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind411_412 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind413 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind414_417 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind421 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind222 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind431 ( idBilaSociCons, idColl, idEnqu);
			CALL  apa2cons_ind611_613 ( idBilaSociCons,  idColl, idEnqu);
			CALL apa2cons_rassct_accident_travail(idBilaSociCons,  idColl, idEnqu);
			CALL apa2cons_rassct_maladie_pro_carac_pro(idBilaSociCons,  idColl, idEnqu);
			CALL apa2cons_rassct_maladie_pro_reconnue(idBilaSociCons,  idColl, idEnqu);
			CALL apa2cons_rassct_accident_by_types(idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_rassct_information_collectivite( idBilaSociCons,  idColl, idEnqu);
		END IF;
		IF vblHandi = 1 THEN
			CALL  apa2cons_handitorial( idBilaSociCons, idColl, idEnqu);
			CALL  apa2cons_ind161 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind162 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind423 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind424 ( idBilaSociCons,  idColl, idEnqu);
		END IF;
		IF vblGepeec = 1 THEN
			CALL  apa2cons_gpeec( idBilaSociCons, idColl, idEnqu);
		END IF;
		IF vblGepeec = 1 OR vblHandi = 1 OR vblRassct = 1 THEN
			CALL  apa2cons_ind171 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind231 ( idBilaSociCons,  idColl, idEnqu);
		END IF;
		IF vblGepeec = 1 OR vblRassct = 1 THEN 
			CALL  apa2cons_ind111 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind112 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind121 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind131 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind150 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind151 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind152 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind1531 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind1532 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind154 ( idBilaSociCons,  idColl, idEnqu);
			CALL  apa2cons_ind155 ( idBilaSociCons,  idColl, idEnqu);
		END IF;
	
		
    END IF;

    IF vblCollDgcl = 1 THEN
    	# DGCL
		CALL apa2cons_dgcljourscarence(idBilaSociCons,  idColl, idEnqu);
    END IF;

END
$$
