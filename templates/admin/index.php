<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $firstName
 * @var string  $lastName
 */
?>

<div class="container">
  <h1 class="display-6 fw-bold mb-2">Tableau de bord d'administration</h1>

  <p class="lead mb-5">
    Bienvenue sur votre espace administrateur,
    <strong class="fw-semibold">
      <?= htmlspecialchars($firstName) ?>
      <?= htmlspecialchars($lastName) ?>
    </strong>.
  </p>

  <?php require __DIR__ . "/_actions.php" ?>
</div>