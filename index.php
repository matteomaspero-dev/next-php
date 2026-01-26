<?php
declare(strict_types=1);

// Load config and App core module
require "config.php";
require PATHS["core"] . "/App.php";

$app = new App();
$app->run();
