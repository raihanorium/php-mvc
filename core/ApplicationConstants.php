<?php
/**
 * Created by PhpStorm.
 * User: Raihan
 * Date: 11/7/2016
 * Time: 10:43 PM
 */

namespace core;


interface ApplicationConstants {
    const CREATE_RESELLER_TABLE = "
        CREATE TABLE IF NOT EXISTS `reseller` (
          `id` INT NOT NULL AUTO_INCREMENT ,
          `full_name` VARCHAR(255) NOT NULL ,
          `username` VARCHAR(255) NOT NULL ,
          `email` VARCHAR(255) NOT NULL ,
          `password` VARCHAR(64) NOT NULL ,
          `is_active` BOOLEAN NOT NULL DEFAULT FALSE ,
          `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
          PRIMARY KEY (`id`),
          UNIQUE `username_unique` (`username`),
          UNIQUE `email_unique` (`email`)) ENGINE = InnoDB;
        ";
    const GET_ALL_RESELLERS = "SELECT * FROM `reseller`";
    const ADD_RESELLER = "INSERT INTO reseller(full_name, username, email, password, is_active) VALUES (:full_name, :username, :email, :password, :is_active)";
    const SELECT_RESELLER_BY_USERNAME = "SELECT * FROM reseller WHERE `username`=:username";
    const SELECT_RESELLER_BY_EMAIL = "SELECT * FROM reseller WHERE `email`=:email";
}