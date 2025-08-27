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

        default:
            header('Location: index.php');
            exit;
    }
} else {
    // Page Views
    $supplierController = new SupplierController();
    $prController = new PurchaseRequestController();
    $dashboardController = new DashboardController();

    // Whitelist of allowed pages
    $allowed_pages = ['home', 'login', 'register', 'dashboard', 'suppliers', 'supplier_create', 'supplier_edit', 'purchase_request_create'];

    if (in_array($page, $allowed_pages)) {
        // Protect pages
        if (($page == 'dashboard' || strpos($page, 'supplier') === 0 || strpos($page, 'purchase_request') === 0) && !isLoggedIn()) {
            header('Location: index.php?page=login');
            exit();
        }

        // Route to controller or simple view
        switch($page) {
            case 'dashboard':
                $dashboardController->index();
                break;
            case 'suppliers':
                $supplierController->index();
                break;
            case 'supplier_create':
                $supplierController->create();
                break;
            case 'supplier_edit':
                $supplierController->edit();
                break;
            case 'purchase_request_create':
                $prController->create();
                break;
            default:
                // Default to loading a simple view from the /views folder
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


// Check if the view file exists and load it
/*
if (file_exists($view_path)) {
    require_once $view_path;
} else {
    // A simple 404 handler
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>The page you requested could not be found.</p>";
}
*/

// Check if the view file exists and load it
if (file_exists($view_path)) {
    require_once $view_path;
} else {
    // A simple 404 handler
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>The page you requested could not be found.</p>";
}
