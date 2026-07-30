<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\AbstractController;

class ErrorController extends AbstractController
{
  /**
   * Affiche la page 404.
   */
  public function notFound(): void
  {
    $this->render("errors/404.php");
  }
}
