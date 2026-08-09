<?php

/**
 * Variables disponibles dans cette vue :
 * @var string $url
 * @var string $icon
 * @var string $title
 * @var int $value
 * @var string $description
 * @var string $buttonLabel
 */
?>

<a
  href="<?= htmlspecialchars($url) ?>"
  class="card h-100 dashboard-action text-decoration-none text-dark shadow-sm">
  <div class="card-body d-flex flex-column">

    <i class="bi bi-<?= htmlspecialchars($icon) ?> fs-1 mb-3 dashboard-action__icon" aria-hidden="true"></i>

    <h3 class="h5">
      <?= htmlspecialchars($title) ?>
      (<?= $value ?>)
    </h3>

    <p class="text-muted flex-grow-1 mb-0">
      <?= htmlspecialchars($description) ?>
    </p>

  </div>

  <div>
    <span class="dashboard-action__button btn btn-primary btn-sm d-flex justify-content-between align-items-center">
      <?= htmlspecialchars($buttonLabel) ?>
      <i class="bi bi-arrow-right" aria-hidden="true"></i>
    </span>
  </div>
</a>