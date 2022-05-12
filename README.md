# projet pour openclassrooms.com
# site communautaire symfony sur les différentes figures de snowboard

INSTALLATION

1. cloner le projet

1.1. Sur github, lorsque vous consultez le projet, en haut à droite, veuillez cliquer sur bouton vert "code", puis copier coller l'URL que vous y trouvez\
1.2. Dans un terminal, placez vous dans le dossier souhaité, et clonez le projet avec la commande « git clone [ce que vous avez copié à l'étape 1.1] »

2. Installer les fichiers manquants

2.1. Remplissez un fichier « .env » avec vos propres informations de base de données et de mail\
2.2. Lancez la commande « composer install » pour installer toutes les dépendances\
2.3. Si nécessaire, faites "composer update"\
2.4. Configurez un fichier « config/packages/swiftmailer.yaml » avec vos données de mail

3. Base de données

3.1. Créez la base de données en lignes de commande : « symfony console doctrine:database:create »\
3.2. Ouvrez la base de données créée via phpmyadmin\
3.3. Importez, depuis phpmyadmin, la base de données, contenue dans le fichier "database.sql" de ce repository.\

4. Test

4.1 Vous pouvez tester le site via votre navigateur, à l'adresse localhost:8000\
4.2 Vous pouvez vous connecter à un compte de test, avec le login "user_test", et le mot de passe "user_test".
