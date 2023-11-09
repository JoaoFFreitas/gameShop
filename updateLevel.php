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

$utilizador1 = $_POST['userLevel'];
$nivel = $_POST['nivel'];

$sql = "UPDATE Utilizadores SET nivel = '$nivel' WHERE userID = '$utilizador1'";
if ($conn->query($sql) === true) {
    header("Location: admin.php");
} else {
    echo "erro" . $conn->error;
};
$conn->close();
