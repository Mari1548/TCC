<?php
session_start();
include("conexao.php"); // Verifique se o caminho está correto

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se a chave "cpf" está definida
    if (!isset($_SESSION['cpf'])) {
        die("Erro: CPF não encontrado na sessão.");
    }

    $cpf = $_SESSION['cpf'];
    $hora = $_POST['horario'] ?? null; // Usa null se não existir
    $data = $_POST['data'] ?? null; // Usa null se não existir
    $codservico = $_POST['servico'] ?? null; // Usa null se não existir

    // Validação básica
    if (is_null($hora) || is_null($data) || is_null($codservico)) {
        die("Erro: Todos os campos devem ser preenchidos.");
    }

    $query = "INSERT INTO agendamentos (hora, data, cpf, codservico) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssis", $hora, $data, $cpf, $codservico);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Agendamento realizado com sucesso!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Erro ao agendar: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Erro na preparação da consulta: " . $conexao->error]);
    }

    $conexao->close();
    exit();
}
?>
