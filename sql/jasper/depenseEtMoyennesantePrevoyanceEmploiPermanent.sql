SELECT * FROM(
	SELECT(
		SELECT SUM(COALESCE(R_71411 * R_71412,0))
		FROM ind_7141
		WHERE ID_BILASOCICONS = 87
	) NB_DEPESANTE,
	(
		SELECT SUM(COALESCE(R_71411,0))
		FROM ind_7141
		WHERE ID_BILASOCICONS = 87
	) NB_BENESANTE,
	(
		SELECT SUM(COALESCE(R_71421 * R_71422,0))
		FROM ind_7142
		WHERE ID_BILASOCICONS = 87
	) NB_DEPEPREV,
	(
		SELECT SUM(COALESCE(R_71421,0))
		FROM ind_7142
		WHERE ID_BILASOCICONS = 87
	) NB_BENEPREV,
	"first_line" LB_ISFOR
	FROM bilan_social_consolide
	WHERE ID_BILASOCICONS = 87
	UNION
	SELECT(
		SELECT SUM(COALESCE(R_71411 * R_71412,0))
		FROM ind_7141
		WHERE ID_BILASOCICONS = 87
	) NB_DEPESANTE,
	(
		SELECT SUM(COALESCE(R_71411,0))
		FROM ind_7141
		WHERE ID_BILASOCICONS = 87
	) NB_BENESANTE,
	(
		SELECT SUM(COALESCE(R_71421 * R_71422,0))
		FROM ind_7142
		WHERE ID_BILASOCICONS = 87
	) NB_DEPEPREV,
	(
		SELECT SUM(COALESCE(R_71421,0))
		FROM ind_7142
		WHERE ID_BILASOCICONS = 87
	) NB_BENEPREV,
	"second_line" LB_ISFOR
	FROM bilan_social_consolide
	WHERE ID_BILASOCICONS = 87
)