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
                "001" => new Validators\BancoDoBrasil,
                "237" => new Validators\Bradesco,
                "341" => new Validators\Itau,
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
