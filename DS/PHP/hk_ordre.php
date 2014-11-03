<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Tøm handlekurv ved å ødelegge current session
if (isset($_GET["ordre_navn"])) {
    //session_destroy();
    ?>
    Din ordre:

<?php

    echo $_GET["ordre_navn"];

}