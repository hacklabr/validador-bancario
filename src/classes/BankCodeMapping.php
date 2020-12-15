<?php

namespace BankValidator\classes;

use BankValidator\classes\exceptions\NotRegistredBankCode;
use BankValidator\interfaces\ValidatorI;


class BankCodeMapping {
    /**
     * Validators
     * 
     * @var ValidatorI[]
     */
    static $validators = [];

    static $validators_classes = [
        "237" => validators\Bradesco::class,
        "341" => validators\Itau::class,
        "001" => validators\BancoDoBrasil::class,
        "033" => validators\Santander::class,
    ];
    
    /**
     * Returns a validator
     * 
     * @param mixed $code Bank number
     * @return ValidatorI 
     * @throws NotRegistredBankCode 
     */
    public static function get_validator($code) {
        if (isset(self::$validators[$code])) {
            return self::$validators[$code];
        } else if(isset(self::$validators_classes[$code])) {
            self::$validators[$code] = new self::$validators_classes[$code];
            return self::$validators[$code];
        } else {
            throw new NotRegistredBankCode("code: $code");
        }
    }
}
