<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #978e8c;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            position: relative;
            box-sizing: border-box;
        }
        img {
            width: 100px; /* Tamanho da logo ajustado */
            height: auto; /* Mantém a proporção da imagem */
        }
        .menu {
            position: absolute;
            left: 50%;
            transform: translateX(-50%); /* Centraliza o menu horizontalmente */
        }
        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center; /* Centraliza verticalmente os itens do menu */
        }
        .menu ul li {
            margin: 0 15px; /* Ajusta a margem dos itens de menu */
        }
        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .menu ul li a:hover {
            color: #555;
        }
        .container {
            padding: 20px;
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
        .services {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .service-card {
            width: 200px;
            border: 2px solid #786b68;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            border-radius: 8px;
            background-color: #fff;
            padding-bottom: 60px; /* Espaço extra para o botão */
        }
        .service-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .service-card p {
            margin: 10px 0;
            font-size: 16px;
            color: #786b68;
            font-weight: bold;
        }
        .service-card button {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            color: #fff;
            background-color: #978e8c; /* Cor igual ao cabeçalho */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            bottom: 10px;
            left: 0;
            transition: background-color 0.3s;
        }
        .service-card button:hover {
            background-color: #776e6d; /* Cor mais escura para o efeito hover */
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
            <li><a href="login.php">Login</a></li>
            <li><a href="profissionais.html">Profissionais</a></li>
            <li><a href="agendamentos.php">Agendamentos</a></li>
        </ul>
    </div>
</header>

<div class="container">
    <h1>Serviços</h1>
    
    <div class="services">
        <div class="service-card">
            <img src="imagens/botox.webp" alt="Botox">
            <p>Botox</p>
            <button onclick="redirectToLogin()">Ir para Agendamento</button>
        </div>
        <div class="service-card">
            <img src="imagens/micro.png" alt="Microagulhamento">
            <p>Microagulhamento</p>
            <button onclick="redirectToLogin()">Ir para Agendamento</button>
        </div>
        <div class="service-card">
            <img src="imagens/silicone.webp" alt="Silicone">
            <p>Silicone</p>
            <button onclick="redirectToLogin()">Ir para Agendamento</button>
        </div>
        <div class="service-card">
            <img src="imagens/lipo.jpg" alt="Lipoaspiração">
            <p>Lipoaspiração</p>
            <button onclick="redirectToLogin()">Ir para Agendamento</button>
        </div>
        <div class="service-card">
            <img src="imagens/rino.jpg" alt="Rinoplastia">
            <p>Rinoplastia</p>
            <button onclick="redirectToLogin()">Ir para Agendamento</button>
        </div>
        <div class="service-card">
            <img src="imagens/biche.jpeg" alt="Bichectomia">
            <p>Bichectomia</p>
            <button onclick="redirectToLogin()">Ir para Agendamento</button>
        </div>
    </div>
</div>

<script>
    function redirectToLogin() {
        window.location.href = 'login.html'; // Redireciona para a página de login
    }
</script>

</body>
</html>
