-- -----------------------------------------------------
-- Schema touche_pas_au_klaxon
-- -----------------------------------------------------
DROP DATABASE IF EXISTS touche_pas_au_klaxon;
CREATE DATABASE touche_pas_au_klaxon
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
USE touche_pas_au_klaxon;

-- -----------------------------------------------------
-- Table `touche_pas_au_klaxon`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `touche_pas_au_klaxon`.`users` (
  `idUser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lastName` VARCHAR(100) NOT NULL,
  `firstName` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `touche_pas_au_klaxon`.`agencies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `touche_pas_au_klaxon`.`agencies` (
  `idAgency` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idAgency`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `touche_pas_au_klaxon`.`trips`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `touche_pas_au_klaxon`.`trips` (
  `idTrip` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `startDate` DATE NOT NULL,
  `startHour` TIME NOT NULL,
  `endDate` DATE NOT NULL,
  `endHour` TIME NOT NULL,
  `numberSeats` INT UNSIGNED NOT NULL,
  `availableSeats` INT UNSIGNED NOT NULL,
  `idUser` INT UNSIGNED NOT NULL,
  `idStartAgency` INT UNSIGNED NOT NULL,
  `idEndAgency` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idTrip`),
  UNIQUE INDEX `idTrip_UNIQUE` (`idTrip` ASC),
  CONSTRAINT `fk_trip_user`
    FOREIGN KEY (`idUser`)
    REFERENCES `touche_pas_au_klaxon`.`users` (`idUser`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_trip_start_agency`
    FOREIGN KEY (`idStartAgency`)
    REFERENCES `touche_pas_au_klaxon`.`agencies` (`idAgency`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_trip_end_agency`
    FOREIGN KEY (`idEndAgency`)
    REFERENCES `touche_pas_au_klaxon`.`agencies` (`idAgency`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;
