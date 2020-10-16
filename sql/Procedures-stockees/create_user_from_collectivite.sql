DELIMITER $$

DROP PROCEDURE IF EXISTS create_user_from_collectivite
$$

CREATE PROCEDURE create_user_from_collectivite()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	
    INSERT INTO utilisateur (id_coll, fg_blocage, username, password, lb_pass_temp, is_active, roles, email, cd_utilcrea, fg_stat)
    SELECT c.id_coll, 0, c.nm_sire, 'siret', 'siret', 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', NULL, 'ADMIN', 0
    FROM collectivite c
    WHERE c.cd_utilcrea = 'Import'
    AND c.nm_sire NOT IN(SELECT u2.username FROM utilisateur u2);

END
$$
