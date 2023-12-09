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
$nomedeutilizador = $_SESSION["nome_utilizador"];
if (empty($nomedeutilizador)) {
    $nomedeutilizador = "Área Pessoal";
};

$sql = "SELECT * FROM Utilizadores WHERE userID = $id";
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="games for sale for ps5">
    <meta name="keywords" content="jogos de playstation 5, jogos de ação, jogos de aventura, jogos de corrida, jogos de luta, jogos de estratégia, jogos de RPG">
    <meta name="author" content="João Freitas">
    <link rel="stylesheet" href="Style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                            <a aria-current="page" href="index.php"><img src="images/gameshop-edit.png" alt="logo" class="headerLogo"></a>
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
    <?php
    if (empty($_SESSION["nome_utilizador"])) {
    ?>
        <div style="padding-top: 150px;">
            <form action="login.php" class="contactForm" method="POST">

                Utilizador<span class="marca">*</span> <input type="text" id="lUser" name="lUser" placeholder="Nome de utilizador" required> <br>
                Password<span class="marca">*</span> <input type="password" id="lPassword" name="lPassword" placeholder="password" required> <br>
                <p>Se ainda não está registado registe-se <a href="register.php" Style="color: blue; text-decoration: underline;">aqui.</a></p>
                <input id="button" type="submit" value="Login"> <br>
                <p id="obrigatorio">(Todos os campos marcados com <span class="marca">*</span> são de preenchimento obrigatório)
                </p>

            </form>
        </div>
    <?php
    } else { ?>
    
        <table class="gameTable">
        <tr><th colspan="8">Últimas Compras</th></tr>
        <tr>
            <th></th>
            <th>Título</th>
            <th>Unidades</th>
            <th>Preço(€)</th>
            <th>Data</th>
            <th>Estádo</th>
        </tr>

        <?php
        
        $resultados = mysqli_query($conn, "SELECT * FROM vendas LEFT JOIN jogos ON jogos.gameID = vendas.jogoID WHERE userID = $id");

        if ($resultados) {
            while ($jogo = mysqli_fetch_assoc($resultados)) {
        ?>
                <form action="comprar.php" method="post"><tr>
                    <td><img src="<?php echo $jogo['imagem']; ?>" alt="Imagem do jogo" style="width: 100px;"></td>
                    <td><?php echo $jogo['gameName']; ?></td>
                    <td><?php echo $jogo['amount']; ?></td>
                    <td><?php echo $jogo['totalPrice']; ?></td>
                    <td><?php echo $jogo['data']; ?></td>
                    <td>
                        <?php
                        switch ($jogo['estado']) {
                            case 'sent':
                                echo 'enviado';
                                break;
                            case 'cancelled':
                                echo 'anulado';
                                break;
                            default:
                                echo 'pendente';
                                break;
                        }
                        ?>
                    </td>
                    
                </tr></form>
        <?php
            }
        }
        ?>
    </table>


        <div style="padding-top: 20px;">
            <form action="updateUser.php" class="contactFormAlter" method="post">
                Nome<input type="text" id="nome" name="nome" placeholder="O seu nome"> <br>
                Idade<input type="number" id="idade" name="idade" min="18" > <br>
                NickName<input type="text" id="nickname" name="nickname" placeholder="O seu NickName" > <br>
                Telemóvel<input type="text" id="telemovel" name="telemovel" placeholder="O seu contacto" > <br>
                E-mail<input type="email" name="email" id="email" placeholder="O seu e-mail" > <br>
                Morada<input type="text" id="morada" name="morada" placeholder="A sua morada" > <br>
                Código Postal<input type="text" id="postal" name="postal" placeholder="Código Postal" > <br>
                Cidade<input type="text" id="cidade" name="cidade" placeholder="A sua cidade" > <br>
                País<input type="text" id="pais" name="pais" placeholder="O seu país" > <br>
                Password<input type="password" id="password" name="password" placeholder="Password" > <br>
                <p id="obrigatorio">(Insira só os dados que pretende alterar)</p>
                <input id="button" type="submit" value="Alterar dados" style="margin-top: 20px;"> <br>
            </form>
        </div>
    <?php
    }
    ?>







    <script src="https://kit.fontawesome.com/ec4cd7dbd5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>