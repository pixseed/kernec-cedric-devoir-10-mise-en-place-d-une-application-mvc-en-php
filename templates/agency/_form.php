<?php

/**
 * Variables disponibles dans cette vue :
 * @var string|null $mode
 * @var string $baseFolder
 * @var array|null $agency
 */
?>

<?php if ($mode === "default"): ?>

  <div class="card shadow-sm">
    <div class="card-header">
      <h2 class="h5 mb-0">Gestion d'une agence</h2>
    </div>

    <div class="card-body">
      <p class="text-muted">Sélectionner une action.</p>
      <div class="d-grid gap-2">
        <a
          href="<?= htmlspecialchars($baseFolder . "/agencies/create") ?>"
          class="btn btn-primary">
          Ajouter une agence
        </a>
      </div>
      <hr>
      <p class="small text-muted mb-0">
        Cliquez sur <i class="bi bi-pencil-square" aria-hidden="true"></i> dans le tableau pour éditer une agence existante.
      </p>
      <p class="small text-muted mb-0">
        Cliquez sur <i class="bi bi-trash3-fill" aria-hidden="true"></i> dans le tableau pour supprimer une agence existante.
      </p>
    </div>
  </div>

<?php elseif ($mode === "create" || $mode === "edit"): ?>

  <div class="card shadow-sm">
    <div class="card-header">
      <h2 class="h5 mb-0">
        <?= $mode === "create"
          ? "Ajouter une agence"
          : "Modifier une agence" ?>
      </h2>
    </div>

    <div class="card-body">
      <form
        action="<?= htmlspecialchars(
                  $mode === "create"
                    ? $baseFolder . "/agencies"
                    : $baseFolder . "/agencies/update/" . $agency["idAgency"]
                ) ?>"
        method="POST"
        novalidate>
        <div class="mb-3">
          <label
            for="name"
            class="form-label">
            Nom de l'agence
          </label>
          <input
            type="text"
            id="name"
            name="name"
            value="<?= htmlspecialchars($agency["name"] ?? "") ?>"
            class="form-control <?= isset($errors["name"]) ? "is-invalid" : "" ?>"
            required>

          <?php if (isset($errors["name"])): ?>
            <div class="invalid-feedback">
              <?= htmlspecialchars($errors["name"]) ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="d-flex justify-content-between">
          <a
            href="<?= htmlspecialchars($baseFolder . "/agencies") ?>"
            aria-label="<?= $mode === "create"
                          ? "Annuler la création"
                          : "Annuler la modification" ?>"
            class="btn btn-outline-dark btn-cancel">
            Annuler
          </a>

          <button
            type="submit"
            class="btn btn-primary">
            <?= $mode === "create"
              ? "Ajouter"
              : "Modifier" ?>
          </button>
        </div>

      </form>
    </div>
  </div>

<?php endif; ?>