<?php
require_once APP_ROOT . '/src/lib/Database.php';

class Inquiry {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Create a new inquiry record
    public function create($data) {
        $this->db->query('INSERT INTO inquiries (purchase_request_id, supplier_id, deadline) VALUES (:purchase_request_id, :supplier_id, :deadline)');

        // Bind values
        $this->db->bind(':purchase_request_id', $data['request_id']);
        $this->db->bind(':supplier_id', $data['supplier_id']);
        $this->db->bind(':deadline', $data['deadline']);

        // Execute
        return $this->db->execute();
    }
}
