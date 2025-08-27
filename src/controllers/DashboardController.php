<?php
require_once APP_ROOT . '/src/models/FormSubmission.php';

class DashboardController {
    private $submissionModel;

    public function __construct() {
        if (!isLoggedIn()) {
            header('Location: index.php?page=login');
            exit();
        }
        $this->submissionModel = new FormSubmission();
    }

    public function index() {
        // Fetch purchase request submissions for the logged-in user
        $requests = $this->submissionModel->getSubmissionsByFormNameAndUser('Purchase Request', $_SESSION['user_id']);

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
