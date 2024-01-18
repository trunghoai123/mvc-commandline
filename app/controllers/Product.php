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
            $this->loadView(
                'layouts/client_layout',
                [
                    'page' => 'products/detail',
                    'pageTitle' => 'Detail Product',
                    'data' => ['detail' => $data],
                ]
            );
        } else {
            echo 'model not found';
        }
    }
    function listProduct()
    {
        if (!empty($this->model)) {
            $data = $this->model->getListData();
            $this->loadView(
                'layouts/client_layout',
                [
                    'page' => 'products/list',
                    'pageTitle' => 'List Product',
                    'data' => [ // use for sub view
                        'products' => $data
                    ],
                ]
            );
        } else {
            echo 'model not found';
        }
    }
}
