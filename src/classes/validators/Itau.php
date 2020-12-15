<?php
namespace BankValidator\classes\validators;

use BankValidator\interfaces\ValidatorI;
use BankValidator\classes\exceptions\InvalidAgencySize;
use BankValidator\classes\exceptions\InvalidAccountSize;


class Itau extends Generic {
    const agency_size = 4;
    const account_size = 5;
    
    const valid_chars = '0123456789';

    public function use_account_digit() {
        return true;
    }

    public function use_agency_digit() {
        return false;
    }

    public function calculate_account($account) {
        return $this->calculate_sum($account);
    }

    public function calculate_agency($agency) {
        return null;
    }

    private function calculate_sum($itens) {
        if (is_string($itens)) {
            $itens = array_map('intval', str_split($itens));
        }
        $numbers = $itens;
        $sum_seq = 0;
        $sequence = 0;

        for ($i = 0; $i < sizeof($numbers); $i++) {
            $number = $numbers[$i];
            $sequence = $this->multiply_according_parity($number, $i);
            $sequence = $this->adjust_according_length($sequence);
            $sum_seq += $sequence;
        }
        
        $result = $sum_seq % 10;

        if($result === 0) {
            return "0";
        } else {
            return strval(10 - $result);
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

    public function validate_agency_digit($agency_digit) {
        return empty($agency_digit) || !isset($agency_digit);
    }

    public function account_number_is_valid($account) {
        return Generic::account_number_is_valid($account) && strlen($account) <= self::account_size;
    }

    public function account_digit_match($account, $agency, $digit) {
        $itens = array_map('intval', str_split($agency . $account));
        $right_digit = $this->calculate_account($itens);

        return $right_digit === strtoupper($digit);
    }

    private function multiply_according_parity($number, $i) {
        return $number * ($i % 2 === 0 ? 2 : 1);
    }


    private function adjust_according_length($sequence) {
        if($sequence > 9) {
            $numbers = str_split(strval($sequence));
            $sequence = 0;

            for ($i = 0; $i < sizeof($numbers); $i++) {
                $sequence += intval($numbers[$i]);
            }
        }

        return $sequence;
    }


}