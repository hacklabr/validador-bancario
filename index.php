<?php 
require __DIR__.'/vendor/autoload.php';

// use BankValidator\Validator;
use BankValidator;

BankValidator\Validator::init();
// Pad input before processing
BankValidator\tools\pad_input_to_length("288149", 8);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php var_dump(BankValidator\Validator::validate_account('001', '01232609', '7')); ?>
</body>
</html>