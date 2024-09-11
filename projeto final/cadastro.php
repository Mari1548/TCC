<?php
// Exibe todos os erros para facilitar a depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    // Inclui o arquivo de conexão
    include_once('conexao.php');

    // Verifica se a conexão foi estabelecida corretamente
    if (!$con) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Obtém e escapa os dados do formulário
    $cpf = mysqli_real_escape_string($con, $_POST['cpf']);
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $cidade = mysqli_real_escape_string($con, $_POST['cidade']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);
    $datan = mysqli_real_escape_string($con, $_POST['datan']);

    // Prepara a query SQL
    $query = "INSERT INTO clientes (cpf, nome, email, cidade, telefone, datan) 
              VALUES ('$cpf', '$nome', '$email', '$cidade', '$telefone', '$datan')";

    // Exibe a query para depuração
    echo "<pre>Query: $query</pre>";

    // Executa a query e verifica se foi bem-sucedida
    if (mysqli_query($con, $query)) {
        echo "Cadastrado com sucesso!";
    } else {
        // Exibe a mensagem de erro detalhada
        echo "Erro ao cadastrar: " . mysqli_error($con);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($con);
} else {
    echo "Nenhum dado enviado. Por favor, preencha o formulário.";
}
?>
