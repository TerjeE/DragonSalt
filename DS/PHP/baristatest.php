<?php
$con = mysqli_connect("localhost", "moderator", "ftyujnbv", "barista");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "Connection established";

$kategori = mysqli_query($con, "SELECT * FROM kategori");
$produkt = mysqli_query($con, "SELECT * FROM produkt");
$tilbehor = mysqli_query($con, "SELECT * FROM tilbehor");
$type = mysqli_query($con, "SELECT * FROM type");

echo "<br>Tables imported";

echo "<br>Printer produkt under kategori"
?>
    <br>
    <br>
    <div id="produkt">

        Produkt list
        <?php
        //Går gjennom kategoriene
        while ($kat = mysqli_fetch_array($kategori)) {

            echo "<table border='1'>";
            echo "<caption> " . $kat['Kat_navn'] . "</caption>";
            echo "<tr>";
            echo "<td>";
            echo "Produkt navn";
            echo "</td>";
            echo "<td>";
            echo "id";
            echo "</td>";
            echo "</tr>";


            $prod_i_kat = mysqli_query($con, "SELECT * FROM produkt WHERE kat_id=" . $kat['kat_id'] . "");
            while ($prod = mysqli_fetch_array($prod_i_kat)) {
                //Printer ut produktene i valgt kategori
                echo "<tr>";
                echo "<td>";
                echo $prod['produkt_navn'];
                echo "</td>";
                echo "<td>";
                echo $prod['produkt_id'];
                echo "</td>";
                echo "</tr>";
            }


            echo "</table>";
        }
        ?>
    </div>
    <div style="height: 100px;">
    </div>
    <div>
        <?php
        //Eksempel på popup
        $valgt_prod_id = 2;


        $valgt_prod_id_query = mysqli_query($con, "SELECT * FROM produkt WHERE produkt_id = $valgt_prod_id");
        $data = mysqli_fetch_assoc($valgt_prod_id_query);
        echo "<form action='addfp.php' method='post'>";
        //echo $data['produkt_navn'];
        $kat_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS antall FROM produkt"))['antall'];
        echo "Velg produkt: 1-";
        echo $kat_count;
        echo "<input type='number' name='prod_id' min='1' max='$kat_count'>";

        echo "<table border='1'>";
        while ($ty = mysqli_fetch_array($type)) {
            echo "<tr>";
            echo "<td>";
            echo "<b>" . $ty['type_navn'] . "</b>";


            $tilb = mysqli_query($con, "SELECT * FROM tilbehor WHERE type_id ='" . $ty['type_id'] . "'");
            echo "<table border=0> <tr>";
            while ($row_tilb = mysqli_fetch_array($tilb)) {


                //$typer = mysqli_query($con,"SELECT * FROM type WHERE type_id = " . $row_ty_til['type_id'] . "");
                //while($row_typer = mysqli_fetch_array($typer)){

                echo "<td>";
                echo "<input type='checkbox' name='tilbehor_id[]' value='" . $row_tilb['tilbehor_id'] . "'>";
                echo $row_tilb['tilbehor_navn'];
                echo "</input>";
                echo "</td>";


                //}


            }

            echo "</tr></table>";
            echo "</td>";
            echo "</tr>";

        }
        echo "</table>";
        echo "<input type='submit' value='Legg til'>";
        echo "<input type='reset' name='reset' value='Reset'>";
        echo "</form>";
        ?>


    </div>



<?php
mysqli_close($con);
?>