<?php

/**
 * Variables disponibles dans cette vue :
 * @var string $view
 * @var string $baseUrl
 * @var string|null $mainClass
 */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Touche pas au klaxon</title>
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column min-vh-100">

  <?php require __DIR__ . "/../partials/header.php"; ?>

  <?php require __DIR__ . "/../partials/flash.php"; ?>

  <main class="flex-grow-1 <?= $mainClass ?? '' ?>">
    <?php require __DIR__ . "/../" . $view; ?>
  </main>

  <?php require __DIR__ . "/../partials/footer.php"; ?>

  <script type="module" src="<?= $baseUrl ?>/assets/js/bootstrap.bundle.min.js"></script>
  <script type="module" src="<?= $baseUrl ?>/assets/js/main.js"></script>
</body>

</html>