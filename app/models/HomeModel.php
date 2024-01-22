<?php
class HomeModel
{

    private $table = 'username';
    function __construct()
    {
        // parent::__construct();
    }

    function getListData()
    {
        // return $this->db->query('SELECT * FROM ' . DB_NAME . '.' . $this->table)->fetchAll(PDO::FETCH_ASSOC);
    }
}
