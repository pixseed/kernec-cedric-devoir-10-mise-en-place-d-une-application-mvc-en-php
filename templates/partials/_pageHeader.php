<div class="d-flex justify-content-between align-items-center">
  <h1 class="display-6 fw-bold mb-4 <?= htmlspecialchars($pageTitleClass ?? "") ?>">
    <?= htmlspecialchars($pageTitle) ?>
  </h1>

  <?php if (!empty($pageActions)): ?>
    <div class="d-flex gap-4">

      <?php foreach ($pageActions as $action): ?>
        <a
          href="<?= htmlspecialchars($action["url"]) ?>"
          class="btn <?= htmlspecialchars($action["class"]) ?> d-flex align-items-center gap-2">

          <i
            class="bi <?= htmlspecialchars($action["icon"]) ?> fs-5"
            aria-hidden="true">
          </i>

          <?= htmlspecialchars($action["label"]) ?>
        </a>
      <?php endforeach; ?>

    </div>
  <?php endif; ?>
</div>