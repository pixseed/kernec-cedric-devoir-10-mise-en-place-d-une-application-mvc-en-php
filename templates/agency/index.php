<?php

/**
 * Variables disponibles dans cette vue :
 * @var array $agencies
 * @var string $baseFolder
 */

// Configuration dynamique du header de la page.
$pageTitle = "Liste des agences";

$pageActions = [
  [
    "url" => $baseFolder . "/admin",
    "label" => "Tableau de bord",
    "icon" => "bi-house-fill",
    "class" => "btn-outline-dark"
  ]
];
?>

<div class="container container-page">
  <?php require __DIR__ . "/../partials/_pageHeader.php"; ?>

  <div class="row content-row g-3">

    <div class="col-12 col-lg-6 d-flex flex-column order-2 order-lg-1">
      <div class="scrollable-content border rounded">
        <table class="table table-bordered table-striped table-hover align-middle text-center mb-0">
          <thead class="table-dark">
            <tr>
              <th>Agence</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($agencies as $agencyItem): ?>
              <tr>
                <td><?= htmlspecialchars($agencyItem["name"]) ?></td>
                <td>
                  <a
                    href="<?= htmlspecialchars($baseFolder . "/agencies/edit/" . $agencyItem["idAgency"]) ?>"
                    class="btn"
                    aria-label="Éditer l'agence">
                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                  </a>
                  <button
                    type="button"
                    class="btn"
                    data-delete-agency
                    data-action="<?= htmlspecialchars($baseFolder . "/agencies/delete/" . $agencyItem["idAgency"]) ?>"
                    data-name="<?= htmlspecialchars($agencyItem["name"]) ?>"
                    aria-label="Supprimer l'agence">
                    <i class="bi bi-trash3-fill" aria-hidden="true"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>

    <div class="col-12 col-lg-6 d-flex flex-column order-1 order-lg-2">
      <div class="scrollable-content">
      <?php require __DIR__ . "/_form.php"; ?>
      </div>
    </div>

  </div>

  <?php require __DIR__ . "/../partials/modals/_deleteAgencyModal.php"; ?>

</div>