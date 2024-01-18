<?php

use function PHPUnit\Framework\isEmpty;

class App
{
    private $controller;
    private $action;
    private $params;
    private $route;
    function __construct()
    {
        global $routes;
        $this->route = new Route();
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
        if (!empty($this->route)) {
            $url = $this->route->handleRoute($url);
        }
        $extractedUrl = array_values(array_filter(explode('/', $url)));
        $pathCheck = '';
        if (!empty($extractedUrl)) {
            foreach ($extractedUrl as $key => $item) {
                $pathCheck .= $item . '/';
                $name = rtrim($pathCheck, '/');
                $name = explode('/', $name);
                $name[count($name) - 1] = ucfirst($name[count($name) - 1]);
                $name = implode('/', $name);
                if (file_exists('app/controllers/' . $name . '.php')) {
                    $pathCheck = $name; //admin/dashboard | admin/dashboard/index | dashboard/index
                    break;
                } else {
                    unset($extractedUrl[$key]);
                }
            }
            $extractedUrl = array_values($extractedUrl);
        }

        if (!empty($extractedUrl[0])) { // asign class name
            $this->controller = ucfirst($extractedUrl[0]);
        } else {
            $this->controller = ucfirst($this->controller); // default controller
        }
        if (file_exists('app/controllers/' . $pathCheck . '.php')) {
            require_once('app/controllers/' . $pathCheck . '.php');
            if (class_exists($this->controller)) {
                // $this->controller = new $this->controller();
                unset($extractedUrl[0]);
                $extractedUrl = array_values($extractedUrl);
            } else {
                $this->renderError(404);
                return;
            }
        } else {
            $this->renderError(404);
            return;
        }
        if (!empty($extractedUrl[0])) {
            $this->action = $extractedUrl[0];
        }
        if (method_exists($this->controller, $this->action)) {
            // $this->controller->{$this->action}();
            unset($extractedUrl[0]);
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
