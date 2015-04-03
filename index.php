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

foreach($puertos as $key=>$puerto){
    echo "{$key} &nbsp;&nbsp;";
    echo '<button type="button" class="on btn btn-success" id="'.$puerto.'"/>ON</button>&nbsp;&nbsp;';
    echo '<button type="button" class="off btn btn-danger" id="'.$puerto.'"/>OFF</button><br/><br/>';
}
?>
<script>
$(document).ready(function(){
    $('.on').click(function(){
        $.ajax({
           url : "exec.php",
           type: "POST",
           data : {puerto : pad($(this).attr('id'),2), comando : "on" },
           dataType:'json',
           success: function(data)
           {
                console.log(data);
                //data - response from server
           }
        });
    });

    $('.off').click(function(){
        $.ajax({
           url : "exec.php",
           type: "POST",
           data : {puerto : pad($(this).attr('id'),2), comando : "off" },
           dataType:'json',
           success: function(data)
           {
                console.log(data);
                //data - response from server
           }
        });
    })
});

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
</script>