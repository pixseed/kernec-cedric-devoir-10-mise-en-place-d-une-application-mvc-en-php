<?php

declare(strict_types=1);

namespace App\Validators;

class TripValidator
{
  /**
   * Valide les données du formulaire de création d'un trajet.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @return array ─ Liste des erreurs de validation
   */
  public function validate(array $data): array
  {
    $errors = [];

    // Exécute l'ensemble des validations du formulaire.
    $this->validateDates($data, $errors);
    $this->validateChronology($data, $errors);
    $this->validateSeats($data, $errors);
    $this->validateAgencies($data, $errors);

    return $errors;
  }

  /**
   * Valide les dates et heures obligatoires.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param array $errors ─ Tableau des erreurs de validation
   */
  private function validateDates(array $data, array &$errors): void
  {
    if (empty($data["startDate"])) {
      $errors["startDate"] = "La date de départ est obligatoire.";
    }

    if (empty($data["startHour"])) {
      $errors["startHour"] = "L'heure de départ est obligatoire.";
    }

    if (empty($data["endDate"])) {
      $errors["endDate"] = "La date d'arrivée est obligatoire.";
    }

    if (empty($data["endHour"])) {
      $errors["endHour"] = "L'heure d'arrivée est obligatoire.";
    }
  }

  /**
   * Valide les cohérences temporelles.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param array $errors ─ Tableau des erreurs de validation
   */
  private function validateChronology(array $data, array &$errors): void
  {
    if (
      $data["startDate"] !== ""
      && $data["startHour"] !== ""
      && $data["endDate"] !== ""
      && $data["endHour"] !== ""
    ) {
      $departureDateTime =  strtotime($data["startDate"] . " " . $data["startHour"]);
      $arrivalDateTime =    strtotime($data["endDate"] . " " . $data["endHour"]);

      if ($departureDateTime === false || $arrivalDateTime === false) {
        $errors["invalidDateTime"] = "Les dates ou les heures renseignées sont invalides.";
      } elseif ($arrivalDateTime <= $departureDateTime) {
        $errors["endDateTime"] = "L'arrivée doit être postérieure au départ.";
      }

      if ($departureDateTime !== false && $departureDateTime < time()) {
        $errors["startDateTime"] = "Le départ doit être postérieur à la date et l'heure actuelles.";
      }
    }
  }

  /**
   * Valide le nombre de places.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param array $errors ─ Tableau des erreurs de validation
   */
  private function validateSeats(array $data, array &$errors): void
  {
    if ($data["numberSeats"] < 1) {
      $errors["numberSeats"] = "Le nombre de places doit être supérieur ou égal à 1.";
    }
  }

  /**
   * Valide les agences de départ et d'arrivée.
   * ----------------------------------------------------------------------------
   * @param array $data ─ Données du formulaire
   * @param array $errors ─ Tableau des erreurs de validation
   */
  private function validateAgencies(array $data, array &$errors): void
  {
    if ($data["idStartAgency"] <= 0) {
      $errors["idStartAgency"] = "Veuillez sélectionner une agence de départ.";
    }

    if ($data["idEndAgency"] <= 0) {
      $errors["idEndAgency"] = "Veuillez sélectionner une agence d'arrivée.";
    }

    if (
      $data["idStartAgency"] > 0
      && $data["idEndAgency"] > 0
      && $data["idStartAgency"] === $data["idEndAgency"]
    ) {
      $errors["sameAgency"] = "L'agence d'arrivée doit être différente de l'agence de départ.";
    }
  }
}
