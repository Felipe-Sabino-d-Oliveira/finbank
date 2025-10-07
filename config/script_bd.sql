-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS finbank CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE finbank;

-- Criação da tabela de contas
CREATE TABLE IF NOT EXISTS contas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titular VARCHAR(100) NOT NULL,
    numeroConta VARCHAR(20) NOT NULL UNIQUE,
    saldo DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    tipo ENUM('corrente', 'poupanca') NOT NULL,
    taxaRendimento DECIMAL(5,2) DEFAULT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
