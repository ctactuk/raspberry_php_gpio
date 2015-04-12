<?php
require_once('./helpers/db.php'); 
        
class puerto{
        public $puertos = array();
        
        public function obtenerPuertos(){
            $db = new db();
            $result = $db->execQuery("SELECT id, nombre, puerto, encendido, activo FROM puerto order by activo desc");
            return $result;
        }
    
        public function updatePuertos(){
            $db = new db();
            $where = array ('id'=>1);
            $set = array('activo' => 1, 'encendido'=> 1);
            $result = $db->update('puerto', $where, $set);
            print_r($result);
        }
    }
?>