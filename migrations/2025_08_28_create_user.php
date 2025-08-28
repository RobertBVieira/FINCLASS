<?php
// migrations/20250828_1_create_usuarios_table.php

// A variável $pdo já deve estar disponível, pois este arquivo será incluído pelo migrate.php

$sql = "
CREATE TABLE IF NOT EXISTS usuarios (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `data_cadastro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

// Executa a query
$pdo->exec($sql);