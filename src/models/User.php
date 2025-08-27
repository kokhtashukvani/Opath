<?php
require_once APP_ROOT . '/src/lib/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Find user by username
    public function findByUsername($username) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    // Register user
    public function register($data) {
        $this->db->query('INSERT INTO users (full_name, username, password_hash, role) VALUES (:full_name, :username, :password, :role)');

        // Bind values
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', 'buyer'); // Default role for new users

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login user
    public function login($username, $password) {
        $user = $this->findByUsername($username);

        if ($user === false) {
            return false; // User not found
        }

        $hashed_password = $user->password_hash;
        if (password_verify($password, $hashed_password)) {
            return $user;
        } else {
            return false;
        }
    }
}
