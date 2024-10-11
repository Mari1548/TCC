<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Estética</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 78vh;
            margin: 0;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 97.20%;
            padding: 20px 20px;
            background-color: #978e8c; /* Fundo cinza */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 70px;
        }

        .btn-voltar {
            text-decoration: none;
            color: #555; /* Cor cinza */
            font-size: 16px;
            background-color: #e0e0e0; /* Fundo cinza claro */
            border: none;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn-voltar:hover {
            background-color: #d0d0d0; /* Escurecendo ao passar o mouse */
        }

        .icon-container img {
            height: 40px; /* Aumentando a altura da logo */
            width: auto;
        }

        header img {
            height: 80px; /* Altura ajustada para a logo */
            width: auto;
            padding: 10px;
            margin-left: 13px;
        }

        h2 {
            margin: 20px 0;
            color: #333;
        }

        .form-agendamento {
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        select, input {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #e0e0e0; /* Fundo cinza */
            color: #555; /* Cor cinza */
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #d0d0d0; /* Escurecendo ao passar o mouse */
        }
    </style>
</head>
<body>

<header>
    <img src="imagens/B.png" alt="Logo" />
    <div class="icon-container">
        <a href="perfil.php"><img src="imagens/icon1.png" alt="Ícone Perfil" class="perfil"></a>
    </div>
    <a href="home.html" class="btn-voltar">Voltar</a>
</header>

<h2>Agendamentos Disponíveis</h2>

<div class="form-agendamento">
    <form action="processaagendamento.php" method="post">
        <label for="servico">Escolha o Serviço:</label>
        <select id="servico" required>
            <option value="">Selecione um serviço</option>
            <option value="Preenchimento Labial">Preenchimento Labial</option>
            <option value="Botox">Botox</option>
            <option value="Limpeza de Pele">Limpeza de Pele</option>
            <option value="Depilação">Microagulhamento</option>
            <option value="Depilação">Silicone</option>
            <option value="Depilação">Lipoaspiração</option>
            <option value="Depilação">Rinoplastia</option>
            <option value="Depilação">Bichectomia</option>
            <option value="Depilação">Microfocado Facial</option>
            <option value="Depilação">Bioestimulador</option>
            <option value="Depilação">Intradermoterapia</option>
            <option value="Depilação">Massagem relaxante</option>
            <option value="Depilação">BCAA</option>
            <option value="Depilação">Fios de Sustentação</option>
            <option value="Depilação">Massagem modeladora</option>
            <option value="Depilação">DMAE</option>
            
            
            <!-- Adicione mais serviços conforme necessário -->
        </select>

        <label for="data">Escolha a Data:</label>
        <input type="date" id="data" required>

        <label for="horario">Defina o Horário:</label>
        <input type="time" id="horario" required>

        <button type="submit">Agendar</button>
    </form>
</div>

<script>
    document.getElementById('agendamentoForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const servico = document.getElementById('servico').value;
        const data = document.getElementById('data').value;
        const horario = document.getElementById('horario').value;

        if (servico && data && horario) {
            alert(`Agendamento feito:\nServiço: ${servico}\nData: ${data}\nHorário: ${horario}`);
            // Aqui você pode adicionar a lógica para salvar o agendamento no banco de dados

            // Resetar o formulário
            this.reset();
        } else {
            alert('Por favor, preencha todos os campos.');
        }
    });
</script>

</body>
</html>
