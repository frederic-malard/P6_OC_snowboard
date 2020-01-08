# projet pour openclassrooms.com
# site communautaire symfony sur les différentes figures de snowboard

INSTALLATION

1. cloner le projet

1.1. Sur github, lorsque vous consultez le projet, en haut à droite, veuillez cliquer sur le bouton vert « clone or download » et copier le texte indiqué.\n
1.2. Dans un terminal, placez vous dans le dossier souhaité, et clonez le projet avec la commande « git clone [ce que vous avez copié à l'étape 1.1] »

2. Installer les fichiers manquants

2.1. Lancez la commande « composer install » pour installer toutes les dépendances\n
2.2. Remplissez un fichier « .env » avec vos propres informations de base de données et de mail\n
2.3. Configurez un fichier « config/packages/swiftmailer.yaml » avec vos données de mail

3. Base de données

3.1. Créez la base de données en lignes de commande : « bin/console doctrine:database:create »\n
3.2. Créez les tables : « bin/console doctrine:migrations:migrate »\n
3.3. Lancez la commande « bin/console doctrine:fixtures:load » pour remplir votre base de données avec les données initiales
