<?php
namespace BankValidator\classes\validators;

use BankValidator\interfaces\ValidatorI;
use BankValidator\classes\exceptions\InvalidAgencySize;
use BankValidator\classes\exceptions\InvalidAccountSize;


class Santander implements ValidatorI {
    public static function validate_agency_digit($agency, $digit) {
        // Para obter o DV da agência, multiplica-se os quatro primeiros dígitos da
        // agência pelos multiplicadores 5,4,3,2 nesta ordem. 

        $agency_size = 4;
        $agency_numbers = array_map('intval', str_split($agency));

        if(!self::pre_validate_data($agency, $agency_size)) return false;

        $result = self::calculate_sum($agency_numbers);
        $right_digit = false;

        if($result === 10) {
            $right_digit = "X";
        } else {
            if ($result === 11) {
                $right_digit = "0";
            } else {
                $right_digit = strval($result);
            }
        }

        if($right_digit === $digit) {
            return true;
        }

        // echo $right_digit;
        // echo "<br>";

        return false;
    }

    public static function validate_account_digit($agency, $digit) {
        // Para obter o DV da agência, multiplica-se os quatro primeiros dígitos da
        // agência pelos multiplicadores 5,4,3,2 nesta ordem. 

        $account_size = 8;
        $account_numbers = array_map('intval', str_split($agency));

        if(!self::pre_validate_data($agency, $account_size, "account")) return false;

        $result = self::calculate_sum($account_numbers);
        // echo $result;

        $right_digit = false;

        if($result === 10) {
            $right_digit = "X";
        } else {
            if ($result === 11) {
                $right_digit = "0";
            } else {
                $right_digit = strval($result);
            }
        }

        if($right_digit === $digit) {
            return true;
        }

        // echo $right_digit;
        // echo "<br>";

        return false;
    }

    private static function calculate_sum($itens) {
        $total_sum = 0;
        $itens_size = sizeof($itens);

        for($i = 0, $multiplier = $itens_size + 1; $i < $itens_size; $i++, $multiplier--) {
            // print_r([ $itens[$i] * $multiplier]);
            $total_sum += $itens[$i] * $multiplier;
        }

        return 11 - ($total_sum % 11);
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

}