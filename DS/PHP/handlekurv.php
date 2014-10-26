<div class="hk_frame">

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
            echo $produkt->pris;
            echo " kr";
            $totalpris += $produkt->pris;
            echo "</div>";
            echo '<span class="fjern-produkt"><a href="PHP/hk_fjern.php?return_url=' . $current_url . '&Hk_index='.$index.'">X</a></span>';
            $index++;
            echo "</div>";
        }
        echo "</div>";
        echo "<div class=\"totalpris\">";
        echo "Totalpris: ";
        echo $totalpris;
        echo " kr";
        echo "</div>";

        //Knapper
        echo "<br>";
        echo '<span class="empty-cart"><a href="PHP/hk_empty.php?emptycart=1&return_url=' . $current_url . '">Empty Cart</a></span>';
        echo "<br>";
        echo '<span class="empty-cart"><a href="PHP/hk_tilfp.php?return_url=' . $current_url . '">Test</a></span>';
    } else {
        echo "Empty cart";
    }

    ?>

</div>