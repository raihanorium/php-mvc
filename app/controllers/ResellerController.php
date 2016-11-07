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
        $resellers = $this->resellerService->getAll();
        $this->view->renderTemplate($resellers);
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

        if($this->resellerService->create($reseller) > 0){
            header("Location: ./?p=reseller");
        }
    }
}