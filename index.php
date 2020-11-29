<?php
require __DIR__ . '/vendor/autoload.php';

// use BankValidator\Validator;
use BankValidator;

// BankValidator\Validator::init();
// Pad input before processing
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $bank_code = '001';
    $agency = '5892';
    $agency_digit = '0';
    $account = '20394';
    $account_digit = '7';

    //$valid = BankValidator\Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
    $bank_code = '033';
    $agency = '47812';
    $agency_digit = '';
    $account = '43401980';
    $account_digit = '1';

    $valid = BankValidator\Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
    //var_dump($valid);
    ?>

    <h1 class="code-line" data-line-start=2 data-line-end=3><a id="Validador_bancrio_2"></a>Validador bancário</h1>
    <p class="has-line-data" data-line-start="3" data-line-end="4">Um simples validador de agencia, conta e dígitos verificadores de bancos brasileiros em <strong>PHP</strong>.</p>
    <p class="has-line-data" data-line-start="5" data-line-end="6"><strong>Bancos suportados:</strong></p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Código</th>
                <th>Agência</th>
                <th>Conta</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Bradesco</td>
                <td>237</td>
                <td>4 + <strong>DV</strong></td>
                <td>7 + <strong>DV</strong></td>
            </tr>
            <tr>
                <td>Itaú</td>
                <td>341</td>
                <td>4</td>
                <td>5 + <strong>DV</strong></td>
            </tr>
            <tr>
                <td>Banco do Brasil</td>
                <td>001</td>
                <td>4 + <strong>DV</strong></td>
                <td>8 + <strong>DV</strong></td>
            </tr>
            <tr>
                <td>Santander</td>
                <td>033</td>
                <td>4</td>
                <td>8 + <strong>DV</strong></td>
            </tr>
        </tbody>
    </table>
    <p class="has-line-data" data-line-start="13" data-line-end="14"><strong>DV</strong>: Dígito verificador.</p>
    <h2 class="code-line" data-line-start=15 data-line-end=16><a id="Exemplo_de_uso_15"></a>Exemplo de uso:</h2>
    <pre><code>use BankValidator;


    $bank_code = '033';      // codigo do banco
    $agency = '47812';       // numero da agencia
    $agency_digit = '';      // DV da agência
    $account = '43401980';   // numero da conta
    $account_digit = '1';    // DV da conta  
    $auto_pad_values = true; // Adiciona zeros para completar valores para o banco especifico

    // A opção de auto_pad por padrão é false
    $valid = BankValidator\Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, $auto_pad_values);

    // O validador retornará verdadeiro se houve 
    // sucesso ou um array de erros em caso de falha(s).
    </code></pre>
    <h2 class="code-line" data-line-start=33 data-line-end=34><a id="Erros_possveis_no_retorno_33"></a>Erros possíveis no retorno</h2>
    <p class="has-line-data" data-line-start="34" data-line-end="35">Ao rodar uma validação todos os parâmetros são validados e dependendo do sucesso ou não novos erros são adicionados a lista. A lista pode conter os seguintes erros:</p>
    <ul>
        <li class="has-line-data" data-line-start="35" data-line-end="36"><code>INVALID_AGENCY_NUMBER</code>: Agência não segue os padrões do banco.</li>
        <li class="has-line-data" data-line-start="36" data-line-end="37"><code>INVALID_AGENCY_DIGIT</code> : Digito verificador da agência não segue os padrões do banco</li>
        <li class="has-line-data" data-line-start="37" data-line-end="38"><code>INVALID_ACCOUNT_NUMBER</code>: A conta não segue os padrões do banco.</li>
        <li class="has-line-data" data-line-start="38" data-line-end="39"><code>INVALID_ACCOUNT_DIGIT</code>: Digito verificador da conta não segue os padrões do banco</li>
        <li class="has-line-data" data-line-start="39" data-line-end="40"><code>AGENCY_DIGIT_DONT_MATCH</code>: Digito verificador para a agencia é inválido</li>
        <li class="has-line-data" data-line-start="40" data-line-end="42"><code>ACCOUNT_DIGIT_DONT_MATCH</code>: Digito verificador para a conta é inválido</li>
    </ul>
    <p class="has-line-data" data-line-start="42" data-line-end="43">Exemplo de retorno em caso de combinação invalida:</p>
    <pre><code>$bank_code = '033';
    $agency = '47812'; // agência inválida (5 números)
    $agency_digit = '';
    $account = '43401980';
    $account_digit = '1'; // DV é dado a partir da agência (alguns bancos), logo, tornando-o incorreto

    $valid =  BankValidator\Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
    </code></pre>
    <p class="has-line-data" data-line-start="51" data-line-end="52">Retorno:</p>
    <pre><code>array [ 
        &quot;INVALID_AGENCY_NUMBER&quot;,
        &quot;ACCOUNT_DIGIT_DONT_MATCH&quot;
    ]
    </code></pre>
    <h2 class="code-line" data-line-start=57 data-line-end=58><a id="Excees_previstas_57"></a>Exceções previstas</h2>
    <ul>
        <li class="has-line-data" data-line-start="58" data-line-end="59"><code>BankValidator\classes\exceptions\NotRegistredBankCode</code>: É lançado quando o código do banco passado não está registrado. Os códigos dos bancos suportados podem ser vistos no inicio desse documento.</li>
    </ul>
    <h2 class="code-line" data-line-start=59 data-line-end=60><a id="Desenvolvimento_59"></a>Desenvolvimento</h2>
    <p class="has-line-data" data-line-start="60" data-line-end="61">Esse ambiente faz do <strong>docker</strong>/<strong>docker-compose</strong>. Cerifique-se que ele está instalado. Caso contrario, <a href="https://docs.docker.com/engine/install/">clique aqui</a> para aprender a instalar o <strong>docker</strong>.</p>
    <ul>
        <li class="has-line-data" data-line-start="61" data-line-end="62">Para rodar o ambiente basta executar: &lt;pre&gt; docker-compose up &lt;/pre&gt;</li>
        <li class="has-line-data" data-line-start="62" data-line-end="63">O <strong>composer</strong> é utilizado e instalado automaticamente no ambiente. Lembrando que para atualizar as referencias para o autoloader podemos usar o comando <code>composer dump -o</code></li>
    </ul>
    <h2 class="code-line" data-line-start=63 data-line-end=64><a id="Testes_automatizados_63"></a>Testes automatizados:</h2>
    <p class="has-line-data" data-line-start="64" data-line-end="66">Existe um conjunto de testes individuais para cada banco para validação de erros. Para executar os testes você pode rodar o <strong>phpunit</strong> em seu ambiente:<br>
        &lt;pre&gt; vendor/bin/phpunit &lt;/pre&gt;</p>
</body>

</html>