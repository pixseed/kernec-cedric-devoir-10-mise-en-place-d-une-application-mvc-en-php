# Devoir 10 - Mise en place d'une application MVC en PHP

Projet réalisé dans le cadre de la formation Développeur Web et Web Mobile (DWWM) du CEF.

Le projet consiste à développer une application de covoiturage interne en PHP orienté objet en respectant une architecture MVC.

---

## Sommaire

- [Devoir 10 - Mise en place d'une application MVC en PHP](#devoir-10---mise-en-place-dune-application-mvc-en-php)
  - [Sommaire](#sommaire)
  - [Technologie](#technologie)
  - [Structure](#structure)
  - [Fonctionnalités](#fonctionnalités)
  - [Installation](#installation)
    - [1. Cloner le dépôt](#1-cloner-le-dépôt)
    - [2. Installer les dépendances PHP](#2-installer-les-dépendances-php)
    - [3. Installer les dépendances JavaScript](#3-installer-les-dépendances-javascript)
    - [4. Configurer les variables d'environnement](#4-configurer-les-variables-denvironnement)
    - [5. Initialiser la base de données](#5-initialiser-la-base-de-données)
    - [6. Compiler Sass](#6-compiler-sass)
    - [7. Démarrer le serveur](#7-démarrer-le-serveur)
  - [Qualité du code](#qualité-du-code)
    - [Analyse statique](#analyse-statique)
    - [Tests unitaires](#tests-unitaires)

---

## Technologie

| Technologie | Version |
|-------------|---------|
| PHP | ![PHP](https://img.shields.io/badge/8.2-4F5B93?logo=php&logoColor=white)|
| MySQL | ![MySQL](https://img.shields.io/badge/8.0-f29221?logo=mysql&logoColor=white) |
| Composer |![Composer](https://img.shields.io/badge/2.10-brown?logo=composer&logoColor=white) |
| Bootstrap | ![Bootstrap](https://img.shields.io/badge/5.3.8-712cf9?logo=bootstrap&logoColor=white) |
| Sass | ![Sass](https://img.shields.io/badge/1.102.0-c69?logo=sass&logoColor=white) |
| Dotenv | ![Sass](https://img.shields.io/badge/5.6.4-F1F45A?logo=dotenv&logoColor=black) |
| PHPStan | ![Sass](https://img.shields.io/badge/2.2-793862?logo=php&logoColor=white) |
| PHPUnit | ![Sass](https://img.shields.io/badge/11.5-793862?logo=php&logoColor=white) |

PHP 8.2.12 
- PHP 8
- MySQL
- Composer
- Bootstrap 5
- Sass
- Dotenv

---

## Structure

```
├── App/
│   ├── Controller/
│   │   ├── AgencyController.php
│   │   ├── AuthController.php
│   │   ├── ErrorController.php
│   │   └── HomeController.php
│   │
│   ├── Core/
│   │   ├── AbstractController.php
│   │   ├── AbstractModel.php
│   │   ├── Database.php
│   │   └── Router.php
│   │
│   └── Model/
│       ├── AgencyModel.php
│       ├── TripModel.php
│       └── UserModel.php
│
├── config/
│   ├── app.php
│   ├── database.php
│   ├── init.php
│   └── routes.php
│
├── database/
│   ├── init.php
│   ├── queries.sql
│   ├── schema.sql
│   └── seed.sql
│
├── docs/
│   ├── assets/
│   ├── briefs/
│   ├── src/
│   ├── styles/
│   ├── project.md
│   └── project.pdf
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── img/
│   │   ├── js/
│   │   └── scss/
│   ├── .htaccess
│   └── index.php
│
├── templates/
│   ├── agency/
│   ├── auth/
│   ├── errors/
│   ├── home/
│   ├── layouts/
│   ├── partials/
│   └── trip/
│
├── tests/
│
├── vendor/
│
├── .env
├── .env.example
├── .gitignore
├── composer.json
├── composer.lock
├── package-lock.json
├── package.json
└── README.md
```

## Fonctionnalités

- Architecture MVC
- Autoload PSR-4
- Variables d'environnement avec Dotenv
- Initialisation automatique de la base de données
- Analyse statique avec PHPStan
- Tests unitaires avec PHPUnit
- Compilation Sass

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/pixseed/kernec-cedric-devoir-10-mise-en-place-d-une-application-mvc-en-php.git
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances JavaScript

```bash
npm install
```

### 4. Configurer les variables d'environnement

```bash
cp .env.example .env
```

Puis compléter les informations de connexion à la base.

### 5. Initialiser la base de données

```bash
composer db:init
```

### 6. Compiler Sass

```bash
npm run sass
```

### 7. Démarrer le serveur

Démarrer le serveur web (Apache, XAMPP, WAMPP...) puis accéder au projet via le navigateur.

---

## Qualité du code

### Analyse statique

```bash
composer analyse
```
### Tests unitaires

```bash
composer test
```