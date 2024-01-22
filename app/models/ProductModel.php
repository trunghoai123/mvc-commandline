<?php
class ProductModel extends Model
{
    private $table = DB_NAME . '.username';
    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return $this->table;
    }

    function fieldFill()
    {
        return 'id, name'; // or '*'
    }
    function getListData()
    {
        return $this->db->query('SELECT * FROM ' . $this->table)->fetchAll(PDO::FETCH_ASSOC);
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
