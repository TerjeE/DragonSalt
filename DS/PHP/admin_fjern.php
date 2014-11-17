<?php
session_start();
$error = 0;
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        include_once("config.php");
        ?>
        <div>
            Hello mr admin!
        </div>
        <?php
        if(isset($_POST['produkt_id'])){
            $sql = "DELETE FROM produkt where produkt_id in (";
            if (is_array($_POST['produkt_id'])) {
                foreach ($_POST['produkt_id'] as $produkt_id) {
                    $sql = $sql . $produkt_id;
                    if ($produkt_id === end($_POST['produkt_id'])){
                        
                    }else{
                        $sql = $sql .  ",";
                    }
                    //delete from your_table
                    //where id in (value1, value2, ...);
                }
                $sql = $sql . ")";
            }
            //echo $sql;
            if(mysqli_query($con,$sql)){
            
                 header("Location: admin.php");
            }else{
                echo "Error: ";
                echo "This produkt has already been bought, therefore it can not be deleted.";
                echo "<br>";
                echo "This is for security reasons";
                //echo mysqli_error($con);
                die();
            }
        }
        ?>
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