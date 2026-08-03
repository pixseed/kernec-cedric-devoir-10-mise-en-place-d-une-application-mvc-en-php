<?php

return [
  "app_name" => $_ENV["APP_NAME"],
  "environment" => $_ENV["APP_ENV"],
  "debug" => $_ENV["APP_DEBUG"] === "true",
  "base_url" => $_ENV["APP_BASE_URL"],
  "base_folder" => $_ENV["APP_BASE_FOLDER"],
];