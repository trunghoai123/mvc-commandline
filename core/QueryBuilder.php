<?php

trait QueryBuilder
{
   private $table = '';
   private $select = '';
   private $where = '';
   private $limit = '';
   private $orderBy = '';
   private $join = '';

   private function table($table)
   {
      $this->table = $table;
      return $this;
   }

   private function select($select = '*')
   {
      $this->select = $select;
      return $this;
   }

   private function where($column, $condition, $value, $logicalOperator = 'AND')
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

   private function execute($fetch = 'fetchAll' /* fetchAll | fetch */)
   {
      $sql = "SELECT $this->select FROM $this->table $this->join $this->where $this->limit";
      $query = $this->__conn->query($sql);
      $this->table = '';
      $this->where = '';
      $this->select = '';
      $this->limit = '';
      if (!empty($query)) {
         return $query->$fetch();
      }
      return false;
   }

   private function limit($count, $offset = 0)
   {
      $this->limit = "LIMIT $offset, $count";
      return $this;
   }

   private function orderBy($column, $sort = 'ASC')
   {
      // $columns = array_filter(explode(',', $column));
      // if (!empty($columns) && count($columns) > 2) {
      //    $this->orderBy .= "ORDERBY " . implode(',', $columns);
      // } else {
      //    $this->orderBy = "ORDERBY $column $sort";
      // }
      $this->orderBy = "ORDERBY $column";
      return $this;
   }

   private function join($joinedTable, $relationship, $joinType)
   {
      $this->join .= "$joinType $joinedTable ON $relationship";
      return $this;
   }
}