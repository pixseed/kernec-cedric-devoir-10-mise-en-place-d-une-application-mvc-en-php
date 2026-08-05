<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $baseFolder
 */
?>

<li class="nav-item">
  <a href="<?= $baseFolder ?>/trips/create" class="btn btn-dark">Créer un trajet</a>
</li>
<li class="nav-item">
  <?php require __DIR__ . "/user_infos.php" ?>
</li>
<li class="nav-item">
  <?php require __DIR__ . "/logout_button.php" ?>
</li>