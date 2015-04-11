<?php
require_once('./helpers/db.php'); 
        
class puerto{
        public $puertos = array();
        
        public function puerto(){
                
        }
        
        public function obtenerPuertos(){
            $db = new db();
            $result = $db->execQuery("SELECT id, nombre, puerto, encendido, activo FROM puerto order by activo desc");
            return $result;
        }
    }
?>