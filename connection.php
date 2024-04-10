<?php

// Configurações do banco de dados
$config = [
    'host' => 'localhost',
    'dbname' => 'loja_carros',
    'username' => 'root',
    'password' => ''
];

try {
    // Criação de uma instância da classe PDO para estabelecer a conexão com o banco de dados
    $pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4", $config['username'], $config['password']);

    // Retorno da conexão PDO
    return $pdo;
} catch (PDOException $e) {
    // Em caso de erro na conexão, exibe uma mensagem de erro
    exit("Erro de conexão com o banco de dados: " . $e->getMessage());
}