<div class="hk_frame">
    <div id="title">Handlekurv</div>
    <?php
    $current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    if (isset($_SESSION["produkt"]) && !empty($_SESSION["produkt"])) {
        echo "<div class='hk_produktliste'>";

        $index = 0;
        $totalpris = 0;
        foreach ($_SESSION["produkt"] as $produkt) {
            echo "<div class='hk_produkt'>";
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
            echo "<div class=\"hk_pris\">";
            echo number_format($produkt->pris, 2, '.', '');
            echo " kr";
            $totalpris += $produkt->pris;
            echo "</div>";
            echo '<div class="fjern-produkt"><a onclick="scrollTest(this)" href="PHP/hk_fjern.php?return_url=' . $current_url . '&Hk_index='.$index.'">X</a></div>';
            $index++;
            echo "</div>";
        }

        echo "</div>";
        echo "<form action='PHP/hk_tilfp.php' method='post'>";
        echo "<div class='hk_timepicker'>";
        echo "Pickup time:";



        echo "<INPUT NAME='time' TYPE='time' VALUE=".date('H:i',time()+600)." MIN=".date('H:i', time()+600).">";
        if(isset($_GET["error"])){
            echo "<br>";
            echo $_GET["error"];
        }
        echo"</div>";

        echo "<div class='hk_checkout'>";
        echo "<div class=\"totalpris\">";
        echo "Totalpris: ";
        echo number_format($totalpris, 2, '.', '');
        echo " kr";
        echo "</div>";

        echo '<input type="hidden" name="return_url" value="' . $current_url . '">';



        //Knapper
        echo "<br>";
        echo '<div class="empty-cart"><a onclick="scrollTest(this)" href="PHP/hk_empty.php?emptycart=1&return_url=' . $current_url . '">Empty Cart</a></div>';
        echo "<br>";
        echo '<div class="checkBtn"><input Value="Checkout" type="submit" onclick="scrollTest(this)""></input></div>';
        echo "</div>";
        echo "</form>";
    } else {
        echo "<div class='hk_produkt'>Empty cart</div>";
    }


    ?>

</div>