<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .orcamento {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .tabela-info {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid black;
        }

        .tabela-info td {
            padding: 8px;
            border: 1px solid black;
        }

        .tabela-info strong {
            display: inline;
            width: 120px;
        }

        .tabela-servicos {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid black;
        }

        .tabela-servicos th,
        .tabela-servicos td {
            padding: 10px;
            border: 1px solid black;
            text-align: left;
        }

        .tabela-servicos th {
            font-weight: bold;
        }

        .titulo-servicos {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .informacoes-proposta,
        .informacoes-representante,
        .marcenaria {
            margin: 20px auto;
            max-width: 1200px;
            padding: 10px;
            font-size: 16px;
        }

        .informacoes-proposta p,
        .informacoes-representante p {
            margin: 5px 0;
            font-weight: bold;
        }

        .informacoes-representante p {
            margin-bottom: 40px;
        }

        .marcenaria p {
            margin: 5px 0;
        }

        .informacoes-representante {
            text-align: center;
        }

        .informacoes-representante hr {
            width: 200px;
            margin: 10px auto;
        }

        /* Estilo para impressão */
        @media print {
            button {
                display: none;
                /* Oculta botão na impressão */
            }
        }
    </style>
</head>

<body>
    <img src="logo.png" alt="Logo da Empresa" style="height: 100px; width: 200px">


    <h1 class="orcamento">ORÇAMENTO</h1>

    <table class="tabela-info">
        <tr>
            <td colspan="3"><strong>DENOMINAÇÃO:</strong> VAGUINHO PLANEJADOS</td>
        </tr>
        <tr>
            <td colspan="3"><strong>ENDEREÇO:</strong> RUA DR LUIZ GOMES DOS REIS, Nº 112</td>
        </tr>
        <tr>
            <td colspan="1"><strong>CEP:</strong> 17.470-029</td>
            <td colspan="1"><strong>CNPJ Nº:</strong> 46.535.355/0001-86</td>
            <td colspan="1"><strong>FONE:</strong> (14) 99719-7638</td>
        </tr>
        <tr>
            <td colspan="2"><strong>E-MAIL:</strong> vaguinhogabriel01@gmail.com</td>
            <td colspan="1"><strong>DATA:</strong> <?php echo date("d/m/Y", strtotime($_POST['data'])); ?></td>
        </tr>
    </table>

    <table class="tabela-servicos">
        <thead>
            <tr>
                <th>UN</th>
                <th>ESPECIFICAÇÕES DOS SERVIÇOS</th>
                <th>VALOR</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalGeral = 0;
            for ($i = 0; $i < count($_POST['un']); $i++) {
                $valor = (float) $_POST['valor_servico'][$i];
                $total = $valor; // Aqui, você pode adicionar lógica se precisar multiplicar pela quantidade, por exemplo.
                $totalGeral += $total;
                echo "<tr>
                    <td>" . htmlspecialchars($_POST['un'][$i]) . "</td>
                    <td>" . htmlspecialchars($_POST['especificacoes'][$i]) . "</td>
                    <td>" . number_format($valor, 2, ',', '.') . "</td>
                    <td>" . number_format($total, 2, ',', '.') . "</td>
                  </tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>TOTAL GERAL:</strong></td>
                <td><?php echo number_format($totalGeral, 2, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="informacoes-proposta">
        <p><strong>VALOR DA PROPOSTA:</strong> <?php echo number_format($_POST['valor_proposta'], 2, ',', '.'); ?></p>
        <p><strong>CLIENTE TOMADOR DO SERVIÇO:</strong> <?php echo htmlspecialchars($_POST['cliente']); ?></p>
        <p><strong>VALIDADE DA PROPOSTA:</strong> <?php echo date("d/m/Y", strtotime($_POST['validade'])); ?></p>
    </div>

    <div class="informacoes-representante">
        <p>Duartina, <?php
        setlocale(LC_TIME, 'pt_BR.utf8', 'portuguese');

        $data = strtotime($_POST['data']);
        echo strftime("%d de %B de %Y", $data); // Exibe a data por extenso
        ?></p>
        <hr>
    </div>

    <div class="marcenaria">
        <p><strong>Nome do Representante:</strong> VAGNER ROBERTO GABRIEL</p>
        <p><strong>RG do Representante:</strong> 33.474.439-9</p>
        <p><strong>CPF do Representante:</strong> 273.959.458-59</p>
    </div>

    <button onclick="window.print()">Imprimir Orçamento</button>

</body>

</html>