DELIMITER $$

DROP TRIGGER IF EXISTS BSC_BU_On_Statut_Change
$$

CREATE TRIGGER BSC_BU_On_Statut_Change
BEFORE UPDATE
ON bilan_social_consolide FOR EACH ROW
BEGIN
  DECLARE sumValue INT;
  
  IF new.FG_STAT = '2' THEN

    # Le nouveau statut du BSC est "Validé"
    # On effectue les aggregats de comptage des agents

    SELECT SUM(IFNULL(R_1115, 0) + IFNULL(R_1116, 0))
    INTO sumValue
    FROM ind_111
    WHERE ID_BILASOCICONS = new.ID_BILASOCICONS;

    SET new.NB_AGENT_TITULAIRE = sumValue;

    SELECT SUM(IFNULL(R_1219, 0) + IFNULL(R_12110, 0))
    INTO sumValue
    FROM ind_121
    WHERE ID_BILASOCICONS = new.ID_BILASOCICONS;

    SET new.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT = sumValue;

    SELECT SUM(IFNULL(R_13111, 0) + IFNULL(R_13112, 0))
    INTO sumValue
    FROM ind_1311
    WHERE ID_BILASOCICONS = new.ID_BILASOCICONS;

    SET new.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT = sumValue;

    # Calcul inutile si création colonne en tant que colonne calculée !
    SET new.NB_AGENT_EMPLOI_PERMANENT = IFNULL(new.NB_AGENT_TITULAIRE, 0) + IFNULL(new.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT, 0);
  ELSE
    # Quelque soit l'état, si différent de "Validé" alors on reset

    SET new.NB_AGENT_TITULAIRE = NULL;
    SET new.NB_AGENT_CONTRACTUEL_EMPLOI_PERMANENT = NULL;
    SET new.NB_AGENT_CONTRACTUEL_EMPLOI_NON_PERMANENT = NULL;
    SET new.NB_AGENT_EMPLOI_PERMANENT = NULL;
  END IF;
END
$$

# On force le recalcul des aggregats pour les BSC existants
# UPDATE bilan_social_consolide
# SET FG_STAT = '2'
# WHERE FG_STAT = '2';
