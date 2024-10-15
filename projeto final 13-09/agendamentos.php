<?php
session_start();
include("conexao.php");

// Verifique se o usuário está logado
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Verifique se o agendamento foi bem-sucedido
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo '<script>alert("Agendamento realizado com sucesso!");</script>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Estética</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            padding-top: 120px; /* Ajuste conforme a altura do header */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #978e8c;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-sair {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-sair:hover {
            background-color: #d0d0d0;
        }

        .perfil {
            height: 40px;
            width: auto;
            cursor: pointer;
        }

        header img.logo {
            height: 80px;
            width: auto;
        }

        h2 {
            margin: 20px 0;
            color: #333;
            text-align: center;
        }

        .form-agendamento {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Sombreado nas bordas */
            padding: 30px;
            width: 400px;
            text-align: center;
            transition: transform 0.3s;
        }

        .form-agendamento:hover {
            transform: scale(1.02);
        }

        label {
            display: block;
            margin: 15px 0 5px;
            color: #555;
            font-weight: bold;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        select:focus, input:focus {
            border-color: #978e8c;
            box-shadow: 0 0 5px rgba(151, 139, 139, 0.5);
        }

        button {
            background-color: #978e8c;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s, transform 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #7b7a77;
            transform: translateY(-2px);
        }

    </style>
</head>
<body>

<header>
    <div class="header-left">
        <img src="imagens/B.png" alt="Logo" class="logo" />
    </div>
    <div class="header-right">
        <a href="perfil.php">
            <img src="imagens/icon1.png" alt="Ícone Perfil" class="perfil">
        </a>
        <a href="home.html" class="btn-sair">Sair</a>
    </div>
</header>

<h2>Agendamentos Disponíveis</h2>

<div class="form-agendamento">
    <form id="agendamentoForm" action="processaagendamento.php" method="post">
        <label for="servico">Escolha o Serviço:</label>
        <select id="servico" name="servico" required>
            <option value="">Selecione um serviço</option>
            <option value="1">Preenchimento Labial</option>
            <option value="2">Botox</option>
            <option value="3">Limpeza de Pele</option>
            <option value="4">Microagulhamento</option>
            <option value="5">Silicone</option>
            <option value="6">Lipoaspiração</option>
            <option value="7">Rinoplastia</option>
            <option value="8">Bichectomia</option>
            <option value="9">Microfocado Facial</option>
            <option value="10">Bioestimulador</option>
            <option value="11">Intradermoterapia</option>
            <option value="12">Massagem Relaxante</option>
            <option value="13">BCAA</option>
            <option value="14">Fios de Sustentação</option>
            <option value="15">Massagem Modeladora</option>
            <option value="16">DMAE</option>
        </select>

        <label for="data">Escolha a Data:</label>
        <input type="date" id="data" name="data" required>

        <label for="horario">Defina o Horário:</label>
        <input type="time" id="horario" name="horario" required>

        <button type="submit">Agendar</button>
    </form>
</div>

</body>
</html>
