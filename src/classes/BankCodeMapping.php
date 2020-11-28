<?php
namespace BankValidator\classes;

use BankValidator\classes\exceptions\NotRegistredBankCode;
use BankValidator\classes\validators\BancoDoBrasil;

class BankCodeMapping {
    static $validators = [];

    static public function init($validators = null) {
        if($validators) {
            self::$validators = $validators;    
        } else {
            self::$validators = [
                "001" => new BancoDoBrasil,
                // "237" => BradescoValidator,
                // "341" => ItauValidator,
                // "033" => SantanderValidator,
                // "745" => CitibankValidator,
                // "399" => HSBCValidator,
                // "041" => BanrisulValidator
            ];
        }
    }
    
    public static function get_validator($code) {
        if(isset(self::$validators[$code])) {
            return self::$validators[$code];
        } else {
            throw new NotRegistredBankCode("code: $code");
        }
    }
}
