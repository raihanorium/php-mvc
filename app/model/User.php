<?php

namespace model;

class User {
    public $id;
    public $full_name;
    public $username;
    public $email;
    public $password;
    public $roles = array('user');
}