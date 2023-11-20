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
  <title>GameShop</title>
</head>

<body>
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







  <script src="https://kit.fontawesome.com/ec4cd7dbd5.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>