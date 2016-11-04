<?php
/**
 * Created by PhpStorm.
 * User: Raihan
 * Date: 11/4/2016
 * Time: 11:52 AM
 */

namespace core;


class UserNotLoggedInException extends \Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}