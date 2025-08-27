<?php
require_once APP_ROOT . '/src/models/Form.php';
require_once APP_ROOT . '/src/models/FormField.php';

class FormRenderer {
    private $formModel;
    private $formFieldModel;

    public function __construct() {
        $this->formModel = new Form();
        $this->formFieldModel = new FormField();
    }

    public function render($formName, $actionUrl) {
        $form = $this->formModel->findByName($formName);
        if (!$form) {
            return "<p>Error: Form '{$formName}' not found.</p>";
        }

        $fields = $this->formFieldModel->getFieldsByFormId($form->id);

        $html = '<form class="card" action="' . $actionUrl . '" method="post">';
        $html .= '<div class="card-header"><h4 class="card-title">' . htmlspecialchars($form->description) . '</h4></div>';
        $html .= '<div class="card-body"><div class="row">';

        foreach ($fields as $field) {
            $html .= $this->renderField($field);
        }

        $html .= '</div></div>'; // close .row and .card-body
        $html .= '<div class="card-footer text-end">';
        $html .= '<button type="submit" class="btn btn-primary">Submit</button>';
        $html .= '</div></form>';

        return $html;
    }

    private function renderField($field) {
        $fieldHtml = '<div class="col-md-6"><div class="mb-3">';
        $required = $field->is_required ? 'required' : '';
        $required_label = $field->is_required ? ' <span class="text-danger">*</span>' : '';

        $fieldHtml .= '<label class="form-label">' . htmlspecialchars($field->label) . $required_label . '</label>';

        switch ($field->field_type) {
            case 'text':
                $fieldHtml .= '<input type="text" class="form-control" name="' . htmlspecialchars($field->field_name) . '" ' . $required . '>';
                break;
            case 'textarea':
                $fieldHtml .= '<textarea class="form-control" name="' . htmlspecialchars($field->field_name) . '" rows="5" ' . $required . '></textarea>';
                break;
            // More field types will be added here in the future
            default:
                $fieldHtml .= '<p>Unsupported field type: ' . htmlspecialchars($field->field_type) . '</p>';
                break;
        }

        $fieldHtml .= '</div></div>'; // close .mb-3 and .col-md-6
        return $fieldHtml;
    }
}
