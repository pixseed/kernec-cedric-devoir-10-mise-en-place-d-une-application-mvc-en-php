<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\AbstractModel;

class UserModel extends AbstractModel
{
  public function findByEmail(string $email)
  {
    $stmt = $this->connection->prepare(
      "SELECT * FROM users WHERE email = ?"
    );

    $stmt->execute([$email]);

    $user = $stmt->fetch();

    return $user;
  }
}