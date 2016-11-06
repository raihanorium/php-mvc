<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raihan
 * Date: 10/18/2016
 * Time: 12:33 AM
 */

namespace services;


class ErrorService {
    private $errors = array();

    public function setError($error) {
        array_push($this->errors, $error);
    }

    public function getErrors() {
        $err = $this->errors;
        $this->errors = array();
        return $err;
    }
}