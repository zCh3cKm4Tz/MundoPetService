<?php
session_start();
include 'db_connection.php'; // Conecta ao banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if (!$email || !$senha) {
        echo "Preencha todos os campos!";
        exit;
    }

    // Verifica se o usuário existe no banco de dados
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Se o usuário for encontrado, verifica a senha
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            echo "sucesso"; // Login bem-sucedido
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Método de solicitação inválido.";
}
?>
