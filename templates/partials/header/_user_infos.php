<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $firstname
 * @var string  $lastname
 */
?>

<span class="navbar-text mx-3">
  Bonjour 
  <?= htmlspecialchars($firstname, ENT_QUOTES, "UTF-8") ?> 
  <?= htmlspecialchars($lastname, ENT_QUOTES, "UTF-8") ?>
</span>