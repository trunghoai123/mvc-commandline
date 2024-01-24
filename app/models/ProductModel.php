<?php
class ProductModel extends Model
{
    private $table = 'users';
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
    function getList()
    {
        // return $this->db->table($this->table)->join('product', 'username.productId=product.id')->execute();
        // return $this->db->table($this->table)->select('id')->where('id', '>=', 1)
        //     ->where('id', '<', 5, 'AND')->limit(4)->execute();
        return $this->db->table($this->table)->select('*')
            ->where('name', 'like', '%')->where('id', '>=', 1, 'OR')
            ->limit(100)->orderBy('id asc')->join('invoices', 'invoices.user_id=users.id', 'inner join')->execute();
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
