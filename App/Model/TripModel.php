<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class TripModel extends AbstractModel {
  /**
   * Recherche tous les trajets disponibles à venir.
   * ----------------------------------------------------------------------------
   */
  public function findAllAvailable(): array
  {
    $stmt = $this->connection->prepare(
      "SELECT
          t.idTrip,
          t.idUser,
          sa.name AS departure,
          t.startDate,
          t.startHour,
          ea.name AS arrival,
          t.endDate,
          t.endHour,
          t.availableSeats
      FROM trips t
      INNER JOIN agencies sa
          ON t.idStartAgency = sa.idAgency
      INNER JOIN agencies ea
          ON t.idEndAgency = ea.idAgency
      WHERE t.availableSeats > 0
          AND TIMESTAMP(t.startDate, t.startHour) >= NOW()
      ORDER BY t.startDate, t.startHour"
    );

    $stmt->execute();

    $trips = $stmt->fetchAll();

    return $trips;
  }

  /**
   * Recherche les informations complémentaires d'un trajet à partir de son identifiant.
   * ----------------------------------------------------------------------------
   * @param int $idTrip ─ Identifiant unique du trajet
   * @return array|false ─ Tableau de données complémentaire du trajet ou false s'il n'existe pas
   */
  public function findDetailsById(int $idTrip): array|false
  {
    $stmt = $this->connection->prepare(
      "SELECT
          CONCAT(u.lastName, ' ', u.firstName) AS author,
          u.phone,
          u.email,
          t.numberSeats
      FROM trips t
      INNER JOIN users u
          ON t.idUser = u.idUser
      WHERE t.idTrip = :idTrip"
    );

    $stmt->execute([
      ":idTrip" => $idTrip
    ]);

    $trip = $stmt->fetch();

    return $trip;
  }

  /**
   * Recherche un trajet à partir de son identifiant.
   * ----------------------------------------------------------------------------
   * @param int $idTrip ─ Identifiant unique du trajet
   * @return array|false ─ Tableau de données du trajet ou false s'il n'existe pas
   */
  public function findById(int $idTrip): array|false
  {
    $stmt = $this->connection->prepare(
      "SELECT
        idTrip,
        startDate,
        startHour,
        endDate,
        endHour,
        numberSeats,
        availableSeats,
        idUser,
        idStartAgency,
        idEndAgency
      FROM trips
      WHERE idTrip = :idTrip"
    );

    $stmt->execute([
      ":idTrip" => $idTrip
    ]);

    return $stmt->fetch();
  }

  /**
   * Insert les données de création de trajet dans la base.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Tableau des données à insérer dans la base
   * @return bool ─ True si le trajet a été créé avec succès, sinon false
   */
  public function insert(array $data): bool
  {
    $stmt = $this->connection->prepare(
      "INSERT INTO trips
      (
          startDate,
          startHour,
          endDate,
          endHour,
          numberSeats,
          availableSeats,
          idUser,
          idStartAgency,
          idEndAgency
      )
      VALUES (
          :startDate,
          :startHour,
          :endDate,
          :endHour,
          :numberSeats,
          :availableSeats,
          :idUser,
          :idStartAgency,
          :idEndAgency
      );"
    );

    return $stmt->execute([
      ":startDate"      => $data["startDate"],
      ":startHour"      => $data["startHour"],
      ":endDate"        => $data["endDate"],
      ":endHour"        => $data["endHour"],
      ":numberSeats"    => $data["numberSeats"],
      ":availableSeats" => $data["availableSeats"],
      ":idUser"         => $data["idUser"],
      ":idStartAgency"  => $data["idStartAgency"],
      ":idEndAgency"    => $data["idEndAgency"]
    ]);
  }

  /**
   * Met à jour les données du trajet dans la base.
   * ----------------------------------------------------------------------------
   * @param int $idTrip ─ Identifiant unique du trajet modifié
   * @param array $data ─ Données à mettre à jour
   * @return bool ─ True si le trajet a été modifié avec succès, sinon false
   */
  public function update(int $idTrip, array $data): bool
  {
    $stmt = $this->connection->prepare(
      "UPDATE trips
      SET
        startDate = :startDate,
        startHour = :startHour,
        endDate = :endDate,
        endHour = :endHour,
        numberSeats = :numberSeats,
        availableSeats = :availableSeats,
        idStartAgency = :idStartAgency,
        idEndAgency = :idEndAgency
      WHERE idTrip = :idTrip"
    );

    return $stmt->execute([
      ":startDate"      => $data["startDate"],
      ":startHour"      => $data["startHour"],
      ":endDate"        => $data["endDate"],
      ":endHour"        => $data["endHour"],
      ":numberSeats"    => $data["numberSeats"],
      ":availableSeats" => $data["numberSeats"],
      ":idStartAgency"  => $data["idStartAgency"],
      ":idEndAgency"    => $data["idEndAgency"],
      ":idTrip"         => $idTrip,
    ]);
  }

  /**
   * Supprime un trajet dans la base.
   * ----------------------------------------------------------------------------
   */
  public function delete(int $idTrip): bool
  {
    $stmt = $this->connection->prepare(
      "DELETE FROM trips
      WHERE idTrip = :idTrip"
    );

    return $stmt->execute([
      ":idTrip" => $idTrip
    ]);
  }
}
