<?php
include_once("classes.php");
include_once("config.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
//Tøm handlekurv ved å ødelegge current session
if (isset($_GET["ordre_navn"])) {
    //session_destroy();
    ?>
<link rel="stylesheet" type="text/css" href="../kvittering.css">
<div class="kvittering">
<div class="kvittering_produktliste">
    Din ordre:

<?php

    echo $_GET["ordre_navn"];
    $sql = 'CALL fpFraOrdreNavn ("'.$_GET["ordre_navn"].'")';
    //echo $sql;

    $fp = mysqli_query($con,$sql);
    $totalpris = 0;
    freeAllResults($con);
    while($row = mysqli_fetch_assoc($fp)){


        $sql = 'CALL `tilbehorFraFp`('.$row['fp_id'].')';
        //echo $sql;
        $tilb = mysqli_query($con,$sql);
        freeAllResults($con);
?>
    <div class="kvittering_produkt">
        <div class="fp_navn">
        <?php echo $row['fp_navn'];?>
        </div>
        <div class="produkt_pris">
        <?php echo $row['produkt_pris'];?>.-
        </div>
        <?php
        $fppris = $row['produkt_pris'];
        while($row2 = $tilb -> fetch_array()) {
            //print_r($row2);
            if (isset ($row2['tilbehor_navn'])) {

            ?>
            <div class="tilbehor">
                <div class="tilbehornavn">
                    <?php echo $row2['tilbehor_navn']; ?>
                </div>
                <div class="kvittering_tpris">
                    <?php echo $row2['tilbehor_pris']; ?>.-
                </div>
            </div>

            <?php
                $fppris += $row2['tilbehor_pris'];
            }
        }
        $totalpris += $fppris;

?>
        <div class="fp_pris">
            <?php echo $fppris;?>.-
        </div>
        </div>
<?php
    }
    ?>
    <div class="total_pris">
        Totalpris:
    <?php echo $totalpris; ?>.-
    </div>

    <?php
    freeAllResults($con);
}

?>
</div>

</div>
</div>