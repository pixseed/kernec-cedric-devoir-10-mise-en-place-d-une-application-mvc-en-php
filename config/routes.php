<?php

// Accueil
$router->get("/", "HomeController@index");

// Authentification
$router->get("/login", "AuthController@index");
$router->post("/login", "AuthController@login");
$router->get("/logout", "AuthController@logout");

// Trajets
$router->get("/trips", "TripController@index");
$router->get("/trips/create", "TripController@create");
$router->post("/trips", "TripController@store");

$router->get("/trips/:id", 'TripController@show');
$router->get("/trips/edit/:id", "TripController@edit");
$router->post("/trips/update/:id", "TripController@update");
$router->post("/trips/delete/:id", "TripController@delete");

// Agences
$router->get("/agencies", "AgencyController@index");
$router->get("/agencies/create", "AgencyController@create");
$router->post("/agencies", "AgencyController@store");

$router->get("/agencies/edit/:id", "AgencyController@edit");
$router->post("/agencies/update/:id", "AgencyController@update");
$router->post("/agencies/delete/:id", "AgencyController@delete");

// Utilisateurs
$router->get("/users", "UserController@index");