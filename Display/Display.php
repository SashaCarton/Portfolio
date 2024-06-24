<?php 

namespace Display;
use Router\Router;
class Display 
{
    private $page;
    public function __construct(Router $router)
    {
        $this->page = $router->run();
    }

    public function display()
    {
        include_once __DIR__ . "/../views/'. $this->page . '.php"; 
    }
}