-- =====================================================
-- TOUCHE PAS AU KLAXON
-- Requêtes SQL de développement
-- =====================================================

USE touche_pas_au_klaxon;

-- =====================================================
-- USERS
-- =====================================================

-- RQ01 - Liste des utilisateurs
SELECT *
FROM users
ORDER BY lastName, firstName;

-- RQ02 - Rechercher un utilisateur par email (authentification)
SELECT *
FROM users
WHERE email = 'admin@touchepasauklaxon.fr';

-- RQ03 - Utilisateur par identifiant
SELECT *
FROM users
WHERE idUser = 1;


-- =====================================================
-- AGENCIES
-- =====================================================

-- RQ04 - Liste des agences
SELECT *
FROM agencies
ORDER BY name;

-- RQ05 - Agence par identifiant
SELECT *
FROM agencies
WHERE idAgency = 1;

-- RQ06 - Créer une agence
INSERT INTO agencies (name)
VALUES ('Lorient');

-- RQ07 - Modifier une agence
UPDATE agencies
SET name = 'Vannes'
WHERE idAgency = 13;

-- RQ08 - Supprimer une agence
DELETE FROM agencies
WHERE idAgency = 13;


-- =====================================================
-- TRIPS
-- =====================================================

-- RQ09 - Créer des trajets
-- Ici, on crée trois trajets afin de tester les autres requêtes de cette même table.
INSERT INTO trips
(
    startDate,
    startHour,
    endDate,
    endHour,
    numberSeats,
    availableSeats,
    idUser,
    idStartAgency,
    idEndAgency
)
VALUES
(
    '2026-08-01',
    '08:00:00',
    '2026-08-01',
    '10:30:00',
    4,
    4,
    1,
    1,
    2
),
(
    '2026-08-02',
    '07:45:00',
    '2026-08-02',
    '09:15:00',
    5,
    2,
    2,
    3,
    5
),
(
    '2026-08-03',
    '17:30:00',
    '2026-08-03',
    '20:00:00',
    3,
    0,
    3,
    6,
    4
);

-- RQ10 - Liste des trajets (administrateur)
SELECT
    sa.name AS departure,
	t.startDate,
    t.startHour,
    ea.name AS destination,
	t.endDate,
    t.endHour,
    t.availableSeats
FROM trips t
INNER JOIN agencies sa
    ON t.idStartAgency = sa.idAgency
INNER JOIN agencies ea
    ON t.idEndAgency = ea.idAgency
ORDER BY t.startDate, t.startHour;

-- RQ11 - Liste des trajets (page d'accueil)
SELECT
    sa.name AS departure,
	t.startDate,
    t.startHour,
    ea.name AS destination,
	t.endDate,
    t.endHour,
    t.availableSeats
FROM trips t
INNER JOIN agencies sa
    ON t.idStartAgency = sa.idAgency
INNER JOIN agencies ea
    ON t.idEndAgency = ea.idAgency
WHERE t.availableSeats > 0
    AND TIMESTAMP(t.startDate, t.startHour) >= NOW()
ORDER BY t.startDate, t.startHour;

-- RQ12 - Trajet par identifiant
SELECT *
FROM trips
WHERE idTrip = 1;

-- RQ13 - Modifier un trajet
UPDATE trips
SET availableSeats = 3
WHERE idTrip = 1;

-- RQ14 - Supprimer un trajet
DELETE FROM trips
WHERE idTrip = 1;

-- RQ15 - Informations complémentaires d'un trajet (modale)
SELECT
    CONCAT(u.firstName, ' ', u.lastName) AS author,
    u.phone,
    u.email,
    t.numberSeats
FROM trips t
INNER JOIN users u
    ON t.idUser = u.idUser
WHERE t.idTrip = 1;