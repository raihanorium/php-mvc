<?php
namespace app\controllers;

require_once 'app/service/ResellerService.php';
require_once 'app/service/ServiceService.php';
require_once 'app/model/Reseller.php';
require_once 'app/service/RatePlanService.php';

use core\Controller;
use core\GlobalException;
use model\Reseller;
use services\RatePlanService;
use services\ResellerService;
use services\ServiceService;

/**
 * @hasAnyRole(admin)
 */
class ResellerController extends Controller {
    private $resellerService;
    private $serviceService;
    private $ratePlanService;

    public function __construct() {
        $this->resellerService = ResellerService::Instance();
        $this->serviceService = ServiceService::Instance();
        $this->ratePlanService = RatePlanService::Instance();
        parent::__construct();
    }

    public function index($request) {
        $request['resellers'] = $this->resellerService->getAll();
        $this->view->renderTemplate($request);
    }

    public function add($request) {
        $request['services'] = $this->serviceService->getAllActive();
        $request['rate_plans'] = $this->ratePlanService->getAllPlan();
        $this->view->renderTemplate($request);
    }

    public function edit($request) {
        $request['services'] = $this->serviceService->getAllActive();
        $request['rate_plans'] = $this->ratePlanService->getAllPlan();
        try {
            $result = $this->resellerService->get($request['id']);
            if($result){
                $request['reseller'] = (array)$result;
                $this->view->renderTemplate($request);
            } else {
                throw new GlobalException('Reseller not found');
            }
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $this->index($request);
        }
    }

    public function save($request){
        $reseller = new Reseller();
        $reseller->full_name = $request['full_name'];
        $reseller->username = $request['username'];
        $reseller->email = $request['email'];
        $reseller->password = $request['password'];
        $reseller->role = $request['role'];
        $reseller->rate_plan_id = $request['rate_plan_id'];
        $reseller->services = isset($request['services'])? $request['services'] : array();
        $reseller->is_active = isset($request['is_active']);

        try {
            $result = $this->resellerService->create($reseller);
            if($result > 0){
                header("Location: ./?p=reseller");
            }
        } catch (\Exception $ex){
            $request['services'] = $this->serviceService->getAllActive();
            $request['rate_plans'] = $this->ratePlanService->getAllPlan();
            $request['error'] = $ex->getMessage();
            $this->view->renderView('reseller/add', $request);
        }
    }

    public function update($request){
        $reseller = $this->resellerService->get($request['id']);
        $reseller->full_name = $request['full_name'];
        $reseller->services = $request['services'];
        $reseller->rate_plan_id = $request['rate_plan_id'];
        $reseller->is_active = isset($request['is_active']);
        if(strlen($request['password']) > 0){
            $reseller->password = $request['password'];
        }

        try {
            $result = $this->resellerService->update($reseller);
            header("Location: ./?p=reseller");
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $this->view->renderView('reseller/add', $request);
        }
    }

    public function delete($request){
        try {
            $result = $this->resellerService->delete($request['id']);
            if($result > 0){
                header("Location: ./?p=reseller");
            }
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $this->index($request);
        }
    }
}