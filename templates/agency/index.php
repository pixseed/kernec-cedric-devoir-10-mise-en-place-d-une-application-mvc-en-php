<?php

/**
 * Variables disponibles dans cette vue :
 * @var array $agencies
 * @var string $baseFolder
 */
?>

<div class="container">
  <h1 class="display-6 fw-bold mb-4">Liste des agences</h1>

  <div class="row">
    <div class="col-6">
      <div class="table-responsive border rounded">
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

    <div class="col-6">
      <?php require __DIR__ . "/_form.php"; ?>
    </div>

  </div>

  <?php require __DIR__ . "/../partials/modals/_deleteAgencyModal.php"; ?>

</div>