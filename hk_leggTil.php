

<?php
session_start();


if(!empty($_POST['produkt_id'])) {
    echo "produkt_navn: " .  $_POST['produkt_navn'];
    echo "<br>";
    echo "produkt_id: " .  $_POST['produkt_id'];

    if(!empty($_POST['tilbehor_id'])) {
        $tilbehor=$_POST['tilbehor_id'];
    } else {
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

    if(!isset($_SESSION["produkt"])){
        $_SESSION["produkt"]=array();
        $_SESSION["produkt"][0]=array();
        array_push($_SESSION["produkt"][0],$produkt);
        $_SESSION["produkt"][0]=array_merge($_SESSION["produkt"][0],$tilbehor);
    }else{
       $length = sizeof($_SESSION["produkt"]);
        $_SESSION["produkt"][$length]=array();
        array_push($_SESSION["produkt"][$length],$produkt);
        $_SESSION["produkt"][$length]=array_merge($_SESSION["produkt"][$length],$tilbehor);
    }


}
?>
