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

$resultados = mysqli_query($conn, "SELECT * FROM carrinhos LEFT JOIN jogos ON carrinhos.jogoID = jogos.gameID LEFT JOIN Utilizadores ON carrinhos.userID = Utilizadores.userID WHERE carrinhos.userID = $userID");
if ($resultados) {
    while ($jogo = mysqli_fetch_assoc($resultados)) {
        $amount = $jogo["amount"];
        $gameID = $jogo["jogoID"];
        $total = intval($jogo["amount"]) * floatval(str_replace(',', '.', $jogo["price"]));
        $morada = $jogo["morada"];
        $postal = $jogo["postal"];
        $cidade = $jogo["cidade"];
        $pais = $jogo["pais"];

        $sql = "INSERT INTO vendas (userID, jogoID, amount, totalPrice, `data`,morada, postal, cidade, pais) VALUES ($userID, $gameID, $amount, $total, NOW(),'$morada','$postal','$cidade','$pais')";
    
        if ($conn->query($sql) !== true) {
            echo "erro" . $conn->error;
            $ok = false;
        }
        else {
            $remove = "UPDATE jogos SET stock = stock - $amount WHERE gameID = $gameID";
            if ($conn->query($remove) !== true) {
                echo "erro" . $conn->error;
                $ok = false;
            }
        }


    }
}

if ($ok) {
    $sql = "DELETE FROM carrinhos WHERE userID = $userID";

    if ($conn->query($sql) === true) {
        header("Location: carrinho.php");
    } else {
        echo "erro" . $conn->error;
    };
   

}


$conn->close();
