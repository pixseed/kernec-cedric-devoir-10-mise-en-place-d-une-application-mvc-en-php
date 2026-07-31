<?php

/**
 * Variables transmises par AbstractController::render() :
 * @var string  $firstname
 * @var string  $lastname
 */
?>

<span>
  Bonjour 
  <?= htmlspecialchars($firstname, ENT_QUOTES, "UTF-8") ?> 
  <?= htmlspecialchars($lastname, ENT_QUOTES, "UTF-8") ?>
</span>