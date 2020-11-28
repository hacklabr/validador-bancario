<?php 
require __DIR__.'/vendor/autoload.php';

// use BankValidator\Validator;
use BankValidator;

BankValidator\Validator::init();
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
        $agency = BankValidator\tools\pad_input_to_length('5892', 4);
        $agency_digit = '0';
        // $agency_digit = '2';

        $account = BankValidator\tools\pad_input_to_length('20394', 8);
        $account_digit = '7';
        // $account_digit = '1';
        
        $valid = BankValidator\Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit);
        var_dump($valid);

    
    ?>
</body>
</html>