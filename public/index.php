<?php

declare(strict_types=1);

use App\Core\Router;

session_start();

require_once __DIR__ . "/../config/init.php";

// Charge la configuration de l'application.
$config = require __DIR__ . "/../config/app.php";

// Crée le routeur.
$router = new Router();

// Enregistre toutes les routes.
require __DIR__ . "/../config/routes.php";

// Lance le traitement de la requête.
$router->dispatch(
  $_SERVER["REQUEST_METHOD"],
  $_SERVER["REQUEST_URI"],
  $config["base_url"]
);