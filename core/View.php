<?php
declare(strict_types=1);
namespace core;

class View
{
	private Router $router;

	public function __construct(Router $router)
	{
		$this->router = $router;
	}

	public function render(): void
	{
		ob_start();
		require $this->router->getPagePath();
		$page = ob_get_clean();
		require $this->router->getLayoutPath();
	}
}