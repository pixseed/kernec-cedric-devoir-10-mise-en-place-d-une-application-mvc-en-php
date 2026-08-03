<?php

declare(strict_types=1);

use Buki\Router\Router;

// Démarre la session PHP.
session_start();

// Charge la configuration de l'initialisation de l'application.
require_once __DIR__ . "/../config/init.php";

// Charge les paramètres de configuration de l'application.
$config = require __DIR__ . "/../config/app.php";

// Initialise le routeur.
$router = new Router([
  
  "base_folder" => $config["base_folder"],

  "paths" => [
    "controllers" => __DIR__ . "/../App/Controller",
  ],

  "namespaces" => [
    "controllers" => "App\Controller",
  ],

  "debug" => $config["debug"],
]);

// Charge toutes les routes de l'application.
require __DIR__ . "/../config/routes.php";

// Analyse la requête HTTP et exécute le contrôleur correspondant.
$router->run();