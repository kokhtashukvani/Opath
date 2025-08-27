<?php
require_once APP_ROOT . '/src/models/Form.php';
require_once APP_ROOT . '/src/models/FormField.php';
require_once APP_ROOT . '/src/lib/ApiResponse.php';

class FormBuilderController {
    private $formModel;
    private $formFieldModel;

    public function __construct() {
        if (!isAdmin()) {
            ApiResponse::json(['error' => 'Unauthorized'], 403);
        }
        $this->formModel = new Form();
        $this->formFieldModel = new FormField();
    }

    // GET /forms
    public function index() {
        $forms = $this->formModel->getAll();
        ApiResponse::json($forms);
    }

    // GET /forms/{id}
    public function show() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            ApiResponse::json(['error' => 'Form ID not specified'], 400);
        }
        $form = $this->formModel->findById($id);
        $fields = $this->formFieldModel->getFieldsByFormId($id);

        if ($form) {
            ApiResponse::json(['form' => $form, 'fields' => $fields]);
        } else {
            ApiResponse::json(['error' => 'Form not found'], 404);
        }
    }

    // POST /forms
    public function store() {
        $postData = json_decode(file_get_contents('php://input'), true);
        if (empty($postData['name'])) {
            ApiResponse::json(['error' => 'Form name is required'], 400);
        }

        if ($this->formModel->create($postData)) {
            ApiResponse::json(['success' => true, 'message' => 'Form created successfully'], 201);
        } else {
            ApiResponse::json(['error' => 'Failed to create form'], 500);
        }
    }

    // POST /forms/{id}/fields
    public function storeField() {
        $postData = json_decode(file_get_contents('php://input'), true);
        $form_id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$form_id) {
            ApiResponse::json(['error' => 'Form ID not specified'], 400);
        }

        $postData['form_id'] = $form_id;
        if (empty($postData['label']) || empty($postData['field_type']) || empty($postData['field_name'])) {
            ApiResponse::json(['error' => 'Label, Field Type, and Field Name are required'], 400);
        }

        if ($this->formFieldModel->create($postData)) {
            ApiResponse::json(['success' => true, 'message' => 'Field added successfully'], 201);
        } else {
            ApiResponse::json(['error' => 'Failed to add field'], 500);
        }
    }
}
