<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class TripModel extends AbstractModel {
  /**
   * Recherche tous les trajets disponibles à venir.
   */
  public function findAllAvailable(): array
  {
    $stmt = $this->connection->prepare(
      "SELECT
          t.idTrip,
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
   * Recherche les informations complémentaires d'un trajet.
   * ----------------------------------------------------------------------------
   * @param int $idTrip ─ Identifiant unique du trajet
   */
  public function findById(int $idTrip): array
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
      WHERE t.idTrip = ?"
    );

    $stmt->execute([$idTrip]);

    $trip = $stmt->fetch();

    return $trip;
  }
}
