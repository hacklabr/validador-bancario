<?php 
namespace BankValidator;

use BankValidator\classes\BankCodeMapping;
use PHPUnit\Framework\TestCase;

class BankCodeMappingTest extends TestCase {
    /**
     * @todo The tests should not be single "target"
     */
    public function test_right_bank_codes() {
        BankCodeMapping::init();
        
        // "001" => new Validators\BancoDoBrasil,
        $this->assertEquals(get_class(BankCodeMapping::get_validator('001')), 'BankValidator\classes\validators\BancoDoBrasil');

        // "237" => new Validators\Bradesco,
        $this->assertEquals(get_class(BankCodeMapping::get_validator('237')), 'BankValidator\classes\validators\Bradesco');

        // "341" => new Validators\Itau,
        $this->assertEquals(get_class(BankCodeMapping::get_validator('341')), 'BankValidator\classes\validators\Itau');
    }


    public function test_wrong_bank_codes() {
        BankCodeMapping::init();
        
        $this->expectException('BankValidator\classes\exceptions\NotRegistredBankCode');
        BankCodeMapping::get_validator('1231');
    }
}