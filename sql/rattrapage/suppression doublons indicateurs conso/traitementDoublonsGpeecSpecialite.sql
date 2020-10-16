DELIMITER $$


DROP PROCEDURE IF EXISTS traitementDoublonsGpeecSpecialite
$$

CREATE PROCEDURE traitementDoublonsGpeecSpecialite(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE gpeec_cursor CURSOR FOR
		select BSC_GPEEC_PLUS_NB_AGENTS_PAR_SPE_ET_AGE, ID_SPECIALITE from bsc_gpeec_plus_nb_agents_par_spe_et_age
		where id_bilasocicons = idBilaSociCons
		order by ID_SPECIALITE, BSC_GPEEC_PLUS_NB_AGENTS_PAR_SPE_ET_AGE desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_gpeec_delete;
	CREATE TEMPORARY TABLE temp_gpeec_delete (
		id int
	);

	SET vkeyPrevious = -1;

	OPEN gpeec_cursor;
    ind_loop: LOOP

		FETCH gpeec_cursor INTO vid, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_gpeec_delete (id)
			VALUES (vid);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE gpeec_cursor;

	DELETE FROM bsc_gpeec_plus_nb_agents_par_spe_et_age
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_gpeec_delete t WHERE t.id = bsc_gpeec_plus_nb_agents_par_spe_et_age.BSC_GPEEC_PLUS_NB_AGENTS_PAR_SPE_ET_AGE);

END
$$
