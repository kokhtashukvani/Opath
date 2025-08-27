<?php
require_once APP_ROOT . '/src/models/Form.php';
require_once APP_ROOT . '/src/models/FormField.php';
require_once APP_ROOT . '/src/models/FormSubmission.php';
require_once APP_ROOT . '/src/models/FormSubmissionData.php';

class FormSubmissionHandler {
    private $formModel;
    private $formFieldModel;
    private $submissionModel;
    private $submissionDataModel;

    public function __construct() {
        $this->formModel = new Form();
        $this->formFieldModel = new FormField();
        $this->submissionModel = new FormSubmission();
        $this->submissionDataModel = new FormSubmissionData();
    }

    public function handle($formName, $postData) {
        $form = $this->formModel->findByName($formName);
        if (!$form) {
            return ['success' => false, 'message' => 'Form not found.'];
        }

        $fields = $this->formFieldModel->getFieldsByFormId($form->id);

        // --- Validation ---
        foreach ($fields as $field) {
            if ($field->is_required) {
                if (empty($postData[$field->field_name])) {
                    return ['success' => false, 'message' => "Field '{$field->label}' is required."];
                }
            }
        }

        // --- Save Submission ---
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $submissionId = $this->submissionModel->create($form->id, $userId);

        if (!$submissionId) {
            return ['success' => false, 'message' => 'Failed to create submission record.'];
        }

        // --- Save Submission Data ---
        foreach ($fields as $field) {
            if (isset($postData[$field->field_name])) {
                $this->submissionDataModel->create([
                    'submission_id' => $submissionId,
                    'field_name' => $field->field_name,
                    'field_value' => trim($postData[$field->field_name])
                ]);
            }
        }

        // Now, we need to decide what to do with the data.
        // For a purchase request, we still need to save it to the 'purchase_requests' table.
        // This handler just saves the raw data. The controller will decide what to do next.

        return ['success' => true, 'message' => 'Submission successful.'];
    }
}
