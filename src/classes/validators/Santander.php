<?php
namespace BankValidator\classes\validators;

use BankValidator\classes\exceptions\InvalidAgencySize;
use BankValidator\classes\exceptions\InvalidAccountSize;


class Santander extends Generic {
    const agency_size = 4;
    const account_size = 8;
    
    const valid_chars = '0123456789';

    public function use_account_digit() {
        return true;
    }

    public function use_agency_digit() {
        return false;
    }

    public function calculate_agency($agency) {
        return null;
    }

    public function validate_agency_digit($agency_digit) {
        return empty($agency_digit) || !isset($agency_digit);
    }

    public function agency_number_is_valid($agency) {
        return self::agency_size === strlen($agency);
    }

    public function account_number_is_valid($account) {
        $valid = strlen($account) === self::account_size;

        // Check account type
        $valid_account_types = ['01', '02', '03', '05', '07', '09', '13', '27', '35', '37', '43', '45', '46', '48', '50', '53', '60', '92'];
        $given_type = substr($account, 0, 2);

        $valid = $valid && in_array($given_type, $valid_account_types);
        return Generic::account_number_is_valid($account) && $valid;
    }

    public function account_digit_match($account, $agency, $digit) {
        if(!$this->agency_number_is_valid($agency)) return false;

        $itens = array_map('intval', str_split($agency . '00' . $account));
        $expected_digit = $this->calculate_account($itens);
        // echo "<br>";
        // echo $expected_digit;
        // echo "<br>";

        return $expected_digit == $digit;
    }

    public function calculate_account($itens) {
        if (is_string($itens)) {
            $itens = array_map('intval', str_split($itens));
        }
        $total_sum = 0;
        $itens_size = sizeof($itens);

        if ($itens_size> self::account_size) {
            return false;
        }

        for($i = 0; $i < $itens_size; $i++) {
            //print_r([$this->multiply_according_to_weights($itens[$i], $i)]);
            $total_sum += $this->multiply_according_to_weights($itens[$i], $i) ;
        }

        $total_sum = ($total_sum % 10);
        return 10 - $total_sum;
    }

    private function multiply_according_to_weights($number, $i) {
        $weights = [9, 7, 3, 1, 0, 0, 9, 7, 1, 3, 1, 9, 7, 3 ];
        return ($number * $weights[$i]) % 10;
    }


}