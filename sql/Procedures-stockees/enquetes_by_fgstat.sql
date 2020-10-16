DELIMITER $$

DROP PROCEDURE IF EXISTS getResultSetEnquetesByFgStat
$$

CREATE PROCEDURE getResultSetEnquetesByFgStat(pIdCamp INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
		SELECT e.ID_ENQU,LB_ENQU,e.ID_CAMP, FG_STAT, d.LB_DEPA, d.CD_DEPA, e.BL_CLOTURE  FROM enquete e 
        JOIN departements_enquetes de ON e.ID_ENQU = de.ID_ENQU 
        JOIN departement d ON de.ID_DEPA = d.ID_DEPA
        WHERE ID_CAMP = pIdCamp AND e.FG_STAT = 1;
		
		SELECT e.ID_ENQU,LB_ENQU,e.ID_CAMP,  FG_STAT, d.LB_DEPA, d.CD_DEPA  FROM enquete e 
        JOIN departements_enquetes de ON e.ID_ENQU = de.ID_ENQU 
        JOIN departement d ON de.ID_DEPA = d.ID_DEPA 
        WHERE ID_CAMP = pIdCamp AND e.FG_STAT = 2;
		
		SELECT e.ID_ENQU,LB_ENQU,e.ID_CAMP,  FG_STAT, d.LB_DEPA, d.CD_DEPA  FROM enquete e 
        JOIN departements_enquetes de ON e.ID_ENQU = de.ID_ENQU 
        JOIN departement d ON de.ID_DEPA = d.ID_DEPA 
        WHERE ID_CAMP = pIdCamp AND e.FG_STAT = 3;
		
		SELECT e.ID_ENQU,LB_ENQU,e.ID_CAMP,  FG_STAT, d.LB_DEPA, d.CD_DEPA  FROM enquete e 
        JOIN departements_enquetes de ON e.ID_ENQU = de.ID_ENQU 
        JOIN departement d ON de.ID_DEPA = d.ID_DEPA
        WHERE ID_CAMP = pIdCamp AND e.FG_STAT = 0;
		
		SELECT cdg.ID_CDG, cdg.LB_CDG, d.CD_DEPA, d.LB_DEPA, r.DT_DERNRELA, cc.LB_MAIL
		FROM departement d
		JOIN cdg_departement cdgd ON d.ID_DEPA = cdgd.ID_DEPA
		JOIN cdg cdg ON cdgd.ID_CDG = cdg.ID_CDG
				LEFT JOIN cdg_contact cc ON cc.ID_CDG = cdg.ID_CDG AND cc.BL_CONTACT_PRINCIPAL = 1
				LEFT JOIN relance r ON r.ID_CDG = cdgd.ID_CDG
		WHERE d.ID_DEPA NOT IN (
			SELECT ID_DEPA 
			FROM departements_enquetes de
			JOIN enquete e ON e.ID_ENQU = de.ID_ENQU
			JOIN campagne c ON c.ID_CAMP = e.ID_CAMP
			WHERE c.ID_CAMP = pIdCamp
		)
		GROUP BY d.ID_DEPA, cdgd.ID_CDG;

	
 
END
$$

