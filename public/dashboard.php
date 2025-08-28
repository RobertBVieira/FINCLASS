<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../templates/header.php';


// "Guardião" da página: verifica se o usuário está logado
// Se não existir a session 'user_id', redireciona para o login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Pega o nome do usuário da sessão para uma mensagem de boas-vindas
$user_name = $_SESSION['user_name'];
?>

<h2>Dashboard</h2>
<p>Bem-vindo(a), <?= htmlspecialchars($user_name) ?>!</p>
<p>Esta é a sua área pessoal. Aqui você poderá gerenciar suas tarefas, gastos e ganhos.</p>
<br>
<a href="logout.php">Sair (Logout)</a>

<?php
require_once __DIR__ . '/../templates/header.php';
?>