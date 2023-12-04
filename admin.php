<?php
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
    <script src="script.js"></script>
    <link rel="icon" href="images/gameshopLogo.png">
    <title>GameShop</title>
</head>

<body>
    <header class="sticky-top mt-50">
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



    <!-- Inserir Jogos na BD -->
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
    <?php } else { ?>

        </div>
        <div class="insertGameForm">
            <form action="insertGame.php" method="POST" enctype="multipart/form-data">
                <h2>Inserir Jogos</h2>
                <br>
                <p>Inserir imagem</p>
                <br>
                <input type="file" name="ficheiro" size="35" style="padding-left: 20px;"> <br>
                <br>
                <p>Nome do jogo:</p><input type="text" name="gameName" id="gameName" placeholder="Insira o nome do jogo"> <br>
                <p>Tipo de jogo:</p><input type="text" name="gameType" id="gameType" placeholder="Tipo de jogo"><br>
                <p>Plataforma:</p><input type="text" name="gamePlat" id="gamePlat" placeholder="Plataforma"><br>
                <p>Ano de lançamento:</p><input type="text" name="gameYear" id="gameYear" placeholder="Ano de lançamento"><br>
                <p>Unidades:</p><input type="text" name="stock" id="stock" placeholder="Unidades em stock"><br>
                <p>Preço:</p><input type="text" name="price" id="price" placeholder="Preço do jogo"><br>
                <br>
                <button type="submit" name="enviar">Submeter Ficheiro</button>
                <input type="hidden" name="acc" value="submeter">
            </form>
        </div>
    <?php
    }
    ?>
<br><br>
    <!-- Remover jogos da BD -->
    <form class="gameSelect" action="gameDelete.php" method="post">
        <h3>Apagar Jogos</h3>
        <label for="">Selecionar Jogo</label>
        <select name="gameSelect" id="gameSelect">
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

            $id = $_SESSION["utilizador"];

            $query = "SELECT gameID, gameName FROM jogos";
            $resultado = $conn->query($query);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['gameID'] . "'>" . $row['gameName'] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select>
        <input type="submit" value="Apagar Jogo">
    </form>
    <br><br>
<!-- Aterar stocks e preços -->
<form class="gameStockUpdate" action="gameStockUpdate.php" method="post">
        <h3>Atualizar Stocks</h3>
        <label for="">Selecionar Jogo</label>
        <select name="gameSelect" id="gameSelect">
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

            $id = $_SESSION["utilizador"];

            $query = "SELECT gameID, gameName FROM jogos";
            $resultado = $conn->query($query);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['gameID'] . "'>" . $row['gameName'] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select>
        <input type="text" name="newStock" placeholder="Novo Stock">
        <input type="text" name="newPrice" placeholder="Novo Preço"><br>
        <input type="submit" value="Atualizar">
    </form>
    <br><br>
    <!-- Alterar nivel de utilizador -->
    <form action="updateLevel.php" class="contactForm admin" method="POST">
        <h3 style="margin:auto;">Alterar nivel de acessos</h3>
        <label for="">Selecionar utilizador</label>

        <select name="userLevel" id="userLevel">
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


            $query = "SELECT userID, nickname FROM Utilizadores";
            $resultado = $conn->query($query);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['userID'] . "'>" . $row['nickname'] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select>
        <label for="">Selecionar Nível</label>
        <select name="nivel" id="nivel">
            <option value="admin">admin</option>
            <option value="">utilizador</option>
        </select>
        <input id="button" type="submit" name="submit" value="Alterar Nível de acessos" style="margin-top: 20px;"> <br>

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
        if (!empty($nomedeutilizador)) {
            $query = "SELECT * FROM Utilizadores WHERE nivel = 'admin' ";

            $resultado = $conn->query($query);

            if ($resultado->num_rows > 0) {
                echo '<table class="tableAdm">';
                echo '<tr><th>Administradores:</th></tr>';

                while ($row = $resultado->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td class="admins">-' . $row['nickname'] . ';</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        } ?>

    </form>

    <!-- Visualização de vendas -->
    <div class="gameTableScroll">
    <table class="gameTable">
        <tr><th class="left" colspan="8">Últimas Vendas</th></tr>
        <tr>
            <th>ID de vendas</th>
            <th></th>
            <th>Título</th>
            <th>Unidades</th>
            <th class="hidden-on-mobile">Data</th>
            <th>Preço(€)</th>
            <th>Estádo</th>
        </tr>

        <?php
        
        $resultados = mysqli_query($conn, "SELECT * FROM vendas LEFT JOIN jogos ON jogos.gameID = vendas.jogoID LEFT JOIN Utilizadores ON Utilizadores.userID = vendas.userID ORDER BY vendasID ASC");

        if ($resultados) {
            while ($jogo = mysqli_fetch_assoc($resultados)) {
        ?>
                <form action="comprar.php" method="post"><tr title="<?php echo $jogo['nome'].' - '.$jogo['morada'].', '.$jogo['postal'].' '.$jogo['cidade'].', '.$jogo['pais']; ?>">
                    <td><?php echo $jogo['vendasID']; ?></td>
                    <td><img src="<?php echo $jogo['imagem']; ?>" alt="Imagem do jogo" style="width: 100px;"></td>
                    <td><?php echo $jogo['gameName']; ?></td>
                    <td><?php echo $jogo['amount']; ?></td>
                    <td class="hidden-on-mobile"><?php echo $jogo['data']; ?></td>
                    <td><?php echo $jogo['totalPrice']; ?></td>
                    <td>
                        <select onchange="estadoOnChange(event, <?php echo $jogo['vendasID']; ?>)">
                            <option value="pending" <?php if($jogo['estado'] === 'pending') { echo 'selected="selected"'; } ?>>A processar</option>
                            <option value="sent" <?php if($jogo['estado'] === 'sent') { echo 'selected="selected"'; } ?>>Enviado</option>
                            <option value="cancelled" <?php if($jogo['estado'] === 'cancelled') { echo 'selected="selected"'; } ?>>Anulado</option>
                        </select>
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