<?php

if(!empty($_POST['produkt_id'])) {
    echo "produkt_navn: " .  $_POST['produkt_navn'];
    echo "<br>";
    echo "produkt_id: " .  $_POST['produkt_id'];

    if(!empty($_POST['tilbehor_id'])) {
        foreach($_POST['tilbehor_id'] as $tilbehor_id) {
            echo "<br>";
            echo  "tilbehor_id: $tilbehor_id";


        }
    } else {
        echo "<br>";
        echo "Ikke noe tilbehor";
    }



}
?>