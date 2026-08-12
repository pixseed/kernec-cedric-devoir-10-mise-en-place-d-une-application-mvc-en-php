<?php

/**
 * Variables disponibles dans cette vue :
 * @var array $users
 * @var string $baseFolder
 */

// Configuration dynamique du header de la page.
$pageTitle = "Liste des utilisateurs";

$pageActions = [
  [
    "url" => $baseFolder . "/admin",
    "label" => "Tableau de bord",
    "icon" => "bi-house-fill",
    "class" => "btn-outline-dark"
  ]
];
?>

<div class="container container-page">
  <?php require __DIR__ . "/../partials/_pageHeader.php"; ?>

  <div class="scrollable-content table-responsive border rounded">
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