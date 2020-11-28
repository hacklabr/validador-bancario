<?php 
namespace BankValidator;

use BankValidator\classes\validators\BancoDoBrasil;
use PHPUnit\Framework\TestCase;

class BancoDoBrasilTest extends TestCase{
    public function test_validate_agency_digit() {
        //5892-0
        $agency = "5892";
        $agency_padded = tools\pad_input_to_length($agency, 4);

        $result = BancoDoBrasil::validate_agency_digit($agency_padded, '0');
        $this->assertTrue($result);

        $result = BancoDoBrasil::validate_agency_digit($agency_padded, '2');
        $this->assertFalse($result);

        $result = BancoDoBrasil::validate_agency_digit($agency_padded, 'X');
        $this->assertFalse($result);
    }

    public function test_validate_account_digit() {
        //1061095-2
        $account = "1061095";
        $account_padded = tools\pad_input_to_length($account, 8);

        $result = BancoDoBrasil::validate_account_digit($account_padded, '2');
        $this->assertTrue($result);

        $result = BancoDoBrasil::validate_account_digit($account_padded, '0');
        $this->assertFalse($result);

        $result = BancoDoBrasil::validate_account_digit($account_padded, 'X');
        $this->assertFalse($result);


        //1237360-5
        $account = "1237360";
        $account_padded = tools\pad_input_to_length($account, 8);
        
        $result = BancoDoBrasil::validate_account_digit($account_padded, 'a');
        $this->assertFalse($result);
        
        $result = BancoDoBrasil::validate_account_digit($account_padded, 'X');
        $this->assertFalse($result);

        $result = BancoDoBrasil::validate_account_digit($account_padded, '5');
        $this->assertTrue($result);


        //37129-7
        $account = "37129";
        $account_padded = tools\pad_input_to_length($account, 8);
        
        $result = BancoDoBrasil::validate_account_digit($account_padded, 'a');
        $this->assertFalse($result);

        $result = BancoDoBrasil::validate_account_digit($account_padded, '7');
        $this->assertTrue($result);
        
        $result = BancoDoBrasil::validate_account_digit($account_padded, 'X');
        $this->assertFalse($result);


        //-3X71X9
        $account = "-3X71X9111-11-1";
        $account_padded = tools\pad_input_to_length($account, 8);
        
        $result = classes\validators\BancoDoBrasil::validate_account_digit($account_padded, '1');
        $this->assertFalse($result);
        
        $result = classes\validators\BancoDoBrasil::validate_account_digit($account_padded, '7');
        $this->assertFalse($result);
        
        $result = classes\validators\BancoDoBrasil::validate_account_digit($account_padded, '3');
        $this->assertFalse($result);


        //82239-6
        $account = "82239-6";
        $account_padded = tools\pad_input_to_length($account, 8);
        
        $result = classes\validators\BancoDoBrasil::validate_account_digit($account_padded, '6');
        $this->assertFalse($result);
        
        $result = classes\validators\BancoDoBrasil::validate_account_digit($account_padded, '7');
        $this->assertFalse($result);
        
        $result = classes\validators\BancoDoBrasil::validate_account_digit($account_padded, '3');
        $this->assertFalse($result);
    }
}