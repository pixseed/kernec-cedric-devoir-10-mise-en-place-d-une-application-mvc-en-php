<?php

declare(strict_types=1);

namespace App\Validators;

use App\Model\AgencyModel;

class AgencyValidator
{
  /**
   * Valide les données du formulaire de création d'une agence.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param int|null $excludedId ─ Agence à exclure du contrôle
   * @return array ─ Liste des erreurs de validation
   */
  public function validate(array $data, ?int $excludedId = null): array
  {
    $errors = [];

    // Exécute l'ensemble des validations du formulaire.
    $this->validateName($data, $errors);
    $this->validateDuplicate($data, $errors, $excludedId);

    return $errors;
  }

  /**
   * Valide le nom de l'agence.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param array $errors ─ Tableau des erreurs de validation
   */
  private function validateName(array $data, array &$errors): void
  {
    if ($data["name"] === "") {
      $errors["name"] = "Le nom de l'agence est obligatoire.";

      return;
    }

    if (mb_strlen($data["name"]) > 80) {
      $errors["name"] = "Le nom de l'agence ne peut pas dépasser 80 caractères.";
    }
  }

  /**
   * Vérifie qu'aucune autre agebce ne possède déjà ce nom.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param array $errors ─ Tableau des erreurs de validation
   * @param int|null $excludedId ─ Agence à exclure du contrôle
   */
  private function validateDuplicate(
    array $data,
    array &$errors,
    ?int $excludedId = null
  ): void
  {
    // Si une erreur existe déjà sur le champ, inutile de lancer la vérification.
    if (isset($errors["name"])) {
      return;
    }

    $agencyModel = new AgencyModel();

    if ($agencyModel->existsByName($data["name"], $excludedId)) {
      $errors["name"] = "Une agence portant ce nom existe déjà.";
    }
  }
}