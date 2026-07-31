<?php

/**
 * Variables transmises par AbstractController::render() :
 * @var string  $baseUrl
 */
?>

<nav>
  <ul>
    <li>
      <a href="<?= $baseUrl ?>/trips/create">Créer un trajet</a>
    </li>
    <li>
      <?php require __DIR__ . "/user_infos.php" ?>
    </li>
    <li>
      <?php require __DIR__. "/logout_button.php" ?>
    </li>
  </ul>
</nav>