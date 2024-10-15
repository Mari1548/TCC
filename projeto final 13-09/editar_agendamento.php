<?php
session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Verifica se o código do agendamento foi passado
if (!isset($_GET['codagenda'])) {
    header("Location: agendamentos.php");
    exit();
}

// Obter informações do agendamento
$codagenda = $_GET['codagenda'];
$agendamento_stmt = $con->prepare("SELECT hora, data, codservico FROM agendamento WHERE codagenda = ?");
$agendamento_stmt->bind_param("i", $codagenda);
$agendamento_stmt->execute();
$agendamento_stmt->bind_result($hora, $data, $codservico);
$agendamento_stmt->fetch();
$agendamento_stmt->close();

// Obter lista de serviços
$servicos_sql = "SELECT codservico, nome FROM servicos";
$servicos_result = $con->query($servicos_sql);

$con->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
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

        h2 {
            margin: 20px 0;
            color: #333;
            text-align: center;
        }

        .form-editar {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Sombreado nas bordas */
            padding: 30px;
            width: 400px;
            text-align: center;
            transition: transform 0.3s;
        }

        .form-editar:hover {
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

        /* Redução do tamanho da logo e ícone */
        header img.logo {
            height: 60px; /* Tamanho reduzido da logo */
            width: auto;
        }

        .perfil {
            height: 30px; /* Tamanho reduzido do ícone */
            width: auto;
            cursor: pointer;
        }

        /* Responsividade para telas menores */
        @media (max-width: 600px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 20px;
            }

            .header-right {
                margin-top: 10px;
                gap: 10px;
            }

            .btn-sair {
                padding: 8px;
                font-size: 14px;
            }

            .form-editar {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="header-left">
        <img src="imagens/B.png" alt="Logo" class="logo" />
    </div>

</header>

<h2>Editar Agendamento</h2>

<div class="form-editar">
    <form action="processa_edicao_agendamento.php" method="post">
        <input type="hidden" name="codagenda" value="<?php echo htmlspecialchars($codagenda); ?>">
        
        <label for="servico">Escolha o Serviço:</label>
        <select id="servico" name="servico" required>
            <option value="">Selecione um serviço</option>
            <?php while ($row = $servicos_result->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['codservico']); ?>" <?php echo ($row['codservico'] == $codservico) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['nome']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="data">Escolha a Data:</label>
        <input type="date" id="data" name="data" value="<?php echo htmlspecialchars($data); ?>" required>

        <label for="horario">Defina o Horário:</label>
        <input type="time" id="horario" name="horario" value="<?php echo htmlspecialchars($hora); ?>" required>

        <button type="submit">Atualizar Agendamento</button>
    </form>
</div>

</body>
</html>
