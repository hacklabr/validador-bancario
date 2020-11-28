<?php
namespace BankValidator\classes\validators;

use BankValidator\interfaces\ValidatorI;
use BankValidator\classes\exceptions\InvalidAgencySize;
use BankValidator\classes\exceptions\InvalidAccountSize;


class Itau extends Generic {
    static $agency_size = 4;
    static $account_size = 5;

    private static function calculate_sum($itens) {
        $numbers = $itens;
        $sum_seq = 0;
        $sequence = 0;

        for ($i = 0; $i < sizeof($numbers); $i++) {
            $number = $numbers[$i];
            $sequence = self::multiply_according_parity($number, $i);
            $sequence = self::adjust_according_length($sequence);
            $sum_seq += $sequence;
        }
        
        $result = $sum_seq % 10;

        if($result === 0) {
            return "0";
        } else {
            return strval(10 - $result);
        }
    }

    private static function pre_validate_data($data, $expected_size, $type = "agency") {
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

    public static function validate_agency_digit($agency_digit) {
        return empty($agency_digit) || !isset($agency_digit);
    }

    public static function account_number_is_valid($account) {
        return Generic::account_number_is_valid($account) && strlen($account) === self::$account_size;
    }

    public static function account_digit_match($account, $agency, $digit) {
        $itens = array_map('intval', str_split($agency . $account));
        $right_digit = self::calculate_sum($itens);

        return $right_digit === strtoupper($digit);
    }

    private static function multiply_according_parity($number, $i) {
        return $number * ($i % 2 === 0 ? 2 : 1);
    }


    private static function adjust_according_length($sequence) {
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