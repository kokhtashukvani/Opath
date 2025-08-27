<?php
// Start the session
session_start();

// Include the configuration file
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/lib/helpers.php';

// Simple Router
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : null;

// Autoload controllers (a simple autoloader)
spl_autoload_register(function ($className) {
    $file = APP_ROOT . '/src/controllers/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// --- ROUTING ---

// Actions take priority over page views
if ($action) {
    $authController = new AuthController();
    $supplierController = new SupplierController();
    $prController = new PurchaseRequestController();

    switch ($action) {
        // Auth Actions
        case 'register':
            $authController->register();
            break;
        case 'login':
            $authController->login();
            break;
        case 'logout':
            $authController->logout();
            break;

        // Supplier Actions
        case 'supplier_store':
            $supplierController->store();
            break;
        case 'supplier_update':
            $supplierController->update();
            break;
        case 'supplier_destroy':
            $supplierController->destroy();
            break;

        // Purchase Request Actions
        case 'purchase_request_store':
            $prController->store();
            break;

        // Inquiry Actions
        case 'send_inquiry':
            $controller = new AdminRequestController();
            $controller->sendInquiry();
            break;

        // Form Builder Actions
        case 'form_store':
            $controller = new FormBuilderController();
            $controller->store();
            break;
        case 'form_field_store':
            $controller = new FormBuilderController();
            $controller->storeField();
            break;

        default:
            header('Location: index.php');
            exit;
    }
} else {
    // Page Views
    // Whitelist of allowed pages
    $allowed_pages = ['home', 'login', 'register', 'dashboard', 'suppliers', 'supplier_create', 'supplier_edit', 'purchase_request_create', 'admin_requests', 'inquiry_create', 'forms', 'forms_create', 'forms_show'];

    if (in_array($page, $allowed_pages)) {
        // Protect pages that require a login
        $protected_pages = ['dashboard', 'suppliers', 'supplier_create', 'supplier_edit', 'purchase_request_create', 'admin_requests', 'inquiry_create', 'forms', 'forms_create', 'forms_show'];
        if (in_array($page, $protected_pages) && !isLoggedIn()) {
            header('Location: index.php?page=login');
            exit();
        }

        // Route to the appropriate controller
        switch($page) {
            case 'dashboard':
                $controller = new DashboardController();
                $controller->index();
                break;
            case 'suppliers':
            case 'supplier_create':
            case 'supplier_edit':
                $controller = new SupplierController();
                $method = str_replace('supplier_', '', $page);
                if ($method == 'suppliers') $method = 'index';
                $controller->$method();
                break;
            case 'admin_requests':
                $controller = new AdminRequestController();
                $controller->index();
                break;
            case 'inquiry_create':
                $controller = new AdminRequestController();
                $controller->createInquiry();
                break;
            case 'purchase_request_create':
                $controller = new PurchaseRequestController();
                $controller->create();
                break;
            case 'forms':
            case 'forms_create':
            case 'forms_show':
                $controller = new FormBuilderController();
                $method = str_replace('forms_', '', $page);
                if ($method == 'forms') $method = 'index';
                $controller->$method();
                break;
            default:
                // Default to loading a simple view from the /views folder (home, login, register)
                $view_path = APP_ROOT . '/views/' . $page . '.php';
                if (file_exists($view_path)) {
                    require_once $view_path;
                } else {
                    http_response_code(404);
                    echo "<h1>404 Not Found</h1>";
                }
                break;
        }
    } else {
        // Default to home for unknown pages
        $view_path = APP_ROOT . '/views/home.php';
        require_once $view_path;
    }
}
