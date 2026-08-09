<?php

$modalId = "tripDetailsModal";
$modalLabelId = "tripDetailsModalLabel";
$modalTitle = "Détails du trajet";

ob_start();
?>

<dl class="row mb-0">
  <dt class="col-sm-4">Auteur</dt>
  <dd class="col-sm-8" id="trip-author"></dd>

  <dt class="col-sm-4">Téléphone</dt>
  <dd class="col-sm-8">
    <a id="trip-phone"></a>
  </dd>

  <dt class="col-sm-4">Email</dt>
  <dd class="col-sm-8">
    <a id="trip-email"></a>
  </dd>

  <dt class="col-sm-4">Nombre total de places</dt>
  <dd class="col-sm-8" id="trip-number-seats"></dd>
</dl>

<?php

$modalBody = ob_get_clean();

ob_start();
?>

<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

<?php

$modalFooter = ob_get_clean();

require __DIR__ . "/../_modal.php";
