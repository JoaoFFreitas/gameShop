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
$gameID = $_POST["jogoID"];
$amount = $_POST["unidades"];
$userID = $_SESSION["utilizador"];

$sql = "INSERT INTO carrinhos (userID, jogoID, amount) VALUES ($userID, $gameID, $amount)";

if ($conn->query($sql) === true) {
    header("Location: jogos.php");
} else {
    echo "erro" . $conn->error;
};
$conn->close();
