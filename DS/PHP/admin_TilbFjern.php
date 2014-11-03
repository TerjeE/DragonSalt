<?php
session_start();
$error = 0;
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        include_once("config.php");
        ?>

        <?php
        if(isset($_POST['tilbehor_id'])){
            $sql = "DELETE FROM tilbehor where tilbehor_id in (";
            if (is_array($_POST['tilbehor_id'])) {
                foreach ($_POST['tilbehor_id'] as $tilbehor_id) {
                    $sql = $sql . $tilbehor_id;
                    if ($tilbehor_id === end($_POST['tilbehor_id'])){
                        
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
            
                 header("Location: admin_tilbehor.php");
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