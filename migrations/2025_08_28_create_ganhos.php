
<?php

$sql = "
    CREATE TABLE IF NOT EXISTS ganhos (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `valor` DECIMAL(10, 2) NOT NULL,
  `data_ganho` DATE NOT NULL,

  -- Define a chave estrangeira
  FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;
";

$pdo->exec($sql);