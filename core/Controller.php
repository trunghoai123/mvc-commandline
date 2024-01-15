<?php

class Controller
{
    function __construct()
    {
        echo 'controller';
        echo '<br>';
    }

    function loadModel($model)
    {
        if (file_exists(DIR_ROOT . '/app/models/' . $model . '.php')) {
            require_once(DIR_ROOT . '/app/models/' . $model . '.php');
            if (class_exists($model)) {
                return new $model();
            }
        }
        return false;
    }

    function loadView($view, $data = [])
    {
        if (file_exists(DIR_ROOT . '/app/views/' . $view  . '.php')) {
            extract($data);
            require_once(DIR_ROOT . '/app/views/' . $view . '.php');
            return true;
        } else {
            echo 'view not found';
            return false;
        }
    }
}
