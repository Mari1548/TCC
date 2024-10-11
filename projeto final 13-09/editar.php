<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["admin_logged"]) || !$_SESSION["admin_logged"]) {
    header("Location: agendamentos.php");
    exit();
}

// Obtenha o horário do agendamento que o admin quer editar
$time = $_GET['time'];

// Aqui você deve obter os dados do agendamento do banco
$sql = "SELECT * FROM agendamentos WHERE time='$time'";
$result = $con->query($sql);
$agendamento = $result->fetch_assoc();

// Se o formulário for enviado, atualize o agendamento
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novo_status = $_POST['status'];
    $sql_update = "UPDATE agendamentos SET status='$novo_status' WHERE time='$time'";
    if ($con->query($sql_update) === TRUE) {
        header("Location: agendamentos.php"); // Redireciona após a atualização
        exit();
    } else {
        echo "Erro ao atualizar: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Agendamento</title>
</head>
<body>
    <h1>Editar Agendamento</h1>
    <form method="post">
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($agendamento['status']); ?>" required>
        <input type="submit" value="Salvar">
    </form>
    <a href="agendamentos.php">Voltar</a>
</body>
</html>
