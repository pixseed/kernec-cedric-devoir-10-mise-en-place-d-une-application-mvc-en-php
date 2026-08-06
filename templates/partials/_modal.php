<?php

/**
 * Variables disponibles dans cette vue :
 * @var string $modalId
 * @var string $modalLabelId
 * @var string $modalTitle
 * @var string $modalBody
 * @var string|null $modalFooter
 */
?>

<div
  class="modal fade"
  id="<?= htmlspecialchars($modalId) ?>"
  tabindex="-1"
  aria-labelledby="<?= htmlspecialchars($modalLabelId) ?>"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg ?>">
    <div class="modal-content">

      <div class="modal-header">
        <h2
          class="modal-title fs-5"
          id="<?= htmlspecialchars($modalLabelId) ?>">
          <?= htmlspecialchars($modalTitle) ?>
        </h2>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Fermer">
        </button>
      </div>

      <div class="modal-body">
        <?= $modalBody ?>
      </div>

      <?php if (!empty($modalFooter)): ?>
        <div class="modal-footer">
          <?= $modalFooter ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>