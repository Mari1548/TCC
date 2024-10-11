<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_SESSION['cpf']; // Supondo que o CPF esteja armazenado na sessão
    $hora = $_POST['hora'];
    $data = $_POST['data'];
    $diadasemana = $_POST['diadasemana'];

    $query = "INSERT INTO agendamentos (hora, data, cpf, diadesemana) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ssis", $hora, $data, $cpf, $diadasemana);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Agendamento realizado com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao agendar: " . $stmt->error]);
    }

    $stmt->close();
    $conexao->close();
    exit();
}
?>
