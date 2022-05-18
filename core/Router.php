<?php

namespace app\core;

use app\core;
use app\core\exeption\ForbiddinException;
use app\core\exeption\NotFoundException;

/**
 * 
 * @package app\core
 */


class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];


    /**
     * 
     *
     * @param \app\core\Request $request  
     * @param \app\core\Response $response  
     * 
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param [type] $path
     * @param [type] $callback
     * @return void
     * $callback is current method and path 
     * determine current method and path are convinent get()method
     */

    public function get($path, $callback)
    {

        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {

        $this->routes['post'][$path] = $callback;
    }

    /**
     *  resolve() is used as return
     * and determine what is current path and url path and method
     * @return void
     */
    public function resolve()
    {


        $path = $this->request->getPath();

        $method = $this->request->method();


        /***
         * path and method is collected in callback
         */

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {

            throw new NotFoundException();

            // return $this->renderContent("not found");

        }
        if (is_string($callback)) {
            return Application::$app->view->rederView($callback);
        }

        if (is_array($callback)) {
            /**
             * @var  app\core\Controller $controller
             */
            $controller = new $callback[0]();
            Application::$app->controller =  $controller;
            $controller->action = $callback[1];
            $callback[0] =  $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * layoutContent daki {{content}} qiriqib urniga viewContent daki skripdi tawlab
     * beradigan function
     *
     * 
     */
    public function rederView($view, $params = [])
    {

       return Application::$app->view->rederView($view, $params);
    }

 
  

}
