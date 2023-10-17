<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="games for sale for ps5">
    <meta name="author" content="João Freitas">
    <link rel="stylesheet" href="Style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <title>GameShop</title>
</head>
<nav>
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="header">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="principal.php">Notícias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orcamento.php">Carrinho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactos.php">Contactos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="area_pessoal.php"><?php echo $nomedeutilizador; ?></a>
                </li>
                <?php
                if ($_SESSION["nivel_utilizador"] === "admin") {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Administrador</a>
                    </li>
                <?php
                } else {
                }
                ?>
                <?php
                if (!empty($_SESSION["utilizador"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<body>

</body>

</html>