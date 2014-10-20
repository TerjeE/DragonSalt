<?php
/**
 * Created by IntelliJ IDEA.
 * User: fun
 * Date: 20.10.14
 * Time: 10:57
 */
include_once("classes.php");
session_start();

$index = $_GET["Hk_index"];
array_splice($_SESSION["produkt"],$index,1);

$return_url = base64_decode($_GET["return_url"]);
header('Location:' . $return_url);