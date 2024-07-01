<?php
    if(isset($_POST['submit'])){
        include_once('conexao.php');

        $cpf =$_POST['cpf'];
        $nome =$_POST['nome'];
        $email =$_POST['email'];
        $cidade =$_POST['cidade'];
        $telefone =$_POST['telefone'];
        $datan =$_POST['datan'];
        
        $result = mysqli_query($con,"INSERT INTO clientes(cpf, nome, email, cidade, telefone, datan) values ('$cpf','$nome','$email','$cidade','$telefone','$datan')");

        echo(" cadastrado com sucesso!");
    }
    else{
        echo("Algo ocorreu. Não foi possível realizar o cadastro.");
    }
?>