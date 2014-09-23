<?php
$con=mysqli_connect("localhost","moderator","ftyujnbv","barista");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "Connection established";
if(!empty($_POST['tilbehor_id'])) {
    $sql="INSERT INTO `ferdigprodukt`(`fp_navn`, `produkt_id`) VALUES ('ferdigprodukt',1)";
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
    echo " Added test_ferdigprodukt ";
    echo  mysqli_insert_id($con);
    echo "<br>";
    $fp_id = mysqli_insert_id($con);




    foreach($_POST['tilbehor_id'] as $tilbehor_id) {
        echo "<br>";
        $sql="INSERT INTO `fp_tilbehor`(`fp_id`, `tilbehor_id`) VALUES ($fp_id,$tilbehor_id)";
        if (!mysqli_query($con,$sql)) {
            die('Error: ' . mysqli_error($con));
        }
        echo "Added " . $fp_id . " and " . $tilbehor_id . " to db. <br>";


    }
}

?>