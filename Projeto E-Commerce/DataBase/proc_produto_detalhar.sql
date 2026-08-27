CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_produto_detalhar`(
    IN codigoProduto INT
)
BEGIN
    SELECT id_produto,
           nome_produto,
           descricao_produto,
           valor_produto,
           estoque_produto,
           id_categoria,
           id_marca
    FROM tb_produto
    WHERE id_produto = codigoProduto;
END