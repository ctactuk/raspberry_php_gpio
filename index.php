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

echo '<div class="row">';
foreach($puertos as $key=>$puerto){
    /*echo "{$key} &nbsp;&nbsp;";
    echo '<button type="button" class="on btn btn-success" id="'.$puerto.'"/>ON</button>&nbsp;&nbsp;';
    echo '<button type="button" class="off btn btn-danger" id="'.$puerto.'"/>OFF</button><br/><br/>';*/
    //http://dummyimage.com/171x180/27a354/ffffff&text=Status:+ON

    echo '
      <div class="col-sm-6 col-md-4" style="width:230px;">
        <div class="thumbnail">
          <img data-src="holder.js/171x180" alt="171x180" class="'.$puerto.'" src="http://dummyimage.com/171x180/e02121/ffffff&text=Status:+OFF" data-holder-rendered="true" style="height: 180px; width: 171px; display: block;">
          <div class="caption">
            <h3 id="thumbnail-label">'.$key.'<a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
            <p><button type="button" class="on btn btn-success" id="'.$puerto.'"/>Encender</button> <button type="button" class="off btn btn-danger" id="'.$puerto.'"/>&nbsp;Apagar&nbsp;</button></p>
          </div>
        </div>
      </div>
      ';

}
echo '</div>';
?>

<script>
$(document).ready(function(){
    $('.on').click(function(){
        _executeCmd($(this).attr('id'), "on");
        $('.'+$(this).attr('id')).attr("src", "http://dummyimage.com/171x180/27a354/ffffff&text=Status:+ON");
    });

    $('.off').click(function(){
        _executeCmd($(this).attr('id'), "off");
        $('.'+$(this).attr('id')).attr("src", "http://dummyimage.com/171x180/e02121/ffffff&text=Status:+OFF");
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