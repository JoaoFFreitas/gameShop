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
$id = $_SESSION["utilizador"];
$nome = $_POST["nome"];
$idade = $_POST["idade"];
$email = $_POST["email"];
$num = $_POST["telemovel"];
$nickname = $_POST["nickname"];
$morada = $_POST["morada"];
$postal = $_POST["postal"];
$cidade = $_POST["cidade"];
$pais = $_POST["pais"];
$userPassword = $_POST["password"];
$passEncrypt = password_hash("$userPassword", PASSWORD_BCRYPT);


$sql = "UPDATE Utilizadores SET nome = IFNULL(NULLIF('$nome', ''),nome),
   idade = IFNULL(NULLIF('$idade', ''),0),  
   nickname = IFNULL(NULLIF('$nickname', ''),nickname),
   telemovel = IFNULL(NULLIF('$num', ''), telemovel), 
   email = IFNULL(NULLIF('$email', ''), email),
   palavraChave = IFNULL(NULLIF('$passEncrypt', ''), palavraChave), 
   morada = IFNULL(NULLIF('$morada', ''),morada),
   postal = IFNULL(NULLIF('$postal', ''), postal), 
   cidade = IFNULL(NULLIF('$cidade', ''),cidade), 
   pais = IFNULL(NULLIF('$pais', ''), pais) 
   WHERE userID = '$id'";


if ($conn->query($sql) === true) {
    header("Location: user.php");
} else {
    echo "erro" . $conn->error;
};
$conn->close();
