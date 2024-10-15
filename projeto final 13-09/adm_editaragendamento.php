<?php
session_start();
include("conexao.php");

// Verifica se o admin está logado
if (!isset($_SESSION["admin_logged"]) || !$_SESSION["admin_logged"]) {
    header("Location: login.php");
    exit();
}

// Verifica se o código do agendamento foi passado
if (!isset($_GET['codagenda'])) {
    header("Location: adm_agendamentos.php");
    exit();
}

// Obter os dados do agendamento
$codagenda = $_GET['codagenda'];
$stmt = $con->prepare("SELECT a.*, s.nome AS servico_nome 
                       FROM agendamento a 
                       JOIN servicos s ON a.codservico = s.codservico 
                       WHERE codagenda = ?");
$stmt->bind_param("i", $codagenda);
$stmt->execute();
$result = $stmt->get_result();
$agendamento = $result->fetch_assoc();
$stmt->close();

if (!$agendamento) {
    header("Location: adm_agendamentos.php");
    exit();
}

// Atualizar os dados do agendamento se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $codservico = $_POST['codservico'];

    $update_stmt = $con->prepare("UPDATE agendamento SET data = ?, hora = ?, codservico = ? WHERE codagenda = ?");
    $update_stmt->bind_param("ssii", $data, $hora, $codservico, $codagenda);

    if ($update_stmt->execute()) {
        header("Location: adm_agendamentos.php");
        exit();
    } else {
        echo "Erro ao atualizar agendamento: " . $con->error;
    }

    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="date"], input[type="time"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-voltar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .btn-voltar:hover {
            background-color: #d0d0d0;
        }


        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #978e8c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #7b7a7a;
        }
    </style>
</head>
<body>
    <a href="admindashboard.php" class="btn-voltar">Voltar</a>
    <div class="container">
        <h1>Editar Agendamento</h1>
        <form method="post">
            <label for="data">Data</label>
            <input type="date" id="data" name="data" value="<?php echo htmlspecialchars($agendamento['data']); ?>" required>

            <label for="hora">Hora</label>
            <input type="time" id="hora" name="hora" value="<?php echo htmlspecialchars($agendamento['hora']); ?>" required>

            <label for="codservico">Serviço</label>
            <select id="codservico" name="codservico" required>
                <?php
                $servicos_result = $con->query("SELECT * FROM servicos");
                while ($servico = $servicos_result->fetch_assoc()) {
                    $selected = $servico['codservico'] == $agendamento['codservico'] ? 'selected' : '';
                    echo "<option value='{$servico['codservico']}' $selected>{$servico['nome']}</option>";
                }
                ?>
            </select>

            <button type="submit">Atualizar Agendamento</button>
        </form>
    </div>
</body>
</html>

<?php
$con->close();
?>
