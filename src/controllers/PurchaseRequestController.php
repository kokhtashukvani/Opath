<?php
require_once APP_ROOT . '/src/lib/ApiResponse.php';
require_once APP_ROOT . '/src/lib/FormSubmissionHandler.php';
require_once APP_ROOT . '/src/models/Form.php';
require_once APP_ROOT . '/src/models/FormField.php';

class PurchaseRequestController {

    public function __construct() {
        if (!isLoggedIn()) {
            ApiResponse::json(['error' => 'Unauthorized'], 401);
        }
    }

    // GET /forms/purchase-request - Gets the structure of the form
    public function getFormStructure() {
        $formModel = new Form();
        $formFieldModel = new FormField();

        $form = $formModel->findByName('Purchase Request');
        if (!$form) {
            ApiResponse::json(['error' => 'Purchase Request form definition not found.'], 404);
        }

        $fields = $formFieldModel->getFieldsByFormId($form->id);
        ApiResponse::json(['form' => $form, 'fields' => $fields]);
    }

    // POST /purchase-requests
    public function store() {
        $handler = new FormSubmissionHandler();
        $postData = json_decode(file_get_contents('php://input'), true);

        // Handle the generic submission.
        $result = $handler->handle('Purchase Request', $postData);

        if ($result['success']) {
            ApiResponse::json(['success' => true, 'message' => 'Purchase request submitted successfully.'], 201);
        } else {
            ApiResponse::json(['error' => $result['message']], 400);
        }
    }
}
