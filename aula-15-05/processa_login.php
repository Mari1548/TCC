<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    
    
    $servername = "localhost";
    $username = "aluno";
    $password = "ceep";
    $dbname = "belavitta";
    
    $conn = new mysqli($localhost, $aluno, $ceep, $belavitta);
    
 
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
    

    $sql = "SELECT id FROM usuarios WHERE email='$email' AND cpf='$cpf'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
       
        header("Location: agendamentos.php");
        exit();
    } else {
      
        header("Location: login.php?erro=1");
        exit();
    }
    
    
}
?>
