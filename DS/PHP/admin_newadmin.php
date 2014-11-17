<?php
session_start();
$error = 0;
if(isset($_SESSION['id']) & isset($_SESSION['username'])){
    if($_COOKIE['user'] == $_SESSION['cookie']) {
        include_once("config.php");
        ?>

        <?php
        if(isset($_POST['rusername'])){
            $username = $_POST['rusername'];
            $firstname = $_POST['rfirstname'];
            $surname = $_POST['rsurname'];
            $password = $_POST['rpassword'];
            $rpassword = $_POST['rrpassword'];

            if($password != $rpassword){
                header("Location: admin_registrer.php?error=passwords does not match");
                exit();

            }

            $options = array('cost' => 12);
            $hash = password_hash($password, PASSWORD_BCRYPT, $options);
            $sql = 'INSERT INTO `admins`(`username`, `firstname`, `surname`, `password`, `activated`) VALUES ("'.$username.'","'.$firstname.'","'.$surname.'","'.$hash.'","'. 1 .'")';
            echo $sql;
            //echo $sql;
            if(mysqli_query($con, $sql)){

            }
            header("Location: admin_registrer.php?error=" . mysqli_error($con));


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