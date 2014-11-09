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
        <h1>Admin</h1>
        <?php
        include_once("spAdmins.php");
        if (isset($_GET["error"]) && $_GET["error"] != "") {
            echo $_GET["error"];
        }

        ?>

        <div id="newadmin">
        <form id="form" action="admin_newadmin.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <label for="username">Username:</label>
                    </td>
                    <td>
                        <label for="firstname">Firstname:</label>
                        </td>
                    <td>
                        <label for="lastname">Lastname:</label>
                    </td>
                    <td>

                        <label for="password">Password:</label>
                    </td>
                    <td>
                        <label for="rpassword">Repeat Password:</label>
                    </td>

                </tr>
                <tr>
                    <td>
                        <input id="username" type="text" name="rusername" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" />

                    </td>
                    <td>
                        <input id="firstname" type="text" name="rfirstname" value="<?php if(isset($_POST['rfirstnamne'])){echo $_POST['rfirstname'];} ?>" />

                    </td>
                    <td>
                        <input id="lastname" type="text" name="rlastname" value="<?php if(isset($_POST['rlastname'])){echo $_POST['rlastname'];} ?>" />

                    </td>
                    <td>
                        <input id="password" type="password" name="rpassword" />

                    </td>
                    <td>
                        <input id="rpassword" type="password" name="rrpassword" />

                    </td>
                </tr>
            </table>
            <input type="submit" value="Register" name="Submit" />
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


<?php

?>