<?php
abstract class Model extends Database
{
    use QueryBuilder; // table - select - where - execute
    protected $db;
    protected function __construct()
    {
        $this->db = new Database();
    }

    abstract function tableFill();
    abstract function fieldFill();
    function get()
    {
        $table = $this->tableFill();
        $field = $this->fieldFill();
        $sql = "SELECT $field FROM $table";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function getFirst()
    {
        $table = $this->tableFill();
        $field = $this->fieldFill();
        $sql = "SELECT $field FROM $table";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}
