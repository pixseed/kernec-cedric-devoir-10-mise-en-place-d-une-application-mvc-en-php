<?php

declare(strict_types=1);

namespace Tests\Database;

use PDO;
use RuntimeException;

class TestDatabase
{
  /**
   * Crée et prépare la base de données dédiés aux tests.
   * ----------------------------------------------------------------------------
   * @return PDO ─ Connexion à la base de données de test
   */
  public static function create(): PDO
  {
    // Charge la configuration de la base de données.
    $config = require dirname(__DIR__) . "/../config/database.php";

    // Construit le DSN pour se connecter au serveur MySQL.
    $dsn = "mysql:host={$config["host"]};port={$config["port"]};charset={$config["charset"]}";

    // Initialise la base de données.
    $pdo = new PDO(
      $dsn,
      $config["username"],
      $config["password"],
      [
        // Déclenche une exception lorsqu'une erreur SQL survient.
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Retourne automatiquement les résultats sous forme de tableau associatif.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Utilise les vraies requêtes préparées du serveur MySQL pour une meilleure sécurité.
        PDO::ATTR_EMULATE_PREPARES => false,
      ]
    );

    $dbName = $config["dbname"];

    // Sécurise l'exécution afin de ne jamais modifier la base de développement.
    if (!str_ends_with($dbName, "_test")) {
      throw new RuntimeException(
        "La base utilisée par PHPUnit doit être une base de test."
      );
    }

    $pdo->exec("DROP DATABASE IF EXISTS `{$dbName}`");
    $pdo->exec(
      "CREATE DATABASE `{$dbName}`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci"
    );
    $pdo->exec("USE `{$dbName}`");

    $schema = file_get_contents(__DIR__ . "/../../database/schema.sql");

    if ($schema === false) {
      throw new RuntimeException(
        "Impossible de lire le schéma de la base de données."
      );
    }

    $pdo->exec($schema);

    return $pdo;
  }
}
