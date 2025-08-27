<?php
require_once APP_ROOT . '/src/models/PurchaseRequest.php';
require_once APP_ROOT . '/src/models/Supplier.php';

class AdminRequestController {
    private $requestModel;
    private $supplierModel;

    public function __construct() {
        // Ensure user is an admin to access this controller
        if (!isAdmin()) {
            die('<h1>Access Denied</h1><p>You do not have permission to view this page.</p>');
        }
        $this->requestModel = new PurchaseRequest();
        $this->supplierModel = new Supplier();
    }

    // Show all purchase requests from all users
    public function index() {
        $requests = $this->requestModel->getAll();
        $data = ['requests' => $requests];
        $this->loadView('admin/requests/index', $data);
    }

    // Show the form to create a new inquiry for a purchase request
    public function createInquiry() {
        $request_id = isset($_GET['request_id']) ? $_GET['request_id'] : null;
        if (!$request_id) {
            die('No purchase request specified.');
        }

        $request = $this->requestModel->findById($request_id); // I need to add this method to the model
        $suppliers = $this->supplierModel->getAll();

        $data = [
            'request' => $request,
            'suppliers' => $suppliers
        ];

        $this->loadView('admin/inquiries/create', $data);
    }

    // Handle the submission of the inquiry form
    public function sendInquiry() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request_id = $_POST['request_id'];
            $supplier_ids = isset($_POST['suppliers']) ? $_POST['suppliers'] : [];
            $deadline = $_POST['deadline'];

            if (empty($supplier_ids)) {
                die('No suppliers were selected.');
            }

            require_once APP_ROOT . '/src/models/Inquiry.php';
            $inquiryModel = new Inquiry();

            foreach ($supplier_ids as $supplier_id) {
                $data = [
                    'request_id' => $request_id,
                    'supplier_id' => $supplier_id,
                    'deadline' => $deadline
                ];
                $inquiryModel->create($data);
            }

            // Redirect back to the admin request list with a success message
            header('Location: index.php?page=admin_requests&inquiry_sent=true');
            exit();

        } else {
            header('Location: index.php?page=admin_requests');
            exit();
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
