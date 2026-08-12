<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $baseFolder
 */
?>

<li class="nav-item order-2 order-lg-1">
  <a class="btn btn-dark w-100" href="<?= $baseFolder ?>/users">Utilisateurs</a>
</li>
<li class="nav-item order-3 order-lg-2">
  <a class="btn btn-dark w-100" href="<?= $baseFolder ?>/agencies">Agences</a>
</li>
<li class="nav-item order-4 order-lg-3">
  <a class="btn btn-dark w-100" href="<?= $baseFolder ?>/trips">Trajets</a>
</li>
<li class="nav-item order-1 order-lg-4">
  <?php require __DIR__ . "/_user_infos.php" ?>
</li>
<li class="nav-item order-5 order-lg-5">
  <?php require __DIR__ . "/_logout_button.php" ?>
</li>