<?php
session_start();
include("conexao.php");

// Verifica se o admin está logado
if (!isset($_SESSION["admin_logged"]) || !$_SESSION["admin_logged"]) {
    header("Location: login.php");
    exit();
}

// Consulta todos os agendamentos, incluindo o nome do serviço
$sql = "SELECT a.*, c.nome AS cliente_nome, c.email, s.nome AS servico_nome 
        FROM agendamento a 
        JOIN clientes c ON a.cpf = c.cpf 
        JOIN servicos s ON a.codservico = s.codservico"; // Adicionando join com a tabela de serviços
$result = $con->query($sql);

// Verifica se a consulta retornou resultados
if (!$result) {
    die("Erro ao consultar agendamentos: " . $con->error);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Agendamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #978e8c;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #978e8c;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .header {
            background-color: #978e8c;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .header a {
            color: white;
            margin: 0 15px;
        }

        .btn-voltar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #7a7a7a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin: 10px 0;
        }

        .btn-voltar:hover {
            background-color: #707070;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Área do Administrador</h2>
        <a href="admindashboard.php">Gerenciar Clientes</a>
        <a href="adm_addcliente.php">Adicionar Novo Cliente</a>
        <a href="logout.php">Sair</a>
    </div>
    <div class="container">
        <h1>Lista de Agendamentos</h1>
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Procedimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['cliente_nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['data']); ?></td>
                    <td><?php echo htmlspecialchars($row['hora']); ?></td>
                    <td><?php echo htmlspecialchars($row['servico_nome']); ?></td>
                    <td>
                        <a href="javascript:void(0);" onclick="excluirAgendamento('<?php echo htmlspecialchars($row['codagenda']); ?>')">Excluir</a>
                        <a href="adm_editaragendamento.php?codagenda=<?php echo htmlspecialchars($row['codagenda']); ?>">Editar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    function excluirAgendamento(codagenda) {
        console.log("codagenda a ser excluído:", codagenda);
        if (confirm('Tem certeza que deseja excluir este agendamento?')) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "adm_excluiragend.php?codagenda=" + encodeURIComponent(codagenda), true);
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

<?php
$con->close();
?>
