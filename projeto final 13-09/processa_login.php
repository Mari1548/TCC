<?php
session_start();
include("conexao.php"); 

if (empty($_POST) || empty($_POST["email"]) || empty($_POST["cpf"])) {
    header('Location: index.php');
    exit();
}

$email = mysqli_real_escape_string($con, $_POST['email']);
$cpf = mysqli_real_escape_string($con, $_POST['cpf']);

$sql = "SELECT * FROM administradores WHERE email='$email' AND cpf='$cpf'";
$res = $con->query($sql);

if ($res === false) {
    die("Erro na consulta: " . $con->error);
}

if ($res->num_rows > 0) {
   
    $admin = $res->fetch_assoc();
    $_SESSION["admin_logged"] = true; 
    $_SESSION["admin_id"] = $admin['id'];
    $_SESSION["email"] = $email;
    $_SESSION["is_admin"] = ($email === 'adm123@gmail.com'); 
    header('Location: admindashboard.php'); 
    exit();
} else {

    $sql = "SELECT * FROM clientes WHERE email='$email' AND cpf='$cpf'";
    $res = $con->query($sql);

    if ($res === false) {
        die("Erro na consulta: " . $con->error);
    }

    if ($res->num_rows > 0) {
        $cliente = $res->fetch_assoc();
        $_SESSION["client_logged"] = true; 
        $_SESSION["client_id"] = $cliente['id'];
        $_SESSION["email"] = $email; 
        $_SESSION['cpf'] = $cliente['cpf'];
        header('Location: agendamentos.php'); 
        exit();
    } else {
        $_SESSION['login_error'] = 'Email ou CPF inválido.';
        header('Location: login.php');
        exit();
    }
}

$con->close();
?>
