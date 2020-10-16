Passer les scripts suivants dans l'ordre indiqué en se connectant en ligne de commande au serveur de recette
1-Init-database-recette.sql
2-init-database-collectivite-recette.sql
3-init-database-utilisateur-collectivite-recette.sql

Se positionner au sein du répertoire en local où se trouve les fichiers SQL avec la commande "cd" via cmd de window
mysql -h 217.182.87.53 -u root -pF1IK-)06EpjLq?lXv%nF^9R[ bs < 1-Init-database-recette.sql // à faire sur phpmyadmin
mysql -h 217.182.87.53 -u root -p bs < 2-init-database-collectivite-recette.sql 
	-- Demande de mot de passe en console
mysql -h 217.182.87.53 -u root -p bs < 3-init-database-utilisateur-collectivite-recette.sql
	-- Demande de mot de passe en console