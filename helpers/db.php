<?php

class db{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'carlos2359';
    private $database = 'myhome';
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
}

?>