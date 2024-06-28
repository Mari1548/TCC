<?php
    if(isset($_POST['submit'])){
        include_once('conexao.php');

        $codcliente =$_POST['codcliente'];
        $cpf =$_POST['cpf'];
        $nome =$_POST['nome'];
        $email =$_POST['email'];
        $cidade =$_POST['cidade'];
        $telefone =$_POST['telefone'];
        $datan =$_POST['datan'];
        
        $result = mysqli_query($con,"INSERT INTO clientes(codcliente, cpf, nome, email, cidade, telefone, datan) values ('$codcliente','$cpf','$nome','$email','$cidade','$telefone','$datan')");

        echo(" cadastrado com sucesso!");
    }
    else{
        echo("Algo ocorreu. Não foi possível realizar o cadastro.");
    }
?>