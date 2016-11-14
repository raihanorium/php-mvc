<?php
namespace app\controllers;

require_once 'app/service/TransactionService.php';

use core\Controller;
use core\Security;
use services\TransactionService;

/**
 * @hasAnyRole(admin, reseller)
 */
class TransactionController extends Controller {
    private $transactionService;

    public function __construct() {
        $this->transactionService = TransactionService::Instance();
        parent::__construct();
    }

    public function index($request) {
        $user = Security::getLoggedInUser();
        switch ($user['role']){
            case 1:
                $request['transactions'] = $this->transactionService->getAllForAdmin();
                $this->view->renderView('transaction/index_admin', $request);
                break;
            case 2:
                $request['transactions'] = $this->transactionService->getAllForAdmin();
                $this->view->renderView('transaction/index_reseller', $request);
                break;
            default:
                $this->view->renderTemplate(array('hello' => 'This message is comming from index function of TransactionController'));
                break;
        }
    }
}