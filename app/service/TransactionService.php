<?php
/**
 * Created by PhpStorm.
 * User: Raihan
 * Date: 11/7/2016
 * Time: 9:56 PM
 */

namespace services;

use core\ApplicationConstants;
use core\GlobalException;
use model\Reseller;
use model\Service;
use model\Transaction;

require_once 'Database.php';
require_once 'core/ApplicationConstants.php';
require_once 'app/model/ResellerService.php';

final class TransactionService {
    private $db;
    private $resellerService;

    private function __construct() {
        $this->db = Database::Instance();
        $this->resellerService = ResellerService::Instance();
        $this->db->execute(ApplicationConstants::CREATE_ADMIN_RESELLER_TRANSACTION_TABLE);
        $this->db->execute(ApplicationConstants::CREATE_RESELLER_TRANSACTION_TABLE);
    }

    public static function Instance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new TransactionService();
        }
        return $inst;
    }

    public function get($transaction_id) {
        return $this->db->selectQuery(ApplicationConstants::GET_TRANSACTION, array(':id' => $transaction_id), Transaction::class);
    }

    public function abort($transaction_id) {
        return $this->db->updateQuery(ApplicationConstants::CANCEL_TRANSACTION, array(':id' => $transaction_id));
    }

    public function markAsSent($transaction_id, $txnId) {
        return $this->db->updateQuery(ApplicationConstants::TRANSACTION_MARK_AS_SENT, array(':id' => $transaction_id, ':txnId' => $txnId));
    }

    public function getAllForAdmin() {
        return $this->db->selectQuery(ApplicationConstants::GET_ALL_TRANSACTIONS_ADMIN, array(), Transaction::class);
    }

    public function getResellerCustomerTransactions($reseller_id){
        return $this->db->selectQuery(ApplicationConstants::GET_ALL_RESELLER_CUSTOMER_TRANSACTIONS, array(':from' => $reseller_id), Transaction::class);
    }

    public function getAllTransactionsToProcess() {
        return $this->db->selectQuery(ApplicationConstants::GET_ALL_TRANSACTIONS_TO_PROCESS, array(), Transaction::class);
    }

    public function addAdminResellerTransaction($transaction) {
        return $this->db->updateQuery(
            ApplicationConstants::INSERT_ADMIN_RESELLER_TRANSACTION,
            array(
                ':from' => $transaction->from,
                ':to' => $transaction->to,
                ':amount' => $transaction->amount,
                ':description' => $transaction->description
            )
        );
    }

    public function addResellerTransaction($transaction) {
        $balance = $this->resellerService->getBalance($transaction->from);
        if($balance < $transaction->amount){
            throw new GlobalException('Insufficient balance.');
        }
        return $this->db->updateQuery(
            ApplicationConstants::INSERT_RESELLER_TRANSACTION,
            array(
                ':service_id' => $transaction->service_id,
                ':from' => $transaction->from,
                ':to' => $transaction->to,
                ':amount' => $transaction->amount,
                ':description' => $transaction->description
            )
        );
    }

    public function getResellerTransactionsWithAdmin($reseller_id) {
        return $this->db->selectQuery(ApplicationConstants::GET_ALL_TRANSACTIONS_RESELLER, array(':to' => $reseller_id), Transaction::class);
    }
}