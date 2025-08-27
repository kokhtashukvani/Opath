<?php
require_once APP_ROOT . '/src/lib/Database.php';

class Supplier {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get all suppliers
    public function getAll() {
        $this->db->query('SELECT * FROM suppliers ORDER BY name ASC');
        return $this->db->resultSet();
    }

    // Get supplier by ID
    public function findById($id) {
        $this->db->query('SELECT * FROM suppliers WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Add a new supplier
    public function create($data) {
        $this->db->query('INSERT INTO suppliers (name, contact_person, email, password_hash, phone, address, city, province, specialization) VALUES (:name, :contact_person, :email, :password_hash, :phone, :address, :city, :province, :specialization)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact_person', $data['contact_person']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password_hash', $data['password_hash']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':specialization', $data['specialization']);

        // Execute
        return $this->db->execute();
    }

    // Update a supplier
    public function update($data) {
        $this->db->query('UPDATE suppliers SET name = :name, contact_person = :contact_person, email = :email, phone = :phone, address = :address, city = :city, province = :province, specialization = :specialization WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact_person', $data['contact_person']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':specialization', $data['specialization']);

        // Execute
        return $this->db->execute();
    }

    // Delete a supplier
    public function delete($id) {
        $this->db->query('DELETE FROM suppliers WHERE id = :id');
        $this->db->bind(':id', $id);

        // Execute
        return $this->db->execute();
    }
}
