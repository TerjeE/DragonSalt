<?php
session_start();
include_once("config.php");
?>

<div class="produkt">
    <?php

    $current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $kategori = mysqli_query($con,"SELECT * FROM kategori");
    $produkt = mysqli_query($con,"SELECT * FROM produkt");



        //Går gjennom kategoriene
        while($kat = mysqli_fetch_array($kategori)) {

            echo "<table border='1'>";
            echo "<caption> " . $kat['Kat_navn'] . "</caption>";
            echo "<tr>";
            echo "<td>";
            echo "Produkt navn";
            echo "</td>";
            echo "<td>";
            echo "id";
            echo "</td>";
            echo "</tr>";


            $prod_i_kat = mysqli_query($con,"SELECT * FROM produkt WHERE kat_id=" . $kat['kat_id'] . "");
            while($prod = mysqli_fetch_array($prod_i_kat)){
                //Printer ut produktene i valgt kategori
                echo '<form method="post" action="cart_update.php">';
                echo "<tr>";
                echo "<td>";
                echo $prod['produkt_navn'];
                echo "</td>";
                echo "<td>";
                echo $prod['produkt_id'];
                echo "</td>";

                echo "<td>";
                echo '<button class="add_to_cart"> Add to Cart</button>';
                echo '<input type="hidden" name="produkt_id" value="'.$prod['produkt_id'].'">';
                echo '<input type="hidden" name="type" value="add">';
                echo '<input type="hidden" name="return_url" value="'.$current_url.'">';

                echo "</td>";

                echo "</tr>";
            }

        echo "</table>";

    }
    ?>

</div>