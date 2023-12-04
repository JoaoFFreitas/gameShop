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

$userID = $_SESSION["utilizador"];

$ok = true;



        $sql = "DELETE FROM carrinhos WHERE userID = $userID";
    
        if ($conn->query($sql) !== true) {
            echo "erro" . $conn->error;
            $ok = false;
        }
        else {
            if ($conn->query($sql) === true) {
                header("Location: carrinho.php");
            } else {
                echo "erro" . $conn->error;
            };
        };


$conn->close();