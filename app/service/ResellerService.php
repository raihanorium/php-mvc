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
require_once 'app/service/ServiceService.php';

final class ResellerService {
    private $db;
    private $serviceService;

    private function __construct(){
        $this->db = Database::Instance();
        $this->db->execute(ApplicationConstants::CREATE_RESELLER_TABLE);
        $this->serviceService = ServiceService::Instance();
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
        foreach ($resellers as $reseller){
            $reseller->balance = $this->getBalance($reseller->id);
        }

        return $resellers;
    }

    public function getAllActive(){
        return $this->db->selectQuery(ApplicationConstants::GET_ALL_ACTIVE_RESELLERS, array(), Reseller::class);
    }

    public function create($reseller){
        if($this->isUsernameExists($reseller->username)){
            throw new GlobalException('Username already exists');
        }
        if($this->isEmailExists($reseller->email)){
            throw new GlobalException('Email already exists');
        }

        $result = $this->db->updateQuery(
            ApplicationConstants::ADD_RESELLER,
            array(
                ':full_name' => $reseller->full_name,
                ':username' => $reseller->username,
                ':email' => $reseller->email,
                ':password' => $reseller->password,
                ':role' => $reseller->role,
                ':rate_plan_id' => $reseller->rate_plan_id,
                ':is_active' => $reseller->is_active
            )
        );

        // add services only if role is reseller.
        if(($result > 0) && ($reseller->role == 2)){
            $addedReseller = $this->getByUsernameAndPassword($reseller->username, $reseller->password)[0];
            foreach ($reseller->services as $service){
                $this->db->updateQuery(
                    ApplicationConstants::ADD_RESELLER_SERVICE,
                    array(
                        ':reseller_id' => $addedReseller->id,
                        ':service_id' => $service
                    )
                );
            }
        }

        return $result;
    }

    public function update($reseller){
        $result = $this->db->updateQuery(
            ApplicationConstants::UPDATE_RESELLER,
            array(
                ':id' => $reseller->id,
                ':full_name' => $reseller->full_name,
                ':password' => $reseller->password,
                ':rate_plan_id' => $reseller->rate_plan_id,
                ':is_active' => $reseller->is_active
            )
        );

        // add services only if role is reseller.
        if($reseller->role == 2){
            // delete previous associations first
            $this->serviceService->deleteServicesByResellerId($reseller->id);

            $addedReseller = $this->getByUsernameAndPassword($reseller->username, $reseller->password)[0];
            foreach ($reseller->services as $service){
                $this->db->updateQuery(
                    ApplicationConstants::ADD_RESELLER_SERVICE,
                    array(
                        ':reseller_id' => $addedReseller->id,
                        ':service_id' => $service
                    )
                );
            }
        }

        return $result;
    }

    public function delete($id){
        $reseller = $this->get($id);
        if(!$reseller){
            throw new GlobalException('Reseller not found');
        }

        // delete service associations first
        $this->serviceService->deleteServicesByResellerId($reseller->id);

        return $this->db->updateQuery(ApplicationConstants::DELETE_RESELLER, array(':id' => $id));
    }

    public function get($id) {
        $result = $this->db->selectQuery(ApplicationConstants::SELECT_RESELLER_BY_ID, array(':id' => $id), Reseller::class);
        if($result) {
            $result = $result[0];
            $result->services = $this->serviceService->getServiceIdsByResellerId($id);
        }
        return $result;
    }

    public function getAllServices($resellerId){
        $serviceIds = $this->serviceService->getServiceIdsByResellerId($resellerId);
        $services = array();
        foreach ($serviceIds as $serviceId){
            $service = $this->serviceService->get($serviceId);
            array_push($services, $service[0]);
        }

        return $services;
    }

    private function isUsernameExists($username) {
        $resellers = $this->db->selectQuery(ApplicationConstants::SELECT_RESELLER_BY_USERNAME, array(':username' => $username), Reseller::class);
        return (sizeof($resellers) > 0);
    }

    private function isEmailExists($email) {
        $resellers = $this->db->selectQuery(ApplicationConstants::SELECT_RESELLER_BY_EMAIL, array(':email' => $email), Reseller::class);
        return (sizeof($resellers) > 0);
    }

    public function getByUsernameAndPassword($username, $password) {
        return $this->db->selectQuery(ApplicationConstants::SELECT_RESELLER_BY_USERNAME_PASSWORD,
            array(':username' => $username, ':password' => $password), Reseller::class);
    }

    public function getBalance($reseller_id){
        return $this->db->selectQuery(ApplicationConstants::GET_RESELLER_BALANCE, array(':reseller_id' => $reseller_id), 'double')[0]['balance'];
    }
}