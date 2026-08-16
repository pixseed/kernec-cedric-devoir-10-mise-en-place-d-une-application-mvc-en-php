<?php

namespace App\Core;

use PDO;

/**
 * Fournit une connexion à la base de données à tous les modèles de l'application.
 */
abstract class AbstractModel
{
  protected PDO $connection;

  /**
   * Initialise automatiquement la connexion PDO.
   * ----------------------------------------------------------------------------
   * @param PDO|null $connection ─ Connexion PDO à utiliser si elle est fournie
   */
  public function __construct(?PDO $connection = null)
  {
    if ($connection !== null) {
      $this->connection = $connection;

      return;
    }

    $database = new Database();
    $this->connection = $database->getConnection();
  }
}