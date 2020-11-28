<?php 
namespace BankValidator;

use PHPUnit\Framework\TestCase;

class ItauTest extends TestCase{
    /**
     * @todo The tests should not be single "target"
     */
    public function test_validate_account() {
        Validator::init();

        $bank_code = '341';
        $agency = '0181';
        $agency_digit = '';
        $account = '16799';
        $account_digit = '0';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);

        $bank_code = '341';
        $agency = '7830';
        $agency_digit = '';
        $account = '55732';
        $account_digit = '3';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);


        $bank_code = '341';
        $agency = '6781';
        $agency_digit = '';
        $account = '65394';
        $account_digit = '1';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);

        // Erros tests
        $bank_code = '341';
        $agency = '0181';
        $agency_digit = '';
        $account = '16799';
        $account_digit = '1';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['ACCOUNT_DIGIT_DONT_MATCH']);

        $bank_code = '341';
        $agency = '7830';
        $agency_digit = 'x';
        $account = '55732';
        $account_digit = '3';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['INVALID_AGENCY_DIGIT']);


        $bank_code = '341';
        $agency = '6x81';
        $agency_digit = '';
        $account = '65394';
        $account_digit = '1';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['INVALID_AGENCY_NUMBER', 'ACCOUNT_DIGIT_DONT_MATCH']);
        
    }
}