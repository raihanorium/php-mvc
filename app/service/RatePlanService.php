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

    public function createPlan($planName){
        return $this->db->insertQuery(ApplicationConstants::CREATE_RATE_PLAN, array(':plan_name' => $planName));
    }

    public function updatePlan($planId, $planName){
        return $this->db->insertQuery(ApplicationConstants::UPDATE_RATE_PLAN, array(':plan_id' => $planId,':plan_name' => $planName));
    }

    public function addRatePlanService($planId, $serviceId, $rate){
        return $this->db->updateQuery(ApplicationConstants::CREATE_RATE_PLAN_SERVICE, array(
            ':rate_plan_id' => $planId,
            ':service_id' => $serviceId,
            ':rate' => $rate
        ));
    }

    public function updateRatePlanService($planId, $serviceId, $rate){
        return $this->db->updateQuery(ApplicationConstants::UPDATE_RATE_PLAN_SERVICE, array(
            ':rate_plan_id' => $planId,
            ':service_id' => $serviceId,
            ':rate' => $rate
        ));
    }
}