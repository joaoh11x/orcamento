<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Orçamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="number"] {
            -moz-appearance: textfield; /* Remove spinner from input type number in Firefox */
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .service-row {
            margin-bottom: 10px;
        }
        .remove-btn {
            background-color: #f44336;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Formulário de Orçamento</h1>
<form action="orcamento.php" method="POST" id="orcamentoForm">
    <div class="form-group">
        <label for="data">DATA:</label>
        <input type="date" id="data" name="data" required>
    </div>
    <div class="form-group">
        <label for="cliente">CLIENTE TOMADOR DO SERVIÇO:</label>
        <input type="text" id="cliente" name="cliente" required>
    </div>
    <div class="form-group">
        <label for="validade">VALIDADE DA PROPOSTA:</label>
        <input type="date" id="validade" name="validade" required>
    </div>
    <div class="form-group">
        <label for="valor_proposta">VALOR DA PROPOSTA:</label>
        <input type="number" id="valor_proposta" name="valor_proposta" required step="0.01" readonly>
    </div>

    <!-- Campos para os serviços -->
    <div id="servicosContainer">
        <div class="service-row">
            <div class="form-group">
                <label for="un">UN:</label>
                <input type="text" name="un[]" required>
            </div>
            <div class="form-group">
                <label for="especificacoes">ESPECIFICAÇÕES DOS SERVIÇOS:</label>
                <input type="text" name="especificacoes[]" required>
            </div>
            <div class="form-group">
                <label for="valor_servico">VALOR:</label>
                <input type="number" name="valor_servico[]" required step="0.01" oninput="atualizarTotal()">
            </div>
            <button type="button" class="remove-btn" onclick="removerServico(this)">Remover Item</button>
        </div>
    </div>

    <button type="button" onclick="adicionarServico()">Adicionar Item</button>
    <button type="submit">Enviar Orçamento</button>
</form>

<div id="totalGeralContainer" style="text-align:center; margin-top:20px;">
    <h3>TOTAL GERAL: <span id="totalGeral">0,00</span></h3>
</div>

<script>
    function adicionarServico() {
        const servicosContainer = document.getElementById('servicosContainer');
        const serviceRow = document.createElement('div');
        serviceRow.className = 'service-row';

        serviceRow.innerHTML = `
            <div class="form-group">
                <label for="un">UN:</label>
                <input type="text" name="un[]" required>
            </div>
            <div class="form-group">
                <label for="especificacoes">ESPECIFICAÇÕES DOS SERVIÇOS:</label>
                <input type="text" name="especificacoes[]" required>
            </div>
            <div class="form-group">
                <label for="valor_servico">VALOR:</label>
                <input type="number" name="valor_servico[]" required step="0.01" oninput="atualizarTotal()">
            </div>
            <button type="button" class="remove-btn" onclick="removerServico(this)">Remover Item</button>
        `;

        servicosContainer.appendChild(serviceRow);
    }

    function removerServico(button) {
        const serviceRow = button.parentElement;
        serviceRow.remove();
        atualizarTotal();
    }

    function atualizarTotal() {
        const valores = document.querySelectorAll('input[name="valor_servico[]"]');
        let totalGeral = 0;

        valores.forEach(input => {
            const valor = parseFloat(input.value) || 0; 
            totalGeral += valor;
        });

        document.getElementById('totalGeral').innerText = totalGeral.toFixed(2).replace('.', ',');
        document.getElementById('valor_proposta').value = totalGeral.toFixed(2);
    }
</script>

</body>
</html>
