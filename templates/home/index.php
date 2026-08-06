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
                aria-label="Voir les détails du trajet">
                <i class="bi bi-eye" aria-hidden="true"></i>
              </button>
              <?php if ($trip["idUser"] === $_SESSION["user_id"]): ?>
                <a
                  href="<?= htmlspecialchars($baseFolder . "/trips/edit/" . $trip["idTrip"]) ?>"
                  class="btn"
                  aria-label="Éditer le trajet">
                  <i class="bi bi-pencil-square" aria-hidden="true"></i>
                </a>
                <button
                  type="button"
                  class="btn"
                  data-action="<?= htmlspecialchars($baseFolder . "/trips/delete/" . $trip["idTrip"]) ?>"
                  aria-label="Supprimer le trajet">
                  <i class="bi bi-trash3-fill" aria-hidden="true"></i>
                </button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php require __DIR__ . "/../partials/modals/_tripDetailsModal.php"; ?>
    <?php require __DIR__ . "/../partials/modals/_deleteTripModal.php"; ?>

  </div>
</div>