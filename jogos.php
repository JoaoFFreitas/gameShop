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
$id = $_SESSION['utilizador'];
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
    <link rel="icon" href="images/gameshopLogo.png">
    <title>GameShop</title>
</head>

<body>
    <header class="mt-50">
        <nav>
            <div">
                <div id="navbarNavGS">
                    <ul class="headerGS">
                        <li class="itemGS">
                            <a aria-current="page" href="index.php">
                                <img src="images/gameshop-edit.png" alt="logo" class="headerLogo">
                            </a>
                        </li>
                        <li class="itemGS">
                            <a href="jogos.php">Jogos</a>
                        </li>
                        <?php
                        if ($_SESSION["nivel_utilizador"] === "admin") {
                        ?>
                            <li class="itemGS">
                                <a href="admin.php">Gestão</a>
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
                                <a href="user.php"><?php echo $nomedeutilizador; ?></a>
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
    <div class="gameTableScroll">
    <table class="gameTable">
        <tr>
            <th></th>
            <th>Título</th>
            <th class="hidden-on-mobile">Gênero</th>
            <th class="hidden-on-mobile">Plataforma</th>
            <th class="hidden-on-mobile">Ano</th>
            <?php if (!empty($id)) {
                ?>
                <th>Unidades</th>
                <?php
            }
            ?>
            <th>Preço(€)</th>
        </tr>

        <?php
        
        $resultados = mysqli_query($conn, "SELECT gameID, imagem, gameName, genero, plataforma, price, stock, ano FROM jogos");

        if ($resultados) {
            while ($jogo = mysqli_fetch_assoc($resultados)) {
        ?>
                <form action="comprar.php" method="post"><tr>
                    <td><img src="<?php echo $jogo['imagem']; ?>" alt="Imagem do jogo" style="width: 100px;"></td>
                    <td><?php echo $jogo['gameName']; ?></td>
                    <td class="hidden-on-mobile"><?php echo $jogo['genero']; ?></td>
                    <td class="hidden-on-mobile"><?php echo $jogo['plataforma']; ?></td>
                    <td class="hidden-on-mobile"><?php echo $jogo['ano']; ?></td>
                    <?php
                    if (!empty($id)) {
                        ?>
                            <td>
                                <input type="hidden" name="jogoID" value="<?php echo $jogo['gameID']; ?>">
                                <input type="number" name="unidades" value="1" size="2" max="<?php echo $jogo["stock"];?>">
                            </td>
                        <?php
                    }
                    ?>
                    <td><?php echo $jogo['price']; ?></td>
                    <td>
                        <?php
                        if (!empty($id)) {
                            ?>
                            <input
                                type="submit"
                                name="comprar"
                                <?php echo ($jogo['stock'] <= 0 ? 'disabled="true"' : ''); ?>
                                value="<?php if ($jogo['stock'] > 0) { echo 'Comprar'; } else { echo 'Esgotado'; } ?>"
                            >
                            <?php
                        }
                        ?>
                    </td>
                </tr></form>
        <?php
            }
        }
        ?>
    </table>
    </div>












    <script src="https://kit.fontawesome.com/ec4cd7dbd5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>