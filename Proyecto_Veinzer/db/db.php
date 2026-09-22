<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "Veinzer";

$connection = mysqli_connect($server, $user, $pass, $db);

if (!$connection) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>