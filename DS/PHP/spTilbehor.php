<?php
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
    include_once("config.php");

  
  
  
  
  
$rs = $mysqli->query( 'CALL sp_tilbehor' );
?>
<form name="input" action="admin_TilbFjern.php" method="post">
<table>
    <tr>
        <td>Tilbeh&oslash;r navn</td>
        <td>Tilbeh&oslash;r ID</td>
        <td>Type ID</td>
        <td>Pris</td>
        <td>Fjern</td>
    </tr>
<?php
while($row = mysqli_fetch_array($rs))
{
    ?>
<tr>
    <td>
    <?php echo $row['tilbehor_navn'] ?>
    </td>
    <td>
    <?php echo $row['tilbehor_id'] ?>
    </td>
    <td>
    <?php echo $row['type_id'] ?>
    </td>
    <td>
    <?php echo $row['pris'] ?>
    </td>
    <td>
        <?php
        echo "<input  type='checkbox' name='tilbehor_id[]' value='" . $row['tilbehor_id'] . "'>";
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
