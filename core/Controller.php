<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

/**this class using controlelr connected sitecontroller class
 * @package app\core
 */
class Controller
{
    /**
     * 
     *
     * @var app\core\middlewares\BaseMdiddleware[];
     */
    protected array $middlewares =[];
    public string $layout = 'main';
    public string $action = '';
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

/**
 * return renderView method in router class
 */

    public function render($view, $params = [])
    {

      return   Application::$app->view->rederView($view,$params);

    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Get the value of middlewares
     *
     * @return  app\core\middlewares\BaseMdiddleware[];
     */ 
    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}
