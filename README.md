

# Validador bancário
Um simples validador de agencia, conta e dígitos verificadores de bancos brasileiros em **PHP**.

**Bancos suportados:**
| Nome | Código | Agência | Conta
|--|--|--|--|
| Bradesco | 237 | 4 + **DV** | 7 + **DV**
| Itaú | 341 | 4  | 5 + **DV**
| Banco do Brasil  | 001 | 4 + **DV** | 8 + **DV**
| Santander  | 033 | 4  | 8 + **DV**

**DV**: Dígito verificador.

## Exemplo de uso:

    use BankValidator;
	   
	
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

## Erros possíveis no retorno
Ao rodar uma validação todos os parâmetros são validados e dependendo do sucesso ou não novos erros são adicionados a lista. A lista pode conter os seguintes erros:
 - `INVALID_AGENCY_NUMBER`: Agência não segue os padrões do banco.
 - `INVALID_AGENCY_DIGIT` : Digito verificador da agência não segue os padrões do banco
 - `INVALID_ACCOUNT_NUMBER`: A conta não segue os padrões do banco.
 - `INVALID_ACCOUNT_DIGIT`:  Digito verificador da conta não segue os padrões do banco 
 - `AGENCY_DIGIT_DONT_MATCH`: Digito verificador para a agencia é inválido
 - `ACCOUNT_DIGIT_DONT_MATCH`: Digito verificador para a conta é inválido

Exemplo de retorno em caso de combinação invalida:

	$bank_code = '033';
    $agency = '47812'; // agência inválida (5 números)
    $agency_digit = '';
    $account = '43401980';
    $account_digit = '1'; // DV é dado a partir da agência (alguns bancos), logo, tornando-o incorreto
    
    $valid =  BankValidator\Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
 Retorno:

    array [ 
    	"INVALID_AGENCY_NUMBER",
    	"ACCOUNT_DIGIT_DONT_MATCH"
     ]
## Exceções previstas
- `BankValidator\classes\exceptions\NotRegistredBankCode`: É lançado quando o código do banco passado não está registrado. Os códigos dos bancos suportados podem ser vistos no inicio desse documento.
## Desenvolvimento
Esse ambiente faz do **docker**/**docker-compose**. Cerifique-se que ele está instalado. Caso contrario, [clique aqui](https://docs.docker.com/engine/install/) para aprender a instalar o **docker**. 
- Para rodar o ambiente basta executar: <pre> docker-compose up </pre>
- O **composer** é utilizado e instalado automaticamente no ambiente. Lembrando que para atualizar as referencias para o autoloader podemos usar o comando `composer dump -o`
## Testes automatizados:
Existe um conjunto de testes individuais para cada banco para validação de erros. Para executar os testes você pode rodar o **phpunit** em seu ambiente:
<pre> vendor/bin/phpunit </pre>
