DELIMITER $$

DROP PROCEDURE IF EXISTS historisation_creation
$$

CREATE PROCEDURE historisation_creation()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vidHist INT;
	DECLARE vNmSire VARCHAR(255);
	DECLARE vLbColl VARCHAR(255);
	DECLARE vLbAdre VARCHAR(255);
	DECLARE vCdPost INT;
	DECLARE vLbVill VARCHAR(255);
	DECLARE vCdInse VARCHAR(255);
	DECLARE vNmPopuInse VARCHAR(255);
	DECLARE vLbZoneEmplColl VARCHAR(255);
	DECLARE vTypeColl INT;
	DECLARE vIdCdgDepartement INT;
	DECLARE vIdDepa INT;
	DECLARE vNmSireRata VARCHAR(255);
	DECLARE vDtpopuInsee VARCHAR(255);
	DECLARE vMotif VARCHAR(255);	
	DECLARE LID int;
	DECLARE vBlActi  TINYINT(1);

    DECLARE cursDone INT DEFAULT FALSE;

    DECLARE ind_cursor CURSOR FOR
			  SELECT ish.NM_SIRE, ish.LB_COLL ,  ish.LB_ADRE, ish.CD_POST, ish.LB_VILL, ish.CD_INSE, ish.NM_POPU_INSE, ish.LB_ZONE_EMPL_COLL, rfc.ID_TYPE_COLL, ish.ID_CDG_DEPARTEMENT, d.ID_DEPA, ish.NM_SIRE_RATA, ish.DT_POPU_INSE, ish.MOTIF
			  FROM import_siret_historisation ish
			  JOIN departement d ON d.CD_DEPA = ish.ID_DEPA
			  JOIN ref_type_collectivite rfc ON rfc.CD_TYPECOLL = ish.ID_TYPE_COLL
			  WHERE ish.BL_ERREUR = 0 AND ish.Bl_ARCHI = 0 AND ish.MOTIF != 'vide';


    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;
	

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vNmSire,vLbColl, vLbAdre, vCdPost, vLbVill, vCdInse, vNmPopuInse, vLbZoneEmplColl, vTypeColl, vIdCdgDepartement, vIdDepa, vNmSireRata, vDtpopuInsee,vMotif;
		
        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

		SET vBlActi = 0;
		
		IF vMotif IN ('Fusion', 'Changement adresse') THEN
	  
			SET vBlActi = 1;
		
		END IF;

		INSERT INTO collectivite (NM_SIRE, LB_COLL,  LB_ADRE, CD_POST, LB_VILL, CD_INSE, NM_POPU_INSE, LB_ZONE_EMPL_COLL, ID_TYPE_COLL, ID_CDG_DEPARTEMENT, ID_DEPA, NM_SIRE_RATA, DT_POPU_INSE, BL_ACTI, DT_CREA, CD_UTILCREA)
        VALUES (vNmSire,vLbColl, vLbAdre, vCdPost, vLbVill, vCdInse, vNmPopuInse, vLbZoneEmplColl, vTypeColl, vIdCdgDepartement, vIdDepa, vNmSireRata, vDtpopuInsee, vBlActi, NOW(), 'Import' );
	

		IF vMotif IN ('Fusion', 'Changement adresse') THEN
	  
			DELETE FROM import_siret_historisation WHERE NM_SIRE = vNmSire;
		
		END IF;

    END LOOP;

    CLOSE ind_cursor;

END
$$

