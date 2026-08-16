<?php

declare(strict_types=1);

use Dotenv\Dotenv;

// Charge automatiquement les classes via Composer.
require_once dirname(__DIR__) . "/vendor/autoload.php";

// Charge les variables d'environnement dédiées aux tests.
$dotenv = Dotenv::createImmutable(dirname(__DIR__),".env.test");
$dotenv->load();