<?php
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        include_once("config.php");






        $rs = $mysqli->query( 'CALL sp_admin' );
        ?>
            <table>
                <tr>
                    <td>Fornavn</td>
                    <td>Etternavn</td>
                    <td>id</td>
                    <td>username</td>
                </tr>
                <?php
                while($row = mysqli_fetch_array($rs))
                {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['firstname'] ?>
                        </td>
                        <td>
                            <?php echo $row['surname'] ?>
                        </td>
                        <td>
                            <?php echo $row['id'] ?>
                        </td>
                        <td>
                            <?php echo $row['username'] ?>
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
    }
}

?>
