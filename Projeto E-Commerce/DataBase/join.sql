SELECT 
    nome_produto,
    nome_categoria,
    nome_marca,
    valor_produto,
    estoque_produto
FROM tb_produto

INNER JOIN tb_categoria
    ON tb_produto.id_categoria = tb_categoria.id_categoria

INNER JOIN tb_marca
    ON tb_produto.id_marca = tb_marca.id_marca;

SELECT * FROM tb_categoria;

INSERT INTO tb_categoria
    (nome_categoria)
VALUES
    ('Mouse'),
    ('Teclado'),
    ('Monitores');
    ('Fones');

INSERT INTO tb_marca
    (nome_marca)
VALUES
    ('Redragon'),
    ('Logitech'),
    ('Razer');
    ('Corsair');

SELECT * FROM tb_categoria;

SELECT * FROM tb_marca;