<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class UserModel extends AbstractModel
{
  /**
   * Recherche un utilisateur via l'email.
   * ----------------------------------------------------------------------------
   * @param string $email ─ Adresse email de l'utilisateur recherché
   * @return array|false ─ Tableau de données de l'utilisateur ou false s'il n'existe pas
   */
  public function findByEmail(string $email): array|false
  {
    $stmt = $this->connection->prepare(
      "SELECT * FROM users WHERE email = ?"
    );

    $stmt->execute([$email]);

    $user = $stmt->fetch();

    return $user;
  }

  /**
   * Recherche un utilisateur à partir de son identifiant.
   * ----------------------------------------------------------------------------
   * @param int $idUser ─ Identifiant unique de l'utilisateur
   * @return array|false ─ Tableau de données de l'utilisateur ou false s'il n'existe pas
   */
  public function findById(int $idUser): array|false
  {
    $stmt = $this->connection->prepare(
      "SELECT
          idUser,
          lastName,
          firstName,
          email,
          phone,
          role
      FROM users
      WHERE idUser = :idUser"
    );

  $stmt->execute([
    ":idUser" => $idUser
  ]);

  return $stmt->fetch();
  }

  /**
   * Recherche tous les utilisateurs existants.
   * ----------------------------------------------------------------------------
   * @return array ─ Tableau des utilisateurs
   */
  public function findAll(): array
  {
    $stmt = $this->connection->prepare(
      "SELECT
          idUser,
          lastName,
          firstName,
          email,
          phone,
          role
      FROM users
      ORDER BY lastName, firstName"
    );

    $stmt->execute();

    $users = $stmt->fetchAll();

    return $users;
  }

  /**
   * Compte le nombre total d'utilisateurs existants.
   * ----------------------------------------------------------------------------
   * @return int ─ Nombre d'utilisateurs
   */
  public function countAll(): int
  {
    return $this->countRecords("users");
  }
}