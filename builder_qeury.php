<?php

class QueryBuilder
{
    public $dsn ="mysql:host=localhost;dbname=coding-academy";
    public $username = "root";
    public $pass = "";
    private $pdo ;
    private $finalQuery;

   
    public function __construct()
    {
        $this->pdo = new PDO($this->dsn,$this->username,$this->pass);
        echo "Connected successfully to DB";
    }

    public function select($failds = "*",$table,$condition = null){
        if($condition != null)$this->finalQuery="SELECT ".$failds." FROM ".$table." WHERE $condition";
        else $this->finalQuery="SELECT ".$failds." FROM ".$table;
        return $this;
    }

    public function update($table,$failds,$data,$condition){
        if(count($failds) == count($data)){
            $this->finalQuery = "UPDATE ".$table." SET ";
            for ($i=0 ; $i<count($data) ; $i++) {
                $column = $failds[$i];
                $value = $data[$i];
                if ($i == count($data) - 1) $pair = "$column = \"$value\"";
                else $pair = "$column = $value , ";
                $this->finalQuery .= $pair;
            }
            $this->finalQuery.=" WHERE ".$condition;
            echo $this->finalQuery;
        }
        return $this;
    }

    public function delete($table,$condition){
        $this->finalQuery = "DELETE FROM $table WHERE $condition";
        return $this;
    }


    
    public function orderBy ($failds){
        $this->finalQuery .= " ORDER BY $failds";
        return $this;
    }

    public function  count($failds,$table){

        $this->finalQuery="SELECT COUNT($failds) FROM $table";
        return $this;
    }
    public function insert($table,$failds,$data){
        if(count($failds) == count($data)){
            $this->finalQuery = "INSERT INTO $table (";
            for ($i=0 ; $i<count($failds) ; $i++) {
                $column = $failds[$i];
                if ($i == count($failds) - 1) $this->finalQuery.="$column)";
                else $this->finalQuery.="$column, ";
            }
            $this->finalQuery.=" data (";
            for ($i=0 ; $i<count($data) ; $i++) {
                $value = $data[$i];
                if ($i == count($data) - 1) $this->finalQuery.=" $value)";
                else $this->finalQuery.="$value, ";
            }
                echo $this->finalQuery;
        }
        return $this;
    }


    public function limit($rowCount,$offset = null){
        if($offset!= null){
            $this->finalQuery.=" LIMIT $offset , $rowCount";
        }else{
            $this->finalQuery.=" LIMIT $rowCount";
        }
        echo $this->finalQuery;
        return $this;
    }

    public function innerJoin($failds, $table1, $table2,$condition){
        $this->finalQuery = "SELECT $failds FROM $table1 INNER JOIN $table2 ON $condition";
        return $this;
    }

    public function leftJoin($failds, $table1, $table2,$condition){
        $this->finalQuery = "SELECT $failds FROM $table1 LEFT JOIN $table2 ON $condition";
        return $this;
    }

    public function rightJoin($failds, $table1, $table2,$condition){
        $this->finalQuery = "SELECT $failds FROM $table1 RIGHT JOIN $table2 ON $condition";
        return $this;
    }


}