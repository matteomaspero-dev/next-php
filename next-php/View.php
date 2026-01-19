<?php
declare(strict_types=1);

class View {
	private Router $router;
	private string $pagePath;
	private string $layoutPath;

	public function __construct(Router $router) {
		$this->router = $router;
	}

	public function resolve(string $route) {
		// Locate the Page file
		$this->pagePath = $route . "/page.php";
		
		if (!file_exists($this->pagePath)) {
			throw new Exception("Page not found", 404);
		}

		// Locate the nearest Layout file
		$currentPath = $route;
		while (!file_exists($currentPath . "/layout.php")) {
			if ($currentPath === APP_PATH) {
				throw new Exception("Layout file not found", 500);
			}
			$currentPath = dirname($currentPath);
		}
		$this->layoutPath = $currentPath . "/layout.php";
	}

	public function render() {
		// Make router available to pages
		$router = $this->router;

		// Capture the page output
		ob_start();
		require $this->pagePath;
		$content = ob_get_clean();

		// Render the layout
		require $this->layoutPath;
	}
}
