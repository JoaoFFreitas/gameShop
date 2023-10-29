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
    <nav>
        <div>
            <div id="navbarNav">
                <ul class="header">
                    <li class="item">
                        <a aria-current="page" href="index.php"><img src="images/gameshop-edit.png" alt="logo"></a>
                    </li>
                    <li class="item">
                        <a href="jogos.php">Jogos</a>
                    </li>
                    <li class="item">
                        <a href="#">Consolas</a>
                    </li>
                    <?php
                    if ($_SESSION["nivel_utilizador"] === "admin") {
                    ?>
                        <li class="item">
                            <a href="admin.php">Administrador</a>
                        </li>
                    <?php
                    } else if (empty($_SESSION["utilizador"])) {
                    ?>
                        <li class="item">
                            <a href="login.php">Login</a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($_SESSION["utilizador"])) {
                    ?>
                        <li class="item">
                            <a href="#"><?php echo $nomedeutilizador; ?></a>
                        </li>
                        <li class="item">
                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                        </li>
                        <li class="item">
                            <a href="#">Logout</a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>



    <br><br><br><br><br><br><br><br>

    <form action="registerData.php" class="regForm" method="POST" style="margin-top: 150px;">
        Nome<span class="marca">*</span> <input type="text" id="nome" name="nome" placeholder="O seu nome" required> <br>
        NickName<span class="marca">*</span> <input type="text" id="nickname" name="nickname" placeholder="O seu NickName" required> <br>
        Telemóvel<span class="marca">*</span> <input type="text" id="telemovel" name="telemovel" placeholder="O seu contacto" required> <br>
        E-mail<span class="marca">*</span> <input type="email" name="email" id="email" placeholder="O seu e-mail" required> <br>
        Morada<span class="marca">*</span> <input type="text" id="morada" name="morada" placeholder="A sua morada" required> <br>
        Código Postal<span class="marca">*</span> <input type="text" id="postal" name="postal" placeholder="Código Postal" required> <br>
        Cidade<span class="marca">*</span> <input type="text" id="cidade" name="cidade" placeholder="A sua cidade" required> <br>
        País<span class="marca">*</span> <input type="text" id="pais" name="pais" placeholder="O seu país" required> <br>
        Password<span class="marca">*</span> <input type="password" id="password" name="password" placeholder="Password" required> <br>
        <input id="button" type="submit" value="Registar" style="margin-top: 20px;"> <br>
        <p id="obrigatorio">(Todos os campos marcados com <span class="marca">*</span> são de preenchimento obrigatório)
        </p>

    </form>






    <script src="https://kit.fontawesome.com/ec4cd7dbd5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>