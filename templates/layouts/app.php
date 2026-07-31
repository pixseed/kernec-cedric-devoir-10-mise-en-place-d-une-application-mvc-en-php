<?php

/**
 * Vue transmise par AbstractController::render() :
 * @var string $view.
 */

require __DIR__ . "/../partials/header.php";
require __DIR__ . "/../" . $view;
require __DIR__ . "/../partials/footer.php";