

<?php
include_once("classes.php");
session_start();



if(!empty($_POST['produkt_id'])) {
    echo "produkt_navn: " .  $_POST['produkt_navn'];
    echo "<br>";
    echo "produkt_id: " .  $_POST['produkt_id'];

    if(!empty($_POST['tilbehor_id'])) {
        $tilbehor=$_POST['tilbehor_id'];
    } else {
        $tilbehor=" ";
        echo "<br>";
        echo "Ikke noe tilbehor";
    }

    if(!empty($_POST['produkt_navn'])) {
            echo "<br>";
            echo  "produkt_navn: " . $_POST['produkt_navn'];
            $produkt = $_POST['produkt_navn'];
    } else {
        echo "<br>";
        echo "Ikke noe produkt_navn";
    }

    $prod = new produkt($produkt,$_POST['produkt_id'],$tilbehor);
    if(!isset($_SESSION["produkt"])){
        $_SESSION["produkt"]=array();
        array_push($_SESSION["produkt"],$prod);
    }else{
        array_push($_SESSION["produkt"],$prod);
    }

//    if(!isset($_SESSION["produkt"])){
//        $_SESSION["produkt"]=array();
//        $_SESSION["produkt"][0]=array();
//        array_push($_SESSION["produkt"][0],$produkt);
//        $_SESSION["produkt"][0]=array_merge($_SESSION["produkt"][0],$tilbehor);
//    }else{
//       $length = sizeof($_SESSION["produkt"]);
//        $_SESSION["produkt"][$length]=array();
//        array_push($_SESSION["produkt"][$length],$produkt);
//        $_SESSION["produkt"][$length]=array_merge($_SESSION["produkt"][$length],$tilbehor);
//    }

    $return_url = base64_decode($_POST["return_url"]); //return_url

    header('Location:'.$return_url);


}
?>
