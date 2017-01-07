<?php
namespace app\controllers;

require_once 'app/service/ResellerService.php';
require_once 'app/service/ReportingService.php';
require_once 'app/service/TransactionService.php';
require_once 'app/model/Transaction.php';
require_once 'core/FormValidator.php';

use core\Controller;
use core\FormValidator;
use core\Security;
use model\Transaction;
use services\ReportingService;
use services\ResellerService;
use services\TransactionService;

class HomeController extends Controller {
    private $resellerService;
    private $transactionService;
    private $reportingService;

    public function __construct() {
        $this->resellerService = ResellerService::Instance();
        $this->transactionService = TransactionService::Instance();
        $this->reportingService = ReportingService::Instance();
        parent::__construct();
    }

    /**
     * @hasAnyRole(reseller, admin)
     */
    public function index($request) {
        $user = Security::getLoggedInUser();
        switch ($user['role']){
            case 1:
                $request = $this->prepareTodaysSalesPerServiceChart($request);
                $request = $this->prepareThisMonthsSalesPerServiceChart($request);
                $this->view->renderView('home/home_admin', $request);
                break;
            case 2:
                $request['services'] = $this->resellerService->getAllServices($user['id']);
                $request['transactions'] = $this->transactionService->getResellerCustomerTransactions($user['id']);
                $request['balance'] = $this->resellerService->getBalance($user['id']);
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
            $transaction->to = FormValidator::validate(array('Reseller' => $request['to']),
                array(
                    FormValidator::$REQUIRED => true,
                    FormValidator::$MOBILE_NUMBER => true,
                    FormValidator::$NUMBER_OPERATOR => $transaction->service_id
                )
            );
            $transaction->amount = FormValidator::validate(array('Amount' => (float) $request['amount']),
                array(
                    FormValidator::$REQUIRED => true,
                    FormValidator::$NUMERIC => true,
                    FormValidator::$MINVALUE => 10,
                    FormValidator::$MAXVALUE => (float) preg_replace('/[^\d.]/', '', $request['balance'])
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

    /**
     * @hasAnyRole(reseller, admin)
     */
    public function abort_transaction($request){
        if(!isset($request['submit'])){
            header("Location: ./");
        }

        try{
            $transactionId = $request['id'];
            $transactionObj = $this->transactionService->get($transactionId)[0];

            if($transactionObj->status == 'pending'){
                $this->transactionService->abort($transactionId);
                header('Location: ./?p=smstransaction');
            } else{
                $request['error'] = 'This is not a pending transaction.';
                $request['services'] = $this->resellerService->getAllServices(Security::getLoggedInUser()['id']);
                $this->index($request);
            }
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $request['services'] = $this->resellerService->getAllServices(Security::getLoggedInUser()['id']);
            $this->index($request);
        }
    }

    /**
     * @hasAnyRole(admin)
     */
    public function mark_sent($request){
        if(!isset($request['submit'])){
            header("Location: ./");
        }

        try{
            $transactionId = $request['id'];
            $txnId = $request['txnId'];
            $transactionObj = $this->transactionService->get($transactionId)[0];

            if($transactionObj->status == 'pending'){
                $this->transactionService->markAsSent($transactionId, $txnId);
                header('Location: ./?p=smstransaction');
            } else{
                $request['error'] = 'This is not a pending transaction.';
                $request['services'] = $this->resellerService->getAllServices(Security::getLoggedInUser()['id']);
                $this->index($request);
            }
        } catch (\Exception $ex){
            $request['error'] = $ex->getMessage();
            $request['services'] = $this->resellerService->getAllServices(Security::getLoggedInUser()['id']);
            $this->index($request);
        }
    }

    private function prepareTodaysSalesPerServiceChart($request) {
        $todaysSalesPerService = $this->reportingService->todaysSalesPerService();
        $todaysSalesLabels = array();
        $todaysSalesTotal = array();
        foreach ($todaysSalesPerService as $data) {
            array_push($todaysSalesLabels, $data['name']);
            array_push($todaysSalesTotal, $data['total_sales']);
        }
        $request['todaysSalesLabels'] = $todaysSalesLabels;
        $request['todaysSalesTotal'] = $todaysSalesTotal;
        return $request;
    }

    private function prepareThisMonthsSalesPerServiceChart($request) {
        $salesPerService = $this->reportingService->thisMonthsSalesPerService();
        $salesLabels = array();
        $salesTotal = array();
        foreach ($salesPerService as $data) {
            array_push($salesLabels, $data['name']);
            array_push($salesTotal, $data['total_sales']);
        }
        $request['monthsSalesLabels'] = $salesLabels;
        $request['monthsSalesTotal'] = $salesTotal;
        return $request;
    }
}