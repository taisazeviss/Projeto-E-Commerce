CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_produto_excluir`(
    IN codigoProduto INT
)
BEGIN
    DELETE FROM tb_produto WHERE id_produto = codigoProduto;
END