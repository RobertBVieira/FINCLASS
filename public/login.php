<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if ($email && $senha) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe E se a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Se tudo estiver certo, salva os dados na sessão
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];

            // Redireciona o usuário para o dashboard
            header("Location: dashboard.php");
            exit(); // Encerra o script para garantir o redirecionamento
        } else {
            echo "<p style='color:red;'>E-mail ou senha incorretos.</p>";
        }
    } else {
        echo "<p style='color:red;'>Por favor, preencha todos os campos.</p>";
    }
}
?>

<h2>Login</h2>
<form method="POST" action="login.php">
    <label for="email">E-mail:</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="senha">Senha:</label><br>
    <input type="password" name="senha" id="senha" required><br><br>

    <button type="submit">Entrar</button>
</form>
<p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>.</p>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>