<?php

/**
 * Variables disponibles dans cette vue :
 * @var array $user
 * @var array $agencies
 * @var string $baseFolder
 * @var string $role
 * @var array|null $data
 * @var array|null $errors
 */

$isEdit = isset($data["idTrip"]);

// Configuration dynamique du header de la page.
$pageTitle = $isEdit
  ? "Éditer un trajet"
  : "Créer un trajet";

$pageActions = [];

if ($role === "admin") {
  $pageActions = [
    [
      "url" => $baseFolder . "/admin",
      "label" => "Tableau de bord",
      "icon" => "bi-house-fill",
      "class" => "btn-outline-dark"
    ]
  ];
}

// Configuration dynamique du formulaire selon le mode création ou édition.
$formAction = $isEdit
  ? $baseFolder . "/trips/update/" . $data["idTrip"]
  : $baseFolder . "/trips";

$resetUrl = $isEdit
  ? $baseFolder . "/trips/edit/" . $data["idTrip"]
  : $baseFolder . "/trips/create";

$cancelUrl = $role === "admin"
  ? $baseFolder . "/trips"
  : $baseFolder;

$cancelLabel = $isEdit
  ? "Annuler la modification"
  : "Annuler la création";

$submitLabel = $isEdit
  ? "Modifier"
  : "Ajouter";
?>

