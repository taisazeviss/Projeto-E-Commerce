<?php

class Conexao {
    public static function conectar() {
        $host = "localhost";
        $banco = "db_ecommerce_sql";
        $usuario = "root";
        $senha = "";

        try {
            $pdo = new PDO(
                "mysql:host=$host;dbname=$banco;charset=utf8",
                $usuario,
                $senha
            );

            // Ativa o modo de tratamento de erros!
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $erro) {
            die("Erro de conexão: " . $erro->getMessage());
        }
    }
}