<?php
session_start();
include_once("config.php");
//Tøm handlekurv ved å ødelegge current session
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1){
    $return_url = base64_decode($_GET["return_url"]); //return url
    session_destroy();
    header('Location:'.$return_url);
}

//Legge til et produkt i handlekurv
if(isset($_POST["type"]) && $_POST["type"]=='add'){
    $produkt_id =   filter_var($_POST["produkt_id"], FILTER_SANITIZE_STRING); //produkt_id
    $return_url = base64_decode($_POST["return_url"]); //return_url
    $results = mysqli_query($con,"SELECT produkt_navn FROM produkt WHERE produkt_id='$produkt_id' LIMIT 1");
    $obj = mysqli_fetch_assoc($results);
    if($results){ //We have the product info
        //Prepare array for the session variable
        $new_product = array(array('name'=>$obj["produkt_navn"], 'id'=>$produkt_id));

        if(isset($_SESSION["produkt"])){ //if we have the session
            $found = false; //set found item to false

            foreach ($_SESSION["produkt"] as $cart_itm){ //loop through session array
                if($cart_itm["id"] == $produkt_id){ //the item exist in array
                    $produkt[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"]);
                    $found = true;

                }else{

                    $produkt[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"]);
                }
            }
            if($found == false)//we didnt find item in array
            {
                //add new user item in array
                $_SESSION["produkt"] = array_merge($produkt, $new_product);

            }else{
                //found user item in array list,
                //can instead increase quantity
                //$_SESSION["produkt"] = $produkt;
                $_SESSION["produkt"] = array_merge($produkt, $new_product);
            }
        }else{
            //create a new session var if does not exist
            $_SESSION["produkt"] = $new_product;

        }
    }
    //redirect back to original page
    header('Location:'.$return_url);

}

//Remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["produkt"]))
{
    $produkt_id = $_GET["removep"];
    $return_url = base64_decode($_GET["return_url"]);

    foreach ($_SESSION["produkt"] as $cart_itm)
    {
        if($cart_itm["id"] != $produkt_id){
            $produkt[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"]);
        }

        //create a new product list for cart
        $_SESSION["produkt"] = $produkt;
    }
   header('Location:'.$return_url);


}
?>