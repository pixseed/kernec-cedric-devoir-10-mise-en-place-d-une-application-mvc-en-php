<?php

/**
 * Variables disponibles dans cette vue :
 * @var array $users
 * @var string $baseFolder
 */
?>

<div class="container">
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="display-6 fw-bold mb-4">Liste des utilisateurs</h1>

    <a
      href="<?= htmlspecialchars($baseFolder . "/admin") ?>"
      class="btn btn-outline-dark d-flex align-items-center gap-2">

      <i class="bi bi-house-fill fs-5" aria-hidden="true"></i>
      
      Tableau de bord
    </a>
  </div>

  <div class="table-responsive border rounded">
    <table class="table table-bordered table-striped table-hover align-middle text-center mb-0">
      <thead class="table-dark">
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>E-mail</th>
          <th>Téléphone</th>
          <th>Rôle</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($users as $userItem): ?>
          <tr>
            <td><?= htmlspecialchars($userItem["lastName"]) ?></td>
            <td><?= htmlspecialchars($userItem["firstName"]) ?></td>
            <td><?= htmlspecialchars($userItem["email"]) ?></td>
            <td><?= htmlspecialchars($userItem["phone"]) ?></td>
            <td>
              <span class="badge <?= $userItem["role"] === "admin" ? "text-bg-success text-white" : "text-bg-primary" ?>">
                <?= htmlspecialchars($userItem["role"]) ?>
              </span>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>