# CEF-symfony-stubborn

Stubborn est une boutique e-commerce développée avec Symfony, permettant à des clients de consulter des produits, créer un compte, gérer un panier, et finaliser une commande. Un espace back-office est accessibles aux utlisateurs administrateurs pour gérer les produits.

---

## Fonctionnalités principales

- Affichage des produits et ajout au panier
- Inscription et connexion utilisateur
- Gestion des stocks par taille (XS à XL)
- Espace administrateur sécurisé (ROLE_ADMIN)
- Upload d’images produits
- Création, modification et suppression de produits de la base de données
- Envoi d’emails de confirmation (simulation avec mailtrap)

---

## Installation du projet en local

``` 1 Cloner le dépôt :

git clone https://github.com/lc0362/CEF-symfony-stubborn.git
cd CEF-symfony-stubborn

``` 2 Installer les dépendances :
composer install
npm install
npm run dev

``` 3 Importer la structure de la BDD
Importer le fichier stubborn-structure.sql dans PHPMyAdmin

``` 4 Importer les données de la BDD
Deux possibilités : 
- Importer le fichier stubborn-data.sql dans PHP MyAdmin
- OU exécuter la commande php bin/console doctrine:fixtures:load

``` 5 Configurer l'environnement
Créer un fichier `.env.local` à la racine du projet  
Ajouter une ligne DATABASE_URL avec les identifiants PHPMyAdmin locaux. Ex : DATABASE_URL="mysql://root:@127.0.0.1:3306/stubborn"

``` 6 Lancer le serveur en arrière plan
symfony server:start -d

Ouvrir un navigateur et entrer l'url : http://127.0.0.1:8000


