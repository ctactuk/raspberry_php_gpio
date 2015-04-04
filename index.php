<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
$puertos = array(
        "Puerto 1" => 2,
        "Puerto 2" => 3,
        "Puerto 3" => 4,
        "Puerto 4" => 9,
        "Puerto 5" => 10,
        "Puerto 6" => 17,
        "Puerto 7" => 27,
        "Puerto 8" => 22
);
$host = '104.131.91.98';
$username = 'root';
$password = 'carlos2359';
$database = 'myhome';

$mysqli = new mysqli($host,$username,$password,$database);

if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

//MySqli Select Query
$results = $mysqli->query("SELECT id, nombre, puerto, encendido FROM puerto where activo = 1");

if( !$results)
  die($mysqli->error);
echo '<div class="row">';
while($row = $results->fetch_object()) {
    /*echo "{$key} &nbsp;&nbsp;";
    echo '<button type="button" class="on btn btn-success" id="'.$puerto.'"/>ON</button>&nbsp;&nbsp;';
    echo '<button type="button" class="off btn btn-danger" id="'.$puerto.'"/>OFF</button><br/><br/>';*/
    //http://dummyimage.com/171x180/27a354/ffffff&text=Status:+ON

    echo '
      <div class="col-sm-6 col-md-4" style="width:230px;">
        <div class="thumbnail">
          <img data-src="holder.js/171x80" alt="171x80" class="'.$row->puerto.'" src="img/statuson.png" data-holder-rendered="true" style="height: 80px; width: 171px; display: block;">
          <div class="caption">
            <h3 id="thumbnail-label">'.$row->nombre.'<a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
            <p><button type="button" class="on btn btn-success" id="'.$row->puerto.'"/>Encender</button> <button type="button" class="off btn btn-danger" id="'.$row->puerto.'"/>&nbsp;Apagar&nbsp;</button></p>
          </div>
        </div>
      </div>
      ';

}
echo '</div>';
$results->free();

$mysqli->close();

?>





<script>
$(document).ready(function(){
    $('.on').click(function(){
        _executeCmd($(this).attr('id'), "on");
        $('.'+$(this).attr('id')).attr("src", "img/statuson.png");
    });

    $('.off').click(function(){
        _executeCmd($(this).attr('id'), "off");
        $('.'+$(this).attr('id')).attr("src", "img/statusoff.png");
    });
    
    function _executeCmd(port, cmd){
        $.ajax({
           url : "exec.php",
           type: "POST",
           data : { port : port, cmd : cmd },
           dataType:'json',
           success: function(data)
           {
                console.log(data);
                //data - response from server
           }
        });    
    }
    
});
</script>