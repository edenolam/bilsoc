Passer les scripts suivants dans l'ordre indiqué en se connectant en ligne de commande au serveur de production/formation
1-Init-database-formation.sql
2-init-database-collectivite-formation.sql
3-init-database-utilisateur-collectivite-formation.sql

Se positionner au sein du répertoire en local où se trouve les fichiers SQL avec la commande "cd"
mysql -h 54.37.20.225 -u root -pJZVp${YziNZ0J5{H$&=X:|it bs < 1-Init-database-formation.sql
mysql -h 54.37.20.225 -u root -pJZVp${YziNZ0J5{H$&=X:|it bs < 2-init-database-collectivite-formation.sql
mysql -h 54.37.20.225 -u root -pJZVp${YziNZ0J5{H$&=X:|it bs < 3-init-database-utilisateur-collectivite-formation.sql

