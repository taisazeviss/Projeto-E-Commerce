CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_produto_consultar`()
BEGIN
    SELECT
        p.id_produto,
        p.nome_produto,
        p.descricao_produto,
        p.valor_produto,
        p.estoque_produto,
        c.nome_categoria,
        m.nome_marca
    FROM tb_produto p
    INNER JOIN tb_categoria c
        ON p.id_categoria = c.id_categoria
    INNER JOIN tb_marca m
        ON p.id_marca = m.id_marca;
END