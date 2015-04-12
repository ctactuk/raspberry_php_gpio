<?php
class puerto_model{
    private $id;
    private $nombre;
    private $puerto;
    private $activo;
    private $encendido;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function getPuerto() {
        return $this->puerto;
    }
    
    public function setPuerto($puerto){
        $this->puerto = $puerto;
    }
    
    public function getActivo() {
        return $this->activo;
    }
    
    public function setId($activo){
        $this->activo = $activo;
    }
    
    public function getEncendido() {
        return $this->encendido;
    }
    
    public function setEncendido($encendido){
        $this->encendido = $encendido;
    }
}


?>