<?php
session_start();

if(empty($_POST) or (empty($_POST["email"]) or (empty($_POST["cpf"])))){
    echo"<script> location.href='index.html';</script>";
}
include("conexao.php");
    
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    
    
    $sql = "SELECT * FROM clientes WHERE email='$email' AND cpf='$cpf'";
   
    $res = $con->query($sql) or die($con->error);

    $row = $res->fetch_object();
  
    $qtd = $res->num_rows;
    echo"<script>alert($qtd);</script";
   
    

    if($qtd > 0){
        $_SESSION["email"] = $email;
        //$_SESSION["cpf"] = $row->cpf;
        echo"<script>alert('email ou cpf invalido');</script>";
        echo"<script>location.href='agendamentos.php';</script>";

    }

    
?>
