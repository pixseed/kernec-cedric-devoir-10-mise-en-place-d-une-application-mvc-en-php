<?php

$modalId = "deleteTripModal";
$modalLabelId = "deleteTripModalLabel";
$modalTitle = "Supprimer un trajet";

ob_start();
?>

<p>
  Êtes-vous sûr de vouloir <strong>supprimer</strong> ce trajet ?
</p>
<p class="mb-0">
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
  <button type="submit" class="btn btn-danger">Supprimer</button>
</form>

<?php

$modalFooter = ob_get_clean();

require __DIR__ . "/../_modal.php";