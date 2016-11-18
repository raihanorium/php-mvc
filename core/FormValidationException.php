<?php
/**
 * Created by PhpStorm.
 * User: ataul.raihan
 * Date: 11/16/2016
 * Time: 8:29 PM
 */

namespace core;


class FormValidationException extends \Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}