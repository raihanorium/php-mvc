<?php
/**
 * Created by PhpStorm.
 * User: ataul.raihan
 * Date: 11/16/2016
 * Time: 8:27 PM
 */

namespace core;

require_once 'FormValidationException.php';

class FormValidator {
    public static $REQUIRED = "required";
    private static $REQUIRED_MESSAGE = "is required.";

    public static $NUMERIC = "numeric";
    private static $NUMERIC_MESSAGE = "must be a number.";

    public static $MINVALUE = "minvalue";
    private static $MINVALUE_MESSAGE = "must be at least";

    public static $MOBILE_NUMBER = "mobilenumber";
    private static $MOBILE_NUMBER_MESSAGE = "is not a valid mobile number.";

    public static function validate($field = array(), $rules = array()) {
        foreach ($rules as $ruleName => $ruleValue) {
            self::validateByRuleNameAndValue($field, $ruleName, $ruleValue);
        }
        return array_shift($field);
    }

    private static function requiredValidator($field = array()) {
        foreach ($field as $fieldName => $value) {
            if (strlen($value) < 1) {
                throw new FormValidationException($fieldName . ' ' . self::$REQUIRED_MESSAGE);
            }
        }
    }

    private static function numericValidator($field = array()) {
        foreach ($field as $fieldName => $value) {
            if (!is_numeric($value)) {
                throw new FormValidationException($fieldName . ' ' . self::$NUMERIC_MESSAGE);
            }
        }
    }

    private static function minvalueValidator($field = array(), $ruleValue = 0) {
        foreach ($field as $fieldName => $value) {
            if (!is_numeric($value)) {
                throw new FormValidationException($fieldName . ' ' . self::$NUMERIC_MESSAGE);
            }

            if ($value < $ruleValue) {
                throw new FormValidationException($fieldName . ' ' . self::$MINVALUE_MESSAGE . ' ' . $ruleValue);
            }
        }
    }

    private static function mobileNumberValidator($field = array()) {
        foreach ($field as $fieldName => $value) {
            if (!preg_match("/^(?:\+?88)?01[15-9]\d{8}$/m", $value)) {
                throw new FormValidationException($value . ' ' . self::$MOBILE_NUMBER_MESSAGE);
            }
        }
    }

    private static function validateByRuleNameAndValue($field, $ruleName, $ruleValue) {
        switch ($ruleName) {
            case self::$REQUIRED:
                if ($ruleValue) {
                    self::requiredValidator($field);
                }
                break;
            case self::$NUMERIC:
                if ($ruleValue) {
                    self::numericValidator($field);
                }
                break;
            case self::$MINVALUE:
                self::minvalueValidator($field, $ruleValue);
                break;
            case self::$MOBILE_NUMBER:
                self::mobileNumberValidator($field);
                break;
            default:
                throw new GlobalException('Cannot validate field ' . key($field));
                break;
        }
    }
}