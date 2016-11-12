<?php
namespace app\controllers;

require_once 'app/service/ResellerService.php';

use core\Controller;
use core\Security;
use services\ResellerService;

/**
 * @hasAnyRole(reseller, admin)
 */
class HomeController extends Controller {
    private $resellerService;

    public function __construct() {
        $this->resellerService = ResellerService::Instance();
        parent::__construct();
    }

    public function index($request) {
        $user = Security::getLoggedInUser();
        switch ($user['role']){
            case 1:
                $this->view->renderView('home/home_admin', $request);
                break;
            case 2:
                $request['services'] = $this->resellerService->getAllServices($user['id']);
                $this->view->renderView('home/home_reseller', $request);
                break;
            default:
                $this->view->renderTemplate(array('hello' => 'This message is comming from index function of HomeController'));
                break;
        }
    }
}