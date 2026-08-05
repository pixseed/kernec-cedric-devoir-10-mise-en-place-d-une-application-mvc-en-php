<?php

use App\Helpers\DateHelper;

/**
 * Variables disponibles dans cette vue :
 * @var array $trips
 * @var string $baseFolder
 */
?>

<div class="container">
  <h1 class="display-6 fw-bold mb-4">Trajets proprosés</h1>

  <div class="table-responsive border rounded">
    <table class="table table-bordered table-striped table-hover align-middle text-center mb-0">
      <thead class="table-dark">
        <tr>
          <th>Départ</th>
          <th>Date</th>
          <th>Heure</th>
          <th>Destination</th>
          <th>Date</th>
          <th>Heure</th>
          <th>Places</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($trips as $trip): ?>
          <tr>
            <td><?= htmlspecialchars($trip["departure"]) ?></td>
            <td><?= htmlspecialchars(DateHelper::formatDate($trip["startDate"])) ?></td>
            <td><?= htmlspecialchars(DateHelper::formatHour($trip["startHour"])) ?></td>
            <td><?= htmlspecialchars($trip["arrival"]) ?></td>
            <td><?= htmlspecialchars(DateHelper::formatDate($trip["endDate"])) ?></td>
            <td><?= htmlspecialchars(DateHelper::formatHour($trip["endHour"])) ?></td>
            <td><?= htmlspecialchars($trip["availableSeats"]) ?></td>

            <td>
              <button
              type="button"
              class="btn"
              data-url="<?= htmlspecialchars($baseFolder . "/trips/" . $trip["idTrip"]) ?>"
              aria-label="Voir les détails du trajet"
              >
              <i class="bi bi-eye" aria-hidden="true"></i>
            </button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>

    <div
      class="modal fade"
      id="tripDetailsModal"
      tabindex="-1"
      aria-labelledby="tripDetailsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="tripDetailsModalLabel">Détails du trajet</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <dl class="row mb-0">
              <dt class="col-sm-4">Auteur</dt>
              <dd class="col-sm-8" id="tripAuthor"></dd>

              <dt class="col-sm-4">Téléphone</dt>
              <dd class="col-sm-8" id="tripPhone"></dd>

              <dt class="col-sm-4">Email</dt>
              <dd class="col-sm-8" id="tripEmail"></dd>

              <dt class="col-sm-4">Nombre total de places</dt>
              <dd class="col-sm-8" id="tripNumberSeats"></dd>
            </dl>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>