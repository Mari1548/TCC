<?php
session_start();
include("conexao.php");

// Verifique se o usuário está logado
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Obter o email do usuário
$email = $_SESSION["email"];

// Obter informações do cliente
$stmt = $con->prepare("SELECT cpf, nome, email, cidade, telefone, datan FROM clientes WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($cpf, $nome, $email_usuario, $cidade, $telefone, $datan);
$stmt->fetch();
$stmt->close();

// Atualizar perfil
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Coletar dados do formulário
    $novo_nome = $_POST['nome'];
    $novo_email = $_POST['email'];
    $nova_cidade = $_POST['cidade'];
    $novo_telefone = $_POST['telefone'];
    $nova_datan = $_POST['datan'];

    // Atualizar informações no banco de dados
    $update_stmt = $con->prepare("UPDATE clientes SET nome = ?, email = ?, cidade = ?, telefone = ?, datan = ? WHERE cpf = ?");
    if (!$update_stmt) {
        die("Erro na preparação da consulta: " . $con->error);
    }

    // Bind dos parâmetros
    $update_stmt->bind_param("ssssss", $novo_nome, $novo_email, $nova_cidade, $novo_telefone, $nova_datan, $cpf);

    // Executar a atualização
    if ($update_stmt->execute()) {
        echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href='perfil.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar perfil: " . $update_stmt->error . "');</script>";
    }

    $update_stmt->close();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Estética Bela</title>
    <link rel="stylesheet" type="text/css" href="inicial.css">
    <style>
        .edit-profile-container {
            width: 80%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .edit-profile-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
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
            transition: background 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #7b7a77;
        }

        /* Estilos para o botão de voltar */
        .voltar-container {
            position: absolute; /* Posiciona o botão de forma absoluta */
            top: 50px; /* Distância do topo */
            right: 20px; /* Distância da direita */
        }

        .botao-voltar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .botao-voltar:hover {
            background-color: #7a7a7a; /* Cor ao passar o mouse */
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
    <div class="voltar-container">
        <a href="perfil.php" class="botao-voltar">Voltar</a>
    </div>
</header>

<div class="edit-profile-container">
    <h2>Editar Perfil</h2>
    <form action="editar_perfil.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email_usuario); ?>" required>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($cidade); ?>" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" required>

        <label for="datan">Data de Nascimento:</label>
        <input type="date" id="datan" name="datan" value="<?php echo htmlspecialchars($datan); ?>" required>

        <button type="submit">Salvar Alterações</button>
    </form>
</div>

</body>
</html>
