DELIMITER $$
DROP PROCEDURE IF EXISTS getResultSetApaExport
$$


CREATE PROCEDURE getResultSetApaExport(pIdColl INT, pIdEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
		# liste des agents
		SELECT bsa.*, rg.LB_GRAD AS LB_GRAD, rgd.LB_GRAD AS LB_GRADDETA, ri.LB_INAP AS LB_INAPDEMA, ri2.LB_INAP AS LB_INAPDECI,
                rps.LB_POSISTAT AS LB_POSISTAT, rps2.LB_POSISTAT AS LB_POSISTATNONREMU, rs.LB_STAT AS LB_STAT, rfp.LB_FONCPUBL AS LB_FONCPUBL,
                refonc.LB_EMPLFONC AS LB_EMPLFONC, rc.LB_CATE AS LB_CATE, rf.LB_FILI AS LB_FILI, rce.LB_CADREMPL AS LB_CADREMPL,
                rma.LB_MOTIARRI AS LB_MOTIARRI, rst.LB_STAGTITU AS LB_STAGTITU, rmd.LB_MOTIDEPA AS LB_MOTIDEPA, rtnc.LB_TEMPNONCOMP AS LB_TEMPNONCOMP,
                rtp.LB_TEMPPART AS LB_TEMPPART, rptp.LB_POURTEMPPART AS LB_POURTEMPPART, rct.LB_CYCLTRAV AS LB_CYCLTRAV, rtmp.LB_TYPEMISSPREV AS LB_TYPEMISSPREV,
                renp.LB_EMPLNONPERM AS LB_EMPLNONPERM, rso.LB_STRUORIG AS LB_STRUORIG, rtc.LB_TYPECDD AS LB_TYPECDD, rce2.LB_CADREMPL AS LB_CADREEMPORIG,
                rme.LB_MOTIENTR AS LB_MOTIENTRDEP, rme2.LB_MOTIENTR AS LB_MOTIENTRRET, rf2.LB_FILI AS LB_FILIEMPLFONC, rf3.LB_FILI AS LB_FILIINAP,
                rce3.LB_CADREMPL AS LB_CADREMPLDETA, rmia.LB_MOUVINTEANNE AS LB_MOUVINTEANNE
                FROM bilan_social_agent bsa
                LEFT JOIN ref_grade rg ON bsa.ID_GRAD = rg.ID_GRAD
                LEFT JOIN ref_grade rgd ON bsa.ID_GRADDETA = rgd.ID_GRAD
                LEFT JOIN ref_inaptitude ri ON bsa.ID_INAPDEMA = ri.ID_INAP
                LEFT JOIN ref_inaptitude ri2 ON bsa.ID_INAPDECI = ri2.ID_INAP
                LEFT JOIN ref_position_statutaire rps ON bsa.ID_POSISTAT = rps.ID_POSISTAT
                LEFT JOIN ref_position_statutaire rps2 ON bsa.ID_POSISTATNONREMU = rps2.ID_POSISTAT
                LEFT JOIN ref_statut rs ON bsa.ID_STAT = rs.ID_STAT
                LEFT JOIN ref_fonction_publique rfp ON bsa.ID_FONCPUBL = rfp.ID_FONCPUBL
                LEFT JOIN ref_emploi_fonctionnel refonc ON bsa.ID_EMPLFONC = refonc.ID_EMPLFONC
                LEFT JOIN ref_categorie rc ON bsa.ID_CATE = rc.ID_CATE
                LEFT JOIN ref_filiere rf ON bsa.ID_FILI = rf.ID_FILI
                LEFT JOIN ref_cadre_emploi rce ON bsa.ID_CADREMPL = rce.ID_CADREMPL
                LEFT JOIN ref_motif_arrivee rma ON bsa.ID_MOTIARRI = rma.ID_MOTIARRI
                LEFT JOIN ref_stage_titularisation rst ON bsa.ID_STAGTITU = rst.ID_STAGTITU
                LEFT JOIN ref_motif_depart rmd ON bsa.ID_MOTIDEPA = rmd.ID_MOTIDEPA
                LEFT JOIN ref_temps_non_complet rtnc ON bsa.ID_TEMPNONCOMP = rtnc.ID_TEMPNONCOMP
                LEFT JOIN ref_temps_partiel rtp ON bsa.ID_TEMPPART = rtp.ID_TEMPPART
                LEFT JOIN ref_pourcentage_tempa_partiel rptp ON bsa.ID_POURTEMPPART = rptp.ID_POURTEMPPART
                LEFT JOIN ref_cycle_travail rct ON bsa.ID_CYCLTRAV = rct.ID_CYCLTRAV
                LEFT JOIN ref_type_mission_prevention rtmp ON bsa.ID_TYPEMISSPREV = rtmp.ID_TYPEMISSPREV
                LEFT JOIN ref_emploi_non_permanent renp ON bsa.ID_EMPLNONPERM = renp.ID_EMPLNONPERM
                LEFT JOIN ref_structure_origine rso ON bsa.ID_STRUORIG = rso.ID_STRUORIG
                LEFT JOIN ref_Type_Cdd rtc ON bsa.ID_TYPECDD = rtc.ID_TYPECDD
                LEFT JOIN ref_cadre_emploi rce2 ON bsa.ID_CADREEMPORIG = rce2.ID_CADREMPL
                LEFT JOIN ref_motif_entretien rme ON bsa.ID_MOTIENTRDEP = rme.ID_MOTIENTR
                LEFT JOIN ref_motif_entretien rme2 ON bsa.ID_MOTIENTRRET = rme.ID_MOTIENTR
                LEFT JOIN ref_filiere rf2 ON bsa.ID_FILIEMPLFONC = rf2.ID_FILI
                LEFT JOIN ref_filiere rf3 ON bsa.ID_FILIINAP = rf3.ID_FILI
                LEFT JOIN ref_cadre_emploi rce3 ON bsa.ID_CADREMPLDETA = rce3.ID_CADREMPL
                LEFT JOIN ref_mouvement_interne_annee rmia ON bsa.ID_MOUVINTEANNE = rmia.ID_MOUVINTEANNE
		WHERE ID_COLL = pIdColl
		AND ID_ENQU = pIdEnqu
		ORDER BY ID_BILASOCIAGEN;
		
		# etpr des agents
		SELECT ea.*, rs.LB_STAT AS LB_STAT, rf.LB_FILI AS LB_FILI, renp.LB_EMPLNONPERM AS LB_EMPLNONPERM,
                rce.LB_CADREMPL AS LB_CADREMPL
                FROM etpr_agent ea
                LEFT JOIN ref_statut rs ON rs.ID_STAT = ea.ID_STAT
                LEFT JOIN ref_filiere rf ON rf.ID_FILI = ea.ID_FILI
                LEFT JOIN ref_emploi_non_permanent renp ON renp.ID_EMPLNONPERM = ea.ID_EMPLNONPERM
                LEFT JOIN ref_cadre_emploi rce ON rce.ID_CADREMPL = ea.ID_CADREMPL
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = ea.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY ea.id_bilasociagen;

		# absences des agents
		SELECT aaa.*, rma.LB_MOTIABSE AS LB_MOTIABSE, rnl.LB_NATURE_LESION AS LB_NATURE_LESION, rsl.LB_SIEGE_LESION AS LB_SIEGE_LESION,
                rem.LB_ELEMENT_MATERIEL AS LB_ELEMENT_MATERIEL, rmp.LB_MALADIE_PROFESSIONNELLE AS LB_MALADIE_PROFESSIONNELLE,
                rta.LB_TYPE_ACTIVITE AS LB_TYPE_ACTIVITE_MALADIE_PRO, rta2.LB_TYPE_ACTIVITE AS LB_TYPE_ACTIVITE_ARRET_TRAVAIL
                FROM absence_arret_agent aaa
                LEFT JOIN ref_motif_absence rma ON rma.ID_MOTIABSE = aaa.ID_MOTIABSE
                LEFT JOIN ref_nature_lesion rnl ON rnl.ID_NATURE_LESION = aaa.id_nature_lesion
                LEFT JOIN ref_siege_lesion rsl ON rsl.ID_SIEGE_LESION = aaa.id_siege_lesion
                LEFT JOIN ref_element_materiel rem ON rem.ID_ELEMENT_MATERIEL = aaa.id_element_materiel
                LEFT JOIN ref_maladie_professionnelle rmp ON rmp.ID_MALADIE_PROFESSIONNELLE = aaa.id_maladie_professionnelle
                LEFT JOIN ref_type_activite rta ON rta.ID_TYPE_ACTIVITE = aaa.id_type_activite_maladie_pro
                LEFT JOIN ref_type_activite rta2 ON rta2.ID_TYPE_ACTIVITE = aaa.id_type_activite_arret_travail
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = aaa.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY aaa.id_bilasociagen;

        # remunerations des agents
        SELECT ra.*, rs.LB_STAT AS LB_STAT, rc.LB_CATE AS LB_CATE FROM remuneration_agent ra
                LEFT JOIN ref_statut rs ON rs.ID_STAT = ra.ID_STAT
                LEFT JOIN ref_categorie rc ON rc.ID_CATE = ra.ID_CATE
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = ra.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY ra.id_bilasociagen;

		# formations des agents
		SELECT fa.*, rof.LB_ORGAFORM AS LB_ORGAFORM, rf.LB_FORM AS LB_FORM FROM formation_agent fa
                LEFT JOIN ref_organisme_formation rof ON rof.ID_ORGAFORM = fa.ID_ORGAFORM
                LEFT JOIN ref_formation rf ON rf.ID_FORM = fa.ID_FORM
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = fa.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY fa.id_bilasociagen;
		
		# gpeec
		SELECT bsag.*, rm.LB_METIER AS LB_METIER, rdd.* FROM bilan_social_agent_gpeec bsag
		LEFT JOIN ref_metier rm ON rm.ID_METIER = bsag.ID_METIER
		LEFT JOIN ref_domaine_diplome rdd ON rdd.ID_DOMAINE_DIPLOME = bsag.ID_DOMAINE_DIPLOME_GPEEC
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = bsag.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY bsag.id_bilasociagen;
		
		# gpeec plus
		SELECT bsagp.*, rs.* FROM bilan_social_agent_gpeec_plus bsagp
		LEFT JOIN ref_specialite rs ON rs.ID_SPECIALITE = bsagp.ID_SPECIALITE
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = bsagp.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY bsagp.id_bilasociagen;

		# handitorial agents
		SELECT bsah.*, rcb.*, rnhb.* FROM Bilan_Social_Agent_Handitorial bsah
		LEFT JOIN ref_categorie_boeth rcb ON rcb.ID_CATEGORIE_BOETH = bsah.id_categorie_boeth
		LEFT JOIN ref_nature_handicap_boeth rnhb ON rnhb.ID_NATURE_HANDICAP_BOETH = bsah.id_nature_handicap_boeth
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = bsah.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY bsah.id_bilasociagen; 
		
		# Rassct agents
		SELECT bsar.*, rta.LB_TYPE_ACTIVITE AS LB_TYPE_ACTIVITE_MALADIE_PRO, rta2.LB_TYPE_ACTIVITE AS LB_TYPE_ACTIVITE_ARRET_TRAVAIL, rmp.LB_MALADIE_PROFESSIONNELLE AS LB_MALADIE_PROFESSIONNELLE
                FROM Bilan_Social_Agent_Rassct bsar
		LEFT JOIN ref_type_activite rta ON rta.ID_TYPE_ACTIVITE = bsar.id_type_activite_maladie_pro
		LEFT JOIN ref_type_activite rta2 ON rta.ID_TYPE_ACTIVITE = bsar.id_type_activite_arret_travail
		LEFT JOIN ref_maladie_professionnelle rmp ON rmp.ID_MALADIE_PROFESSIONNELLE = bsar.id_maladie_professionnelle
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = bsar.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY bsar.id_bilasociagen; 
	
		# Dgcl jours de carence agents
		SELECT bsad.* FROM bilan_social_agent_dgcl bsad
		WHERE exists (SELECT 1 FROM bilan_social_agent bsa WHERE bsa.id_bilasociagen = bsad.id_bilasociagen
			   AND bsa.id_coll = pIdColl AND bsa.id_enqu = pIdEnqu)
		ORDER BY bsad.id_bilasociagen; 
END
$$

