<?php
    include 'controllers/puerto_controller.php';
    
    class gpio{
        private $puerto_cl;
        public gpio(){
            $this->puerto_cl = new puerto();
        }
        
        public function executeCommand($port, $cmd){
            $resultado = "";
            $estado = $cmd == 'on' ? 1 : 0;
            
            $return = exec('sudo python /home/pi/domotica/command.py ' . $port . ' ' . $cmd , $output);
    
            $puertos = $this->puerto_cl->updatePuertos('puerto', array('puerto' => $port), array('encendido' => $estado));
            
            return $output;
        }
    }
?>
