<?php
session_start();

// Ativar exibição de erros para debug (Remova em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar se os campos estão preenchidos
if (empty($_POST) || empty($_POST["email"]) || empty($_POST["cpf"])) {
    header('Location: index.php');
    exit();
}

include("conexao.php");

// Sanitizar entradas para prevenir SQL Injection
$email = mysqli_real_escape_string($con, $_POST['email']);
$cpf = mysqli_real_escape_string($con, $_POST['cpf']);

// Verifica se é um administrador
$sql = "SELECT * FROM administradores WHERE email='$email' AND cpf='$cpf'";
$res = $con->query($sql);

if ($res === false) {
    die("Erro na consulta: " . $con->error);
}

if ($res->num_rows > 0) {
    // Se for administrador
    $admin = $res->fetch_assoc();
    $_SESSION["admin_logged"] = true; 
    $_SESSION["admin_id"] = $admin['id']; // Armazena o ID do administrador
    $_SESSION["email"] = $email;
    $_SESSION["is_admin"] = ($email === 'adm123@gmail.com'); 
    header('Location: admindashboard.php'); 
    exit();
} else {
    // Se não for administrador, verifica se é cliente
    $sql = "SELECT * FROM clientes WHERE email='$email' AND cpf='$cpf'";
    $res = $con->query($sql);

    if ($res === false) {
        die("Erro na consulta: " . $con->error);
    }

    if ($res->num_rows > 0) {
        // Se for cliente
        $cliente = $res->fetch_assoc();
        $_SESSION["client_logged"] = true; 
        $_SESSION["client_id"] = $cliente['id']; // Armazena o ID do cliente
        $_SESSION["email"] = $email; 
        header('Location: agendamentos.php'); 
        exit();
    } else {
        // Nenhum usuário encontrado
        $_SESSION['login_error'] = 'Email ou CPF inválido.';
        header('Location: login.php');
        exit();
    }
}

$con->close();
?>
