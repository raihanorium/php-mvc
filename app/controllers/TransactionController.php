<?php
namespace app\controllers;

require_once 'app/service/TransactionService.php';
require_once 'app/model/Transaction.php';
require_once 'core/FormValidator.php';

use core\Controller;
use core\FormValidator;
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
                $request['transactions'] = $this->transactionService->getResellerTransactionsWithAdmin(Security::getLoggedInUser()['id']);
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

        try {
            $transaction = new Transaction();
            $transaction->from = FormValidator::validate(array('From' => Security::getLoggedInUser()['id']), array(FormValidator::$REQUIRED => true));
            $transaction->to = FormValidator::validate(array('Reseller' => $request['to']), array(FormValidator::$REQUIRED => true));
            $transaction->amount = FormValidator::validate(array('Amount' => $request['amount']),
                array(
                    FormValidator::$REQUIRED => true,
                    FormValidator::$NUMERIC => true,
                    FormValidator::$MINVALUE => 10
                )
            );
            $transaction->description = $request['description'];

            $result = $this->transactionService->addAdminResellerTransaction($transaction);
            if($result > 0){
                $this->index($request);
            }
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $this->index($request);
        }
    }
}