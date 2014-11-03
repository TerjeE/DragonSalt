<html>
    <head>
<!--        <meta charset="UTF-8">-->
         <link rel="stylesheet" type="text/css" href="../admin.css">
    </head>
    <body>
        <div  id="nav">
              <ul>
                  <li><a href="admin.php">Produkt</a></li> 
              </ul>
             <ul>
                 <li><a href="admin_tilbehor.php">Tilbeh&oslash;r</a></li>
             </ul>
             <ul>
                 <li><a href="admin_fp.php">Ferdig Produkt</a></li>
             </ul>
            
            </div>
<?php
session_start();
$error = 0;
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        include_once("config.php");
        ?>
        <h1>Tilbeh&oslash;r</h2>
         <?php
        include_once("spTilbehor.php");
        ?>
        <div>
            <form name="input" action="admin_TilbLeggTil.php" method="post">
                <table>
                    <caption>Legg til nytt produkt</caption>
                    <tr>
                        <td>
                            <label id="tilbehor_navn">Tilbeh&oslash;r navn</label>
                        </td>
                        <td>
                            <label id="type_id">Type ID</label>
                        </td>
                        <td>
                            <label id="pris">Pris</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="tilbehor_navn" type="text" name="tilbehor_navn" value="">
                        </td>
                        <td>
                            <select name="type_id">

                                <?php
                                $type = mysqli_query($con, "SELECT * FROM type");
                                while ($typ = mysqli_fetch_array($type)) {
                                    ?>
                                    <option value="<?php echo $typ['type_id'] ?>"><?php echo $typ['type_navn'] ?></option>
                                    <?php
                                }


                                ?>
                            </select>
                        </td>
                        <td>
                            <input id="pris" type="text" name="pris" value="">
                        </td>
                    </tr>
                    
                </table>
                <input type="submit" value="Legg Til">
            </form>
        </div>
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
</body>
</html>