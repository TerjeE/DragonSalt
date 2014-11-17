
<?php
session_start();
$error = 0;
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        include_once("config.php");
        
        ?>
<html>
    <head>
<!--        <meta charset="UTF-8">-->
         <link rel="stylesheet" type="text/css" href="../admin.css">
    </head>
    <body>
        <?php
        include_once("nav.php");
        ?>
        <h1>Tilbeh&oslash;r</h1>
         <?php
        include_once("spTilbehor.php");
         if (isset($_GET["error"]) && $_GET["error"] != "") {
                echo $_GET["error"];
         }

        ?>
        <div>
            <form name="input" action="admin_TilbLeggTil.php" method="post">
                <table>
                    <caption>Legg til et nytt tilbeh&oslash;r</caption>
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
        Please log in.
    </div>
    <?php
}
?>
</body>
</html>