<?php
declare(strict_types=1);
namespace public;

require "../config.php";
require PATHS["core"] . "/App.php";
require PATHS["core"] . "/Router.php";
require PATHS["core"] . "/View.php";

$app = new \core\App();
$app->run();
