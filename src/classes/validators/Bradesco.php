<?php
namespace BankValidator\classes\validators;

use BankValidator\classes\exceptions\InvalidAccountSize;


class Bradesco extends Generic {
    const agency_size = 4;
    const account_size = 7;

    const valid_chars = '0123456789P';

    public function use_account_digit() {
        return true;
    }

    public function use_agency_digit() {
        return true;
    }

    public function calculate_agency($itens) {
        if (is_string($itens)) {
            $itens = array_map('intval', str_split($itens));
        }
        $total_sum = 0;
        $itens_size = sizeof($itens);
        
        if ($itens_size> self::agency_size) {
            return false;
        }
        
        for($i = 0, $multiplier = $itens_size + 1; $i < $itens_size; $i++, $multiplier--) {
            // print_r([ $itens[$i] * $multiplier]);
            $total_sum += $itens[$i] * $multiplier;
        }

        $result = 11 - ($total_sum % 11);

        if($result === 10) {
            return "P";
        } else {
            if ($result === 11) {
              return "0";
            } else {
                return strval($result);
            }
        }
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
            // print_r([ $itens[$i] * $multiplier]);
            $total_sum += $this->multiply_according_to_weights($itens[$i], $i) ;
        }

        $module = ($total_sum % 11);

        if($module === 0) {
            return "0";
        } else {
            if ($module === 1) {
              return "P";
            } else {
                return strval(11 - $module);
            }
        }
    }

    private function multiply_according_to_weights($number, $i) {
        $weights = [2, 7, 6, 5, 4, 3, 2 ];
        return $number * $weights[$i];
    }

    public function agency_number_is_valid($agency) {
        return Generic::agency_number_is_valid($agency) && strlen($agency) <= self::agency_size;
    }

    public function account_number_is_valid($account) {
        return Generic::account_number_is_valid($account) && strlen($account) <= self::account_size;
    }

    public function agency_digit_match($agency, $digit) {
        $itens = array_map('intval', str_split($agency));
        $right_digit = $this->calculate_agency($itens);
        $informed_digit = strtoupper($digit);

        if ($informed_digit === "0") {
            return $right_digit === $informed_digit || $right_digit === "P";
        }

        return $right_digit === $informed_digit;
    }

    public function account_digit_match($account, $agency, $digit) {
        $itens = array_map('intval', str_split($account));
        $right_digit = $this->calculate_account($itens);
        $informed_digit = strtoupper($digit);


        //var_dump($right_digit);
        if ($informed_digit === "0") {
            return $right_digit === $informed_digit || $right_digit === "P";
          }
        return $right_digit === $informed_digit;
    }

}