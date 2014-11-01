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
        // Now direct to users feed
        header("Location: ../index.php");
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
    <title>Basic login system</title>
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
    <h1>Simple PHP Login</h1>
    <form id="form" action="login.php" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label> <input id="username" type="text" name="username" value="" /> <br />
        <label for="password">Password:</label> <input id="password" type="password" name="password" /> <br />
        <input type="submit" value="Login" name="Submit" />
    </form>
</body>
</html>