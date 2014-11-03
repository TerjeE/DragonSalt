<?php

function freeAllResults($mysqli){
    while ($mysqli->next_result()) {
        $result = $mysqli->use_result();
        if ($result instanceof mysqli_result) {
            $result->free();
        }
    }
}

$currency = 'NOK';
$db_username = 'moderator';
$db_password = 'ftyujnbv';
$db_name = 'barista';
$db_host = 'localhost';
try {
    $mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);
    $con = new mysqli($db_host, $db_username, $db_password, $db_name);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}

?>