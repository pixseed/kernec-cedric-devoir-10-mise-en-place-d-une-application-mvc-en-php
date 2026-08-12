<?php

use App\Helpers\DateHelper;

/**
 * Variables disponibles dans cette vue :
 * @var array $trips
 * @var string $baseFolder
 */

// Configuration dynamique du header de la page.
$pageTitle = "Trajets proposés";

$pageTitleClass = !isset($_SESSION["user_id"])
  ? "visually-hidden"
  : "";

$pageActions = [];
?>

<div class="container container-page">
  <?php require __DIR__ . "/../partials/_pageHeader.php" ?>

  <?php if (!isset($_SESSION["user_id"])): ?>
    <p class="fs-3 mb-3">
      Pour obtenir plus d'informations sur un trajet, veuillez vous connecter.
    </p>
  <?php endif; ?>

  <div class="scrollable-content table-responsive flex-grow-1 border rounded bg-white">
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
          <?php if (isset($_SESSION["user_id"])): ?>
            <th>
              <span class="visually-hidden">Actions</span>
            </th>
          <?php endif; ?>
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

            <?php if (isset($_SESSION["user_id"])): ?>
              <td>
                <div class="d-flex flex-nowrap justify-content-center">
                  <button
                    type="button"
                    class="btn"
                    data-url="<?= htmlspecialchars($baseFolder . "/trips/" . $tripItem["idTrip"]) ?>"
                    aria-label="Voir les détails du trajet">
                    <i class="bi bi-eye" aria-hidden="true"></i>
                  </button>

                  <?php if (isset($_SESSION["user_id"]) && $tripItem["idUser"] === $_SESSION["user_id"]): ?>
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
                      data-details-url="<?= htmlspecialchars($baseFolder . "/trips/" . $tripItem["idTrip"]) ?>"
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
                </div>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php require __DIR__ . "/../partials/modals/_tripDetailsModal.php"; ?>
  <?php require __DIR__ . "/../partials/modals/_deleteTripModal.php"; ?>

</div>