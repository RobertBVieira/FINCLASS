<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../templates/header.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    // Validação simples
    if ($nome && $email && $senha) {
        // Criptografa a senha - NUNCA SALVE SENHAS EM TEXTO PURO!
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            // Prepara a query para evitar SQL Injection
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $senha_hash]);
            
            echo "<p>Usuário cadastrado com sucesso! Você já pode fazer o <a href='login.php'>login</a>.</p>";

        } catch (PDOException $e) {
            // Verifica se o erro é de email duplicado
            if ($e->getCode() == 23000) {
                echo "<p style='color:red;'>Erro: Este e-mail já está cadastrado.</p>";
            } else {
                echo "<p style='color:red;'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
            }
        }
    } else {
        echo "<p style='color:red;'>Por favor, preencha todos os campos.</p>";
    }
}
?>

<h2>Cadastro de Novo Usuário</h2>
<form method="POST" action="cadastro.php">
    <label for="nome">Nome:</label><br>
    <input type="text" name="nome" id="nome" required><br><br>

    <label for="email">E-mail:</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="senha">Senha:</label><br>
    <input type="password" name="senha" id="senha" required><br><br>

    <button type="submit">Cadastrar</button>
</form>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>