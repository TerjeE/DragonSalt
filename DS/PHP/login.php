<?php
session_start();

if (isset($_POST['username'])) {

    include_once("config.php");

    // Set the posted data from the form into local variables
    $usname = strip_tags($_POST['username']);
    $paswd = strip_tags($_POST['password']);

    $usname = mysqli_real_escape_string($con, $usname);
    $paswd = mysqli_real_escape_string($con, $paswd);

    $sql = "SELECT id, username, password FROM admins WHERE username = '$usname' AND activated = '1' LIMIT 1";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($query);
    $uid = $row[0];
    $dbUsname = $row[1];
    $dbPassword = $row[2];

    // Check if the username and the password they entered was correct
    if ($usname == $dbUsname && password_verify($paswd, $dbPassword)) {
        // Set session
        $_SESSION['username'] = $usname;
        $_SESSION['id'] = $uid;
        // Set a cookie
        $cookie_name = "user";

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $cookie_value = $usname . $randomString;
        setcookie($cookie_name, $cookie_value, time() + (86400), "/");

        $_SESSION['cookie'] = $cookie_value;

        // Now direct to users feed
        header("Location: admin.php");
    } else {
        echo "<h2>Oops that username or password combination was incorrect.
		<br /> Please try again.</h2>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="UTF-8">
    <title>Barista DBMS</title>
    <style type="text/css">
        html {
            font-family: Verdana, Geneva, sans-serif;
        }
        h1 {
            font-size: 24px;
            text-align: center;
        }
        #wrapper {
            position: absolute;
            width: 100%;
            top: 30%;
            margin-top: -50px;/* half of #content height*/
        }
        #form {
            margin: auto;
            width: 200px;
            height: 100px;
        }
    </style>
</head>

<body>
<div id="wrapper">
    <h1>Barista DBMS Login</h1>
    <form id="form" action="login.php" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label> <input id="username" type="text" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" /> <br />
        <label for="password">Password:</label> <input id="password" type="password" name="password" /> <br />
        <input type="submit" value="Login" name="Submit" />
    </form>
</body>
</html>