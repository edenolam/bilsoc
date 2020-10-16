/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  mbusson
 * Created: 4 janv. 2018
 *  
 *  ATTENTION SCRIPT A NE LANCER QU UNE SEULE FOIS POUR NE PAS FAUSSER LES DONNEES.
 *  CE SCRIPT PERMET DE PERMUTTER LES VALEURS DES BLVALI DANS LES REFERENTIELS POUR ETRE COHERENT PARTOUT AVEC LES EXPORTS ET L AFFICHAGE DES DONNEES DES REFERENTIELS.
    
    Maintenant dans une requête le blVali = 0 permet de recuperer les referentiels qui ne sont pas archivé !

 *
 */
UPDATE `ref_acte_violence_physique` SET `BL_VALI` = CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE `BL_VALI`
    END;

UPDATE `ref_action_prevention` SET `BL_VALI` = CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE `BL_VALI`
    END;

UPDATE `ref_avancement_promotion_concours` SET `BL_VALI` = CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE `BL_VALI`
    END;

UPDATE `ref_cadre_emploi` SET `BL_VALI` = CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_categorie` SET `BL_VALI` = CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_categorie_boeth` SET `BL_VALI` = CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_contrainte_travail` SET `BL_VALI` = CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_cycle_travail` SET `BL_VALI` = CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_domaine_diplome` SET `BL_VALIDE`= CASE
    WHEN BL_VALIDE = 1 THEN 0
    WHEN BL_VALIDE = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_domaine_professionnel` SET `BL_VALIDE`= CASE
    WHEN BL_VALIDE = 1 THEN 0
    WHEN BL_VALIDE = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_element_materiel` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_emploi_fonctionnel` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_emploi_non_permanent` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_famille_metier` SET `BL_VALIDE`= CASE
    WHEN BL_VALIDE = 1 THEN 0
    WHEN BL_VALIDE = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_filiere` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_fonction_publique` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_formation` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_grade` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_groupe_position_statutaire` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_inaptitude` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_inaptitude_boeth` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_maladie_professionnelle` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_mesure_boeth` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_metier` SET `BL_VALIDE` = CASE
    WHEN BL_VALIDE = 1 THEN 0
    WHEN BL_VALIDE = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_motif_absence` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_motif_arrivee` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_motif_depart` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_motif_entretien` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_motif_greve` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_motif_sanction_disciplinaire` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_n4ds` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_nature_handicap_boeth` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_nature_lesion` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_organisme_formation` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_position_statutaire` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_pourcentage_tempa_partiel` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_sanction_disciplinaire` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_siege_lesion` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_stage_titularisation` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_statut` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_structure_origine` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_temps_non_complet` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_temps_partiel` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_tranche_age` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_type_activite` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_type_cdd` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_type_collectivite` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_type_mission_prevention` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;

UPDATE `ref_validation_experience` SET `BL_VALI`= CASE
    WHEN BL_VALI = 1 THEN 0
    WHEN BL_VALI = 0 THEN 1
    ELSE 1
    END;