<?php

class Home extends Controller
{
    private $model;
    function __construct()
    {
        $this->model = $this->loadModel('HomeModel');
    }

    function index()
    {
        if ($this->model !== false) {
            $data = $this->model->getListData();
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } else {
            echo 'model not found';
        }
    }
    function detail($param = '')
    {
        echo 'detail';
        echo '<br>';
        echo $param;
    }
}
