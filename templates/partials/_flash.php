<?php if (!empty($flash)): ?>

  <div class="flash-wrapper bg-body bg-opacity-50">
    <div class="container py-3">
      <div
        id="flash-message"
        class="alert alert-<?= htmlspecialchars($flash["type"]) ?> alert-dismissible fade show mb-0"
        role="alert">
        <?= htmlspecialchars($flash["message"]) ?>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Fermer">
        </button>
      </div>
    </div>
  </div>

<?php endif; ?>