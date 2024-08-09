<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Estética</title>
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
            padding: 1px;
            text-align: center;
            position: relative;
            margin-bottom: 20px;
        }
        header img {
            max-height: 270px;
            vertical-align: middle;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .horarios {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .horario {
            width: 230px; /* Aumentado para caber o botão */
            padding: 40px; /* Aumentado para acomodar o botão */
            margin: 20px;
            text-align: center;
            background-color:#978e8c; /* Cor rosa clara */
            border: 1px solid #ccc;
            border-radius: 10px; /* Arredondamento aumentado */
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra adicionada */
        }
        .horario.agendado {
            background-color: #d0d0d0;
            color: #666;
            cursor: not-allowed;
            
        }
        .horario h3 {
            margin: 0;
            font-size: 22px; /* Tamanho da fonte aumentado */
        }
        .horario p {
            margin: 16px 0;
            font-size: 16px; /* Tamanho da fonte aumentado */
        }
        button {
            width: 130px; /* Aumentado para mais destaque */
            padding: 10px; /* Ajustado para maior conforto */
            font-size: 15px; /* Tamanho da fonte reduzido para "Cancelar Agendamento" */
            color: #333;
            background-color: #d3d3d3;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center; /* Alinha o texto ao centro do botão */
            padding-top: 4px;
        }
        button:disabled {
            background-color: #c0c0c0;
            cursor: not-allowed;
        }
        .cancelar {
            background-color: #dc3545;
            font-size: 12px; /* Reduzido para "Cancelar Agendamento" */
        }
    </style>
</head>
<body>

<header>
    <img src="imagens/B.png" alt="Logo" />

</header>

<h2>Agendamentos Disponíveis</h2>

<div class="horarios">
    <div class="horario" data-time="10:00">
        <h3>10:00</h3>
        <p>Disponível</p>
        <button>Agendar</button>
    </div>
    <div class="horario" data-time="11:00">
        <h3>11:00</h3>
        <p>Disponível</p>
        <button>Agendar</button>
    </div>
    <div class="horario" data-time="13:00">
        <h3>13:00</h3>
        <p>Disponível</p>
        <button>Agendar</button>
    </div>
    <div class="horario" data-time="14:00">
        <h3>14:00</h3>
        <p>Disponível</p>
        <button>Agendar</button>
    </div>
    <div class="horario" data-time="15:00">
        <h3>15:00</h3>
        <p>Disponível</p>
        <button>Agendar</button>
    </div>
    <div class="horario" data-time="16:00">
        <h3>16:00</h3>
        <p>Disponível</p>
        <button>Agendar</button>
    </div>
    <div class="horario" data-time="17:00">
        <h3>17:00</h3>
        <p>Disponível</p>
        <button>Agendar</button>
    </div>
</div>

<script>
    let agendado = false;

    document.querySelectorAll('.horario button').forEach(button => {
        button.addEventListener('click', function() {
            const horarioDiv = this.parentElement;
            const horarioTime = horarioDiv.dataset.time;

            if (button.textContent === 'Cancelar Agendamento') {
                if (confirm('Tem certeza que deseja cancelar o agendamento?')) {
                    horarioDiv.classList.remove('agendado');
                    horarioDiv.querySelector('p').textContent = 'Disponível';
                    button.textContent = 'Agendar';
                    button.classList.remove('cancelar');
                    button.disabled = false;
                    agendado = false;
                }
                return;
            }

            if (agendado) {
                alert('Você já tem um horário agendado!');
                return;
            }

            horarioDiv.classList.add('agendado');
            horarioDiv.querySelector('p').textContent = 'Agendado';
            button.textContent = 'Cancelar Agendamento';
            button.classList.add('cancelar');
            button.disabled = false;
            agendado = true;
            alert(`Horário ${horarioTime} agendado`);
        });
    });
</script>

</body>
</html>