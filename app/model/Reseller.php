<?php
/**
 * Created by PhpStorm.
 * User: ataul.raihan
 * Date: 11/6/2016
 * Time: 2:34 PM
 */

namespace model;


class Reseller {
    public $id;
    public $full_name;
    public $username;
    public $email;
    public $password;
    public $role; // 1=Admin, 2=Reseller
    public $rate_plan_id;
    public $services = array();
    public $is_active;
    public $created_at;
}