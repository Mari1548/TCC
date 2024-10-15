<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - Clínica Bela Vitta</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #978e8c;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-sizing: border-box;
        }

        header img {
            width: 100px;
            height: auto;
        }

        .menu {
            flex-grow: 1; 
            display: flex;
            justify-content: center; 
        }

        .menu ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .menu ul li {
            margin-left: 20px;
        }

        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .menu ul li a:hover {
            color: #555;
        }

        .hero-section {
            width: 100%;
            height: 500px;
            background-image: url('imagens/clinica.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(transparent, rgba(244, 244, 244, 0.8)); 
        }

        .hero-section h1 {
            font-size: 48px;
            background-color: rgba(0, 0, 0, 0.5); 
            padding: 20px;
            border-radius: 10px;
            z-index: 1; 
            position: relative; 
        }

        .about-section {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .about-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }

        .about-section p {
            font-size: 18px;
            line-height: 1.8;
            color: #666;
            text-align: justify;
        }

      
    </style>
</head>
<body>

<header>
    <img src="imagens/B.png" alt="Logo Bela Vitta">
    <div class="menu">
        <ul>
            <li><a href="cadastrar.php">Cadastrar-se</a></li>
            <li><a href="servicos.php">Serviços</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="profissionais.html">Profissionais</a></li>
            <li><a href="home.html">Home</a></li>
        </ul>
    </div>
</header>

<div class="hero-section">
    <h1>Bem-vindo à Clínica Bela Vitta</h1>
</div>

<div class="about-section">
    <h2>Sobre a Clínica</h2>
    <p>
        A Clínica Bela Vitta oferece uma vasta gama de tratamentos estéticos de alta qualidade, combinando inovação tecnológica com uma equipe de profissionais altamente qualificados. Nosso objetivo é garantir que cada cliente se sinta valorizado e atinja seus objetivos de beleza e bem-estar em um ambiente acolhedor e de confiança. Oferecemos serviços personalizados que atendem a todas as suas necessidades, com tratamentos avançados e técnicas modernas, sempre priorizando a segurança e o conforto.
    </p>
</div>

</body>
</html>
