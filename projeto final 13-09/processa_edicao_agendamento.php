<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codagenda = $_POST['codagenda'];
    $servico = $_POST['servico'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    $update_stmt = $con->prepare("UPDATE agendamento SET codservico = ?, data = ?, hora = ? WHERE codagenda = ?");
    $update_stmt->bind_param("issi", $servico, $data, $horario, $codagenda);

    if ($update_stmt->execute()) {
        header("Location: perfil.php");
        exit();
    } else {
        echo "Erro ao atualizar o agendamento.";
    }

    $update_stmt->close();
}

$con->close();
?>
