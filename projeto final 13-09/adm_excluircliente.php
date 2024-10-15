<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["admin_logged"]) || !$_SESSION["admin_logged"]) {
    http_response_code(403);
    echo "Acesso negado.";
    exit();
}

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];
    
 
    $sql = "DELETE FROM clientes WHERE cpf = ?";
    $stmt = $con->prepare($sql);
    
    if ($stmt === false) {
        http_response_code(500);
        echo "Erro na preparação da consulta: " . $con->error;
        exit();
    }
    
    $stmt->bind_param("s", $cpf); 
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Cliente excluído com sucesso.";
        } else {
            http_response_code(404);
            echo "Nenhum cliente encontrado com esse CPF.";
        }
    } else {
        http_response_code(500);
        echo "Erro ao excluir cliente: " . $stmt->error;
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo "CPF do cliente não especificado.";
}

$con->close();
?>
