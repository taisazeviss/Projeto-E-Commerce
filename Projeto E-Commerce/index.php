<?php

require_once "DAO/ProdutosDAO.php";

$objDAO = new ProdutosDAO();

// Define o ID do usuário para atender à chave estrangeira no banco de dados
$id_usuario_logado = 1;

if (isset($_POST["btn_salvar"])) {
    $nome = trim(strip_tags($_POST["nome_produto"]));
    $descricao = trim(strip_tags($_POST["descricao_produto"]));
    $valor = trim(strip_tags($_POST["valor_produto"]));
    $estoque = trim(strip_tags($_POST["estoque_produto"]));
    $categoria = $_POST["id_categoria"];
    $marca = $_POST["id_marca"];

    // Chamada com exatamente 7 parâmetros
    if ($objDAO->CadastrarProduto($nome, $descricao, $valor, $estoque, $categoria, $marca, $id_usuario_logado)) {
        echo "<script>alert('Produto cadastrado com sucesso!');window.location='index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Erro ao cadastrar o produto!');</script>";
    }
}

$listaProdutos = $objDAO->ConsultarProdutos();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro de Produtos</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container">
        <h1>Sistema de Cadastro de Produtos</h1>
        <div class="card">
            <h2>Faça o Cadastro de Produtos:</h2>
            <form action="index.php" method="POST">
                <label>Digite o Nome do Produto:</label>
                <input type="text" name="nome_produto" maxlength="50" placeholder="Digite aqui..." required>

                <label>Digite a Descrição:</label>
                <textarea name="descricao_produto" maxlength="200" placeholder="Digite aqui..." required></textarea>

                <label>Digite o Valor(R$):</label>
                <input type="number" step="0.01" name="valor_produto" placeholder="Digite aqui..." required>

                <label>Digite a Quantidade em Estoque:</label>
                <input type="number" name="estoque_produto" placeholder="Digite aqui..." required>

                <div class="select-grid">
                    <div>
                        <label>Selecione uma Categoria:</label>
                        <select name="id_categoria" required>
                            <option value="">Selecione</option>
                            <option value="1">Mouse</option>
                            <option value="2">Teclado</option>
                            <option value="3">Monitor</option>
                            <option value="4">Fones</option>
                        </select>
                    </div>

                    <div>
                        <label>Selecione uma Marca:</label>
                        <select name="id_marca" required>
                            <option value="">Selecione</option>
                            <option value="1">Redragon</option>
                            <option value="2">Logitech</option>
                            <option value="3">Razer</option>
                            <option value="4">Corsair</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="btn_salvar">Salvar Produto</button>
            </form>
        </div>

        <div class="card">
            <h2>Produtos Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Qtds.</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Marca</th>
                        <th>Valor</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (!empty($listaProdutos) && count($listaProdutos) > 0) {
                        $i = 1;
                        foreach ($listaProdutos as $produto) {
                    ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($produto["nome_produto"]) ?></td>
                                <td><?= htmlspecialchars($produto["nome_categoria"]) ?></td>
                                <td><?= htmlspecialchars($produto["nome_marca"]) ?></td>
                                <td>R$ <?= number_format($produto["valor_produto"], 2, ",", ".") ?></td>
                                <td><?= $produto["estoque_produto"] ?></td>
                                <td class="celula-td">
                                    <a href="editar.php?id=<?= $produto["id_produto"] ?>" class="btn-editar">Editar</a>
                                    <a href="excluir.php?id=<?= $produto["id_produto"] ?>" class="btn-excluir" onclick="return confirm('Deseja excluir este produto?');">Excluir</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="7">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>