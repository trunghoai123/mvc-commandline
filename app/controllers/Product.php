<?php

class Product extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('ProductModel');
    }
    function index()
    {
        if (!empty($this->model)) {
            // $data = $this->model->get();
            // $data = $this->model->getListData();
            // $data = $this->model->getList();
            // $this->model->addNewUser();
            // $this->model->updateUser();
            // $this->model->deleteUser();
            // global query builder
            // $this->db->table('users')->insert([
            //     'id' => random_int(1000, 5000),
            //     'name' => 'inserted user',
            //     'password' => '1233210',
            // ]);
            echo '<pre>';
            // print_r($data);
            echo '</pre>';
        } else {
            echo 'model not found';
        }
    }
    function first()
    {
        if (!empty($this->model)) {
            $data = $this->model->getFirst();
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
