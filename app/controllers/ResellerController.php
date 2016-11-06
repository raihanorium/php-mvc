<?php
namespace app\controllers;

use core\Controller;

/**
 * @hasAnyRole(admin)
 */
class ResellerController extends Controller {
    public function index($request) {
        $resellers = array(
            array('id' => 1, 'full_name' => 'Mr Reseller 1', 'username' => 'reseller1', 'email' => 'reseller1@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 2, 'full_name' => 'Mr Reseller 2', 'username' => 'reseller2', 'email' => 'reseller2@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 3, 'full_name' => 'Mr Reseller 3', 'username' => 'reseller3', 'email' => 'reseller3@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 4, 'full_name' => 'Mr Reseller 4', 'username' => 'reseller4', 'email' => 'reseller4@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 5, 'full_name' => 'Mr Reseller 5', 'username' => 'reseller5', 'email' => 'reseller5@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 6, 'full_name' => 'Mr Reseller 6', 'username' => 'reseller6', 'email' => 'reseller6@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 7, 'full_name' => 'Mr Reseller 7', 'username' => 'reseller7', 'email' => 'reseller7@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 8, 'full_name' => 'Mr Reseller 8', 'username' => 'reseller8', 'email' => 'reseller8@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 9, 'full_name' => 'Mr Reseller 9', 'username' => 'reseller9', 'email' => 'reseller9@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06'),
            array('id' => 10, 'full_name' => 'Mr Reseller 10', 'username' => 'reseller10', 'email' => 'reseller10@email.com', 'password' => 'password', 'is_active' => true, 'created_at' => '2016-11-06')
        );
        $this->view->renderTemplate($resellers);
    }
}