<?php 
namespace BankValidator;

use PHPUnit\Framework\TestCase;

class BancoDoBrasilTest extends TestCase{
    /**
     * @todo The tests should not be single "target"
     */
    public function test_validate_account() {
        Validator::init();

        $bank_code = '001';
        $agency = '5892';
        $agency_digit = '0';
        $account = '20394';
        $account_digit = '7';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);


        $bank_code = '001';
        $agency = '7138';
        $agency_digit = '2';
        $account = '189062';
        $account_digit = 'X';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);
        
    }
}