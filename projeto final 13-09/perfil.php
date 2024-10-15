<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("conexao.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION["email"];

$stmt = $con->prepare("SELECT cpf, nome, email, cidade, telefone, datan FROM clientes WHERE email = ?");
if (!$stmt) {
    die("Erro na preparação da consulta: " . $con->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($cpf, $nome, $email_usuario, $cidade, $telefone, $datan);
$stmt->fetch();
$stmt->close();

// Consultar agendamentos do usuário
$agendamentos_sql = "SELECT a.codagenda, a.hora, a.data, s.nome AS servico
                     FROM agendamento a
                     JOIN servicos s ON a.codservico = s.codservico
                     WHERE a.cpf = ?";
$agendamentos_stmt = $con->prepare($agendamentos_sql);
$agendamentos_stmt->bind_param("s", $cpf);
$agendamentos_stmt->execute();
$agendamentos_result = $agendamentos_stmt->get_result();

$con->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Estética Bela</title>
    <link rel="stylesheet" type="text/css" href="inicial.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .profile-container {
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 30px;
            border: 3px solid #978e8c;
        }

        .profile-details h2 {
            margin: 0;
            color: #333;
        }

        .profile-details p {
            margin: 5px 0;
            color: #666;
        }

        .profile-actions {
            margin-top: 20px;
        }

        .profile-actions a {
            display: inline-block;
            margin-right: 15px;
            background-color: #978e8c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .voltar-container {
            position: absolute; 
            top: 50px; 
            right: 20px; 
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
            background-color: #7a7a7a; 
        }
        
        .profile-actions a:hover {
            background-color: #7a7a7a;
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
        <a href="agendamentos.php" class="botao-voltar">Voltar para Agendamentos</a>
    </div>
</header>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-details">
            <h2><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($nome); ?></h2>
            <p><strong>CPF:</strong> <?php echo htmlspecialchars($cpf); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email_usuario); ?></p>
            <p><strong>Cidade:</strong> <?php echo htmlspecialchars($cidade); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($telefone); ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars(date('d/m/Y', strtotime($datan))); ?></p>
        </div>
    </div>
    <div class="profile-actions">
        <a href="editar_perfil.php">Editar Perfil</a>
    </div>

    <div class="agendamentos-container">
        <h2>Seus Agendamentos</h2>
        <?php if ($agendamentos_result->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Ação</th>
                </tr>
                <?php while ($row = $agendamentos_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['servico']); ?></td>
                        <td><?php echo htmlspecialchars($row['data']); ?></td>
                        <td><?php echo htmlspecialchars($row['hora']); ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="excluirAgendamento('<?php echo htmlspecialchars($row['codagenda']); ?>')">Excluir</a>
                            <a href="editar_agendamento.php?codagenda=<?php echo htmlspecialchars($row['codagenda']); ?>">Editar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Você ainda não tem agendamentos.</p>
        <?php endif; ?>
    </div>
</div>

<script>
function excluirAgendamento(codagenda) {
    if (confirm('Tem certeza que deseja excluir este agendamento?')) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "excluir_agendamento.php?codagenda=" + encodeURIComponent(codagenda), true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                location.reload(); 
            } else {
                alert('Erro ao excluir agendamento: ' + xhr.responseText);
            }
        };
        xhr.send();
    }
}
</script>

</body>
</html>
