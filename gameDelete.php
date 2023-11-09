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

$gameDelete = $_POST["gameSelect"];

$sql = "DELETE FROM jogos WHERE gameID = '$gameDelete'";

if ($conn->query($sql) === true) {
    header("Location: admin.php");
} else {
    echo "erro" . $conn->error;
};
$conn->close();
