<?php

    require_once "DAO/ProdutosDAO.php";

    $objDAO = new ProdutosDAO();

    // ID do usuário logado para atender à Chave Estrangeira
    $id_usuario_logado = 1; 

    if (!isset($_GET["id"])) {
        header("location: index.php");
        exit();
    }

    $id = $_GET["id"];
    $produto = $objDAO->DetalharProduto($id);

    if (!$produto) {
        echo "<script>alert('Produto não encontrado!');window.location='index.php';</script>";
        exit();
    }

    if (isset($_POST["btn_alterar"])) {
        $nome = strip_tags(trim($_POST["nome_produto"]));
        $descricao = strip_tags(trim($_POST["descricao_produto"]));
        $valor = strip_tags(trim($_POST["valor_produto"]));
        $estoque = strip_tags(trim($_POST["estoque_produto"]));
        $categoria = $_POST["id_categoria"];
        $marca = $_POST["id_marca"];

        // CORREÇÃO: Passando os 8 parâmetros incluindo o $id_usuario_logado no final
        if ($objDAO->AlterarProduto($id, $nome, $descricao, $valor, $estoque, $categoria, $marca, $id_usuario_logado)) {
            echo "<script>alert('Produto alterado com sucesso!');window.location='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Erro ao alterar o produto!');</script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Editar Produto</h2>
            <form method="POST">
                <label>Nome do Produto:</label>
                <input type="text" name="nome_produto" maxlength="50" value="<?= htmlspecialchars($produto["nome_produto"]) ?>" required>

                <label>Descrição:</label>
                <textarea name="descricao_produto" maxlength="200" rows="4" required><?= htmlspecialchars($produto["descricao_produto"]) ?></textarea>

                <label>Valor (R$):</label>
                <input type="number" step="0.01" name="valor_produto" value="<?= $produto["valor_produto"] ?>" required>

                <label>Estoque:</label>
                <input type="number" name="estoque_produto" value="<?= $produto["estoque_produto"] ?>" required>

                <div class="select-grid">
                    <div>
                        <label>Categoria:</label>
                        <select name="id_categoria" required>
                            <option value="">Selecione</option>
                            <option value="1" <?= $produto["id_categoria"] == 1 ? "selected" : "" ?>>Mouse</option>
                            <option value="2" <?= $produto["id_categoria"] == 2 ? "selected" : "" ?>>Teclado</option>
                            <option value="3" <?= $produto["id_categoria"] == 3 ? "selected" : "" ?>>Monitor</option>
                            <option value="4" <?= $produto["id_categoria"] == 4 ? "selected" : "" ?>>Fones</option>
                        </select>
                    </div>

                    <div>
                        <label>Marca:</label>
                        <select name="id_marca" required>
                            <option value="">Selecione</option>
                            <option value="1" <?= $produto["id_marca"] == 1 ? "selected" : "" ?>>Redragon</option>
                            <option value="2" <?= $produto["id_marca"] == 2 ? "selected" : "" ?>>Logitech</option>
                            <option value="3" <?= $produto["id_marca"] == 3 ? "selected" : "" ?>>Razer</option>
                            <option value="4" <?= $produto["id_marca"] == 4 ? "selected" : "" ?>>Corsair</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="btn_alterar">Alterar Produto</button>
            </form>
        </div>
    </div>
</body>
</html>