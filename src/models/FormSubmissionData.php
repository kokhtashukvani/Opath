<?php
require_once APP_ROOT . '/src/lib/Database.php';

class FormSubmissionData {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Create a new submission data record
    public function create($data) {
        $this->db->query('INSERT INTO form_submission_data (submission_id, field_name, field_value) VALUES (:submission_id, :field_name, :field_value)');

        $this->db->bind(':submission_id', $data['submission_id']);
        $this->db->bind(':field_name', $data['field_name']);
        $this->db->bind(':field_value', $data['field_value']);

        return $this->db->execute();
    }
}
