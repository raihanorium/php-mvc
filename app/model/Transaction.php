<?php
/**
 * Created by PhpStorm.
 * User: ataul.raihan
 * Date: 11/14/2016
 * Time: 11:59 PM
 */

namespace model;


class Transaction {
    public $id;
    public $from;
    public $to;
    public $amount;
    public $created_at;
    public $description;
}