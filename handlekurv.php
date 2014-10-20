<div class="shopping-cart">

    <?php
    $current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    if (isset($_SESSION["produkt"])) {
        foreach ($_SESSION["produkt"] as $produkt) {
            echo "<b>";
            echo $produkt->navn . "<br>";
            echo "</b>";
            if (is_array($produkt->tilbehor)) {


                echo htmlentities(" Tilbehør: ");
                foreach ($produkt->tilbehor as $tilbehor_id) {
                    //echo $tilbehor_id;

                    $tilbehor_navn = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tilbehor WHERE tilbehor_id ='$tilbehor_id'"))['tilbehor_navn'];
                    echo $tilbehor_navn;
                    echo "\t";
                }
                echo "<br>";
            } else {
                echo htmlentities("Uten tilbehør");
                echo "<br>";

            }

        }
        //Knapper
        echo "<br>";
        echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
    }else{
        echo "Empty cart";
    }

    ?>

</div>