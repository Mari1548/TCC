<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    
    $servername = "localhost";
    $username = "aluno";
    $password = "ceep";
    $dbname = "belavitta";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
 
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
    

    $sql = "SELECT id FROM usuarios WHERE email='$email' AND senha='$senha'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
       
        header("Location: agendamentos.php");
        exit();
    } else {
      
        header("Location: login.php?erro=1");
        exit();
    }
    
    $conn->close();
}
?>
