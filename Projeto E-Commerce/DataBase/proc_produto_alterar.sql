CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_produto_alterar`(
    IN codigoProduto INT,
    IN nomeProduto VARCHAR(45),
    IN descricaoProduto VARCHAR(300),
    IN valorProduto DECIMAL(10,2),
    IN estoqueProduto INT,
    IN categoriaProduto INT,
    IN marcaProduto INT
)
BEGIN
    UPDATE tb_produto
    SET
        nome_produto = nomeProduto,
        descricao_produto = descricaoProduto,
        valor_produto = valorProduto,
        estoque_produto = estoqueProduto,
        id_categoria = categoriaProduto,
        id_marca = marcaProduto
    WHERE id_produto = codigoProduto;
END