# ArrasGame

## Introduction
ArrasGame est une plateforme web permettant aux utilisateurs de s'inscrire à des tournois, de gérer les inscriptions et d'administrer les utilisateurs. Le site propose des fonctionnalités adaptées aux utilisateurs et aux administrateurs.

## Installation
1. Clonez le dépôt :
   ```bash
   git clone [URL_DU_DEPOT]
   ```
2. Placez le projet dans le répertoire de votre serveur local (ex. : `c:\laragon\www\ArrasGame`).
3. Configurez la base de données :
   - Créez une base de données nommée `ArrasGame`.
   - Importez le fichier SQL contenant la structure et les données nécessaires.
4. Configurez la connexion à la base de données dans `connexion.php` :
   ```php
   $host = '127.0.0.1';
   $dbname = 'ArrasGame';
   $username = 'UtilisateurPHPmyAdmin';
   $password = 'MotDePassePHPmyAdmin';
   ```
5. Lancez votre serveur local (ex. : Laragon, XAMPP) et accédez au site via `http://localhost/ArrasGame`.

## Structure du projet
- **index.php** : Page d'accueil du site.
- **login.html** : Page de connexion des utilisateurs.
- **register1.php** et **register2.php** : Pages d'inscription des utilisateurs.
- **tournois.php** : Liste des tournois et gestion des inscriptions.
- **profile_admin.php** : Gestion des utilisateurs pour les administrateurs.
- **create_tournament.php**, **edit_tournament.php**, **delete_tournament.php** : Gestion des tournois.
- **create_user_form.php**, **create_user.php**, **edit_user.php**, **delete_user.php** : Gestion des utilisateurs.
- **register_tournament.php** : Inscription des utilisateurs aux tournois.
- **delete_inscription.php**, **edit_inscription.php**, **create_inscription.php** : Gestion des inscriptions.
- **connexion.php** : Fichier de connexion à la base de données.
- **css/** : Contient les fichiers CSS pour le style.
- **js/** : Contient les fichiers JavaScript pour les interactions.

## Fonctionnalités principales
### Utilisateurs
- Inscription et connexion sécurisées.
- Inscription à des tournois ouverts.
- Désinscription des tournois auxquels ils participent.

### Administrateurs
- Gestion des utilisateurs : création, modification et suppression.
- Gestion des tournois : création, modification et suppression.
- Gestion des inscriptions : création, modification et suppression.

## API (Endpoints principaux)
### Inscription d'un utilisateur
- **URL** : `/register2.php`
- **Méthode** : POST
- **Paramètres** :
  ```json
  {
    "username": "string",
    "email": "string",
    "password": "string"
  }
  ```

### Connexion d'un utilisateur
- **URL** : `/login.php`
- **Méthode** : POST
- **Paramètres** :
  ```json
  {
    "username": "string",
    "password": "string"
  }
  ```

### Inscription à un tournoi
- **URL** : `/register_tournament.php`
- **Méthode** : POST
- **Paramètres** :
  ```json
  {
    "tournoi_id": "integer"
  }
  ```

## Dépendances
- **PHP** : Langage principal pour le backend.
- **MySQL** : Base de données pour stocker les utilisateurs, tournois et inscriptions.
- **Bootstrap** : Framework CSS pour le design.
- **jQuery** : Bibliothèque JavaScript pour les interactions.

## Contributions
1. Forkez le dépôt.
2. Créez une branche pour vos modifications :
   ```bash
   git checkout -b feature/nom-de-la-fonctionnalité
   ```
3. Soumettez une pull request.

## Licence
Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).
