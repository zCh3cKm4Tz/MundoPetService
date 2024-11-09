<?php
$servername = "186.202.152.70"; // IP do servidor MySQL
$username = "db_pet_service"; // Nome de usuário MySQL
$password = "Petservice24@@"; // Senha do banco de dados
$dbname = "db_pet_service"; // Nome do banco de dados

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}
?>
