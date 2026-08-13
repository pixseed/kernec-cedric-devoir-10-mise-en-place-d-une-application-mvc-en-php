<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $firstName
 * @var string  $lastName
 */
?>

<span class="navbar-text mx-lg-3">
  Bonjour 
  <?= htmlspecialchars($firstName) ?> 
  <?= htmlspecialchars($lastName) ?>
</span>