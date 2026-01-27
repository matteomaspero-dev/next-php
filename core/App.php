<?php
declare(strict_types=1);

require PATHS["core"] . "/Page.php";

class App {

	public function run(): void {
		$page = new Page("login");
		$page = new Page("register");
	}
}
