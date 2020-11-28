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
        $agency = '5892';
        $agency_digit = '0';
        $account = '20394';
        $account_digit = '7';
        
        $valid = BankValidator\Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        var_dump($valid);

    
    ?>
</body>
</html>