<?php
//Tøm handlekurv ved å ødelegge current session
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1){
    $return_url = base64_decode($_GET["return_url"]); //return url
    session_destroy();
    header('Location:'.$return_url);
}
?>