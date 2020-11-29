<?php
namespace BankValidator\classes\validators;

use BankValidator\classes\exceptions\InvalidAgencySize;
use BankValidator\classes\exceptions\InvalidAccountSize;


class Santander extends Generic {
    static $agency_size = 4;
    static $account_size = 8;

    public static function validate_agency_digit($agency_digit) {
        return empty($agency_digit) || !isset($agency_digit);
    }

    public static function account_number_is_valid($account) {
        $valid = strlen($account) === self::$account_size;

        // Check account type
        $valid_account_types = ['01', '02', '03', '05', '07', '09', '13', '27', '35', '37', '43', '45', '46', '48', '50', '53', '60', '92'];
        $given_type = substr($account, 0, 2);

        $valid = $valid && in_array($given_type, $valid_account_types);
        return Generic::account_number_is_valid($account) && $valid;
    }
}