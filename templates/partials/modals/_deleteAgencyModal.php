<?php
$modalId = "deleteAgencyModal";
$modalLabelId = "deleteAgencyModalLabel";
$modalTitle = "Confirmer la suppression";

ob_start();
?>

<p>
  Êtes-vous sûr de vouloir <strong>supprimer</strong> cette agence ?
</p>

<div class="border rounded p-3 mb-3 bg-body-tertiary">
  <div class="small text-muted mb-2">
    Élément concerné
  </div>
  <div id="delete-agency-name" class="badge text-bg-secondary"></div>
</div>

<p class="mb-0">
  <i class="bi bi-exclamation-triangle-fill"></i>&nbsp<strong>Cette action est irréversible.</strong>
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

<form id="delete-agency-form" method="POST">
  <button type="submit" class="btn btn-danger">Supprimer</button>
</form>

<?php

$modalFooter = ob_get_clean();

require __DIR__ . "/../_modal.php";
