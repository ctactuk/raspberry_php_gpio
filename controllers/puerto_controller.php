<?php
require_once('./helpers/db.php'); 
        
class puerto{
        public $puertos = array();
        
        public function obtenerPuertos(){
            $db = new db();
            $result = $db->execQuery("SELECT id, nombre, puerto, encendido, activo FROM puerto order by activo desc");
            
            return $result;
        }
    
        public function updatePuertos($table,$where,$set){
            $db = new db();
            $result = $db->update($table, $where, $set);
            
            return $result;
        }
    }
?>