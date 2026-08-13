<?php

/**
 * Variables disponibles dans cette vue :
 * @var string  $baseFolder
 * @var string  $role
 */

use App\Constants\Role;

?>

<?php
$homeUrl = $baseFolder;

if ($role === Role::ADMIN) {
  $homeUrl .= "/admin";
}
?>


<a class="navbar-brand" href="<?= htmlspecialchars($homeUrl) ?>">
  Touche pas au klaxon
</a>