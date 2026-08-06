<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class AgencyModel extends AbstractModel {
  public function getAll(): array
  {
    $stmt = $this->connection->prepare(
      "SELECT idAgency, name
      FROM agencies
      ORDER BY name"
    );

    $stmt->execute();

    $agencies = $stmt->fetchAll();

    return $agencies;
  }
}
