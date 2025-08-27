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
        require_once APP_ROOT . '/src/lib/FormRenderer.php';
        $renderer = new FormRenderer();
        $formHtml = $renderer->render('Purchase Request', 'index.php?action=purchase_request_store');

        $data = ['form_html' => $formHtml];
        $this->loadView('purchase_requests/create', $data);
    }

    // Store a new purchase request
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once APP_ROOT . '/src/lib/FormSubmissionHandler.php';
            $handler = new FormSubmissionHandler();

            // Sanitize POST data first
            $sanitizedPost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle the generic submission. This now the single source of truth.
            $result = $handler->handle('Purchase Request', $sanitizedPost);

            if ($result['success']) {
                // Redirect on success
                header('Location: index.php?page=dashboard&pr_success=true');
            } else {
                // If the generic handler fails, show the error
                die($result['message']);
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
