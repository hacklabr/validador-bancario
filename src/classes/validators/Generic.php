<?php
namespace BankValidator\classes\validators;

use BankValidator\interfaces\ValidatorI;
use BankValidator\classes\exceptions\InvalidAgencySize;
use BankValidator\classes\exceptions\InvalidAccountSize;


class Generic implements ValidatorI {
    private static function calculate_sum($itens) {
        $total_sum = 0;
        $itens_size = sizeof($itens);

        for($i = 0, $multiplier = $itens_size + 1; $i < $itens_size; $i++, $multiplier--) {
            // print_r([ $itens[$i] * $multiplier]);
            $total_sum += $itens[$i] * $multiplier;
        }

        return 11 - ($total_sum % 11);
    }

    public static function agency_number_is_valid($agency) {
        return (boolean) preg_match('/^(?!0000)([0-9]{4})$/', $agency);
    }

    public static function validate_agency_digit($agency_digit) {
        return (boolean) preg_match('/^[a-zA-Z0-9]{0,1}$/', $agency_digit);
    }

    public static function account_number_is_valid($account) {
        return (boolean) preg_match('/^[0-9]{1,12}$/', $account) && intval($account) > 0 ;
    }

    public static function validate_account_digit($account_digit) {
        return (boolean) preg_match('/^[a-zA-Z0-9]{1}$/', $account_digit);
    }

    // Itaú, Bradesco, and Banco do Brasil  classes will overwrite
    public static function agency_digit_match($agency, $digit) {
        return true;
    }

    public static function account_digit_match($account, $digit) {
        return true;
    }

}