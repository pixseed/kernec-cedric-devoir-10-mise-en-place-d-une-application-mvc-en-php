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
        <?php foreach ($trips as $tripItem): ?>
          <tr>
            <td><?= htmlspecialchars($tripItem["departure"]) ?></td>
            <td><?= htmlspecialchars(DateHelper::formatDate($tripItem["startDate"])) ?></td>
            <td><?= htmlspecialchars(DateHelper::formatHour($tripItem["startHour"])) ?></td>
            <td><?= htmlspecialchars($tripItem["arrival"]) ?></td>
            <td><?= htmlspecialchars(DateHelper::formatDate($tripItem["endDate"])) ?></td>
            <td><?= htmlspecialchars(DateHelper::formatHour($tripItem["endHour"])) ?></td>
            <td><?= htmlspecialchars($tripItem["availableSeats"]) ?></td>

            <td>
              <button
                type="button"
                class="btn"
                data-url="<?= htmlspecialchars($baseFolder . "/trips/" . $tripItem["idTrip"]) ?>"
                aria-label="Voir les détails du trajet">
                <i class="bi bi-eye" aria-hidden="true"></i>
              </button>
              <?php if ($tripItem["idUser"] === $_SESSION["user_id"]): ?>
                <a
                  href="<?= htmlspecialchars($baseFolder . "/trips/edit/" . $tripItem["idTrip"]) ?>"
                  class="btn"
                  aria-label="Éditer le trajet">
                  <i class="bi bi-pencil-square" aria-hidden="true"></i>
                </a>
                <button
                  type="button"
                  class="btn"
                  data-action="<?= htmlspecialchars($baseFolder . "/trips/delete/" . $tripItem["idTrip"]) ?>"
                  data-delete-trip
                  data-departure="<?= htmlspecialchars($tripItem["departure"]) ?>"
                  data-start-date="<?= htmlspecialchars(DateHelper::formatDate($tripItem["startDate"])) ?>"
                  data-start-hour="<?= htmlspecialchars(DateHelper::formatHour($tripItem["startHour"])) ?>"
                  data-arrival="<?= htmlspecialchars($tripItem["arrival"]) ?>"
                  data-end-date="<?= htmlspecialchars(DateHelper::formatDate($tripItem["endDate"])) ?>"
                  data-end-hour="<?= htmlspecialchars(DateHelper::formatHour($tripItem["endHour"])) ?>"
                  aria-label=" Supprimer le trajet">
                  <i class="bi bi-trash3-fill" aria-hidden="true"></i>
                </button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php require __DIR__ . "/../partials/modals/_tripDetailsModal.php"; ?>
  <?php require __DIR__ . "/../partials/modals/_deleteTripModal.php"; ?>

</div>