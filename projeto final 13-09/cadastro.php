<?php

if (isset($_POST['submit'])) {
    include_once('conexao.php'); 

    if (!$con) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }


    $cpf = mysqli_real_escape_string($con, $_POST['cpf']);
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $cidade = mysqli_real_escape_string($con, $_POST['cidade']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);
    $datan = mysqli_real_escape_string($con, $_POST['datan']);

    $query = "INSERT INTO clientes (cpf, nome, email, cidade, telefone, datan) 
              VALUES ('$cpf', '$nome', '$email', '$cidade', '$telefone', '$datan')";

    if (mysqli_query($con, $query)) {
        header('Location: agendamentos.php');
        exit();
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "Nenhum dado enviado. Por favor, preencha o formulário.";
}
?>
