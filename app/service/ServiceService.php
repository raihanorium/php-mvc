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

require_once 'Database.php';
require_once 'core/ApplicationConstants.php';
require_once 'app/model/ResellerService.php';

final class ServiceService {
    private $db;

    private function __construct(){
        $this->db = Database::Instance();
        $this->db->execute(ApplicationConstants::CREATE_SERVICE_TABLE);
        $this->db->execute(ApplicationConstants::INSERT_DEFAULT_SERVICES);
    }

    public static function Instance(){
        static $inst = null;
        if ($inst === null) {
            $inst = new ServiceService();
        }
        return $inst;
    }

    public function getAll(){
        return $this->db->selectQuery(ApplicationConstants::GET_ALL_SERVICES, array(), Service::class);
    }

    public function getAllActive(){
        return $this->db->selectQuery(ApplicationConstants::GET_ALL_ACTIVE_SERVICES, array(), Service::class);
    }

    public function get($id) {
        return $this->db->selectQuery(ApplicationConstants::SELECT_SERVICE_BY_ID, array(':id' => $id), Service::class);
    }

    public function getServiceIdsByResellerId($resellerId){
        $ret = array();
        $result = $this->db->selectQuery(ApplicationConstants::GET_SERVICES_OF_RESELLER, array(':reseller_id' => $resellerId), 'int');
        foreach ($result as $service){
            array_push($ret, $service['id']);
        }
        return $ret;
    }

    public function deleteServicesByResellerId($resellerId){
        return $this->db->updateQuery(ApplicationConstants::DELETE_RESELLER_SERVICE, array(':reseller_id' => $resellerId));
    }
}