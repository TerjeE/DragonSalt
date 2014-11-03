
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
        <h1>Produkt</h1>
         <?php
        include_once("spTest.php");
        ?>
        <div>
            <form name="input" action="admin_leggtil.php" method="post">
                <table>
                    <caption>Legg til nytt produkt</caption>
                    <tr>
                        <td>
                            <label id="produkt_navn">Produkt navn</label>
                        </td>
                        <td>
                            <label id="kat_id">Kategori</label>
                        </td>
                        <td>
                            <label id="bilde">Bilde</label>
                        </td>
                        <td>
                            <label id="beskrivelse">Beskrivelse</label>
                        </td>
                        <td>
                            <label id="pris">Pris</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="produkt_navn" type="text" name="produkt_navn" value="">
                        </td>
                        <td>
                            <select name="kat_id">

                                <?php
                                $kategori = mysqli_query($con, "SELECT * FROM kategori");
                                while ($kat = mysqli_fetch_array($kategori)) {
                                    ?>
                                    <option value="<?php echo $kat['kat_id'] ?>"><?php echo $kat['Kat_navn'] ?></option>
                                    <?php
                                }


                                ?>
                            </select>
                        </td>
                        <td>
                            <input id="bilde" type="text" name="bilde" value="pics/">
                        </td>
                        <td>
                            <input id="beskrivelse" type="text" name="beskrivelse" value="">
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