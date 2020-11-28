<?php

namespace BankValidator\classes\exceptions;

class InvalidAccountSize extends \Exception {
    public function errorMessage() {
      $error_msg = 'Error on line '.$this->getLine().' in '.$this->getFile()
      .': <b>'.$this->getMessage().'</b>: Invalid account size.';

      return $error_msg;
    }
}