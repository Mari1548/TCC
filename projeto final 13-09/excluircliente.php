<?php
session_start();
include("conexao.php");

// Verifica se o admin está logado
if (!isset($_SESSION["admin_logged"]) || !$_SESSION["admin_logged"]) {
    http_response_code(403);
    echo "Acesso negado.";
    exit();
}

// Verifica se o ID do cliente foi passado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql_delete = "DELETE FROM clientes WHERE id=?";
    $stmt = $con->prepare($sql_delete);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Cliente excluído com sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao excluir cliente: " . $con->error;
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo "ID do cliente não fornecido.";
}

$con->close();
?>
