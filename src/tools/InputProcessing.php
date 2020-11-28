<?php 
namespace BankValidator\tools;

function pad_input_to_length($input, $length, $pad_string = "0", $pad_type = STR_PAD_LEFT) {
    return str_pad($input, $length, $pad_string, $pad_type);
}