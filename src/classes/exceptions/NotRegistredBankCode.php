<?php

namespace BankValidator\classes\exceptions;

class NotRegistredBankCode extends \Exception {
    public function errorMessage() {
      $error_msg = 'Error on line '.$this->getLine().' in '.$this->getFile()
      .': <b>'.$this->getMessage().'</b>: The bank code is not registred.';

      return $error_msg;
    }
}