<?php
include_once('conexao.php');

$email = 'adm123@gmail.com';
$cpf = '111111111111'; 

$query = "INSERT INTO administradores (email, cpf) VALUES ('$email', '$cpf')";

if (mysqli_query($con, $query)) {
    echo "Administrador criado com sucesso!";
} else {
    echo "Erro: " . mysqli_error($con);
}


mysqli_close($con);
?>
