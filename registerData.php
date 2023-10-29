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

$nome = $_POST["nome"];
$email = $_POST["email"];
$num = $_POST["telemovel"];
$nickname = $_POST["nickname"];
$morada = $_POST["morada"];
$postal = $_POST["postal"];
$cidade = $_POST["cidade"];
$pais = $_POST["pais"];
$userPassword = $_POST["password"];
$passEncrypt = password_hash("$userPassword", PASSWORD_BCRYPT);


$sql = "INSERT INTO Utilizadores (nome, nickname, email, telemovel, morada, postal, palavraChave, cidade, pais) VALUES ('$nome','$nickname','$email','$num','$morada','$postal','$passEncrypt','$cidade','$pais')";

if ($conn->query($sql) === true) {
    header("Location: login.php");;
} else {
    echo "erro" . $conn->error;
};
$conn->close();
