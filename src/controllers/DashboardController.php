<?php
require_once APP_ROOT . '/src/models/FormSubmission.php';
require_once APP_ROOT . '/src/lib/ApiResponse.php';

class DashboardController {
    private $submissionModel;

    public function __construct() {
        if (!isLoggedIn()) {
            ApiResponse::json(['error' => 'Unauthorized'], 401);
        }
        $this->submissionModel = new FormSubmission();
    }

    public function index() {
        // Fetch purchase request submissions for the logged-in user
        $requests = $this->submissionModel->getSubmissionsByFormNameAndUser('Purchase Request', $_SESSION['user_id']);

        ApiResponse::json($requests);
    }
}
