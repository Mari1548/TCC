<?php
session_start();
include("conexao.php"); 

if (!isset($_SESSION["client_logged"])) {
    header('Location: login.php');
    exit();
}

if (empty($_POST) || empty($_POST["servico"]) || empty($_POST["data"]) || empty($_POST["horario"])) {
    header('Location: agendamentos.php?status=error'); 
    exit();
}


$servico = mysqli_real_escape_string($con, $_POST['servico']);
$data = mysqli_real_escape_string($con, $_POST['data']);
$horario = mysqli_real_escape_string($con, $_POST['horario']);
$cpf = $_SESSION['cpf']; 

$sql = "INSERT INTO agendamento (hora, data, cpf, codservico) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssi", $horario, $data, $cpf, $servico);
    if ($stmt->execute()) {
        header('Location: agendamentos.php?status=success'); 
    } else {
        header('Location: agendamentos.php?status=error'); 
    }
    $stmt->close();
} else {
    die("Erro na preparação da consulta: " . $con->error);
}

$con->close();
?>
