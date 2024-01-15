<?php

use function PHPUnit\Framework\isEmpty;

class App
{
    private $controller;
    private $action;
    private $params;
    function __construct()
    {
        global $routes;
        if (!empty($routes['default_controller'])) {
            $this->controller = $routes['default_controller'];
        } else {
            $this->controller = 'Home';
        }

        $this->action = 'index';
        $this->params = [];
        $this->processURl();
    }
    function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    function processURl()
    {
        $url = $this->getUrl();
        $extractedUrl = array_values(array_filter(explode('/', $url)));
        if (!empty($extractedUrl[0])) {
            $this->controller = ucfirst($extractedUrl[0]);
        }
        if (file_exists('app/controllers/' . $this->controller . '.php')) {
            require_once('app/controllers/' . $this->controller . '.php');
            if (class_exists($this->controller)) {
                // $this->controller = new $this->controller();
                unset($extractedUrl[0]);
            } else {
                $this->renderError(404);
                return;
            }
        } else {
            $this->renderError(404);
            return;
        }
        if (!empty($extractedUrl[1])) {
            $this->action = $extractedUrl[1];
        }
        if (method_exists($this->controller, $this->action)) {
            // $this->controller->{$this->action}();
            unset($extractedUrl[1]);
        } else {
            $this->renderError(404);
            return;
        }

        $this->params = $extractedUrl ? array_values($extractedUrl) : [];

        call_user_func_array([new $this->controller(), $this->action], $this->params);
    }

    function renderError($statusCode)
    {
        require_once('errors/' . $statusCode . '.php');
    }
}
