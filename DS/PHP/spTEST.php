<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../admin.css">
    </head>
    <body>
<?php
  include_once("config.php");
  session_start();
  
  
  
$rs = $mysqli->query( 'CALL sp_SelAllProdukt' );
?>
<table>
    <tr>
        <td>Produkt navn</td>
        <td>Produkt ID</td>
        <td>Pris</td>
        <td>Kategori ID</td>
        <td>Bilde</td>
        <td>Beskrivelse</td>
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
    <?php echo $row['pris'] ?>
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
</tr>

    <?php
//debug($row);
}
?>
</table>
    <?php

function debug($o)
{
print '<pre>';
print_r($o);
print '</pre>';
}
?>
  </body>

</html>
  