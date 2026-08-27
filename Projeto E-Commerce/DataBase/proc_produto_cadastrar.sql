CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_produto_cadastrar`(
    IN nomeProduto VARCHAR(45),
    IN descricaoProduto VARCHAR(300),
    IN valorProduto DECIMAL(10,2),
    IN estoqueProduto INT,
    IN categoriaProduto INT,
    IN marcaProduto INT
)
BEGIN
    INSERT INTO tb_produto
    (nome_produto, descricao_produto, valor_produto, estoque_produto, id_categoria, id_marca)
    VALUES
    (nomeProduto, descricaoProduto, valorProduto, estoqueProduto, categoriaProduto, marcaProduto);
END