<?php

use App\Helpers\DateHelper;

/**
 * Variables transmises par HomeController::render() :
 * @var array $trips
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
              data-id="<?= $trip["idTrip"] ?>">
              <i class="bi bi-eye"></i>
            </button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>