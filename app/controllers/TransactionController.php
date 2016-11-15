<?php
namespace app\controllers;

require_once 'app/service/TransactionService.php';
require_once 'app/model/Transaction.php';

use core\Controller;
use core\Security;
use model\Transaction;
use services\ResellerService;
use services\TransactionService;

/**
 * @hasAnyRole(admin, reseller)
 */
class TransactionController extends Controller {
    private $transactionService;
    private $resellerService;

    public function __construct() {
        $this->transactionService = TransactionService::Instance();
        $this->resellerService = ResellerService::Instance();
        parent::__construct();
    }

    public function index($request) {
        $user = Security::getLoggedInUser();
        switch ($user['role']){
            case 1:
                $request['resellers'] = $this->resellerService->getAllActive();
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

    public function add($request){
        if(!isset($request['submit'])){
            header("Location: ./?p=transaction");
        }

        $transaction = new Transaction();
        $transaction->from = Security::getLoggedInUser()['id'];
        $transaction->to = $request['to'];
        $transaction->amount = $request['amount'];
        $transaction->description = $request['description'];

        try {
            $result = $this->transactionService->addAdminResellerTransaction($transaction);
            if($result > 0){
                header("Location: ./?p=transaction");
            }
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $this->index($request);
        }
    }
}