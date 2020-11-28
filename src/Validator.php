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

    /**
     * Validates if the following parameters generate a valid combination of a bank
     *
     * @param [string] $bank_code
     * @param [string] $agency
     * @param [string] $agency_digit
     * @param [string] $account
     * @param [string] $account_digit
     * @param [boolean] $pad_inputs: Make sure you know are you're doing, this param will fill the left gaps with zeors
     * @return boolean|array If the parameters are valid return true otherwise an array of erros is returned
     */
    public static function validate($bank_code, $agency, $agency_digit, $account, $account_digit, $pad_inputs = false) {
        $validator = BankCodeMapping::get_validator($bank_code);

        if($pad_inputs) {
            $agency = tools\pad_input_to_length($agency, $validator::$agency_size);
            $account = tools\pad_input_to_length($account, $validator::$account_size);
        }
        
        $errors = [];

        if(!$validator::agency_number_is_valid($agency)) {
            // echo "1";
            $errors[] = 'INVALID_AGENCY_NUMBER';
        }

        if(!$validator::validate_agency_digit($agency_digit)) {
            // echo "2";
            $errors[] = 'INVALID_AGENCY_DIGIT';
        }

        if(!$validator::account_number_is_valid($account)) {
            // echo "3";
            $errors[] = 'INVALID_ACCOUNT_NUMBER';
        }

        if(!$validator::validate_account_digit($account_digit)) {
            // echo "4";
            $errors[] = 'INVALID_ACCOUNT_DIGIT';

        }

        if($validator::agency_number_is_valid($agency) && $validator::validate_agency_digit($agency_digit)) {
            if(!$validator::agency_digit_match($agency, $agency_digit)) {
                // echo "5";
                $errors[] = 'AGENCY_DIGIT_DONT_MATCH';
            }
        }

        if($validator::account_number_is_valid($account) && $validator::validate_account_digit($account_digit)) {
            if(!$validator::account_digit_match($account, $agency, $account_digit)) {
                // echo "6";
                $errors[] = 'ACCOUNT_DIGIT_DONT_MATCH';
            }
        }

        if(sizeof($errors)) {
            return $errors;
        }

        return true;

        //var_dump($validator::account_digit_match($agency, "6"));
    }

    

}