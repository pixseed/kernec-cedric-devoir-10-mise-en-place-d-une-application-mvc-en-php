<div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-3 mb-3">

  <h1 class="display-6 fw-bold mb-0 <?= htmlspecialchars($pageTitleClass ?? "") ?>">
    <?= htmlspecialchars($pageTitle) ?>
  </h1>

  <?php if (!empty($pageActions)): ?>
    <div class="d-flex gap-2 flex-shrink-0">

      <?php foreach ($pageActions as $action): ?>
        <a
          href="<?= htmlspecialchars($action["url"]) ?>"
          class="btn <?= htmlspecialchars($action["class"]) ?> d-flex align-items-center gap-2 <?= htmlspecialchars($action["order"] ?? "") ?>"
          aria-label="<?= htmlspecialchars($action["label"]) ?>">

          <i
            class="bi <?= htmlspecialchars($action["icon"]) ?> fs-5"
            aria-hidden="true">
          </i>

          <span class="d-none d-lg-inline">
            <?= htmlspecialchars($action["label"]) ?>
          </span>

        </a>
      <?php endforeach; ?>

    </div>
  <?php endif; ?>

</div>