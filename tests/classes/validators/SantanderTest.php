<?php 
namespace BankValidator;

use PHPUnit\Framework\TestCase;

class SantanderTest extends TestCase{
    /**
     * @todo The tests should not be single "target"
     */
    public function test_validate_account() {
        Validator::init();

        $bank_code = '033';
        $agency = '0189';
        $agency_digit = '0';
        $account = '01017417';
        $account_digit = '9';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);


        $bank_code = '033';
        $agency = '3414';
        $agency_digit = '';
        $account = '01092006';
        $account_digit = '4';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);


        $bank_code = '033';
        $agency = '4781';
        $agency_digit = '';
        $account = '43401980';
        $account_digit = '1';

        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        
        $this->assertTrue($valid);


        $bank_code = '033';
        $agency = '3212';
        $agency_digit = '';
        $account = '05402827';
        $account_digit = '6';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);



        //Errors
        $bank_code = '033';
        $agency = '0189';
        $agency_digit = '0';
        $account = '22017417';
        $account_digit = '9';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['INVALID_ACCOUNT_NUMBER']);


        $bank_code = '033';
        $agency = '3414';
        $agency_digit = '';
        $account = '01092006';
        $account_digit = '3';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['ACCOUNT_DIGIT_DONT_MATCH']);



        $bank_code = '033';
        $agency = '47812';
        $agency_digit = '';
        $account = '43401980';
        $account_digit = '1';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertEquals($valid, ['INVALID_AGENCY_NUMBER', 'ACCOUNT_DIGIT_DONT_MATCH']);
        // $this->assertTrue($valid);




        $bank_code = '033';
        $agency = '3212';
        $agency_digit = '';
        $account = '05402827';
        $account_digit = '6';
        
        $valid = Validator::validate($bank_code, $agency, $agency_digit, $account, $account_digit, true);
        $this->assertTrue($valid);

    }
}