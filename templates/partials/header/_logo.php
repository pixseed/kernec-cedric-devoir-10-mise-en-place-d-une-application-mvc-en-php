<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $baseFolder
 * @var string  $role
 */
?>

<?php
$homeUrl = $baseFolder;

if ($role === "admin") {
  $homeUrl .= "/admin";
}
?>


<a class="navbar-brand" href="<?= htmlspecialchars($homeUrl) ?>">
  Touche pas au klaxon
</a>