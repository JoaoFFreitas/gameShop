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
                                <a href="#"><?php echo $nomedeutilizador; ?></a>
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



    <br><br><br><br><br><br><br><br>

    <?php
    if (empty($_SESSION["utilizador"])) {
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

        </div>
        <div>
            <form action="insertGame.php" class="insertGame admin" method="post">
                <h3 style="margin:auto;">Submeter Jogo</h3>
                <div class="contentWrapper">
                    <form action="portfolioData.php" method="post" enctype="multipart/form-data">
                        <h3>Inserir imagem</h3>
                        <label for="">Título da imagem:</label>
                        <input type="text" name="title" id="title" placeholder="Insira um título..."> <br>
                        <input type="file" name="ficheiro" size="35"> <br>
                        <button type="submit" name="enviar">Submeter Ficheiro</button>
                        <input type="hidden" name="acc" value="submeter">
                </div>
                <label for="">Título:</label>
                <input type="text" name="gameName" id="gameName" placeholder="Insira o Nome do jogo">
                <label for="">Conteúdo:</label>
                <textarea name="newsContent" id="newsContent" cols="30" rows="10" maxlength="500" placeholder="Inserir conteúdo da notícia"></textarea>
                <input id="button" type="submit" name="submit" value="Submeter" style="margin-top: 20px;"> <br>
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