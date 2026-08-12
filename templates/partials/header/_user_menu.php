<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $baseFolder
 */
?>

<li class="nav-item order-2 order-lg-1">
  <a href="<?= $baseFolder ?>/trips/create" class="btn btn-dark w-100">Créer un trajet</a>
</li>
<li class="nav-item order-1 -order-lg-2">
  <?php require __DIR__ . "/_user_infos.php" ?>
</li>
<li class="nav-item order-3 order-lg-3">
  <?php require __DIR__ . "/_logout_button.php" ?>
</li>