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
        return $this->db->selectQuery(ApplicationConstants::GET_ALL_RESELLERS, array(), Reseller::class);
    }

    public function create($reseller){
        if($this->isUsernameExists($reseller->username)){
            throw new GlobalException('Username already exists');
        }
        return $this->db->updateQuery(
            ApplicationConstants::ADD_RESELLER,
            array(
                ':full_name' => $reseller->full_name,
                ':username' => $reseller->username,
                ':email' => $reseller->email,
                ':password' => $reseller->password,
                ':is_active' => $reseller->is_active
            )
        );
    }

    private function isUsernameExists($username) {
        $resellers = $this->db->selectQuery(ApplicationConstants::SELECT_RESELLER_BY_USERNAME, array(':username' => $username), Reseller::class);
        return (sizeof($resellers) > 0);
    }
}