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
$nomedeutilizador = $_SESSION["nome_utilizador"];
if (empty($nomedeutilizador)) {
  $nomedeutilizador = "Área Pessoal";
};

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="games for sale for ps5">
  <meta name="author" content="João Freitas">
  <link rel="stylesheet" href="Style.css">
  <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="script.js"></script>  
  <title>GameShop</title>
</head>

<body onload="valorTotal()">
  <header class="sticky-top mt-50">
    <nav>
      <div">
        <div id="navbarNavGS">
          <ul class="headerGS">
            <li class="itemGS">
              <a aria-current="page" href="index.php"><img src="images/gameshop-edit.png" alt="logo"></a>
            </li>
            <li class="itemGS">
              <a href="jogos.php">Jogos</a>
            </li>
            <?php
            if ($_SESSION["nivel_utilizador"] === "admin") {
            ?>
              <li class="itemGS">
                <a href="admin.php">Administrador</a>
              </li>
            <?php
            } else if (empty($_SESSION["nome_utilizador"])) {
            ?>
              <li class="itemGS">
                <a href="login.php">Login</a>
              </li>
            <?php
            }
            ?>
            <?php
            if (!empty($_SESSION["nome_utilizador"])) {
            ?>
              <li class="itemGS">
                <a href="user.php"><?php echo $nomedeutilizador;
                                    $_SESSION["userID"] ?></a>
              </li>
              <li class="itemGS">
                <a href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i></a>
              </li>
              <li class="itemGS">
                <a href="logout.php">Logout</a>
              </li>
            <?php
            }
            ?>

          </ul>
        </div>
        </div>
    </nav>
  </header>
  <br><br><br><br><br>

  <table class="gameTable">
        <tr>
            <th></th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Plataforma</th>
            <th>Ano</th>
            <th>Unidades</th>
            <th>Preço(€)</th>
        </tr>

  <?php
        $userID = $_SESSION["utilizador"];
        
        $resultados = mysqli_query($conn, "SELECT * FROM carrinhos LEFT JOIN jogos ON carrinhos.jogoID = jogos.gameID WHERE userID = $userID");

        if ($resultados) {
            while ($jogo = mysqli_fetch_assoc($resultados)) {
              $amount = $jogo["amount"];
        ?>
                <tr>
                    <td><img src="<?php echo $jogo['imagem']; ?>" alt="Imagem do jogo" style="width: 100px;"></td>
                    <td><?php echo $jogo['gameName']; ?></td>
                    <td><?php echo $jogo['genero']; ?></td>
                    <td><?php echo $jogo['plataforma']; ?></td>
                    <td><?php echo $jogo['ano']; ?></td>
                    <td class="amount"><?php echo $amount ?></td>
                    <td class="valor"><?php echo $jogo['price']; ?></td>
                </tr>
        <?php
            }
        }
        ?>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total: <span id=valorTotal></span>€(IVA incluído)</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><form action="finalizarCompra.php" method="post">
                      <input type="hidden" id="formTotal" name="total" value="0">
                      <input type="submit" value="Comprar" name="comprar">
                    </form></th>
                </tr>
    </table>





  <script src="https://kit.fontawesome.com/ec4cd7dbd5.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>