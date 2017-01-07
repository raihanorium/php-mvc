<?php
/**
 * Created by PhpStorm.
 * User: ataul.raihan
 * Date: 1/7/2017
 * Time: 10:53 PM
 */

namespace services;

use core\ApplicationConstants;

require_once 'Database.php';
require_once 'core/ApplicationConstants.php';

class ReportingService {
    private $db;

    private function __construct() {
        $this->db = Database::Instance();
    }

    public static function Instance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new ReportingService();
        }
        return $inst;
    }

    public function todaysSalesPerService(){
        return $this->db->selectQuery(ApplicationConstants::TODAYS_SALES_PER_SERVICE_REPORT, array(), 'array');
    }
}