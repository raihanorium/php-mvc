<?php
namespace app\controllers;

require_once 'app/service/ResellerService.php';
require_once 'app/service/TransactionService.php';
require_once 'app/model/Transaction.php';
require_once 'core/FormValidator.php';

use core\Controller;
use core\FormValidator;
use core\Security;
use model\Transaction;
use services\ResellerService;
use services\TransactionService;

class HomeController extends Controller {
    private $resellerService;
    private $transactionService;

    public function __construct() {
        $this->resellerService = ResellerService::Instance();
        $this->transactionService = TransactionService::Instance();
        parent::__construct();
    }

    /**
     * @hasAnyRole(reseller, admin)
     */
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

    /**
     * @hasAnyRole(reseller)
     */
    public function transaction_reseller($request){
        if(!isset($request['submit'])){
            header("Location: ./?p=transaction");
        }

        try{
            $transaction = new Transaction();
            $transaction->service_id = FormValidator::validate(array('Service' => $request['service_id']), array(FormValidator::$REQUIRED => true));
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

            $result = $this->transactionService->addResellerTransaction($transaction);
            if($result > 0){
                header("Location: ./");
            }
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $request['services'] = $this->resellerService->getAllServices(Security::getLoggedInUser()['id']);
            $this->index($request);
        }
    }
}