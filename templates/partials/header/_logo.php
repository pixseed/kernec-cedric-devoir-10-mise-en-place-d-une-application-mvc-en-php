<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $baseFolder
 */
?>

<?php
$homeUrl = $baseFolder;

if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
  $homeUrl .= "/admin";
}
?>


<a class="navbar-brand" href="<?= htmlspecialchars($homeUrl) ?>">
  Touche pas au klaxon
</a>