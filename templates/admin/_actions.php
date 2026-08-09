<?php

/**
 * Variables disponibles dans cette vue :
 * @var string $baseFolder
 * @var int $numberUsers
 * @var int $numberTrips
 * @var int $numberAgencies
 */

$actions = [
  [
    "title" => "Utilisateurs",
    "value" => $numberUsers,
    "icon" => "people-fill",
    "description" => "Consulter la liste complète des utilisateurs.",
    "buttonLabel" => "Consulter",
    "url" => $baseFolder . "/users",
  ],
  [
    "title" => "Trajets",
    "value" => $numberTrips,
    "icon" => "car-front-fill",
    "description" => "Gérer les trajets.",
    "buttonLabel" => "Gérer",
    "url" => $baseFolder . "/trips",
  ],
  [
    "title" => "Agences",
    "value" => $numberAgencies,
    "icon" => "building",
    "description" => "Gérer les agences.",
    "buttonLabel" => "Gérer",
    "url" => $baseFolder . "/agencies",
  ],
]
?>

<div class="card">
  <div class="card-header">
    <h2 class="h5 mb-0">
      <i class="bi bi-lightning-charge-fill" aria-hidden="true"></i>
      Actions rapides
    </h2>
  </div>
  <div class="card-body">
    <div class="row g-4">
      <?php foreach ($actions as $action): ?>
        <div class="col-lg-4">
          <?php extract($action); ?>
          <?php require __DIR__ . "/partials/_actionCard.php"; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>