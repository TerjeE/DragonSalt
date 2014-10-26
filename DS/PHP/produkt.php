<div class="produkt">
    <?php

    $current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    //    echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $kategori = mysqli_query($con, "SELECT * FROM kategori");
    $produkt = mysqli_query($con, "SELECT * FROM produkt");


    //Går gjennom kategoriene
    while ($kat = mysqli_fetch_array($kategori)) {

        echo "<caption class='produktKat'> " . $kat['Kat_navn'] . "</caption>";


        $prod_i_kat = mysqli_query($con, "SELECT * FROM produkt WHERE kat_id=" . $kat['kat_id'] . "");
        while ($prod = mysqli_fetch_array($prod_i_kat)) {
            //Printer ut produktene i valgt kategori
            //echo '<form method="post" action="PHP\hk_leggTil.php">';

            $dick = $prod['produkt_navn'];


            //Knapp
            echo "<div class=\"knapp\" onclick=\"openBox('$dick')\">";
            echo "<p class=\"produktnavn\">";
            echo $dick;
            echo "</p>";

            $img = $prod['bilde'];
            echo '<img src="'.$img.'"></img>';
            echo "<p class=\"beskrivelse\">";
            echo $prod['beskrivelse'];
            echo "</p>";
            echo "</div>";

            //popup
            echo "<div class='et_produkt popup' id='$dick'>";

            //echo $prod['produkt_navn'];


            echo $prod['produkt_navn'];
            echo "<div class=\"produktpris\">";
            echo $prod['pris'];
            echo " kr";
            echo "</div>";



            //echo $prod['produkt_id'];
            echo '<form method="post" action="PHP/hk_leggTil.php">';
            echo '<input type="hidden" name="produkt_id" value="' . $prod['produkt_id'] . '">';
            echo '<input type="hidden" name="produkt_navn" value="' . $prod['produkt_navn'] . '">';
            echo '<input type="hidden" name="type" value="add">';
            echo '<input type="hidden" name="return_url" value="' . $current_url . '">';

            echo "<div class='tilbehor'>";
            $type = mysqli_query($con, "SELECT * FROM type");
            while ($ty = mysqli_fetch_array($type)) {
                echo "<div class='tilbehorType'>";
                echo $ty['type_navn'];

                $tilb = mysqli_query($con, "SELECT * FROM tilbehor WHERE type_id ='" . $ty['type_id'] . "'");

                $_SESSION["tempLastTilbehorNavn"] = array();
                while ($row_tilb = mysqli_fetch_array($tilb)) {
                    echo "<div class='tilbehornavn'>";
                    echo "<input  type='checkbox' name='tilbehor_id[]' value='" . $row_tilb['tilbehor_id'] . "'>";
                    echo $row_tilb['tilbehor_navn'];
                    echo "<div class=\"tilbehorpris\">";
                    echo $row_tilb['pris'];
                    echo " kr";
                    echo "</div>";
                    echo "</input>";
                    echo "</div>";


                }
                echo "</div>";


            }
            echo "</div>";


            echo '<button class="add_to_cart"> Add to Cart</button>';
            echo "</div>";
            echo "</form>";

        }


    }
    ?>

</div>