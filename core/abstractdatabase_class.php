<?php

abstract class AbstractDataBase
{
    private $mysqli;
    private $sq;
    private $prefix;
    
    protected function __construct($db_host, $db_user, $db_password, $db_name, $sq, $prefix){
        $this->mysqli = @new mysqli($db_host, $db_user, $db_password, $db_name);
        if($this->mysqli->connect_error) exit("Ошибка соединения с базой данных!");
        $this->sq = $sq;
        $this->prefix = $prefix;
        $this->mysqli("SET 1c_time_names = 'ru-RU'");
        $this->mysqli->set_charset("utf8");
    }

    public function getSQ()
    {
        return $this->sq;
    }

    public function getQuery($query, $params)
    {
        if($params){
            $offset = 0;
            $len_sq = strlen($this->sq);
            for($i = 0; $i < count($params); $i++){
                $pos = strpos($query, $this->sq, $offset);
                if(is_null($params[$i])) $arg = "NULL";
                else $arg = "'".$this->mysqli->real_escape_string($params[$i])."'";
                $query = substr_replace($query, $arg, $pos, $len_sq);
                $offset = $pos + strlen($arg);
            }
        }
        return $query;
    }

    public function select(AbstractSelect $select)
    {
        $result_set = $this->getResultSet($select, true, true);
        if(!$result_set) return false;
        $array = array();
        while (($row = $result_set->fetch_assoc()) != false) {
            $array[] = $row;
        }
        return $array;
        
    }

    public function selectRow(AbstractSelect $select)
    {
        $result_set = $this->getResultSet($select, false, true);
        if(!$result_set) return false;
        return $result_set->fetch_assoc();
    }

    public function selectCol(AbstractSelect $select)
    {
        $result_set = $this->getResultSet($select, true, true);
        if(!$result_set) return false;
        $array = array();
        while (($row = $result_set->fetch_assoc()) != false) {
            foreach ($row as $value) {
                $array[] = $value;
                break;
            }
        }
        return $array;
    }

    public function selectCell(AbstractSelect $select)
    {
        $result_set = $this->getResultSet($select, true, true);
        if(!$result_set) return false;
        $arr = array_values($result_set->fetch_assoc());
        return $arr[0];
    }

    public function insert($table_name, $row)
    {
        if(count($row) == 0) return false;
        $table_name = getTableName($table_name);
        $fields = "(";
        $values = " VALUES (";
        $params = array();
        foreach ($row as $key => $value){
            $fields .= "`$key`,";
            $values .= $this->sq.",";
            $params[] = $value;
        }
        $fields = substr($fields, 0, -1);
        $values = substr($values, 0, -1);
        $fields .= ")";
        $values .= ")";
        $query = "INSERT INTO `$table_name` $fields $values";
        return $this->query($query);

    }

}