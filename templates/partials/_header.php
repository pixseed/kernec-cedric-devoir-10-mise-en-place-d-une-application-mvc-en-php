<?php

/**
 * Variables disponibles dans cette vue :
 * @var bool    $isAuthenticated
 * @var string  $role
 */
?>

<header class="header">
  <nav class="navbar navbar-expand-lg py-3 shadow-sm">
    <div class="container">
      <?php require __DIR__ . "/header/_logo.php"; ?>
    
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNavbar"
        aria-controls="mainNavbar"
        aria-expanded="false"
        aria-label="Ouvrir le menu">

        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto gap-2 align-items-lg-center">
          <?php if (!$isAuthenticated): ?>
            <?php require __DIR__ . "/header/_guest_menu.php" ?>
        
          <?php elseif ($role === "admin"): ?>
            <?php require __DIR__ . "/header/_admin_menu.php" ?>
        
          <?php else: ?>
            <?php require __DIR__ . "/header/_user_menu.php" ?>
        
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>
</header>