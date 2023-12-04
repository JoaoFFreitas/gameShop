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

$stock = $_POST["newStock"];
$price = $_POST["newPrice"];
$jogo = $_POST["gameSelect"];


$sql = "UPDATE jogos SET stock = IFNULL(NULLIF('$stock', ''),stock),
 price = IFNULL(NULLIF('$price', ''),price) WHERE gameID = '$jogo'";

if ($conn->query($sql) === true) {
    header("Location: admin.php");
} else {
    echo "erro" . $conn->error;
};
$conn->close();
