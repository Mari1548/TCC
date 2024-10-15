<?php
session_start();
include("conexao.php");

// Verifica se o admin está logado
if (!isset($_SESSION["admin_logged"]) || !$_SESSION["admin_logged"]) {
    header("Location: login.php");
    exit();
}

// Processa o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];
    $datan = $_POST['datan'];

    // Verifica se o CPF já está cadastrado
    $check_cpf = $con->prepare("SELECT cpf FROM clientes WHERE cpf = ?");
    $check_cpf->bind_param("s", $cpf);
    $check_cpf->execute();
    $check_cpf->store_result();

    if ($check_cpf->num_rows > 0) {
        $erro = "CPF já cadastrado!";
    } else {
        // Insere os dados no banco
        $stmt = $con->prepare("INSERT INTO clientes (cpf, nome, email, cidade, telefone, datan) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $cpf, $nome, $email, $cidade, $telefone, $datan);

        if ($stmt->execute()) {
            $sucesso = "Cliente adicionado com sucesso!";
        } else {
            $erro = "Erro ao adicionar cliente: " . $con->error;
        }

        $stmt->close();
    }

    $check_cpf->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Cliente</title>
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

        input[type="text"], input[type="email"], input[type="date"], input[type="tel"] {
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

        .message {
            text-align: center;
            margin-bottom: 15px;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <a href="admindashboard.php" class="btn-voltar">Voltar</a>
    <div class="container">
        <h1>Adicionar Cliente</h1>

        <!-- Mensagens de sucesso ou erro -->
        <?php if (isset($sucesso)): ?>
            <p class="message"><?php echo $sucesso; ?></p>
        <?php elseif (isset($erro)): ?>
            <p class="message error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form method="post">
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" maxlength="11" required>

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="cidade">Cidade</label>
            <input type="text" id="cidade" name="cidade" required>

            <label for="telefone">Telefone</label>
            <input type="tel" id="telefone" name="telefone" required>

            <label for="datan">Data de Nascimento</label>
            <input type="date" id="datan" name="datan" required>

            <button type="submit">Adicionar Cliente</button>
        </form>
    </div>
</body>
</html>

<?php
$con->close();
?>
