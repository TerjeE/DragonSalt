<div class="shopping-cart">

    <?php

    $current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

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