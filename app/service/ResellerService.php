<?php
/**
 * Created by PhpStorm.
 * User: Raihan
 * Date: 11/7/2016
 * Time: 9:56 PM
 */

namespace services;

use core\ApplicationConstants;
use model\Reseller;

require_once 'Database.php';
require_once 'core/ApplicationConstants.php';

final class ResellerService {
    private $db;

    private function __construct(){
        $this->db = Database::Instance();
        $this->db->execute(ApplicationConstants::CREATE_RESELLER_TABLE);
    }

    public static function Instance(){
        static $inst = null;
        if ($inst === null) {
            $inst = new ResellerService();
        }
        return $inst;
    }

    public function getAll(){
        $resellers = $this->db->selectQuery(ApplicationConstants::GET_ALL_RESELLERS, array(), Reseller::class);
        return $resellers;
    }
}