<?php

require_once __DIR__ . "/Conexao.php";

class ProdutosDAO extends Conexao
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::conectar();
    }

    // CADASTRAR PRODUTO
    public function CadastrarProduto($nome, $descricao, $valor, $estoque, $categoria, $marca, $id_usuario)
    {
        try {
            $sql = $this->conexao->prepare(
                "CALL proc_produto_cadastrar(?, ?, ?, ?, ?, ?, ?)"
            );

            return $sql->execute([
                $nome,
                $descricao,
                $valor,
                $estoque,
                $categoria,
                $marca,
                $id_usuario
            ]);
        } catch (PDOException $e) {
            // Exibe a mensagem de erro exata do MySQL na tela para diagnóstico
            echo "<script>alert('Erro do Banco: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    // LISTAR PRODUTOS
    public function ConsultarProdutos()
    {
        try {
            $sql = $this->conexao->prepare(
                "CALL proc_produto_consultar()"
            );

            $sql->execute();
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return $dados ? $dados : [];
        } catch (PDOException $e) {
            echo "Erro ao consultar produtos: " . $e->getMessage();
            return [];
        }
    }

    // BUSCAR PRODUTO PELO ID
    public function DetalharProduto($id)
    {
        try {
            $sql = $this->conexao->prepare(
                "CALL proc_produto_detalhar(?)"
            );

            $sql->execute([$id]);
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return $dados;
        } catch (PDOException $e) {
            echo "Erro ao detalhar produto: " . $e->getMessage();
            return null;
        }
    }

    // ALTERAR PRODUTO
    public function AlterarProduto($id, $nome, $descricao, $valor, $estoque, $categoria, $marca, $id_usuario)
    {
        try {
            $sql = $this->conexao->prepare(
                "CALL proc_produto_alterar(?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $res = $sql->execute([
                $id,
                $nome,
                $descricao,
                $valor,
                $estoque,
                $categoria,
                $marca,
                $id_usuario
            ]);

            $sql->closeCursor();
            return $res;
        } catch (PDOException $e) {
            echo "Erro ao alterar produto: " . $e->getMessage();
            return false;
        }
    }

    // EXCLUIR PRODUTO
    public function ExcluirProduto($id)
    {
        try {
            $sql = $this->conexao->prepare(
                "CALL proc_produto_excluir(?)"
            );

            $res = $sql->execute([$id]);
            $sql->closeCursor();

            return $res;
        } catch (PDOException $e) {
            echo "<script>alert('Erro no Banco: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }
}
