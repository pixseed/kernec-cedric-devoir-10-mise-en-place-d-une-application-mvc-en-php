<?php

/**
 * Variables disponibles dans cette vue :
 * @var array $agencies
 * @var string $baseFolder
 * @var array|null $data
 * @var array|null $errors
 */
?>

<form action="<?= $baseFolder ?>/trips" method="POST" class="d-flex flex-column" novalidate>
  <div class="row">
    <div class="col-10 row">
      <div class="col-6">
        <h2>Départ</h2>

        <hr>

        <div class="mb-3">
          <div class="d-flex gap-3">
            <div>
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

            <div>
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
          class="form-select <?= isset($errors["idStartAgency"]) || isset($errors["sameAgency"]) ? "is-invalid" : "" ?>"
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

      <div class="col-6">
        <h2>Arrivée</h2>

        <hr>

        <div class="mb-3">
          <div class="d-flex gap-3">
            <div>
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

            <div>
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
          class="form-select <?= isset($errors["sameAgency"]) ? "is-invalid" : "" ?>"
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
        <?php if (isset($errors["sameAgency"])): ?>
          <div class="invalid-feedback">
            <?= htmlspecialchars($errors["sameAgency"]) ?>
          </div>
        <?php endif; ?>
      </div>

      <?php if (isset($errors["invalidDateTime"])): ?>
        <div class="alert alert-danger mt-3">
          <?= htmlspecialchars($errors["invalidDateTime"]) ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="col-2">
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

  <hr>

  <div class="d-flex justify-content-center gap-3">
    <a href="<?= $baseFolder ?>/" class="btn btn-outline-dark btn-cancel">
      <i class="bi bi-arrow-left" aria-hidden="true"></i>
    </a>
    <a href="<?= $baseFolder ?>/trips/create" class="btn btn-outline-dark btn-clear">
      <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
    </a>
    <button type="submit" class="btn btn-primary">Valider</button>
  </div>

</form>