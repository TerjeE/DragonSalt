<?php

include_once("classes.php");
include_once("config.php");
session_start();
$current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

    if (isset($_SESSION["produkt"])) {
        unset($_SESSION["ferdigprodukt"]);
        $ordrenavn = "error";
        foreach ($_SESSION["produkt"] as $produkt) {
            //Legg til produkt i ferdigprodukt
            $pid = $produkt->pid;
            $navn = $produkt->navn;

            /*echo "<b>";
            echo $navn . "<br>";
            echo $pid . "<br>";
            echo "</b>";*/

            $sql = 'INSERT INTO `ferdigprodukt`(`fp_navn`, `produkt_id`) VALUES ("'.$navn.'", '.$pid.')';
            /*echo "<br>";
            echo $sql;
            echo "<br>";*/
            if (!mysqli_query($con, $sql)) {
                die('Error: ' . mysqli_error($con));
            }
            //echo "<br>";
            $fp_id = mysqli_insert_id($con);


            if (!isset($_SESSION["ferdigprodukt"])) {
                $_SESSION["ferdigprodukt"] = array();
                array_push($_SESSION["ferdigprodukt"], $fp_id);
            } else {
                array_push($_SESSION["ferdigprodukt"], $fp_id);
            }


            /*echo " Added fp_id =  ";
            echo $fp_id;
            echo " produkt_id = ";
            echo $pid;*/
            echo "<br>";



            if (is_array($produkt->tilbehor)) {
                //Legg til tilbehor i fp_tilbehor
                /*echo "<ul>";*/
                foreach ($produkt->tilbehor as $tilbehor_id) {
                    /*echo "<li>";
                    //echo $tilbehor_id;
                    echo "</li>";*/



                    $sql = 'INSERT INTO `fp_tilbehor`(`fp_id`, `tilbehor_id`) VALUES ('.$fp_id.','.$tilbehor_id.')';
                    //echo $sql;
                    if (!mysqli_query($con, $sql)) {
                        die('Error: ' . mysqli_error($con));
                    }
                    //echo "<br>Added " . $fp_id . " and " . $tilbehor_id . " to fp_tilbehor. <br>";
                }
                /*echo "</ul>";*/
            } else {
                /*echo "<ul>";
                echo "<li>";
                echo htmlentities("Uten tilbehør");
                echo "</li>";
                echo "</ul>";*/
            }

        }
        include_once("hk_tilordre.php");
        include_once("hk_empty.php");



        header('Location: hk_ordre.php?ordre_navn=' . $navn);
        //echo '<span class="empty-cart"><a href="PHP/hk_tilfp.php?return_url=' . $current_url . '">Test</a></span>';
    } else {
        echo "Empty cart";
    }

?>