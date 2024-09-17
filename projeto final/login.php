<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Estética</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0e0e0;
        }
        header {
            background-color: #978e8c;
            color: #333;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Espaça logo e menu */
            box-sizing: border-box;
        }
        header img {
            max-height: 60px; /* Ajuste o tamanho da logo conforme necessário */
        }
        .menu {
            flex: 1; /* Faz o menu ocupar o espaço restante */
            display: flex;
            justify-content: center; /* Centraliza o menu horizontalmente */
        }
        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .menu ul li {
            margin: 0 15px;
        }
        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .menu ul li a:hover {
            color: #555;
        }
        .login-container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .login-container h2 {
            text-align: center;
            color: #333;
        }
        .back-button {
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        .back-button:hover {
            background-color: #444;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container form input[type="email"],
        .login-container form input[type="password"],
        .login-container form input[type="submit"] {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .login-container form input[type="submit"] {
            background-color: #978e8c;
            color: white;
            cursor: pointer;
        }
        .login-container form input[type="submit"]:hover {
            background-color: #776e6d;
        }
    </style>
</head>
<body>

<header>

    <img src="imagens/B.png" alt="Logo" />
    <div class="menu">
        <ul>
            <li><a href="cadastrar.php">Cadastrar-se</a></li>
            <li><a href="index.html">Home</a></li>
            <li><a href="servicos.php">Serviços</a></li>
            <li><a href="profissionais.html">Profissionais</a></li>
            
        </ul>
    </div>
</header>

<div class="login-container">
    <h2>Faça login</h2>
    <form action="processa_login.php" method="post">
        <input type="email" name="email" placeholder="Seu email" required>
        <input type="password" name="cpf" placeholder="Seu CPF" required>
        <input type="submit" value="Entrar">
    </form>
</div>

</body>
</html>
