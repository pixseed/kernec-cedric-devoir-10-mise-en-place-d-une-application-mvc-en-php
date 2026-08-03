<?php

declare(strict_types=1);

namespace App\Helpers;

use DateTime;

class DateHelper
{
  /**
   * Formate une date au format français.
   * ----------------------------------------------------------------------------
   * @param string $date ─ Date à formater
   */
  public static function formatDate(string $date): string
  {
    return (new DateTime($date))->format("d/m/y");
  }

  /**
   * Formate une heure.
   * ----------------------------------------------------------------------------
   * @param string $hour ─ Heure à formater
   */
  public static function formatHour(string $hour): string
  {
    return (new DateTime($hour))->format("H:i");
  }
}