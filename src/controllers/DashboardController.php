<?php
require_once APP_ROOT . '/src/models/PurchaseRequest.php';

class DashboardController {
    private $requestModel;

    public function __construct() {
        if (!isLoggedIn()) {
            header('Location: index.php?page=login');
            exit();
        }
        $this->requestModel = new PurchaseRequest();
    }

    public function index() {
        // Fetch purchase requests for the logged-in user
        $requests = $this->requestModel->getByUserId($_SESSION['user_id']);

        $data = [
            'purchase_requests' => $requests
        ];

        $this->loadView('dashboard', $data);
    }

    // Helper to load view files
    public function loadView($view, $data = []) {
        $view_path = APP_ROOT . '/views/' . $view . '.php';
        if (file_exists($view_path)) {
            require_once $view_path;
        } else {
            die('View does not exist: ' . $view);
        }
    }
}
