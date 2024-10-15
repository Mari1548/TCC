<?php
session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Verifica se o código do agendamento foi passado
if (isset($_GET['codagenda'])) {
    $codagenda = $_GET['codagenda'];

    // Prepara a consulta para excluir o agendamento
    $stmt = $con->prepare("DELETE FROM agendamento WHERE codagenda = ?");
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $con->error);
    }

    // Liga o parâmetro e executa a consulta
    $stmt->bind_param("i", $codagenda);
    if ($stmt->execute()) {
        echo "Agendamento excluído com sucesso.";
    } else {
        echo "Erro ao excluir o agendamento: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Código do agendamento não informado.";
}

$con->close(); // Fecha a conexão
?>
