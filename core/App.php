<?php
declare(strict_types=1);
namespace core;

class App
{
    private Router $router;
    private View $view;

    public function __construct()
    {
        $this->router = new Router($_SERVER["REQUEST_URI"]);
        $this->view = new View($this->router);
    }

    public function run(): void
    {
        $this->view->render();
    }
}
