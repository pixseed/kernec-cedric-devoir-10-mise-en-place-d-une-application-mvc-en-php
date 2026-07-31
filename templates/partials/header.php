<?php

/**
 * Variables transmises par AbstractController::render() :
 * @var bool    $isAuthenticated
 * @var string  $role
 */
?>

<header>

  <?php require __DIR__ . "/header/logo.php"; ?>

  <?php if (!$isAuthenticated): ?>
    <?php require __DIR__ . "/header/guest_menu.php" ?>

  <?php elseif ($role === "admin"): ?>
    <?php require __DIR__ . "/header/admin_menu.php" ?>

  <?php else: ?>
    <?php require __DIR__ . "/header/user_menu.php" ?>

  <?php endif ?>