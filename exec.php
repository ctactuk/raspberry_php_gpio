<?php
$host = 'localhost';
$username = 'root';
$password = 'carlos2359';
$database = 'myhome';

$mysqli = new mysqli($host,$username,$password,$database);

if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

if(isset($_POST['port']) && isset($_POST['cmd'])){
        $port = intval($_POST['port']);
        $cmd = $_POST['cmd'];
        $estado = $cmd == 'on' ? 1 : 0;
        $resultado = "";
        $return = exec('sudo python /home/pi/domotica/command.py ' . $port . ' ' . $cmd , $output);
    
        $results = $mysqli->query("UPDATE puerto SET encendido={$estado} WHERE puerto = {$port}");
    
        $query = "UPDATE puerto SET encendido=? WHERE puerto=?";

        if($results){
            $resultado = "ok";
        }else{
            $resultado = "no_ok";
        }
        echo json_encode($output);
        //echo json_encode($port);
}

?>