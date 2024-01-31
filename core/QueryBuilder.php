<?php

trait QueryBuilder
{
   private $table = '';
   private $select = '';
   private $where = '';
   private $limit = '';
   private $orderBy = '';
   private $join = '';

   public function table($table)
   {
      $this->table = $table;
      return $this;
   }

   public function select($select = '*')
   {
      $this->select = $select;
      return $this;
   }

   public function where($column, $condition, $value, $logicalOperator = 'AND')
   {
      $prefix = '';
      if (empty($this->where)) {
         $prefix = 'WHERE';
      } else {
         $prefix = $logicalOperator;
      }
      $this->where .= "$prefix $column $condition '$value'";
      return $this;
   }

   public function execute($fetch = 'fetchAll' /* fetchAll | fetch */)
   {
      $sql = "SELECT $this->select FROM $this->table $this->join $this->where $this->orderBy $this->limit";
      $query = $this->__conn->query($sql);
      $this->table = '';
      $this->where = '';
      $this->select = '';
      $this->limit = '';
      if (!empty($query)) {
         return $query->$fetch(PDO::FETCH_ASSOC);
      }
      return false;
   }

   public function insert($data)
   {
      if (!empty($data)) {
         $this->insertData($this->table, $data);
      }
   }

   public function update($data, $field = '', $condition = '', $value = '')
   {
      if (!empty($data)) {
         $cond = '';
         if (!empty($field) && !empty($condition) && !empty($value)) {
            $this->where($field, $condition, $value);
            $cond = str_replace('WHERE', '', $this->where);
            $cond = trim($cond);
         }
         return $this->updateData($this->table, $data, $cond);
      }
      return false;
   }

   public function delete($field = '', $condition = '', $value = '')
   {
      $cond = '';
      if (!empty($field) && !empty($condition) && !empty($value)) {
         $this->where($field, $condition, $value);
         $cond = str_replace('WHERE', '', $this->where);
         $cond = trim($cond);
      }
      return $this->deleteData($this->table, $cond);
   }

   public function limit($count, $offset = 0)
   {
      $this->limit = "LIMIT $offset, $count";
      return $this;
   }

   public function orderBy($column,/* $sort = 'ASC'*/)
   {
      // $columns = array_filter(explode(',', $column));
      // if (!empty($columns) && count($columns) > 2) {
      //    $this->orderBy .= "ORDERBY " . implode(',', $columns);
      // } else {
      //    $this->orderBy = "ORDERBY $column $sort";
      // }
      $this->orderBy = "ORDER BY $column";
      return $this;
   }

   public function join($joinedTable, $relationship, $joinType)
   {
      $this->join .= "$joinType $joinedTable ON $relationship";
      return $this;
   }
}
