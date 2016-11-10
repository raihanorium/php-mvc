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
          `role` INT NOT NULL DEFAULT 2,
          `is_active` BOOLEAN NOT NULL DEFAULT FALSE ,
          `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
          PRIMARY KEY (`id`),
          UNIQUE `username_unique` (`username`),
          UNIQUE `email_unique` (`email`))
        ENGINE = InnoDB;
        ";
    const GET_ALL_RESELLERS = "SELECT * FROM `reseller`";
    const ADD_RESELLER = "INSERT INTO reseller(full_name, username, email, password, role, is_active)
                          VALUES (:full_name, :username, :email, :password, :role, :is_active)";
    const UPDATE_RESELLER = "UPDATE `reseller` SET `full_name`=:full_name, `password`=:password, `is_active`=:is_active WHERE `id`=:id";
    const SELECT_RESELLER_BY_USERNAME = "SELECT * FROM reseller WHERE `username`=:username";
    const SELECT_RESELLER_BY_EMAIL = "SELECT * FROM reseller WHERE `email`=:email";
    const SELECT_RESELLER_BY_ID = "SELECT * FROM reseller WHERE `id`=:id";
    const SELECT_RESELLER_BY_USERNAME_PASSWORD = "SELECT * FROM reseller WHERE `username`=:username AND `password`=:password";
    const DELETE_RESELLER = "DELETE FROM `reseller` WHERE `id`=:id";

    const CREATE_SERVICE_TABLE = "
        CREATE TABLE IF NOT EXISTS `service` (
          `id` INT NOT NULL AUTO_INCREMENT ,
          `name` VARCHAR(50) NOT NULL ,
          `description` VARCHAR(255) NULL ,
          `operator_code` VARCHAR(5) NULL ,
          `is_active` BOOLEAN NOT NULL DEFAULT TRUE ,
          PRIMARY KEY (`id`),
          UNIQUE `name_unique` (`name`))
        ENGINE = InnoDB;
        
        CREATE TABLE IF NOT EXISTS `reseller_service` (
          `reseller_id` INT NOT NULL,
          `service_id` INT NOT NULL,
          CONSTRAINT `reseller_service_composite` PRIMARY KEY (`reseller_id`, `service_id`)
        );
    ";
    const INSERT_DEFAULT_SERVICES = "
        INSERT INTO `service` (`name`, `description`, `operator_code`) VALUES ('Grameenphone', NULL, '017');
        INSERT INTO `service` (`name`, `description`, `operator_code`) VALUES ('Robi', NULL, '018');
        INSERT INTO `service` (`name`, `description`, `operator_code`) VALUES ('Banglalink', NULL, '019');
        INSERT INTO `service` (`name`, `description`, `operator_code`) VALUES ('Airtel', NULL, '016');
        INSERT INTO `service` (`name`, `description`, `operator_code`) VALUES ('Teletalk', NULL, '015');
        INSERT INTO `service` (`name`, `description`, `operator_code`) VALUES ('bKash', NULL, NULL);
        INSERT INTO `service` (`name`, `description`, `operator_code`) VALUES ('Rocket', NULL, NULL);
    ";
    const GET_ALL_SERVICES = "SELECT * FROM `service`";
    const GET_ALL_ACTIVE_SERVICES = "SELECT * FROM `service` WHERE `is_active`=1";
    const SELECT_SERVICE_BY_ID = "SELECT * FROM `service` WHERE `id`=:id";
    const ADD_RESELLER_SERVICE = "INSERT INTO `reseller_service` (`reseller_id`, `service_id`) VALUES(:reseller_id, :service_id);";
    const DELETE_RESELLER_SERVICE = "DELETE FROM `reseller_service` WHERE`reseller_id`=:reseller_id;";
    const GET_SERVICES_OF_RESELLER = "SELECT `service_id` AS `id` FROM `reseller_service` WHERE `reseller_id`=:reseller_id;";
}