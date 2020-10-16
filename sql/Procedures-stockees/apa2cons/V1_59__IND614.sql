DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind614
$$

CREATE PROCEDURE apa2cons_ind614(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	insert into ind_6141(ID_BILASOCICONS, ID_SANC_DISC, R_61411, R_61412, CD_UTILCREA, DT_CREA)
        select idBilaSociCons, sda.ID_SANC_DISC, SUM(sda.NB_AGENTS_H), SUM(sda.NB_AGENTS_F), 'APA2CONS', NOW()
	from sanction_disciplinaire_agent sda
        join information_colectivite_agent ica ON ica.ID_INFOCOLLAGEN = sda.ID_INFOCOLLAGEN
        join ref_sanction_disciplinaire rsd ON sda.ID_SANC_DISC = rsd.ID_SANC_DISC
        WHERE ica.ID_COLL = idColl
        AND ica.ID_ENQU = idEnqu
        AND rsd.BL_VALI = 0
		GROUP BY idBilaSociCons, sda.ID_SANC_DISC, 'APA2CONS', NOW();

	insert into ind_6143(ID_BILASOCICONS, ID_SANC_DISC, R_61431, R_61432, CD_UTILCREA, DT_CREA)
        select idBilaSociCons, sda.ID_SANC_DISC, SUM(sda.NB_AGENTS_H), SUM(sda.NB_AGENTS_F), 'APA2CONS', NOW()
	from sanction_disciplinaire_stagiaire sda
        join information_colectivite_agent ica ON ica.ID_INFOCOLLAGEN = sda.ID_INFOCOLLAGEN
        join ref_sanction_disciplinaire rsd ON sda.ID_SANC_DISC = rsd.ID_SANC_DISC
        WHERE ica.ID_COLL = idColl
        AND ica.ID_ENQU = idEnqu
        AND rsd.BL_VALI = 0
		GROUP BY idBilaSociCons, sda.ID_SANC_DISC, 'APA2CONS', NOW();

    insert into ind_6144(ID_BILASOCICONS, ID_SANC_DISC, R_61441, R_61442, CD_UTILCREA, DT_CREA)
        select idBilaSociCons, sda.ID_SANC_DISC, SUM(sda.NB_AGENTS_H), SUM(sda.NB_AGENTS_F), 'APA2CONS', NOW()
	from sanction_disciplinaire_contractuel sda
        join information_colectivite_agent ica ON ica.ID_INFOCOLLAGEN = sda.ID_INFOCOLLAGEN
        join ref_sanction_disciplinaire rsd ON sda.ID_SANC_DISC = rsd.ID_SANC_DISC
        WHERE ica.ID_COLL = idColl
        AND ica.ID_ENQU = idEnqu
        AND rsd.BL_VALI = 0
		GROUP BY idBilaSociCons, sda.ID_SANC_DISC, 'APA2CONS', NOW();


    insert into ind_6142(ID_BILASOCICONS, ID_MOTI_SANC_DISC, R_61421, R_61422, CD_UTILCREA, DT_CREA)
        select idBilaSociCons, msda.ID_MOTI_SANC_DISC, SUM(msda.NB_AGENTS_H), SUM(msda.NB_AGENTS_F), 'APA2CONS', NOW()
	from motif_sanction_disciplinaire_agent msda
        join information_colectivite_agent ica ON ica.ID_INFOCOLLAGEN = msda.ID_INFOCOLLAGEN
        join ref_motif_sanction_disciplinaire rmsd ON msda.ID_MOTI_SANC_DISC = rmsd.ID_MOTI_SANC_DISC
        WHERE ica.ID_COLL = idColl
        AND ica.ID_ENQU = idEnqu
        AND rmsd.BL_VALI = 0
		GROUP BY idBilaSociCons, msda.ID_MOTI_SANC_DISC, 'APA2CONS', NOW();
	
END
$$
