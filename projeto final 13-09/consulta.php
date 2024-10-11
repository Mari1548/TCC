<?php
session_start();
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

    $query = "SELECT * FROM administradores WHERE email=? AND cpf=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $email, $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_message'] = "Admin logado com sucesso!"; // Mensagem a ser exibida
        header("Location: agendamentos.php"); // Redireciona para a página de agendamentos
        exit();
    } else {
        echo "Credenciais inválidas!";
    }

    $stmt->close();
    mysqli_close($con);
}