<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class AgencyModel extends AbstractModel {
  /**
   * Recherche toutes les agences existantes.
   * ----------------------------------------------------------------------------
   * @return array ─ Tableau des agences
   */
  public function findAll(): array
  {
    $stmt = $this->connection->prepare(
      "SELECT 
        idAgency,
        name
      FROM agencies
      ORDER BY name"
    );

    $stmt->execute();

    return $stmt->fetchAll();
  }

  /**
   * Recherche une agence par son identifiant.
   * ----------------------------------------------------------------------------
   * @param int $idAgency ─ Identifiant unique de l'agence
   * @return array|false ─ Tableau de données de l'agence ou false si elle n'existe pas
   */
  public function findById(int $idAgency): array|false
  {
    $stmt = $this->connection->prepare(
      "SELECT
        idAgency,
        name
      FROM agencies
      WHERE idAgency = :idAgency"
    );

    $stmt->execute([
      ":idAgency" => $idAgency
    ]);

    return $stmt->fetch();
  }

  /**
   * Insert une agence dans la base.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Tableau des données à insérer dans la base
   * @return bool ─ True si l'insertion a réussi, sinon false
   */
  public function insert(array $data): bool
  {
    $stmt = $this->connection->prepare(
      "INSERT INTO agencies (name)
      VALUES (:name)"
    );

    return $stmt->execute([
      ":name" => $data["name"]
    ]);
  }

  /**
   * Met à jour une agence.
   * ----------------------------------------------------------------------------
   * @param int $idAgency ─ Identifiant unique de l'agence
   * @param array $data ─ Données à mettre à jour
   * @return bool ─ True si la modification a réussi, sinon false
   */
  public function update(int $idAgency, array $data): bool
  {
    $stmt = $this->connection->prepare(
      "UPDATE agencies
      SET name = :name
      WHERE idAgency = :idAgency"
    );

    return $stmt->execute([
      ":name"     => $data["name"],
      ":idAgency" => $idAgency
    ]);
  }

  /**
   * Supprime une agence.
   * ----------------------------------------------------------------------------
   * @param int $idAgency ─ Identifiant unique de l'agence
   * @return bool ─ True si la suppression a réussi, sinon false
   */
  public function delete(int $idAgency): bool
  {
    $stmt = $this->connection->prepare(
      "DELETE FROM agencies
      WHERE idAgency = :idAgency"
    );

    return $stmt->execute([
      ":idAgency" => $idAgency
    ]);
  }

  /**
   * Vérifie l'unicité d'une agence lors de la création ou la modification.
   * ----------------------------------------------------------------------------
   * @param string $name ─ Nom de l'agence
   * @param int|null $excludedId ─ Agence à exclure du contrôle
   * @return bool ─ true si une agence portant ce nom existe, sinon false
   */
  public function existsByName(string $name, ?int $excludedId = null): bool
  {
    $sql = "
    SELECT idAgency
    FROM agencies
    WHERE name = :name
    ";

    if ($excludedId !== null) {
      $sql .= "AND idAgency <> :idAgency";
    }
    
    $stmt = $this->connection->prepare($sql);
    
    $params = [
      ":name" => $name,
    ];
      
    if ($excludedId !== null) {
      $params[":idAgency"] = $excludedId;
    }

    $stmt->execute($params);

    // Retourne true si une agence correspondant aux critères existe.
    return (bool) $stmt->fetch();
  }
}
