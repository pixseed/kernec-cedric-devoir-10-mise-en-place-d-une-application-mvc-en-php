<?php

$modalId = "deleteTripModal";
$modalLabelId = "deleteTripModalLabel";
$modalTitle = "Confirmer la suppression";

ob_start();
?>

<p>
  Êtes-vous sûr de vouloir <strong>supprimer</strong> ce trajet ?
</p>

<div class="d-flex align-items-center gap-3 mb-3">

  <div class="flex-fill">
    <div class="border rounded p-3 bg-body-tertiary">
      <div>
        <div class="small text-muted mb-2">
          Départ
        </div>
        <div id="delete-trip-departure" class="fw-semibold mb-2"></div>
      </div>

      <hr>

      <div class="d-flex column gap-4">
        <div>
          <div class="small text-muted mb-2">
            Date
          </div>
          <div id="delete-trip-start-date" class="mb-2"></div>
        </div>

        <div>
          <div class="small text-muted mb-2">
            Heure
          </div>
          <div id="delete-trip-start-hour"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="text-muted fs-3">
    <i class="bi bi-arrow-right"></i>
  </div>

  <div class="flex-fill">
    <div class="border rounded p-3 bg-body-tertiary">
      <div>
        <div class="small text-muted mb-2">
          Arrivée
        </div>
        <div id="delete-trip-arrival" class="fw-semibold mb-2"></div>
      </div>

      <hr>

      <div class="d-flex column gap-4">
        <div>
          <div class="small text-muted mb-2">
            Date
          </div>
          <div id="delete-trip-end-date" class="mb-2"></div>
        </div>

        <div>
          <div class="small text-muted mb-2">
            Heure
          </div>
          <div id="delete-trip-end-hour"></div>
        </div>
      </div>
    </div>
  </div>

</div>

<p class="mb-0">
  <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
  <strong>Cette action est irréversible.</strong>
</p>

<?php

$modalBody = ob_get_clean();

ob_start();
?>

<button
  type="button"
  class="btn btn-dark"
  data-bs-dismiss="modal">
  Annuler
</button>

<form id="delete-trip-form" method="POST">
  <button type="submit" class="btn btn-danger">
    Supprimer
  </button>
</form>

<?php

$modalFooter = ob_get_clean();

require __DIR__ . "/../_modal.php";
