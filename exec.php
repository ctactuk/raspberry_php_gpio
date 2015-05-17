<?php
echo json_encode($_POST);
include 'config/app_config.php'
//include 'controllers/puerto_controller.php';
/*
define('PATH_TO_SCRIPT','/home/pi/domotica/command.py');
define('ROOT_PRIVILEGES','sudo');
define('PYTHON_COMMAND','python');
*/
//$puerto_cl = new puerto();

if(isset($_POST['port']) && isset($_POST['cmd'])){
        $port = intval($_POST['port']);
        $cmd = $_POST['cmd'];
        $estado = $cmd == 'on' ? 1 : 0;
        $resultado = "";
        $return = exec('sudo python /home/pi/domotica/command.py' . $port . ' ' . $cmd , $output);
    
        //$puertos = $puerto_cl->updatePuertos('puerto', array('puerto' => $port), array('encendido' => $estado));

        echo json_encode($output);
        //echo json_encode($_POST);
}

?>