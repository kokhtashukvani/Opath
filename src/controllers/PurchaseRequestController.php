<?php
require_once APP_ROOT . '/src/models/PurchaseRequest.php';

class PurchaseRequestController {
    private $requestModel;

    public function __construct() {
        if (!isLoggedIn()) {
            header('Location: index.php?page=login');
            exit();
        }
        $this->requestModel = new PurchaseRequest();
    }

    // Show form to create a new purchase request
    public function create() {
        $this->loadView('purchase_requests/create');
    }

    // Store a new purchase request
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'product_name' => trim($_POST['product_name']),
                'product_description' => trim($_POST['product_description']),
                'brand' => trim($_POST['brand']),
                'quantity' => trim($_POST['quantity']),
            ];

            // Basic validation
            if (!empty($data['product_name']) && !empty($data['quantity'])) {
                if ($this->requestModel->create($data)) {
                    header('Location: index.php?page=dashboard&pr_success=true');
                } else {
                    die('Something went wrong while creating the request.');
                }
            } else {
                die('Please fill out all required fields.');
            }
        }
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
