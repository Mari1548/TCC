<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("conexao.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}


$email = $_SESSION["email"];

$stmt = $con->prepare("SELECT cpf, nome, email, cidade, telefone, datan FROM clientes WHERE email = ?");
if (!$stmt) {
    die("Erro na preparação da consulta: " . $con->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($cpf, $nome, $email_usuario, $cidade, $telefone, $datan);
$stmt->fetch();
$stmt->close();

$con->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Estética Bela</title>
    <link rel="stylesheet" type="text/css" href="inicial.css">
    <style>
    
        .profile-container {
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 30px;
            border: 3px solid #978e8c;
        }

        .profile-details h2 {
            margin: 0;
            color: #333;
        }

        .profile-details p {
            margin: 5px 0;
            color: #666;
        }

        .profile-actions {
            margin-top: 20px;
        }

        .profile-actions a {
            display: inline-block;
            margin-right: 15px;
            background-color: #978e8c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .profile-actions a:hover {
            background-color: #7a7a7a;
        }


        @media (max-width: 992px) {
            header img {
                width: 120px; 
            }

            .menu ul li a {
                font-size: 14px;
            }

            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-header img {
                margin-bottom: 20px;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>

<header>
    <img src="imagens/B.png" alt="Logo" />
    <div class="menu">
        <ul>
            <li><a href="cadastrar.php">Cadastrar-se</a></li>
            <li><a href="servicos.php">Serviços</a></li>
            <li><a href="home.html">Home</a></li>
            <li><a href="profissionais.html">Profissionais</a></li>
        </ul>
    </div>
</header>

<div class="profile-container">
    <div class="profile-header">
        <!-- Como não há foto de perfil na tabela, usaremos uma imagem padrão -->
        <img src="imagens/perfil.png" alt="Foto de Perfil">
        <div class="profile-details">
            <h2><?php echo htmlspecialchars($nome); ?></h2>
            <p><strong>CPF:</strong> <?php echo htmlspecialchars($cpf); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email_usuario); ?></p>
            <p><strong>Cidade:</strong> <?php echo htmlspecialchars($cidade); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($telefone); ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars(date('d/m/Y', strtotime($datan))); ?></p>
        </div>
    </div>
    <div class="profile-actions">
        <a href="editar_perfil.php">Editar Perfil</a>
        <!-- Você pode adicionar mais ações conforme necessário -->
    </div>
</div>

</body>
</html>
