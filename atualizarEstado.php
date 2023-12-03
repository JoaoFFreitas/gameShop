<?php
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'gameShop';

$conn = @mysqli_connect($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
};

session_start();
$estado = $_POST["estado"];
$vendasID = $_POST["vendasID"];

$sql = "UPDATE vendas SET estado = '$estado' WHERE vendasID = $vendasID";

if ($conn->query($sql) !== true) {
    echo "erro" . $conn->error;
};
$conn->close();
