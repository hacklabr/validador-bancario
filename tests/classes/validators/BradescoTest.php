<?php 
namespace BankValidator;

use PHPUnit\Framework\TestCase;

class BradescoTest extends TestCase{
    /**
     * @todo The tests should not be single "target"
     */
    public function test_validate_account() {
        Validator::init();

        $bank_code = '237';
        $agency = '0019';
        $agency_digit = '1';
        $account = '1635877';
        $account_digit = '0';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);

        $bank_code = '237';
        $agency = '3466';
        $agency_digit = '5';
        $account = '0982915';
        $account_digit = '6';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);


        $bank_code = '237';
        $agency = '5324';
        $agency_digit = '4';
        $account = '1035952';
        $account_digit = '0';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);


        $bank_code = '237';
        $agency = '0912';
        $agency_digit = '1';
        $account = '1740271';
        $account_digit = '4';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);



        // Erros 
        $bank_code = '237';
        $agency = '1019'; // change 1
        $agency_digit = '1';
        $account = '1635877';
        $account_digit = '0';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['AGENCY_DIGIT_DONT_MATCH']);

        $bank_code = '237';
        $agency = '3466';
        $agency_digit = '5';
        $account = '0982915';
        $account_digit = '1';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['ACCOUNT_DIGIT_DONT_MATCH']);


        $bank_code = '237';
        $agency = '5324';
        $agency_digit = '4';
        $account = '1035952';
        $account_digit = 'X';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['ACCOUNT_DIGIT_DONT_MATCH']);


        $bank_code = '237';
        $agency = '0912';
        $agency_digit = '-';
        $account = '1740271';
        $account_digit = '4';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['INVALID_AGENCY_DIGIT']);
    }
}