<?php
/**
 * Created by IntelliJ IDEA.
 * User: ataul.raihan
 * Date: 10/17/2016
 * Time: 3:32 PM
 */

namespace services;

require_once '../../core/SqlBatchRunner.php';

use core\SqlBatchRunner;

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "project";

    private $pdo;


    /**
     * Database constructor.
     */
    public function __construct() {
        SqlBatchRunner::run_sql_file('../../core/autopay.sql');
        $this->pdo = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->databaseName . '', $this->username, $this->password);
    }

    public function selectQuery($query, $parameters, $class) {
        $allData = array();

        try {
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($parameters);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $class);
            while ($user = $stmt->fetch()) {
                array_push($allData, $user);
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return $allData;
    }

    public function updateQuery($query, $parameters) {
        try {
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($parameters);

            # Affected Rows?
            return $stmt->rowCount();
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return -1;
    }
}