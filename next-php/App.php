<?php
declare(strict_types=1);

// Load core modules
require CORE_PATH . "/Router.php";
require CORE_PATH . "/View.php";

class App {
	private Router $router;
	private View $view;

	public function __construct() {
		$this->router = new Router();
		$this->view = new View($this->router);
	}
	
	public function run(): void {
		$route = $this->router->resolve($_SERVER["REQUEST_URI"]);
		
		$this->view->resolve($route);
		$this->view->render();
	}
}
