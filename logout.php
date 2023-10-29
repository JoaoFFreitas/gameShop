<?php

session_start();
$_SESSION["utilizador"] = '';
$_SESSION["nome_utilizador"] = '';
session_destroy();
header("Location: index.php");
