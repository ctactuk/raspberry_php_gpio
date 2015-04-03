<?php
if(isset($_POST['puerto']) && isset($_POST['comando'])){
        $puerto = intval($_POST['puerto']);
        $comando = $_POST['comando'];
        /*$retorno = exec('sudo python /home/pi/domotica/command.py ' . $puerto . ' ' . $comando , $output);
        echo json_encode($output);*/
        echo json_encode($comando);
}

?>