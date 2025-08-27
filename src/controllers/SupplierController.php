<?php
require_once APP_ROOT . '/src/models/Supplier.php';
require_once APP_ROOT . '/src/lib/ApiResponse.php';

class SupplierController {
    private $supplierModel;

    public function __construct() {
        if (!isAdmin()) {
            ApiResponse::json(['error' => 'Unauthorized'], 403);
        }
        $this->supplierModel = new Supplier();
    }

    // GET /suppliers
    public function index() {
        $suppliers = $this->supplierModel->getAll();
        ApiResponse::json($suppliers);
    }

    // GET /suppliers/{id} - The router will need to handle this
    public function show() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            ApiResponse::json(['error' => 'Supplier ID not specified'], 400);
        }
        $supplier = $this->supplierModel->findById($id);
        if ($supplier) {
            ApiResponse::json($supplier);
        } else {
            ApiResponse::json(['error' => 'Supplier not found'], 404);
        }
    }

    // POST /suppliers
    public function store() {
        $postData = json_decode(file_get_contents('php://input'), true);
        if (empty($postData['name']) || empty($postData['email']) || empty($postData['password'])) {
            ApiResponse::json(['error' => 'Name, email, and password are required'], 400);
        }

        $postData['password_hash'] = password_hash($postData['password'], PASSWORD_DEFAULT);

        if ($this->supplierModel->create($postData)) {
            ApiResponse::json(['success' => true, 'message' => 'Supplier created successfully'], 201);
        } else {
            ApiResponse::json(['error' => 'Failed to create supplier'], 500);
        }
    }

    // PUT /suppliers/{id}
    public function update() {
        $postData = json_decode(file_get_contents('php://input'), true);
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            ApiResponse::json(['error' => 'Supplier ID not specified'], 400);
        }

        $postData['id'] = $id;

        if ($this->supplierModel->update($postData)) {
            ApiResponse::json(['success' => true, 'message' => 'Supplier updated successfully']);
        } else {
            ApiResponse::json(['error' => 'Failed to update supplier'], 500);
        }
    }

    // DELETE /suppliers/{id}
    public function destroy() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            ApiResponse::json(['error' => 'Supplier ID not specified'], 400);
        }

        if ($this->supplierModel->delete($id)) {
            ApiResponse::json(null, 204); // No content
        } else {
            ApiResponse::json(['error' => 'Failed to delete supplier'], 500);
        }
    }
}
