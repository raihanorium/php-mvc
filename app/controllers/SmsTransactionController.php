<?php
/**
 * Created by PhpStorm.
 * User: ataul.raihan
 * Date: 1/4/2017
 * Time: 10:29 PM
 */

namespace app\controllers;

require_once 'app/service/TransactionService.php';

use core\Controller;
use services\TransactionService;

/**
 * @hasAnyRole(admin)
 */
class SmsTransactionController extends Controller {
    private $transactionService;

    public function __construct() {
        $this->transactionService = TransactionService::Instance();
        parent::__construct();
    }

    public function index($request) {
        $request['transactions'] = $this->transactionService->getAllTransactionsToProcess();
        $this->view->renderTemplate($request);
    }
}