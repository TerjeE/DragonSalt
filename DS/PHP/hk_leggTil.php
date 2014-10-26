<?php
include_once("classes.php");
include_once("config.php");
session_start();


if (!empty($_POST['produkt_id'])) {
    $_SESSION['kat_id']=$_POST['kat_id'];

    $produkt_id = $_POST['produkt_id'];
    echo "produkt_navn: " . $_POST['produkt_navn'];
    echo "<br>";
    echo "produkt_id: " . $produkt_id;

    if (!empty($_POST['tilbehor_id'])) {
        $tilbehor = $_POST['tilbehor_id'];
    } else {
        $tilbehor = " ";
        echo "<br>";
        echo "Ikke noe tilbehor";
    }

    if (!empty($_POST['produkt_navn'])) {
        echo "<br>";
        echo "produkt_navn: " . $_POST['produkt_navn'];
        $produkt = $_POST['produkt_navn'];
    } else {
        echo "<br>";
        echo "Ikke noe produkt_navn";
    }


    //Pris
    //Pris er sum av tilbehor pris og produkt pris
    $sql = 'SELECT pris FROM `produkt` WHERE produkt_id="'.$produkt_id.'"';
    echo "<br>";
    echo $sql;
    echo "<br>";
    if (!($sqlpris = mysqli_query($con, $sql))) {
        die('Error: ' . mysqli_error($con));
    }
    $test = mysqli_fetch_assoc($sqlpris);
    $produkt_pris = $test['pris'];
    echo $produkt_pris;
    $totalpris = $produkt_pris;

    if (is_array($_POST['tilbehor_id'])) {
        foreach ($_POST['tilbehor_id'] as $tilbehor_id) {
            $tilbehor_pris = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tilbehor WHERE tilbehor_id ='$tilbehor_id'"))['pris'];
            $totalpris += $tilbehor_pris;
        }
    }

    $prod = new produkt($produkt, $produkt_id, $tilbehor , $totalpris);
    if (!isset($_SESSION["produkt"])) {
        $_SESSION["produkt"] = array();
        array_push($_SESSION["produkt"], $prod);
    } else {
        array_push($_SESSION["produkt"], $prod);
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

    header('Location:' . $return_url);


}
?>
