<?php
namespace app\controllers;

require_once 'app/service/RatePlanService.php';
require_once 'core/FormValidator.php';

use core\Controller;
use core\FormValidator;
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
        $request['plan_name'] = $request['plan'][0]['plan_name'];
        $request['rate_plans'] = $this->ratePlanService->getAllPlan();
        $this->view->renderView('rateplan/index', $request);
    }

    public function submit($request){
        if(!isset($request['submit'])){
            header('Location: .?p=rateplan');
        }

        switch ($request['submit']){
            case 'Save':
                $this->save($request);
                break;
            case 'Save As':
                $this->saveAs($request);
                break;
        }
    }

    private function save($request){
        try {
            $planId = FormValidator::validate(array('Plan' => $request['selected_plan_id']), array(FormValidator::$REQUIRED => true));
            if($planId == 1){
                throw new \Exception('Default plan cannot be saved. Use Save As instead.');
            }

            $this->ratePlanService->updatePlan($planId, $request['plan_name']);
            foreach ($request['service'] as $service_id => $rate){
                $this->ratePlanService->updateRatePlanService($planId, $service_id, $rate);
            }

            header('Location: .?p=rateplan');
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $this->index($request);
        }
    }

    private function saveAs($request){
        $plan_id = $this->ratePlanService->createPlan($request['plan_name']);
        foreach ($request['service'] as $service_id => $rate){
            $this->ratePlanService->addRatePlanService($plan_id, $service_id, $rate);
        }

        header('Location: .?p=rateplan');
    }
}