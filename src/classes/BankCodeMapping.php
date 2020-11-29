<?php

namespace BankValidator\classes;

use BankValidator\classes\exceptions\NotRegistredBankCode;


class BankCodeMapping {
    static $validators = [];

    static public function init($validators = null) {
        if ($validators) {
            self::$validators = $validators;
        } else {
            self::$validators = [
                "237" => new validators\Bradesco,
                "341" => new validators\Itau,
                "001" => new validators\BancoDoBrasil,
                // "033" => SantanderValidator,
                // "745" => CitibankValidator,
                // "399" => HSBCValidator,
                // "041" => BanrisulValidator
            ];
        }
    }

    public static function get_validator($code) {
        if (isset(self::$validators[$code])) {
            return self::$validators[$code];
        } else {
            throw new NotRegistredBankCode("code: $code");
        }
    }
}
