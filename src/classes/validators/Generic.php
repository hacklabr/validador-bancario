<?php
namespace BankValidator\classes\validators;

use BankValidator\interfaces\ValidatorI;
use BankValidator\classes\exceptions\InvalidAgencySize;
use BankValidator\classes\exceptions\InvalidAccountSize;


class Generic implements ValidatorI {

    public function use_account_digit() {
        return true;
    }

    public function use_agency_digit() {
        return true;
    }
    
    public function agency_number_is_valid($agency) {
        return (boolean) preg_match('/^(?!0000)([0-9]{4})$/', $agency);
    }

    public function validate_agency_digit($agency_digit) {
        return (boolean) preg_match('/^[a-zA-Z0-9]{0,1}$/', $agency_digit);
    }

    public function calculate_agency($agency) {
        return null;
    }

    public function account_number_is_valid($account) {
        return (boolean) preg_match('/^[0-9]{1,12}$/', $account) && intval($account) > 0 ;
    }

    public function validate_account_digit($account_digit) {
        return (boolean) preg_match('/^[a-zA-Z0-9]{1}$/', $account_digit);
    }

    public function calculate_account($account) {
        return null;
    }

    // Itaú, Bradesco and Banco do Brasil classes will overwrite
    public function agency_digit_match($agency, $digit) {
        return true;
    }

    public function account_digit_match($account, $agency, $digit) {
        return true;
    }

}