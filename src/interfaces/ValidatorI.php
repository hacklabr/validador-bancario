<?php 
namespace BankValidator\interfaces;

interface ValidatorI {
    public static function validate_agency_digit($agency, $digit);
    public static function validate_account_digit($account, $digit);
}