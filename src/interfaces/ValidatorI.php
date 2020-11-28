<?php 
namespace BankValidator\interfaces;

/**
 * Inteface used that all banks implement
 */
interface ValidatorI {
    public static function validate_agency_digit($agency, $digit);
    public static function validate_account_digit($account, $digit);
}