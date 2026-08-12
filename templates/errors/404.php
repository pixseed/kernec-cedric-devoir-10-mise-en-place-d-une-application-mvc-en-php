<?php

/**
 * Variables disponibles dans cette vue :
 * @var string $baseFolder
 * @var string $role
 */

$homeUrl = $baseFolder;

if ($role === "admin") {
  $homeUrl .= "/admin";
}
?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-6">

      <div class="card shadow-sm bg-white">
        <div class="card-body text-center p-5">

          <div class="display-1 fw-bold lh-1">
            404
          </div>

          <h1 class="h2 mt-3">
            Page introuvable
          </h1>

          <p class="text-muted mb-4">
            La page que vous recherchez n'existe pas ou n'est plus disponible.
          </p>

          <a href="<?= $homeUrl ?>" class="btn btn-primary">
            <i class="bi bi-house-door me-2"></i>
            Retour à l'accueil
          </a>

        </div>
      </div>
    </div>
  </div>
</div>