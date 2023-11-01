<?php
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'gameShop';

$conn = @mysqli_connect($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

$ok = '';
if ($_POST["acc"] == "submeter") {
    $tamanho = $_FILES["ficheiro"]["size"];
    $tipo = $_FILES["ficheiro"]["type"];
    $ficheiro = $_FILES["ficheiro"]["name"];
    $temp = $_FILES["ficheiro"]["tmp_name"];
    $utilizador = $_SESSION["nome_utilizador"];
    $titulo = $_POST["gameName"];
    $type = $_POST["gameType"];
    $gameYear = $_POST["gameYear"];
    $gamePlat = $_POST["gamePlat"];
    $stock = $_POST["stock"];
    $price = $_POST["price"];

    if ($ficheiro != "") {
        $unique = $_POST["gameName"] . '_' . uniqid() . '_' . $ficheiro;
        $destino = "games/novo_" . $unique;
        if (copy($temp, $destino)) {
            $ok = 'Ficheiro submetido : sim';
            $utilizador = $_SESSION["nome_utilizador"];
            $sql = "INSERT INTO jogos (gameName, imagem, plataforma, genero, price, ano, stock) VALUES ('$titulo', '$destino', '$gamePlat', '$type', '$price', '$gameYear','$stock')";
            if ($conn->query($sql) === true) {
                echo "Informações inseridas na base de dados com sucesso.";
                header("Location: admin.php");
            } else {
                echo "Erro ao inserir informações na base de dados: " . $conn->error;
            }
        } else {
            $ok = 'Ficheiro submetido : não';
        }
    }
} else {
    $ok = 'Nenhum ficheiro submetido';
};
echo $ok;

$image = imagecreatefrompng($destino);
