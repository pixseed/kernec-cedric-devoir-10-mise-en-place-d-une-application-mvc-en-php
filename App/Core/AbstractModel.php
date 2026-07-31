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
   */
  public function __construct()
  {
    $database = new Database();
    $this->connection = $database->getConnection();
  }
}