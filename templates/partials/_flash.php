<?php if (!empty($flash)): ?>

  <div class="container mt-4">
    <div
      id="flash-message"
      class="alert alert-<?= htmlspecialchars($flash["type"]) ?> alert-dismissible fade show"
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

<?php endif; ?>