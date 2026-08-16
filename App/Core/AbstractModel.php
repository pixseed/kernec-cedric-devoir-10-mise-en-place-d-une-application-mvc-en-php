<?php

namespace App\Core;

use PDO;

/**
 * Fournit les comportements communs à tous les modèles de l'application.
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

  /**
   * Compte le nombre total d'enregistrement d'une table.
   * ----------------------------------------------------------------------------
   * @param string $table ─ Nom de la table
   * @return int ─ Nombre total d'enregistrements
   */
  protected function countRecords(string $table): int
  {
    $stmt = $this->connection->query(
      "SELECT COUNT(*) FROM {$table}"
    );

    return (int) $stmt->fetchColumn();
  }
}