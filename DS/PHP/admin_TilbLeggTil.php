<?php
session_start();
$error = 0;
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        include_once("config.php");
        ?>

        <?php
        if(isset($_POST['tilbehor_navn'])){
            $tilbehor_navn = $_POST['tilbehor_navn'];
            $type_id = $_POST['type_id'];
            $pris = $_POST['pris'];

            echo $tilbehor_navn;
            echo $type_id;
            echo $pris;

            $sql = 'INSERT INTO `tilbehor`(`tilbehor_navn`, `type_id`, `pris`) VALUES ("'.$tilbehor_navn.'",'.$type_id.','.$pris.')';
            //echo $sql;
            if(mysqli_query($con, $sql)){

            }
            header("Location: admin_tilbehor.php?error=" . mysqli_error($con));
            

        }
        ?>
    <?php
    }else{
        $error = 1;
    }
}else{
    $error = 1;
}
if($error == 1){
    ?>
    <div>
        Please log inn.
    </div>
<?php
}
?>