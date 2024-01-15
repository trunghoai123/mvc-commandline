<?php

class Product extends Controller
{
    private $model;
    function __construct()
    {
        $this->model = $this->loadModel('ProductModel');
    }

    function index()
    {
        if (!empty($this->model)) {
            echo 'hello';
            $data = $this->model->getListData();
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } else {
            echo 'model not found';
        }
    }
    function detail($id = '0')
    {
        if (!empty($this->model)) {
            $data = $this->model->getDetail($id);
            $this->loadView('products/detail', ['detail' => $data]);
        } else {
            echo 'model not found';
        }
    }
    function listProduct()
    {
        if (!empty($this->model)) {
            $data = $this->model->getListData();
            $this->loadView('products/list',  ['products' => $data]);
        } else {
            echo 'model not found';
        }
    }
}
