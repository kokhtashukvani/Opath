<?php
require_once APP_ROOT . '/src/lib/Database.php';

class PurchaseRequest {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Create a new purchase request
    public function create($data) {
        $this->db->query('INSERT INTO purchase_requests (user_id, product_name, product_description, brand, quantity) VALUES (:user_id, :product_name, :product_description, :brand, :quantity)');

        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':product_name', $data['product_name']);
        $this->db->bind(':product_description', $data['product_description']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':quantity', $data['quantity']);

        // Execute
        return $this->db->execute();
    }

    // Get all purchase requests for a specific user
    public function getByUserId($user_id) {
        $this->db->query('SELECT * FROM purchase_requests WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    // Get a single purchase request by its ID
    public function findById($id) {
        $this->db->query('SELECT * FROM purchase_requests WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get all purchase requests (for admins)
    public function getAll() {
        $this->db->query('SELECT pr.*, u.full_name as user_name FROM purchase_requests pr JOIN users u ON pr.user_id = u.id ORDER BY pr.created_at DESC');
        return $this->db->resultSet();
    }
}
