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
        if($this->isEmailExists($reseller->email)){
            throw new GlobalException('Email already exists');
        }

        return $this->db->updateQuery(
            ApplicationConstants::ADD_RESELLER,
            array(
                ':full_name' => $reseller->full_name,
                ':username' => $reseller->username,
                ':email' => $reseller->email,
                ':password' => $reseller->password,
                ':role' => $reseller->role,
                ':is_active' => $reseller->is_active
            )
        );
    }

    public function update($reseller){
        return $this->db->updateQuery(
            ApplicationConstants::UPDATE_RESELLER,
            array(
                ':id' => $reseller->id,
                ':full_name' => $reseller->full_name,
                ':password' => $reseller->password,
                ':is_active' => $reseller->is_active
            )
        );
    }

    public function delete($id){
        $reseller = $this->get($id);
        if(!$reseller){
            throw new GlobalException('Reseller not found');
        }

        return $this->db->updateQuery(ApplicationConstants::DELETE_RESELLER, array(':id' => $id));
    }

    public function get($id) {
        return $this->db->selectQuery(ApplicationConstants::SELECT_RESELLER_BY_ID, array(':id' => $id), Reseller::class);
    }

    private function isUsernameExists($username) {
        $resellers = $this->db->selectQuery(ApplicationConstants::SELECT_RESELLER_BY_USERNAME, array(':username' => $username), Reseller::class);
        return (sizeof($resellers) > 0);
    }

    private function isEmailExists($email) {
        $resellers = $this->db->selectQuery(ApplicationConstants::SELECT_RESELLER_BY_EMAIL, array(':email' => $email), Reseller::class);
        return (sizeof($resellers) > 0);
    }
}