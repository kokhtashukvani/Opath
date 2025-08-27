<?php
require_once APP_ROOT . '/src/lib/Database.php';

class Form {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get all forms
    public function getAll() {
        $this->db->query('SELECT * FROM forms ORDER BY name ASC');
        return $this->db->resultSet();
    }

    // Get form by ID
    public function findById($id) {
        $this->db->query('SELECT * FROM forms WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get form by name
    public function findByName($name) {
        $this->db->query('SELECT * FROM forms WHERE name = :name');
        $this->db->bind(':name', $name);
        return $this->db->single();
    }

    // Add a new form
    public function create($data) {
        $this->db->query('INSERT INTO forms (name, description) VALUES (:name, :description)');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);

        return $this->db->execute();
    }
}
