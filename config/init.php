<?php

declare(strict_types=1);

use Dotenv\Dotenv;

// Charge automatiquement les classes via Composer.
require_once dirname(__DIR__) . "/vendor/autoload.php";

// Charge les variables d'environnement (.env)
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();