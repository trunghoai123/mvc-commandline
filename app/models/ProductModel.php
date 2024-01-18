<?php
class ProductModel
{
    function __construct()
    {
    }

    function getListData()
    {
        return [
            [
                'id' => 1,
                'name' => 'product 1',
                'price' => 1000
            ],
            [
                'id' => 2,
                'name' => 'product 2',
                'price' => 2000
            ],
            [
                'id' => 3,
                'name' => 'product 3',
                'price' => 3000
            ],
        ];
    }
    function getDetail($id)
    {
        return [
            [
                'id' => 1,
                'name' => 'product 1',
                'price' => 1000
            ],
            [
                'id' => 2,
                'name' => 'product 2',
                'price' => 2000
            ],
            [
                'id' => 3,
                'name' => 'product 3',
                'price' => 3000
            ],
        ][$id];
    }
}
