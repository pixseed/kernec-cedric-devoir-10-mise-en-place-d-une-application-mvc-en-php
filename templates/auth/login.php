<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-9 col-lg-7 col-xl-5 col-xxl-4">

      <div class="card card shadow-sm bg-white">
        <div class="card-body p-4 p-lg-5">
          <h1 class="display-5 fw-bold text-primary">Connexion</h1>
          <hr>

          <form method="post" novalidate>
            <div class="mb-3">
              <label for="email" class="form-label">Adresse email</label>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="Renseignez votre adresse email"
                value="<?= htmlspecialchars($email ?? '') ?>"
                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>">

              <?php if (isset($errors["email"])): ?>
                <div class="invalid-feedback">
                  <?= htmlspecialchars($errors["email"]) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="Renseignez votre mot de passe"
                class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">

              <?php if (isset($errors["password"])): ?>
                <div class="invalid-feedback">
                  <?= htmlspecialchars($errors["password"]) ?>
                </div>
              <?php endif; ?>
            </div>

            <?php if (isset($errors["auth"])): ?>
              <div class="alert alert-danger mb-3">
                <?= htmlspecialchars($errors["auth"]) ?>
              </div>
            <?php endif; ?>

            <div>
              <button type="submit" class="btn btn-primary">
                Se connecter
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>