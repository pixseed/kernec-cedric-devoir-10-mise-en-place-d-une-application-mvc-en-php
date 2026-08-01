<?php

/**
 * Variables transmises par AbstractController::render() :
 * @var string  $baseUrl
 */
?>

<li class="nav-item">
  <a class="btn btn-dark" href="<?= $baseUrl ?>/users">Utilisateurs</a>
</li>
<li class="nav-item">
  <a class="btn btn-dark" href="<?= $baseUrl ?>/agencies">Agences</a>
</li>
<li class="nav-item">
  <a class="btn btn-dark" href="<?= $baseUrl ?>/trips">Trajets</a>
</li>
<li class="nav-item">
  <?php require __DIR__ . "/user_infos.php" ?>
</li>
<li class="nav-item">
  <?php require __DIR__ . "/logout_button.php" ?>
</li>