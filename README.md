Application de saisie des Bilan Sociaux
===

## Installation environnement Docker

1. Clone project
```bash
git clone -b develop git@git.iorga.com:CIG/bilan_social.git
```

2. Move in source directory
```bash
cd bilan_social
```

3. Launch docker container (web, mysql, phpmyadmin, maildev)
```bash
docker-compose up -d --build
```
   **Attention utiliser "mysql" pour "database_host"**

4. Enter in web container
```bash
docker exec -itu apache bilansocial_web_1 bash
```
  **bilansocial_web_1** est le nom du service docker WEB

5. Install dependencies
```bash
composer install
```

6. Look at the logs (directly from bash, not from the Docker container)
```bash
docker exec -it bilansocial_web_1 bash -c "tail -f /var/log/apache2/*"
```

7. Installer les librairies JS clientes
```bash
cd web
yarn install
```