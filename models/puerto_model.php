<?php
class puerto_model{
    private $_id;
    private $_nombre;
    private $_puerto;
    private $_activo;
    private $_encendido;
    
    public function getId() {
        return $this->_id;
    }
    
    public function setId($id){
        $this->_id = $id;
    }
    
    public function getNombre() {
        return $this->_nombre;
    }
    
    public function setNombre($nombre){
        $this->_nombre = $nombre;
    }
    
    public function getPuerto() {
        return $this->_puerto;
    }
    
    public function setPuerto($_puerto){
        $this->_puerto = $puerto;
    }
    
    public function getActivo() {
        return $this->_activo;
    }
    
    public function setId($activo){
        $this->_activo = $activo;
    }
    
    public function getEncendido() {
        return $this->_encendido;
    }
    
    public function setEncendido($encendido){
        $this->_encendido = $encendido;
    }
}


?>