<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["admin_logged"]) || !$_SESSION["admin_logged"]) {
    error_log("Admin não logado ou sessão inválida.");
    die("Você não está autorizado a realizar essa ação.");
}

// Verifica se o codagenda foi passado
if (!isset($_GET['codagenda'])) {
    error_log("codagenda não informado.");
    die("codagenda não informado.");
}

$codagenda = intval($_GET['codagenda']); // Converte para inteiro para segurança
error_log("codagenda recebido para exclusão: $codagenda");

// Prepara a consulta de exclusão
$sql = "DELETE FROM agendamento WHERE codagenda = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $codagenda);

if ($stmt->execute()) {
    echo "Agendamento excluído com sucesso.";
} else {
    error_log("Erro ao excluir: " . $stmt->error);
    echo "Erro ao excluir agendamento. Verifique os logs do servidor.";
}

$stmt->close();
$con->close();
?>
