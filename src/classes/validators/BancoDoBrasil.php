<?php
namespace BankValidator\classes\validators;

use BankValidator\classes\exceptions\InvalidAgencySize;
use BankValidator\classes\exceptions\InvalidAccountSize;


class BancoDoBrasil extends Generic {
    const agency_size = 4;
    const account_size = 8;

    public function calculate_account($account) {
        return $this->calculate_sum($account);
    }

    public function calculate_agency($agency) {
        return $this->calculate_sum($agency);
    }

    private function calculate_sum($itens) {
        $total_sum = 0;
        $itens_size = sizeof($itens);

        for($i = 0, $multiplier = $itens_size + 1; $i < $itens_size; $i++, $multiplier--) {
            // print_r([ $itens[$i] * $multiplier]);
            $total_sum += $itens[$i] * $multiplier;
        }

        $result = 11 - ($total_sum % 11);

        if($result === 10) {
            return "X";
        } else {
            if ($result === 11) {
              return "0";
            } else {
                return strval($result);
            }
        }
    }

    private function pre_validate_data($data, $expected_size, $type = "agency") {
        // Check if there arent any chars
        if(!is_numeric($data)) return false;

        $data_array = array_map('intval', str_split($data));
        
        // check if the agency has the right quantity of numbers
        if(sizeof($data_array) != $expected_size) {
            if($type === "agency") {
                throw new InvalidAgencySize("agency size: " . sizeof($data_array) . " (" . $expected_size . " expected)" );
                // trigger_error("Invalid agency size");
                return false;
            } else {
                throw new InvalidAccountSize("account size: " . sizeof($data_array) . " (" . $expected_size . " expected)" );
                // trigger_error("Invalid account size");
                return false;
            }
        }

        return true;
    }

    public function agency_number_is_valid($agency) {
        return Generic::agency_number_is_valid($agency) && strlen($agency) === self::agency_size;
    }

    public function account_number_is_valid($account) {
        return Generic::account_number_is_valid($account) && strlen($account) === self::account_size;
    }

    public function agency_digit_match($agency, $digit) {
        $itens = array_map('intval', str_split($agency));
        $right_digit = $this->calculate_agency($itens);

        return $right_digit === strtoupper($digit);
    }

    public function account_digit_match($account, $agency, $digit) {
        $itens = array_map('intval', str_split($account));
        $right_digit = $this->calculate_account($itens);

        return $right_digit === strtoupper($digit);
    }

}