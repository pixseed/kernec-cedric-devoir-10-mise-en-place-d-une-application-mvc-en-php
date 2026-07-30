<?php

use App\Controller\AgencyController;
use App\Controller\AuthController;
use App\Controller\HomeController;

$router->get("/", [HomeController::class, "index"]);
$router->get("/login", [AuthController::class, "index"]);
$router->post("/login", [AuthController::class, "login"]);
$router->get("/agencies", [AgencyController::class, "index"]);