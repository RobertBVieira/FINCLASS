<?php
// migrations/2025_08_28_create_tarefa.php

// A variável $pdo já está disponível

$sql = "
CREATE TABLE IF NOT EXISTS tarefa (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  
  -- GARANTINDO QUE O TIPO É O MESMO DA CHAVE PRIMÁRIA DE 'usuarios'
  `usuario_id` INT NOT NULL, 
  
  `titulo` VARCHAR(255) NOT NULL,
  `status` ENUM('pendente', 'concluida') NOT NULL DEFAULT 'pendente',
  `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  -- DEFININDO A REGRA DA CHAVE ESTRANGEIRA CORRETAMENTE
  FOREIGN KEY (`usuario_id`) 
  REFERENCES `usuarios`(`id`) 
  ON DELETE CASCADE
) ENGINE=InnoDB;
";

// Executa a query
$pdo->exec($sql);