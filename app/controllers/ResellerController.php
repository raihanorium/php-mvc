<?php
namespace app\controllers;

require_once 'app/service/ResellerService.php';

use core\Controller;
use services\ResellerService;

/**
 * @hasAnyRole(admin)
 */
class ResellerController extends Controller {
    private $resellerService;

    public function __construct() {
        $this->resellerService = ResellerService::Instance();
        parent::__construct();
    }

    public function index($request) {
        $resellers = $this->resellerService->getAll();
        $this->view->renderTemplate($resellers);
    }

    public function add() {
        $this->view->renderTemplate();
    }
}