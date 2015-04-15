<?php
    include 'controllers/puerto_controller.php';
    
    class gpio{
        private $puerto_cl = new puerto();
        public gpio(){
            
        }
        
        public function executeCommand($port, $cmd){
            $resultado = "";
            $estado = $cmd == 'on' ? 1 : 0;
            
            $return = exec('sudo python /home/pi/domotica/command.py ' . $port . ' ' . $cmd , $output);
    
            $puertos = $puerto_cl->updatePuertos('puerto', array('puerto' => $port), array('encendido' => $estado));
            
            return $output;
        }
    }
?>
