<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home Automated V0.1</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/bootstrap-switch.min.css">
    <style>
    body {
      padding-top: 50px;
      padding-bottom: 20px;
    }  
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <div  class="container">
        <?php

        $host = 'localhost';
        $username = 'root';
        $password = 'carlos2359';
        $database = 'myhome';

        $mysqli = new mysqli($host,$username,$password,$database);

        if ($mysqli->connect_error) {
            die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
        }

        $results = $mysqli->query("SELECT id, nombre, puerto, encendido FROM puerto");

        if( !$results)
          die($mysqli->error);
          echo '<div class="row">';
          while($row = $results->fetch_object()) {
            $disabled = $row->activo == 1 ? '' : 'disabled';
            $encendido = $row->encendido == 1 ? "img/statuson.png" : "img/statusoff.png";
            echo '
              <div class="col-sm-6 col-md-4 ' . $disabled . '" style="width:230px;">
                <div class="thumbnail">
                  <img data-src="holder.js/171x80" alt="171x80" class="' . $row->puerto . '" src="' . $encendido . '" data-holder-rendered="true" style="height: 80px; width: 171px; display: block;">
                  <div class="caption">
                    <p class="bg-info"><h4 id="thumbnail-label">' . $row->nombre . '<a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h4></p>
                    <p><input type="checkbox" name="my-checkbox" class="checkboxes" checked id="' . $row->puerto . '" data-handle-width="60"></p>
                  </div>
                </div>
              </div>';

          }
        echo '</div>';

        $results->free();
        $mysqli->close();

        ?>
      </div>
      <script src="js/jquery.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/bootstrap-switch.min.js"></script>
      <script>
      $(document).ready(function(){
          $('.checkboxes')
          .bootstrapSwitch()
          .on('switchChange.bootstrapSwitch', function(event, state) {
             if(state){
                 _executeCmd($(this).attr('id'), "on");
                 $('.'+$(this).attr('id')).attr("src", "img/statuson.png");
             }else{
                _executeCmd($(this).attr('id'), "off");
                 $('.'+$(this).attr('id')).attr("src", "img/statusoff.png");
             }
            });
          
          /*$('.on').click(function(){
              _executeCmd($(this).attr('id'), "on");
              $('.'+$(this).attr('id')).attr("src", "img/statuson.png");
          });

          $('.off').click(function(){
              _executeCmd($(this).attr('id'), "off");
              $('.'+$(this).attr('id')).attr("src", "img/statusoff.png");
          });*/

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
    </body>
</html>