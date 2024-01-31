<?php


class Database
{
    use QueryBuilder; // table - select - where - execute
    private  $__conn;

    public function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    function insertData($table, $data)
    {
        if (!empty($data)) {
            $fieldString = '';
            $valueString = '';
            foreach ($data as $key => $value) {
                $fieldString .= $key . ',';
                $valueString .= "'" . $value . "',";
            }
            $fieldString = trim($fieldString, ',');
            $valueString = trim($valueString, ',');
            $sql = "INSERT INTO $table($fieldString) VALUES ($valueString)";
            $status = $this->query($sql);
        }
    }

    function updateData($table, $data, $condition = '')
    {
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                $updateStr .= $key . "='" . $value . "',";
            }

            $updateStr = rtrim($updateStr, ',');
            if (!empty($condition)) {
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            } else {
                $sql = "UPDATE $table SET $updateStr";
            }
            $status = $this->query($sql);
            if ($status) {
                return true;
            }
        }
    }

    function deleteData($table, $condition = '')
    {
        if (!empty($condition)) {
            $sql = "DELETE FROM $table WHERE $condition";
        } else {
            $sql = "DELETE FROM $table";
        }
        $status = $this->query($sql);
        if ($status) {

            return true;
        }
        return false;
    }
    function query($sql)
    {
        $statement = $this->__conn->query($sql);
        return $statement;
    }
    // function query1()
    // {
    //     $statement = $this->__conn->query('SELECT * FROM php_mvc.username');
    //     print_r($statement->fetch());
    //     return $statement->fetchAll(PDO::FETCH_COLUMN);
    // }

    function lastInsertId()
    {
        return $this->__conn->lastInsertId();
    }
}
