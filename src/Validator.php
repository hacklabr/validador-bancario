<?php 
namespace BankValidator;
use BankValidator\classes\BankCodeMapping;

class Validator{
    public static function init() {
        BankCodeMapping::init();
    }

    /**
     * validate_account
     *
     * @param [string] $bank_code
     * @param [string] $account
     * @param [string] $digit
     * @return boolean
     */
    public static function validate_account($bank_code, $account, $digit) {
        $validator = BankCodeMapping::get_validator($bank_code);
        return $validator::validate_account_digit($account, $digit);
    }

    /**
     * validate_agency
     *
     * @param [string] $bank_code
     * @param [string] $agency
     * @param [string] $digit
     * @return boolean
     */
    public static function validate_agency($bank_code, $agency, $digit) {
        $validator = BankCodeMapping::get_validator($bank_code);
        return $validator::validate_agency_digit($agency, $digit);
    }
    
    /**
     * validate_bank_account
     *
     * @param [string] $bank_code
     * @param [string] $account
     * @param [string] $account_digit
     * @param [string] $agency
     * @param [string] $agency_digit
     * @return boolean
     */
    public static function validate_bank_account($bank_code, $account, $account_digit, $agency, $agency_digit) {
        $validator = BankCodeMapping::get_validator($bank_code);
        return $validator::validate_account_digit($account, $account_digit) && $validator::validate_agency_digit($agency, $agency_digit);
    }

}