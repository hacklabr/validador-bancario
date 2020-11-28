<?php 
namespace BankValidator;
use BankValidator\classes\BankCodeMapping;

class Validator{
    public static function init() {
        BankCodeMapping::init();
    }

    public static function validate_account($bank_code, $account, $digit) {
        $validator = BankCodeMapping::get_validator($bank_code);
        return $validator::validate_account_digit($account, $digit);
    }

    public static function validate_agency($bank_code, $agency, $digit) {
        $validator = BankCodeMapping::get_validator($bank_code);
        return $validator::validate_agency_digit($agency, $digit);
    }

}