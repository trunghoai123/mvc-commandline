<?php

trait QueryBuilder
{
   private $table = '';
   private $select = '';
   private $where = '';
   private $limit = '';
   private $orderBy = '';
   private $join = '';

   protected function table($table)
   {
      $this->table = $table;
      return $this;
   }

   protected function select($select = '*')
   {
      $this->select = $select;
      return $this;
   }

   protected function where($column, $condition, $value, $logicalOperator = 'AND')
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

   protected function execute($fetch = 'fetchAll' /* fetchAll | fetch */)
   {
      $sql = "SELECT $this->select FROM $this->table $this->join $this->where $this->orderBy $this->limit";
      echo $sql;
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

   protected function limit($count, $offset = 0)
   {
      $this->limit = "LIMIT $offset, $count";
      return $this;
   }

   protected function orderBy($column,/* $sort = 'ASC'*/)
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

   protected function join($joinedTable, $relationship, $joinType)
   {
      $this->join .= "$joinType $joinedTable ON $relationship";
      return $this;
   }
}
