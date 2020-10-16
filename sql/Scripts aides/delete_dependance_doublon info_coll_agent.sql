/*
*	Requête supprimant les dépendances de clefs étrangères pour un ligne de la table information_collectivite_agent
*	Utile pour supprimer les doublons (qui font en une page blanche à la connexion)
*	Prend en entrée (dans le WHERE) l'ID_INFOCOLLAGEN ciblé
*/

DELETE i_132, a_p, c_t, etrp_114, etrp_124, etrp_131, prev, a_v_p, sant
FROM information_colectivite_agent i_c_a
LEFT JOIN infocoll_132 i_132 ON i_132.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
LEFT JOIN action_prevention a_p ON a_p.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
LEFT JOIN conflit_travail c_t ON c_t.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
LEFT JOIN etpr_114_annee_precedente etrp_114 ON etrp_114.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
LEFT JOIN etpr_124_annee_precedente etrp_124 ON etrp_124.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
LEFT JOIN etpr_131_annee_precedente etrp_131 ON etrp_131.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
LEFT JOIN prevoyance prev ON prev.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
LEFT JOIN acte_violence_physique a_v_p ON a_v_p.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
LEFT JOIN sante sant ON sant.ID_INFOCOLLAGEN = i_c_a.ID_INFOCOLLAGEN
WHERE i_c_a.ID_INFOCOLLAGEN = "";

/*
*	Requête de suppression d'une information_collectivite_agent
*	Prend en entrée l'ID_INFOCOLLAGEN
*/

DELETE i_c_a
FROM information_colectivite_agent i_c_a
WHERE i_c_a.ID_INFOCOLLAGEN = "";