<?php
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
    include_once("config.php");

  
  
  
  
  
$rs = $mysqli->query( 'CALL sp_SelAllProdukt' );
freeAllResults($mysqli);
?>
<form name="input" action="admin_fjern.php" method="post">
<table>
    <tr>
        <td>Produkt navn</td>
        <td>Produkt ID</td>
        <td>Kategori ID</td>
        <td>Bilde</td>
        <td>Beskrivelse</td>
        <td>Pris</td>
        <td>Fjern</td>
    </tr>
<?php
while($row = mysqli_fetch_array($rs))
{
    ?>
<tr>
    <td>
    <?php echo $row['produkt_navn'] ?>
    </td>
    <td>
    <?php echo $row['produkt_id'] ?>
    </td>
    <td>
    <?php echo $row['kat_id'] ?>
    </td>
    <td>
    <?php echo $row['bilde'] ?>
    </td>
    <td>
    <?php echo $row['beskrivelse'] ?>
    </td>
    <td>
    <?php echo $row['pris'] ?>
    </td>
    <td>
        <?php
        echo "<input  type='checkbox' name='produkt_id[]' value='" . $row['produkt_id'] . "'>";
        ?>
    </td>
</tr>


    <?php
//debug($row);
}
?>

</table>
    <input type="submit" value="Fjern">
</form>
    <?php

function debug($o)
{
print '<pre>';
print_r($o);
print '</pre>';
}
}
}

?>
