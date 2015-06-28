<?php
require_once('./config/db_config.php');
class db{
    private $host = HOST;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $database = DATABASE;
    private $mysqli;
    
    
    public function db(){
        $this->connect(); 
    }
    
    private function connect(){
        $this->mysqli = new mysqli($this->host,$this->username,$this->password,$this->database);

        if ($this->mysqli->connect_error) {
            die('Error : ('. $this->mysqli->connect_errno .') '. $this->mysqli->connect_error);
        }
    }
    
    public function execQuery($query){
        $results = array();
        $exec = $this->mysqli->query($query);

        if( !$exec)
          die($this->mysqli->error);
        
         while($result = $exec->fetch_object()) {
            $results[] = $result;
         }
        
        $exec->free();
        $this->mysqli->close();
        
        return $results;
    }
    
    public function insert($table, $rows = null){
        $columns = '';
        $values = '';
        if(is_null($rows)){
            return array('result' => false, 'error'=> 'no rows sent...!');
        }else{
            if(isset($rows['columns']) && is_array($rows['columns'])){
                $columns = '(' . implode(',',$rows['columns']) . ')';
                if(isset($rows['values']) && is_array($rows['values'])){
                    $values = '(' . implode(',', $rows['values']) . ')';
                    if($columns != '' && $values != ''){
                        $query = "insert into {$table} {$columns} values {$values}";
                        if($this->mysqli->query($query))
                        {
                            return array('resultado' => true, 'inserted_id' => $mysqli->insert_id);
                        }
                        else{
                            return array('resultado' => false, 'error' => $this->mysqli->error);
                        }
                    }
                    $columns = '';
                    $values = '';
                }
            }        
        }
    }
    
    public function update($table, $where = null, $values = null){
        $where_update = '';
        $set = '';
        $update_query = '';
        $result = array();
        
        if(!is_null($where) && is_array($where)){
            $where_update .= ' where ';
            $count = 0;
            foreach($where as $key => $and){
                $where_update .= $key . " = '{$and}'";
                if(count($where) > 1 && $count < (count($where) -1)){
                    $where_update .= ' and ';
                }
                $count ++;
            }
        }
        
        if(!is_null($values) && is_array($values)){
            $set .= ' set ';
            $count = 0;
            foreach($values as $key => $value){
                $set .= $key . " = '{$value}'";
                if(count($values) > 1 && $count < (count($values) -1)){
                    $set .= ", ";
                }
                $count ++;
            }
        }
        
        if($where_update != '' and $set != ''){
            $update_query = "update {$table} {$set} {$where_update}";
        }
        
        if($update_query != ''){
            if($this->mysqli->query($update_query)){
                $result = array('resultado'=>true);
            }else{
                 $result = array(
                                 'resultado'=>false,
                                 'error' => $this->mysqli->error
                                );
            }
        }
        
        $this->mysqli->close();
        
        return $result;
    }
}

?>