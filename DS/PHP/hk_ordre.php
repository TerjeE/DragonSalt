<?php
include_once("classes.php");
include_once("config.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
//Tøm handlekurv ved å ødelegge current session
if (isset($_GET["ordre_navn"])) {
    //session_destroy();
    ?>
    Din ordre:

<?php

    echo $_GET["ordre_navn"];

}
?>
<div class="kvittering">
    <div id="title">Kvittering</div>
    <?php

    $current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    if (isset($_SESSION["produkt"]) && !empty($_SESSION["produkt"])) {
        echo "<div class='kvittering_produktliste'>";

        $index = 0;
        $totalpris = 0;
        foreach ($_SESSION["produkt"] as $produkt) {
            echo "<div class='kvittering_produkt'>";
            echo "<b>";
            echo $produkt->navn . "<br>";
            echo "</b>";

            if (is_array($produkt->tilbehor)) {
                echo "<ul>";
                //echo htmlentities(" Tilbehør: ");
                foreach ($produkt->tilbehor as $tilbehor_id) {
                    echo "<li>";
                    //echo $tilbehor_id;

                    $tilbehor_navn = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tilbehor WHERE tilbehor_id ='$tilbehor_id'"))['tilbehor_navn'];
                    echo $tilbehor_navn;

                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<ul>";
                echo "<li>";
                echo htmlentities("Uten tilbehør");
                echo "</li>";
                echo "</ul>";
            }
            echo "<div class=\"kvittering_pris\">";
            echo $produkt->pris;
            echo " kr";
            $totalpris += $produkt->pris;
            echo "</div>";
            $index++;
            echo "</div>";
        }

        echo "</div>";

        echo "<div class=\"totalpris\">";
        echo "Totalpris: ";
        echo $totalpris;
        echo " kr";
    }




    ?>

</div>