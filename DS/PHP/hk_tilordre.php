<?php
include_once("classes.php");
include_once("config.php");

if (isset($_SESSION["ferdigprodukt"])) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    $navn = $randomString;
    $ordrenavn = $navn;
    //$dato = date("Y/m/d");
    $dato = $ousertime;
    $sql = 'INSERT INTO `ordre`(`ordre_navn`, `dato`) VALUES ("'.$navn.'", "'.$dato.'")';

    /*echo "<br>";
    echo $sql;
    echo "<br>";*/
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    $ordre_id = mysqli_insert_id($con);

    foreach ($_SESSION["ferdigprodukt"] as $ferdigprodukt) {

        $sql = 'INSERT INTO `ferdig_ordre`(`fp_id`, `ordre_id`) VALUES ("'.$ferdigprodukt .'", '.$ordre_id .')';

        /*echo "<br>";
        echo $sql;
        echo "<br>";*/
        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }

    }
}


?>