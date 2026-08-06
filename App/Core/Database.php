<?php

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

/**
 * Gère la connexion à la base de données.
 */
class Database
{
  private ?PDO $connection = null;

  /**
   * Établit la connexion PDO à partir de la configuration.
   * ----------------------------------------------------------------------------
   */
  public function __construct()
  {
    $config = require __DIR__ . "/../../config/database.php";

    try {
      // Construit le DSN pour se connecter au serveur MySQL.
      $this->connection = new PDO(
        "mysql:host={$config["host"]};port={$config["port"]};dbname={$config["dbname"]};charset={$config["charset"]}",
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

    } catch (PDOException $e) {
      throw new RuntimeException(
        "Erreur de connexion à la base de données.",
        0,
        $e
      );
    }
  }

  /**
   * Retourne l'instance PDO de connexion à la base de données.
   * ----------------------------------------------------------------------------
   */
  public function getConnection(): PDO
  {
    return $this->connection;
  }
}