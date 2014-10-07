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
            echo "<tr><td>Produkt navn</td><td>id</td><td>Buy</td></tr>";


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
                echo "</form>";
            }

        echo "</table>";

    }
    ?>

</div>

<div class="shopping-cart">

    <?php
    if(isset($_SESSION["produkt"])){
        $total = 0;
        echo '<ol>';
        foreach ($_SESSION["produkt"] as $cart_itm)
            {
                echo '<li class="cart-itm">';
                echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["id"].'&return_url='.$current_url.'">&times;</a></span>';
                echo '<h3>'.$cart_itm["name"].'</h3>';
                echo '<div class="prod_id">Prod id : '.$cart_itm["id"].'</div>';
                echo '</li>';
            }
            echo '</ol>';
            echo '</strong> <a href="view_cart.php">Check-out!</a></span>';
            echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
        }else{
        echo 'Your Cart is empty';
    }
    ?>
</div>
