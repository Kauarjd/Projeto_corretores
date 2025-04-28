<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];

    try {
        $stmt = $pdo->prepare("INSERT INTO corretores (nome, cpf, creci) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $cpf, $creci]);
        $_SESSION['success_message'] = "Corretor cadastrado com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao cadastrar: " . $e->getMessage();
    }
}

header("Location: index.php"); // Corrigido para redirecionamento relativo seguro
exit;
?>