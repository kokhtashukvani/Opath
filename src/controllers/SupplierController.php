<?php
require_once APP_ROOT . '/src/models/Supplier.php';

class SupplierController {
    private $supplierModel;

    public function __construct() {
        // Ensure user is an admin to access this controller
        if (!isAdmin()) {
            // You can redirect or show an access denied message
            die('<h1>Access Denied</h1><p>You do not have permission to view this page.</p>');
        }
        $this->supplierModel = new Supplier();
    }

    // Show all suppliers
    public function index() {
        $suppliers = $this->supplierModel->getAll();
        $data = ['suppliers' => $suppliers];
        $this->loadView('suppliers/index', $data);
    }

    // Show form to create a new supplier
    public function create() {
        $this->loadView('suppliers/create');
    }

    // Store a new supplier in the database
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'contact_person' => trim($_POST['contact_person']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'city' => trim($_POST['city']),
                'province' => trim($_POST['province']),
                'specialization' => trim($_POST['specialization']),
                'password' => trim($_POST['password']),
            ];

            // Basic validation
            if (!empty($data['name']) && !empty($data['email']) && !empty($data['password'])) {
                // Hash password for the supplier's own login
                $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->supplierModel->create($data)) {
                    header('Location: index.php?page=suppliers');
                } else {
                    die('Something went wrong while creating supplier.');
                }
            } else {
                // In a real app, show errors
                die('Please fill out all required fields.');
            }
        }
    }

    // Show form to edit a supplier
    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $supplier = $this->supplierModel->findById($id);
            if ($supplier) {
                $data = ['supplier' => $supplier];
                $this->loadView('suppliers/edit', $data);
            } else {
                die('Supplier not found.');
            }
        } else {
            die('No ID specified.');
        }
    }

    // Update a supplier in the database
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $_POST['id'],
                'name' => trim($_POST['name']),
                'contact_person' => trim($_POST['contact_person']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'city' => trim($_POST['city']),
                'province' => trim($_POST['province']),
                'specialization' => trim($_POST['specialization']),
            ];

            if ($this->supplierModel->update($data)) {
                header('Location: index.php?page=suppliers');
            } else {
                die('Something went wrong while updating supplier.');
            }
        }
    }

    // Delete a supplier from the database
    public function destroy() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            if ($this->supplierModel->delete($id)) {
                header('Location: index.php?page=suppliers');
            } else {
                die('Something went wrong while deleting supplier.');
            }
        } else {
            die('No ID specified for deletion.');
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
