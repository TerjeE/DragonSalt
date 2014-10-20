<?php
$con=mysqli_connect("localhost","moderator","ftyujnbv","barista");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "Connection established";
if(!empty($_POST['produkt_id'])) {
    $navn=mysqli_query($con,"SELECT produkt_navn FROM produkt where produkt_id=$_POST[produkt_id]");
    
    $test =mysqli_fetch_assoc($navn);
    $produkt_navn = $test['produkt_navn'];
    echo $produkt_navn;
    
    $sql="INSERT INTO `ferdigprodukt`(`fp_navn`, `produkt_id`) VALUES ('$produkt_navn', $_POST[produkt_id])";
    echo "<br>";
    echo "<br>";
    echo $sql;
    echo "<br>";
    echo "<br>";
    
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
    echo "<br>";
    echo " Added fp_id =  ";
    echo  mysqli_insert_id($con);
    echo " produkt_id = ";
    echo $_POST['produkt_id'];
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