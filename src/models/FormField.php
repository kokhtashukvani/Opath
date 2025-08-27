<?php
require_once APP_ROOT . '/src/lib/Database.php';

class FormField {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get all fields for a specific form
    public function getFieldsByFormId($form_id) {
        $this->db->query('SELECT * FROM form_fields WHERE form_id = :form_id ORDER BY sort_order ASC');
        $this->db->bind(':form_id', $form_id);
        return $this->db->resultSet();
    }

    // Add a new field to a form
    public function create($data) {
        $this->db->query('INSERT INTO form_fields (form_id, label, field_type, field_name, is_required, sort_order) VALUES (:form_id, :label, :field_type, :field_name, :is_required, :sort_order)');

        $this->db->bind(':form_id', $data['form_id']);
        $this->db->bind(':label', $data['label']);
        $this->db->bind(':field_type', $data['field_type']);
        $this->db->bind(':field_name', $data['field_name']);
        $this->db->bind(':is_required', $data['is_required']);
        $this->db->bind(':sort_order', $data['sort_order']);

        return $this->db->execute();
    }
}
