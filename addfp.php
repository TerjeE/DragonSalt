<?php
$con=mysqli_connect("localhost","moderator","ftyujnbv","barista");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "Connection established";
if(!empty($_POST['prod_id'])) {
    $sql="INSERT INTO `ferdigprodukt`(`fp_navn`, `produkt_id`) VALUES ('ferdigprodukt', $_POST[prod_id])";
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
    echo "<br>";
    echo " Added fp_id =  ";
    echo  mysqli_insert_id($con);
    echo " produkt_id = ";
    echo $_POST['prod_id'];
    echo " into ferdigprodukt";
    echo "<br>";
    $fp_id = mysqli_insert_id($con);



    if(!empty($_POST['tilbehor_id'])) {
        foreach($_POST['tilbehor_id'] as $tilbehor_id) {
            echo "<br>";
            $sql="INSERT INTO `fp_tilbehor`(`fp_id`, `tilbehor_id`) VALUES ($fp_id,$tilbehor_id)";
            if (!mysqli_query($con,$sql)) {
                die('Error: ' . mysqli_error($con));
            }
            echo "Added " . $fp_id . " and " . $tilbehor_id . " to fp_tilbehor. <br>";


        }
    } else {
        echo "Ikke noe tilbehor";
    }
}

?>