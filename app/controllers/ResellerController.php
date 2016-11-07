<?php
namespace app\controllers;

require_once 'app/service/ResellerService.php';
require_once 'app/model/Reseller.php';

use core\Controller;
use model\Reseller;
use services\ResellerService;

/**
 * @hasAnyRole(admin)
 */
class ResellerController extends Controller {
    private $resellerService;

    public function __construct() {
        $this->resellerService = ResellerService::Instance();
        parent::__construct();
    }

    public function index($request) {
        $request['resellers'] = $this->resellerService->getAll();
        $this->view->renderTemplate($request);
    }

    public function add() {
        $this->view->renderTemplate();
    }

    public function save($request){
        $reseller = new Reseller();
        $reseller->full_name = $request['full_name'];
        $reseller->username = $request['username'];
        $reseller->email = $request['email'];
        $reseller->password = $request['password'];
        $reseller->is_active = isset($request['is_active']);

        try {
            $result = $this->resellerService->create($reseller);
            if($result > 0){
                header("Location: ./?p=reseller");
            }
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