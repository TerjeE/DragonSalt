<?php
session_start();
include_once("config.php");
?>

<div class="produkt">
    <?php

    $current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $kategori = mysqli_query($con, "SELECT * FROM kategori");
    $produkt = mysqli_query($con, "SELECT * FROM produkt");



    //Går gjennom kategoriene
    while ($kat = mysqli_fetch_array($kategori))
    {
        echo "<br>";
        echo "<caption> " . $kat['Kat_navn'] . "</caption>";




        $prod_i_kat = mysqli_query($con, "SELECT * FROM produkt WHERE kat_id=" . $kat['kat_id'] . "");
        while ($prod = mysqli_fetch_array($prod_i_kat))
        {
            //Printer ut produktene i valgt kategori
            echo '<form method="post" action="addfp.php">';
            echo "<table border='1'>";

            echo "<tr><td>Produkt navn</td><td>id</td><td>Buy</td></tr>";
            echo "<tr>";
            echo "<td>";
            echo $prod['produkt_navn'];
            echo "</td>";
            echo "<td>";
            echo $prod['produkt_id'];
            echo "</td>";

            echo "<td>";
            echo '<button class="add_to_cart"> Add to Cart</button>';
            echo '<input type="hidden" name="produkt_id" value="' . $prod['produkt_id'] . '">';
            echo '<input type="hidden" name="type" value="add">';
            echo '<input type="hidden" name="return_url" value="' . $current_url . '">';

            echo "</td>";

            echo "</tr>";
            echo "<td>";

            $type = mysqli_query($con, "SELECT * FROM type");
            while ($ty = mysqli_fetch_array($type))
            {
                echo "<br>";
                echo "<b>" . $ty['type_navn'] . "</b>";
                echo "<br>";

                $tilb = mysqli_query($con, "SELECT * FROM tilbehor WHERE type_id ='" . $ty['type_id'] . "'");

                while ($row_tilb = mysqli_fetch_array($tilb))
                {

                    echo "<input type='checkbox' name='tilbehor_id[]' value='" . $row_tilb['tilbehor_id'] . "'>";
                    echo $row_tilb['tilbehor_navn'];
                    echo "</input>";

                }


            }


            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "</form>";

        }



    }
    ?>

</div>