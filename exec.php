<?php
include 'config/app_config.php'
include 'controllers/puerto_controller.php';
require_once('config/constants.php');
/*
define('PATH_TO_SCRIPT','/home/pi/domotica/command.py');
define('ROOT_PRIVILEGES','sudo');
define('PYTHON_COMMAND','python');*/

$puerto_cl = new puerto();

if(isset($_POST['port']) && isset($_POST['cmd'])){
        $port = intval($_POST['port']);
        $cmd = $_POST['cmd'];
        $estado = $cmd == 'on' ? 1 : 0;
        $resultado = "";
        $return = exec(ROOT_PRIVILEGES . ' ' . PYTHON_COMMAND . ' ' . PATH_TO_SCRIPT . ' ' . $port . ' ' . $cmd , $output);
    
        $puertos = $puerto_cl->updatePuertos('puerto', array('puerto' => $port), array('encendido' => $estado));

        echo json_encode($output);
}

?>