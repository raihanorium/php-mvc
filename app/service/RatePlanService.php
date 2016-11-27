<?php
/**
 * Created by PhpStorm.
 * User: Raihan
 * Date: 11/7/2016
 * Time: 9:56 PM
 */

namespace services;

use core\ApplicationConstants;
use model\RatePlan;

require_once 'Database.php';
require_once 'core/ApplicationConstants.php';
require_once 'app/model/RatePlan.php';

final class RatePlanService {
    private $db;

    private function __construct() {
        $this->db = Database::Instance();
        $this->db->execute(ApplicationConstants::CREATE_RATE_PLAN_TABLE);
        $this->db->execute(ApplicationConstants::CREATE_RATE_PLAN_SERVICE_TABLE);
    }

    public static function Instance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new RatePlanService();
        }
        return $inst;
    }

    public function getAllPlan() {
        return $this->db->selectQuery(ApplicationConstants::GET_RATE_PLANS, array(), RatePlan::class);
    }

    public function getPlanDetails($planId) {
        return $this->db->selectQuery(ApplicationConstants::GET_RATE_PLAN_SERVICE, array(':plan_id' => $planId), 'array');
    }
}