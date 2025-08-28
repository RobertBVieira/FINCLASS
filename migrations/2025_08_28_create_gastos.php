<?php

$sql = "
    CREATE TABLE IF NOT EXISTS gastos (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `valor` DECIMAL(10, 2) NOT NULL, -- Suporta valores até 99.999.999,99
  `data_gasto` DATE NOT NULL,
  `categoria` VARCHAR(50) NULL,

  -- Define a chave estrangeira
  FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;";

$pdo->exec($sql);