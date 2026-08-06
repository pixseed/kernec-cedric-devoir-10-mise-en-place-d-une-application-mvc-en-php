<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $baseFolder
 */
?>

<li class="nav-item">
  <a class="btn btn-dark" href="<?= $baseFolder ?>/users">Utilisateurs</a>
</li>
<li class="nav-item">
  <a class="btn btn-dark" href="<?= $baseFolder ?>/agencies">Agences</a>
</li>
<li class="nav-item">
  <a class="btn btn-dark" href="<?= $baseFolder ?>/trips">Trajets</a>
</li>
<li class="nav-item">
  <?php require __DIR__ . "/_user_infos.php" ?>
</li>
<li class="nav-item">
  <?php require __DIR__ . "/_logout_button.php" ?>
</li>