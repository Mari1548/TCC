<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insercao</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
   
</head>
<body>
    <div class="box">
        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST["cpf"])) {
                $cpf = $_POST["cpf"];
                $cpf = preg_replace('/[^0-9]/', '', $cpf);
                if (strlen($cpf) == 11) {
                    echo "CPF digitado: " . substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
                } else {
                    echo "CPF inválido!";
                }
            } else {
                echo "Por favor, preencha o campo CPF!";
            }
        }
        ?>
        <form action="cadastro.php" method="POST">
            <fieldset>
                <legend><b>Formulário de Clientes</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" id="cpf" name="cpf" class="inputUser" maxlength="14" 
                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF válido 
                    (formato: xxx.xxx.xxx-xx)" required>
                    <label for="cpf" class="labelInput">CPF</label>
                <br>
                </div>
                <br><br>
                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <input type="date" name="data_nascimento" id="data_nascimento" required class="data">
                <br><br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>
               
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>