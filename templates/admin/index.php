<div class="container">
  <h1 class="display-6 fw-bold mb-2">Tableau de bord d'administration</h1>

  <p class="lead mb-5">
    Bienvenue sur votre espace administrateur,
    <strong class="fw-semibold">
      <?= htmlspecialchars($_SESSION["firstname"]) ?>
      <?= htmlspecialchars($_SESSION["lastname"]) ?>
    </strong>.
  </p>

  <?php require __DIR__ . "/_actions.php" ?>
</div>