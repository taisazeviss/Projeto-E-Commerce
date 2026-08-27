<?php

require_once "DAO/ProdutosDAO.php";

$objDAO = new ProdutosDAO();

if (!isset($_GET["id"])) {
    header("location: index.php");
    exit();
}

$id = $_GET["id"];

$objDAO->ExcluirProduto($id);

echo "<script>alert('Produto excluído com sucesso!');window.location='index.php';</script>";