<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["email"])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit();
}

$email = $_SESSION["email"];

$stmt = $con->prepare("SELECT cpf FROM clientes WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($cpf);
$stmt->fetch();
$stmt->close();


$data = json_decode(file_get_contents("php://input"), true);
$horario = $data['horario'];
$dia = $data['dia'];
$data_agendamento = date('Y-m-d', strtotime("next $dia")); // Obtém a data do próximo dia da semana

// Insere o agendamento no banco de dados
$stmt = $con->prepare("INSERT INTO agendamentos (hora, data, cpf) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $horario, $data_agendamento, $cpf);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao agendar: ' . $stmt->error]);
}
$stmt->close();
$con->close();
?>
