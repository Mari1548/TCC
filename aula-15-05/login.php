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

<div class="login-container">
    <h2>Faça login</h2>
    <form action="processa_login.php" method="POST">
        <input type="email" name="email" placeholder="Seu email" required>
        <input type="password" name="cpf" placeholder="Seu CPF" required>
        <input type="submit" value="Entrar">
    </form>
</div>

</body>
</html>