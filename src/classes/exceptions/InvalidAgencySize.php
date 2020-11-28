<?php

namespace BankValidator\classes\exceptions;

class InvalidAgencySize extends \Exception {
    public function errorMessage() {
      $error_msg = 'Error on line '.$this->getLine().' in '.$this->getFile()
      .': <b>'.$this->getMessage().'</b>: Invalid agency size.';

      return $error_msg;
    }
}