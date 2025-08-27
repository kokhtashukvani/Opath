<?php
require_once APP_ROOT . '/src/models/Form.php';

class FormBuilderController {
    private $formModel;

    public function __construct() {
        if (!isAdmin()) {
            die('<h1>Access Denied</h1><p>You do not have permission to view this page.</p>');
        }
        $this->formModel = new Form();
    }

    // List all forms
    public function index() {
        $forms = $this->formModel->getAll();
        $data = ['forms' => $forms];
        $this->loadView('admin/forms/index', $data);
    }

    // Show the form to create a new form definition
    public function create() {
        $this->loadView('admin/forms/create');
    }

    // Show a single form and its fields
    public function show() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            die('No form specified.');
        }

        require_once APP_ROOT . '/src/models/FormField.php';
        $formFieldModel = new FormField();

        $form = $this->formModel->findById($id);
        $fields = $formFieldModel->getFieldsByFormId($id);

        $data = [
            'form' => $form,
            'fields' => $fields
        ];

        $this->loadView('admin/forms/show', $data);
    }

    // Store a new form definition
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
            ];

            if (!empty($data['name'])) {
                if ($this->formModel->create($data)) {
                    header('Location: index.php?page=forms');
                } else {
                    die('Something went wrong.');
                }
            } else {
                die('Form name is required.');
            }
        }
    }

    // Store a new field for a form
    public function storeField() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'form_id' => $_POST['form_id'],
                'label' => trim($_POST['label']),
                'field_type' => trim($_POST['field_type']),
                'field_name' => trim($_POST['field_name']),
                'is_required' => isset($_POST['is_required']) ? 1 : 0,
                'sort_order' => trim($_POST['sort_order']),
            ];

             // Basic validation
            if (!empty($data['label']) && !empty($data['field_type']) && !empty($data['field_name'])) {
                require_once APP_ROOT . '/src/models/FormField.php';
                $formFieldModel = new FormField();

                if ($formFieldModel->create($data)) {
                    header('Location: index.php?page=forms_show&id=' . $data['form_id']);
                } else {
                    die('Something went wrong while saving the field.');
                }
            } else {
                die('Label, Type, and Name are required for a field.');
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
