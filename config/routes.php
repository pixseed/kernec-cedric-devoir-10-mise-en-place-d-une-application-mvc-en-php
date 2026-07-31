<?php

use App\Controller\AgencyController;
use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\TripController;
use App\Controller\UserController;

// Accueil
$router->get("/", [HomeController::class, "index"]);

// Authentification
$router->get("/login", [AuthController::class, "index"]);
$router->post("/login", [AuthController::class, "login"]);
$router->get("/logout", [AuthController::class, "logout"]);

// Trajets
$router->get("/trips", [TripController::class, "index"]);
$router->get("/trips/create", [TripController::class, "create"]);
$router->post("/trips", [TripController::class, "store"]);
$router->get("/trips/edit/{id}", [TripController::class, "edit"]);
$router->post("/trips/update/{id}", [TripController::class, "update"]);
$router->post("/trips/delete/{id}", [TripController::class, "delete"]);

// Agences
$router->get("/agencies", [AgencyController::class, "index"]);
$router->get("/agencies/create", [AgencyController::class, "create"]);
$router->post("/agencies", [AgencyController::class, "store"]);
$router->get("/agencies/edit/{id}", [AgencyController::class, "edit"]);
$router->post("/agencies/udpate/{id}", [AgencyController::class, "update"]);
$router->post("/agencies/delete/{id}", [AgencyController::class, "delete"]);

// Utilisateurs
$router->get("/users", [UserController::class, "index"]);