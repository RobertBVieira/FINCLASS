<?php

echo "Inicializando processo de migration";

require_once 'config.php';

try{
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations (
        id INT PRIMARY KEY AUTO_INCREMENT,
        migration_file VARCHAR(255) NOT NULL UNIQUE,
        executed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
    ");
    $stmt = $pdo->query("SELECT migration_file FROM migrations");
    $executed_migrations  = $stmt->fetchALL(PDO::FETCH_COLUMN);

    // pega os arquivos da pasta de migratrions
    $migration_files = scandir('migrations');

    // Remove '.' e '..' do array de arquivos
    $migration_files = array_diff($migration_files, ['.', '..']);
    sort($migration_files); // Garante a ordem de execução

    echo "Verificando novas migrações...\n";

    // CÓDIGO NOVO - SEM TRANSAÇÃO
foreach ($migration_files as $file) {
    if (!in_array($file, $executed_migrations)) {
        echo "Executando migração: $file...\n";

        // O try/catch ainda é útil para capturar erros do SQL
        try {
            // Inclui e executa a migration diretamente
            require_once 'migrations/' . $file;

            // Se o comando acima não deu erro, a migration foi um sucesso.
            // Agora, registramos na tabela de controle.
            $stmt = $pdo->prepare("INSERT INTO migrations (migration_file) VALUES (?)");
            $stmt->execute([$file]);

            echo "Migração $file executada com sucesso.\n";
        } catch (Exception $e) {
            // Se a migration falhar, o script vai parar aqui e mostrar o erro
            die("ERRO ao executar a migração $file: " . $e->getMessage());
        }
    }
}

    echo "Nenhuma nova migração para executar. O banco de dados está atualizado.\n";

} catch (PDOException $e) {
    die("ERRO GERAL: " . $e->getMessage());
}

echo "Processo de migração finalizado.\n";
