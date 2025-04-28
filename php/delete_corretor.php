<?php
session_start();
require_once 'db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM corretores WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $_SESSION['success_message'] = "Corretor excluído com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao excluir corretor: " . $e->getMessage();
    }
}

header("Location: ../index.php");
exit;
?>