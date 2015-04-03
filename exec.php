<?php
if(isset($_POST['port']) && isset($_POST['cmd'])){
        $port = intval($_POST['port']);
        $cmd = $_POST['cmd'];
        $return = exec('sudo python /home/pi/domotica/command.py ' . $port . ' ' . $cmd , $output);
    
        echo json_encode($output);
        //echo json_encode($port);
}

?>