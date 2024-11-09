<?php
include 'db_connection.php'; // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    // Validação dos campos
    if (!$nome || !$email || !$senha) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Verificar se o email já está registrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Email já registrado!";
    } else {
        // Criptografa a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Insere o novo usuário
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaCriptografada);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao registrar.";
        }
    }
} else {
    echo "Método de solicitação inválido.";
}
?>
