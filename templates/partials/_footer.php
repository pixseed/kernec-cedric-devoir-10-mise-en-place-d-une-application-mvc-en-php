<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $baseFolder
 */
?>

<footer class="footer bg-dark text-light">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 py-3">
    <a href="<?= $baseFolder ?>" class="navbar-brand fw-bold m-0">Touche pas au klaxon</a>
    <p class="text-center m-0">
      &copy; <?= date('Y') ?> - Tous droit réservé │ Création
      <a
        href="https://github.com/pixseed"
        rel="noopener noreferrer"
        class="text-light">
        @pixseed
      </a>
    </p>
  </div>
</footer>