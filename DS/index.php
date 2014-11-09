<!DOCTYPE html>
<html onclick="htmlClicked()">

    <head>
        <link rel="icon" href="pics/favicon.ico" type="image/x-icon"/>
    </head>

    <link rel="stylesheet" type="text/css" href="indexStyle.css">
    <script type="text/javascript" src="JS/menyTest.js"></script>

    <body onload="scrolldown()">
    <?php
    include_once("PHP/classes.php");
    include_once("PHP/config.php");
    session_start();

    ?>


    <?php

        include_once 'PHP/produkt.php';
        include_once 'PHP/handlekurv.php';
        //include_once 'PHP/adminpanel.php';

    ?>

    </body>

</html>
