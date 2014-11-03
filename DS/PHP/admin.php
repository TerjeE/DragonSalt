<?php
session_start();
$error = 0;
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        ?>
        <div>
            Hello mr admin!
        </div>

        <div>
            <form name="input" action="admin.php" method="post">
                <table>
                    <tr>
                        <td>
                            <label id="produkt_navn">Produkt navn:</label>
                        </td>
                        <td>
                            <label id="kat_id">Kategori:</label>
                        </td>
                        <td>
                            <label id="bilde">Bilde:</label>
                        </td>
                        <td>
                            <label id="beskrivelse">Beskrivelse:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="produkt_navn" type="text" name="produkt_navn" value="">
                        </td>
                        <td>
                            <select name="kat_id">
                                <option value="1">Kaffe</option>
                                <option value="2">Te</option>
                            </select>
                        </td>
                        <td>
                            <input id="bilde" type="text" name="bilde" value="pics/">
                        </td>
                        <td>
                            <input id="beskrivelse" type="text" name="beskrivelse" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Submit">
                        </td>
                    </tr>
                </table>
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