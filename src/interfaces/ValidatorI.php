<?php 
namespace BankValidator\interfaces;

/**
 * Inteface used that all banks implement
 */
interface ValidatorI {
    public static function agency_number_is_valid($agency);
    public static function validate_agency_digit($agency_digit);
    public static function account_number_is_valid($account);
    public static function validate_account_digit($account_digit);

    // Itaú, Bradesco, e Banco do Brasil 
    public static function agency_digit_match($agency, $digit);
    public static function account_digit_match($account, $digit);
}