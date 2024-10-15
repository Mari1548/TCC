<?php
session_start();
include("conexao.php");

// Verifica se o admin está logado
if (!isset($_SESSION["admin_logged"]) || !$_SESSION["admin_logged"]) {
    header("Location: login.php");
    exit();
}

// Verifica se o CPF do cliente foi passado
if (!isset($_GET['cpf'])) {
    header("Location: admindashboard.php");
    exit();
}

// Obter os dados do cliente
$cpf = $_GET['cpf'];
$stmt = $con->prepare("SELECT * FROM clientes WHERE cpf = ?");
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();
$stmt->close();

if (!$cliente) {
    header("Location: admindashboard.php");
    exit();
}

// Atualizar os dados do cliente se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novo_cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];
    $datan = $_POST['datan'];

    // Verificar se o CPF mudou
    if ($novo_cpf !== $cpf) {
        // Atualizar o CPF e os outros dados
        $update_stmt = $con->prepare("UPDATE clientes SET cpf = ?, nome = ?, email = ?, cidade = ?, telefone = ?, datan = ? WHERE cpf = ?");
        $update_stmt->bind_param("sssssss", $novo_cpf, $nome, $email, $cidade, $telefone, $datan, $cpf);
    } else {
        // Apenas atualizar os dados, mantendo o CPF
        $update_stmt = $con->prepare("UPDATE clientes SET nome = ?, email = ?, cidade = ?, telefone = ?, datan = ? WHERE cpf = ?");
        $update_stmt->bind_param("ssssis", $nome, $email, $cidade, $telefone, $datan, $cpf);
    }

    if ($update_stmt->execute()) {
        header("Location: admindashboard.php");
        exit();
    } else {
        echo "Erro ao atualizar dados do cliente: " . $con->error;
    }

    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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

        input[type="text"], input[type="email"], input[type="date"], input[type="number"] {
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
            background-color: #7b7a77;
        }
    </style>
</head>
<body>
    <a href="admindashboard.php" class="btn-voltar">Voltar</a>
    <div class="container">
        <h1>Editar Cliente</h1>
        <form method="post">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cliente['cpf']); ?>" required>

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($cliente['cidade']); ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="number" id="telefone" name="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required>

            <label for="datan">Data de Nascimento:</label>
            <input type="date" id="datan" name="datan" value="<?php echo htmlspecialchars($cliente['datan']); ?>" required>

            <button type="submit">Atualizar Cliente</button>
        </form>
    </div>
</body>
</html>

<?php
$con->close();
?>
