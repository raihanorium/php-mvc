<?php
namespace app\controllers;

require_once 'app/service/RatePlanService.php';

use core\Controller;
use services\RatePlanService;

/**
 * @hasAnyRole(admin)
 */
class RatePlanController extends Controller {
    private $ratePlanService;

    public function __construct() {
        $this->ratePlanService = RatePlanService::Instance();
        parent::__construct();
    }

    public function index($request){
        $request['plan'] = $this->ratePlanService->getPlanDetails(1);
        $request['rate_plans'] = $this->ratePlanService->getAllPlan();
        $this->view->renderTemplate($request);
    }

    public function show($request){
        $plan_id = $request['id'];
        $request['plan'] = $this->ratePlanService->getPlanDetails($plan_id);
        $request['rate_plans'] = $this->ratePlanService->getAllPlan();
        $this->view->renderView('rateplan/index', $request);
    }
}