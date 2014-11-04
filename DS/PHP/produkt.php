<div class="produkt">
    <?php

    $current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    //    echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $kategori = mysqli_query($con, "SELECT * FROM kategori");
    $produkt = mysqli_query($con, "SELECT * FROM produkt");


    //Går gjennom kategoriene
    while ($kat = mysqli_fetch_array($kategori)) {

        //Kategori knapp
        $kategorinavn = $kat['Kat_navn'];
        echo "<div class=\"kategoriknapp\" onclick=\"openKat('$kategorinavn')\">";
        echo "<caption class='produktKat'> " . $kat['Kat_navn'] . "</caption>";
        echo "</div>";
    }

    //Går gjennom kategoriene
    //$kategori = mysqli_query($con, "SELECT * FROM kategori");
    mysqli_data_seek($kategori, 0);
    $iterations = 1;
    while ($kat = mysqli_fetch_array($kategori)) {
        $kategorinavn = $kat['Kat_navn'];
        $currentkat = 1;
        if (isset($_SESSION['kat_id'])){
            $currentkat = $_SESSION['kat_id'];
        }
        if($iterations != $currentkat) {
            echo "<div class='kategori' id='$kategorinavn' style='display: none'>";
        }else{
            echo "<div class='kategori' id='$kategorinavn' style='display: block'>";
        }


        //$prod_i_kat = mysqli_query($con, "SELECT * FROM produkt WHERE kat_id=" . $kat['kat_id'] . "");
        $prod_i_kat = mysqli_query($con, "CALL produktFraKatID(". $kat['kat_id'] .")");

        //frigjør det andre svaret fra prosedyren( prosedyrer returnerer svaret og prosedyrestatusen.
        freeAllResults($con);

        while ($prod = mysqli_fetch_array($prod_i_kat)) {
            //Printer ut produktene i valgt kategori
            //echo '<form method="post" action="PHP\hk_leggTil.php">';

            $produktNavn = $prod['produkt_navn'];


            //Knapp
            echo "<div class=\"et_produkt\">";
            echo "<p class=\"produktnavn\">";
            echo $produktNavn;
            echo "</p>";

            $img = $prod['bilde'];
            echo '<img src="'.$img.'"></img>';
            echo "<p class=\"beskrivelse\">";
            echo $prod['beskrivelse'];
            echo "</p>";


            echo "<div class=\"buttons\">";
            echo "<div class=\"pris\">";
            echo $prod['pris'];
            echo " kr";
            echo "</div>";
            echo "<button onclick=\"openBox('$produktNavn')\">";
            echo htmlentities("Med Tilbehør");
            echo "</button>";

            echo '<form method="post" action="PHP/hk_leggTil.php">';
            echo '<input type="hidden" name="produkt_id" value="' . $prod['produkt_id'] . '">';
            echo '<input type="hidden" name="produkt_navn" value="' . $prod['produkt_navn'] . '">';
            echo '<input type="hidden" name="return_url" value="' . $current_url . '">';
            echo '<input type="hidden" name="kat_id" value="' . $kat['kat_id'] . '">';
            echo "<button>";
            echo htmlentities("Kjøp");
            echo "</button>";
            echo "</form>";


            echo "</div>";


            echo "</div>";

            //popup
            echo "<div class='popup' id='$produktNavn' onclick='popupClicked()'>";


            echo $prod['produkt_navn'];
            echo "<div class=\"produktpris\">";
            echo $prod['pris'];
            echo " kr";
            echo "</div>";



            echo '<form method="post" action="PHP/hk_leggTil.php">';
            echo '<input type="hidden" name="produkt_id" value="' . $prod['produkt_id'] . '">';
            echo '<input type="hidden" name="produkt_navn" value="' . $prod['produkt_navn'] . '">';
            echo '<input type="hidden" name="return_url" value="' . $current_url . '">';
            echo '<input type="hidden" name="kat_id" value="' . $kat['kat_id'] . '">';

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


            echo '<button class="add_to_cart">Legg til</button>';
            echo "</div>";
            echo "</form>";

        }
        echo "</div>";

        $iterations++;
    }
    ?>

</div>