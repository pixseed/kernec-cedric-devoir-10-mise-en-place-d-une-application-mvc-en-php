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
   */
  public function __construct()
  {
    $config = require __DIR__ . "/../../config/database.php";

    try {
      $this->connection = new PDO(
        "mysql:host={$config["host"]};dbname={$config["dbname"]};charset={$config["charset"]}",
        $config["username"],
        $config["password"],
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
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
   * Retourne l'instance PDO.
   */
  public function getConnection(): PDO
  {
    return $this->connection;
  }
}