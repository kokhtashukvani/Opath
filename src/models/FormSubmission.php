<?php
require_once APP_ROOT . '/src/lib/Database.php';

class FormSubmission {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Create a new form submission record and return the new ID
    public function create($form_id, $user_id) {
        $this->db->query('INSERT INTO form_submissions (form_id, user_id) VALUES (:form_id, :user_id)');

        $this->db->bind(':form_id', $form_id);
        $this->db->bind(':user_id', $user_id);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Get all submissions for a specific form and user, with their data
    public function getSubmissionsByFormNameAndUser($formName, $userId) {
        // First, get the form ID from the name
        $this->db->query('SELECT id FROM forms WHERE name = :name');
        $this->db->bind(':name', $formName);
        $form = $this->db->single();
        if (!$form) {
            return [];
        }
        $formId = $form->id;

        // Get all submissions for this form and user
        $this->db->query('
            SELECT
                s.id as submission_id,
                s.submitted_at,
                sd.field_name,
                sd.field_value
            FROM form_submissions s
            JOIN form_submission_data sd ON s.id = sd.submission_id
            WHERE s.form_id = :form_id AND s.user_id = :user_id
            ORDER BY s.submitted_at DESC, s.id, sd.id
        ');
        $this->db->bind(':form_id', $formId);
        $this->db->bind(':user_id', $userId);
        $results = $this->db->resultSet();

        // Process the flat results into a structured array
        $submissions = [];
        foreach ($results as $row) {
            $submissionId = $row->submission_id;
            if (!isset($submissions[$submissionId])) {
                $submissions[$submissionId] = [
                    'id' => $submissionId,
                    'submitted_at' => $row->submitted_at
                ];
            }
            $submissions[$submissionId][$row->field_name] = $row->field_value;
        }

        return array_values($submissions); // Return as a simple array
    }
}
