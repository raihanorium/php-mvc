<?php
/**
 * Created by PhpStorm.
 * User: ataul.raihan
 * Date: 11/11/2016
 * Time: 12:13 AM
 */

namespace app\controllers;

require_once 'app/service/ServiceService.php';
require_once 'app/model/Service.php';

use core\Controller;
use services\ServiceService;

/**
 * @hasAnyRole(admin)
 */
class ServiceController extends Controller {
    private $serviceService;

    public function __construct() {
        $this->serviceService = ServiceService::Instance();
        parent::__construct();
    }

    public function index($request) {
        $request['services'] = $this->serviceService->getAll();
        $this->view->renderTemplate($request);
    }
}