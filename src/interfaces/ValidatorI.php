<?php 
namespace BankValidator\interfaces;

/**
 * Inteface used that all banks implement
 */
interface ValidatorI {
<<<<<<< Updated upstream
=======
    public function use_agency_digit();
    public function use_account_digit();

>>>>>>> Stashed changes
    public function agency_number_is_valid($agency);
    public function validate_agency_digit($agency_digit);
    public function calculate_agency($agency);

    public function account_number_is_valid($account);
    public function validate_account_digit($account_digit);
    public function calculate_account($account);

    // Itaú, Bradesco, e Banco do Brasil 
    public function agency_digit_match($agency, $digit);
    public function account_digit_match($account, $agency, $digit);
}