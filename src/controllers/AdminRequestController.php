<?php
require_once APP_ROOT . '/src/models/PurchaseRequest.php';
require_once APP_ROOT . '/src/models/Supplier.php';
require_once APP_ROOT . '/src/models/Inquiry.php';
require_once APP_ROOT . '/src/lib/ApiResponse.php';

class AdminRequestController {
    private $requestModel;
    private $supplierModel;
    private $inquiryModel;

    public function __construct() {
        if (!isAdmin()) {
            ApiResponse::json(['error' => 'Unauthorized'], 403);
        }
        $this->requestModel = new PurchaseRequest();
        $this->supplierModel = new Supplier();
        $this->inquiryModel = new Inquiry();
    }

    // GET /admin/requests
    public function index() {
        $requests = $this->requestModel->getAll();
        ApiResponse::json($requests);
    }

    // GET /admin/requests/inquiry-data?request_id={id}
    // Gets the data needed for the "create inquiry" page
    public function getInquiryData() {
        $request_id = isset($_GET['request_id']) ? $_GET['request_id'] : null;
        if (!$request_id) {
            ApiResponse::json(['error' => 'Purchase request ID not specified'], 400);
        }
        $request = $this->requestModel->findById($request_id);
        $suppliers = $this->supplierModel->getAll();

        ApiResponse::json(['request' => $request, 'suppliers' => $suppliers]);
    }

    // POST /admin/inquiries
    public function sendInquiry() {
        $postData = json_decode(file_get_contents('php://input'), true);
        $request_id = $postData['request_id'] ?? null;
        $supplier_ids = $postData['suppliers'] ?? [];
        $deadline = $postData['deadline'] ?? null;

        if (!$request_id || empty($supplier_ids) || !$deadline) {
            ApiResponse::json(['error' => 'Request ID, suppliers, and deadline are required.'], 400);
        }

        foreach ($supplier_ids as $supplier_id) {
            $data = [
                'request_id' => $request_id,
                'supplier_id' => $supplier_id,
                'deadline' => $deadline
            ];
            $this->inquiryModel->create($data);
        }

        ApiResponse::json(['success' => true, 'message' => 'Inquiries sent successfully.'], 201);
    }
}
