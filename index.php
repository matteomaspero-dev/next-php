<?php

// Load config and core modules
require_once 'config.php';
require_once CORE_PATH . '/App.php';

try {
	// Init and run the application
	$app = new App();
	$app->run();

} catch (Exception $e) {
	// Default to 500 if no code set
	$code = $e->getCode() ? (int)$e->getCode() : 500;
	http_response_code($code);

	// Render a simple error message
	echo '<h1>Error $code</h1>';
	echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
}
