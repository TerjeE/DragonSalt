<?php
session_start();
$error = 0;
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        include_once("config.php");
        ?>
        <div>
            Hello mr admin!
        </div>
        <?php
        if(isset($_POST['produkt_navn'])){
            $produkt_navn = $_POST['produkt_navn'];
            $kat_id = $_POST['kat_id'];
            $pris = $_POST['pris'];
            $bilde = $_POST['bilde'];
            $beskrivelse = $_POST['beskrivelse'];

            echo $produkt_navn;
            echo $kat_id;
            echo $pris;
            echo $bilde;
            echo $beskrivelse;
            $sql = 'INSERT INTO `produkt`(`produkt_navn`, `kat_id`, `pris`, `bilde`, `beskrivelse`) VALUES ("'.$produkt_navn.'",'.$kat_id.','.$pris.', "'.$bilde.'","'.$beskrivelse.'")';
            //echo $sql;
            if(mysqli_query($con, $sql)){

            }

            header("Location: admin.php?error=" . mysqli_error($con));
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