<div class="container">
  <?php require __DIR__ . "/../partials/_pageHeader.php"; ?>

  <div>
    <fieldset class="border rounded px-3 pb-3 bg-body-tertiary mb-3">
      <legend class="float-none w-auto px-2 fs-5 fw-semibold">
        Auteur
      </legend>

      <div class="d-flex flex-column flex-md-row justify-content-between gap-2 pb-1">
        <div class="fw-bold">
          <i class="bi bi-person-fill me-1" aria-hidden="true"></i>
          <span>
            <?= htmlspecialchars($user["firstName"]) ?>
            <?= htmlspecialchars($user["lastName"]) ?>
          </span>
        </div>

        <div class="">
          <i class="bi bi-envelope-fill me-1" aria-hidden="true"></i>
          <span><?= htmlspecialchars($user["email"]) ?></span>
        </div>

        <div class="">
          <i class="bi bi-telephone-fill me-1" aria-hidden="true"></i>
          <span><?= htmlspecialchars($user["phone"]) ?></span>
        </div>
      </div>
    </fieldset>
  </div>

  <form
    action="<?= $formAction ?>"
    method="POST"
    class="border rounded p-3 bg-body-tertiary"
    novalidate>
    <div class="row g-4">
      <div class="col-12 col-lg-5">
        <h2>Départ</h2>

        <hr>

        <div class="mb-3">
          <div class="row g-3">
            <div class="col-12 col-sm">
              <label for="departureDate" class="form-label">Date</label>
              <input
                type="date"
                name="startDate"
                id="departureDate"
                class="form-control <?= isset($errors["startDate"]) || isset($errors["startDateTime"]) ? "is-invalid" : "" ?>"
                value="<?= htmlspecialchars($data["startDate"] ?? "") ?>"
                required>

              <?php if (isset($errors["startDate"])): ?>
                <div class="invalid-feedback">
                  <?= htmlspecialchars($errors["startDate"]) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="col-12 col-sm">
              <label for="departureHour" class="form-label">Heure</label>
              <input
                type="time"
                name="startHour"
                id="departureHour"
                class="form-control <?= isset($errors["startHour"]) || isset($errors["startDateTime"]) ? "is-invalid" : "" ?>"
                value="<?= htmlspecialchars($data["startHour"] ?? "") ?>"
                required>
              <?php if (isset($errors["startHour"])): ?>
                <div class="invalid-feedback">
                  <?= htmlspecialchars($errors["startHour"]) ?>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <?php if (isset($errors["startDateTime"])): ?>
            <div class="invalid-feedback d-block">
              <?= htmlspecialchars($errors["startDateTime"]) ?>
            </div>
          <?php endif; ?>
        </div>

        <label for="idDepartureAgency" class="form-label">
          Agence de départ
        </label>
        <select
          name="idStartAgency"
          id="idDepartureAgency"
          class="form-select <?= isset($errors["idStartAgency"]) ? "is-invalid" : "" ?>"
          required>
          <option
            value=""
            <?= empty($data["idStartAgency"]) ? "selected" : "" ?>
            disabled>
            Sélectionner une agence de départ
          </option>

          <?php foreach ($agencies as $agency): ?>
            <option
              value="<?= htmlspecialchars((string) $agency["idAgency"]) ?>"
              <?= ($data["idStartAgency"] ?? 0) == $agency["idAgency"] ? "selected" : "" ?>>
              <?= htmlspecialchars($agency["name"]) ?>
            </option>
          <?php endforeach; ?>
        </select>

        <?php if (isset($errors["idStartAgency"])): ?>
          <div class="invalid-feedback">
            <?= htmlspecialchars($errors["idStartAgency"]) ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="col-12 col-lg-5">
        <h2>Arrivée</h2>

        <hr>

        <div class="mb-3">
          <div class="row g-3">
            <div class="col-12 col-sm">
              <label for="arrivalDate" class="form-label">Date</label>
              <input
                type="date"
                name="endDate"
                id="arrivalDate"
                class="form-control <?= isset($errors["endDate"]) || isset($errors["endDateTime"]) ? "is-invalid" : "" ?>"
                value="<?= htmlspecialchars($data["endDate"] ?? "") ?>"
                required>

              <?php if (isset($errors["endDate"])): ?>
                <div class="invalid-feedback">
                  <?= htmlspecialchars($errors["endDate"]) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="col-12 col-sm">
              <label for="arrivalHour" class="form-label">Heure</label>
              <input
                type="time"
                name="endHour"
                id="arrivalHour"
                class="form-control <?= isset($errors["endHour"]) || isset($errors["endDateTime"]) ? "is-invalid" : "" ?>"
                value="<?= htmlspecialchars($data["endHour"] ?? "") ?>"
                required>
              <?php if (isset($errors["endHour"])): ?>
                <div class="invalid-feedback">
                  <?= htmlspecialchars($errors["endHour"]) ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <?php if (isset($errors["endDateTime"])): ?>
            <div class="invalid-feedback d-block">
              <?= htmlspecialchars($errors["endDateTime"]) ?>
            </div>
          <?php endif; ?>
        </div>

        <label for="idArrivalAgency" class="form-label">
          Agence d'arrivée
        </label>
        <select
          name="idEndAgency"
          id="idArrivalAgency"
          class="form-select <?= isset($errors["idEndAgency"]) || isset($errors["sameAgency"]) ? "is-invalid" : "" ?>"
          required>
          <option
            value=""
            <?= empty($data["idEndAgency"]) ? "selected" : "" ?>
            disabled>
            Sélectionner une agence d'arrivée
          </option>

          <?php foreach ($agencies as $agency): ?>
            <option
              value="<?= htmlspecialchars((string) $agency["idAgency"]) ?>"
              <?= ($data["idEndAgency"] ?? 0) == $agency["idAgency"] ? "selected" : "" ?>>
              <?= htmlspecialchars($agency["name"]) ?>
            </option>
          <?php endforeach; ?>
        </select>

        <?php if (isset($errors["idEndAgency"])): ?>
          <div class="invalid-feedback">
            <?= htmlspecialchars($errors["idEndAgency"]) ?>
          </div>
        <?php endif; ?>

        <?php if (isset($errors["sameAgency"])): ?>
          <div class="invalid-feedback">
            <?= htmlspecialchars($errors["sameAgency"]) ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="col-12 col-lg-2">
        <h2>Places</h2>

        <hr>

        <div class="d-flex gap-3 mb-3">
          <div>
            <label for="numberSeats" class="form-label">Nombre de places</label>
            <input
              type="number"
              name="numberSeats"
              value="<?= htmlspecialchars($data["numberSeats"] ?? "1") ?>"
              min="1"
              id="numberSeats"
              class="form-control <?= isset($errors["numberSeats"]) ? "is-invalid" : "" ?>"
              required>
            <?php if (isset($errors["numberSeats"])): ?>
              <div class="invalid-feedback">
                <?= htmlspecialchars($errors["numberSeats"]) ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <?php if (isset($errors["invalidDateTime"])): ?>
      <div class="alert alert-danger mt-3">
        <?= htmlspecialchars($errors["invalidDateTime"]) ?>
      </div>
    <?php endif; ?>

    <hr>

    <div class="d-flex justify-content-center gap-3">
      <a
        href="<?= $cancelUrl ?>/"
        aria-label="<?= $cancelLabel ?>"
        class="btn btn-outline-dark btn-cancel">
        <i class="bi bi-arrow-left" aria-hidden="true"></i>
      </a>

      <a
        href="<?= $resetUrl ?>"
        aria-label="Effacer le formulaire"
        class="btn btn-outline-dark btn-clear">
        <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
      </a>

      <button type="submit" class="btn btn-primary"><?= $submitLabel ?></button>
    </div>

  </form>
</div>