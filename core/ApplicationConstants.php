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
          `rate_plan_id` INT NOT NULL DEFAULT 1,
          `is_active` BOOLEAN NOT NULL DEFAULT FALSE ,
          `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
          PRIMARY KEY (`id`),
          UNIQUE `username_unique` (`username`),
          UNIQUE `email_unique` (`email`))
        ENGINE = InnoDB;
        ";
    const GET_ALL_RESELLERS = "SELECT * FROM `reseller` WHERE `role`=2";
    const GET_ALL_ACTIVE_RESELLERS = "SELECT * FROM `reseller` WHERE `role`=2 AND `is_active`=1";
    const ADD_RESELLER = "INSERT INTO reseller(full_name, username, email, password, role, rate_plan_id, is_active)
                          VALUES (:full_name, :username, :email, :password, :role, :rate_plan_id, :is_active)";
    const UPDATE_RESELLER = "UPDATE `reseller` SET `full_name`=:full_name, `password`=:password, `rate_plan_id`=:rate_plan_id, `is_active`=:is_active WHERE `id`=:id";
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

    const CREATE_ADMIN_RESELLER_TRANSACTION_TABLE = "
        CREATE TABLE IF NOT EXISTS `admin_reseller_transaction` ( 
          `id` BIGINT NOT NULL AUTO_INCREMENT , 
          `from` INT NOT NULL , 
          `to` INT NOT NULL , 
          `amount` DOUBLE NOT NULL , 
          `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
          `description` VARCHAR(255) NULL , 
          PRIMARY KEY (`id`), 
          INDEX `from_index` (`from`), 
          INDEX `to_index` (`to`)
        ) ENGINE = InnoDB;";
    const GET_ALL_TRANSACTIONS_ADMIN = "
        SELECT
            art.id,
            art.from,
            rf.full_name AS `from_name`,
            art.to,
            rt.full_name AS `to_name`,
            art.amount,
            art.created_at,
            art.description
        FROM `admin_reseller_transaction` art
        INNER JOIN `reseller` rf ON(art.from=rf.id)
        INNER JOIN `reseller` rt ON(art.to=rt.id)
        ORDER BY art.created_at DESC LIMIT 20
      ";
    const GET_ALL_TRANSACTIONS_RESELLER = "
        SELECT
            art.id,
            art.from,
            rf.full_name AS `from_name`,
            art.to,
            rt.full_name AS `to_name`,
            art.amount,
            art.created_at,
            art.description
        FROM `admin_reseller_transaction` art
        INNER JOIN `reseller` rf ON(art.from=rf.id)
        INNER JOIN `reseller` rt ON(art.to=rt.id)
        WHERE art.`to`=:to
        ORDER BY art.created_at DESC LIMIT 20
      ";
    const GET_TRANSACTION = "
        SELECT
            *
        FROM `reseller_transaction` rt
        WHERE rt.`id`=:id
      ";
    const CANCEL_TRANSACTION = "
        UPDATE `reseller_transaction` rt SET rt.`status`='aborted'
        WHERE rt.`id`=:id
      ";
    const TRANSACTION_MARK_AS_SENT = "
        UPDATE `reseller_transaction` rt SET
          rt.`status`='sent',
          rt.`sms_txn_id`=:txnId
        WHERE rt.`id`=:id
      ";
    const INSERT_ADMIN_RESELLER_TRANSACTION = "INSERT INTO `admin_reseller_transaction`(`from`, `to`, `amount`, `description`)
      VALUES (:from, :to, :amount, :description);";

    const CREATE_RESELLER_TRANSACTION_TABLE = "
        CREATE TABLE IF NOT EXISTS `reseller_transaction` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `service_id` INT NOT NULL , 
            `from` INT NOT NULL , 
            `to` VARCHAR(20) NOT NULL , 
            `amount` DOUBLE NOT NULL , 
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
            `status` ENUM('pending','sent','error','aborted') NOT NULL DEFAULT 'pending' , 
            `sms_txn_id` VARCHAR(50) NULL , 
            `description` VARCHAR(255) NULL , 
            PRIMARY KEY (`id`), 
            INDEX `idx_from` (`from`), 
            INDEX `idx_to` (`to`)
        ) ENGINE = InnoDB;
    ";
    const INSERT_RESELLER_TRANSACTION = "
        INSERT INTO `reseller_transaction` (`service_id`, `from`, `to`, `amount`, `description`) VALUES(:service_id, :from, :to, :amount, :description);
    ";

    const GET_ALL_RESELLER_CUSTOMER_TRANSACTIONS = "
        SELECT
            rt.id,
            rt.to,
            s.name AS `service`,
            rt.amount,
            rt.created_at,
            rt.status
        FROM `reseller_transaction` rt
        INNER JOIN `service` s ON(s.id = rt.service_id)
        WHERE rt.from=:from
        ORDER BY rt.created_at DESC LIMIT 20;
    ";

    const GET_ALL_TRANSACTIONS_TO_PROCESS = "
        SELECT
            rt.id,
            rt.to,
            s.name AS `service`,
            rt.amount,
            r.full_name AS `reseller`,
            rt.created_at,
            rt.status
        FROM `reseller_transaction` rt
        INNER JOIN `service` s ON(s.id = rt.service_id)
        INNER JOIN `reseller` r ON(r.id = rt.from)
        WHERE rt.`status`='pending'
        ORDER BY rt.created_at DESC LIMIT 20
    ";

    const GET_RESELLER_BALANCE = "
        SELECT (a.total - r.total) `balance` FROM(
        (SELECT IFNULL(SUM(`amount`), 0) `total` FROM `admin_reseller_transaction` WHERE `to`=:reseller_id) a,
        (SELECT IFNULL(SUM(`amount`), 0) `total` FROM `reseller_transaction` WHERE `from`=:reseller_id AND `status`<>'aborted') r
        )
    ";

    const CREATE_RATE_PLAN_TABLE = "
        CREATE TABLE IF NOT EXISTS `rate_plan` ( 
          `id` INT NOT NULL AUTO_INCREMENT ,
          `name` VARCHAR(50) NOT NULL ,
          `description` VARCHAR(255) NULL ,
          PRIMARY KEY (`id`)
        ) ENGINE = InnoDB;
        
        INSERT INTO `rate_plan`(`id`, `name`, `description`)
        	SELECT 1, 'Default', 'Default system rate plan' FROM DUAL
        WHERE NOT EXISTS
        	(SELECT * FROM `rate_plan` WHERE `id`=1);
    ";

    const CREATE_RATE_PLAN_SERVICE_TABLE = "
        CREATE TABLE IF NOT EXISTS `rate_plan_service` (
          `rate_plan_id` INT(11) NOT NULL,
          `service_id` INT(11) NOT NULL,
          `rate` FLOAT NOT NULL,
          PRIMARY KEY (`rate_plan_id`,`service_id`)
        ) ENGINE=InnoDB;
        
        INSERT INTO `rate_plan_service`(`rate_plan_id`, `service_id`, `rate`)
          SELECT 1,`id`, 0.0 FROM `service` WHERE `is_active`=1
          AND NOT EXISTS(SELECT * FROM `rate_plan_service` WHERE `rate_plan_id`=1)
          ORDER BY `id`;
    ";

    const GET_RATE_PLANS = "
        SELECT * FROM `rate_plan`;
    ";

    const CREATE_RATE_PLAN = "
        INSERT INTO `rate_plan`(`name`, `description`)
        	VALUES(:plan_name, 'User created rate plan');
    ";

    const UPDATE_RATE_PLAN = "
        UPDATE `rate_plan` SET `name`=:plan_name WHERE `id`=:plan_id;
    ";

    const GET_RATE_PLAN_SERVICE = "
        SELECT
            rp.`name` AS `plan_name`,
            rps.`service_id`,
            s.`name` AS `service_name`,
            rps.rate
        FROM `rate_plan_service` rps
        INNER JOIN `rate_plan` rp ON(rp.`id` = rps.`rate_plan_id`)
        INNER JOIN `service` s ON(s.`id` = rps.`service_id`)
        WHERE rps.`rate_plan_id`=:plan_id
        ORDER BY s.`id`;
    ";

    const CREATE_RATE_PLAN_SERVICE = "
        INSERT INTO `rate_plan_service`(`rate_plan_id`, `service_id`, `rate`)
        VALUES(:rate_plan_id, :service_id, :rate);
    ";

    const UPDATE_RATE_PLAN_SERVICE = "
        UPDATE `rate_plan_service` SET `rate`=:rate
        WHERE `rate_plan_id`=:rate_plan_id AND `service_id`=:service_id;
    ";
}