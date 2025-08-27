<?php
require_once APP_ROOT . '/src/models/User.php';
require_once APP_ROOT . '/src/lib/ApiResponse.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        // Get data from request body instead of $_POST
        $postData = json_decode(file_get_contents('php://input'), true);

        // Basic validation
        if (empty($postData['full_name']) || empty($postData['username']) || empty($postData['password'])) {
            ApiResponse::json(['error' => 'Please provide full name, username, and password.'], 400);
        }
        if (strlen($postData['password']) < 6) {
            ApiResponse::json(['error' => 'Password must be at least 6 characters.'], 400);
        }
        if ($this->userModel->findByUsername($postData['username'])) {
            ApiResponse::json(['error' => 'Username is already taken.'], 400);
        }

        // Prepare data for model
        $data = [
            'full_name' => $postData['full_name'],
            'username' => $postData['username'],
            'password' => password_hash($postData['password'], PASSWORD_DEFAULT)
        ];

        // Register user
        if ($this->userModel->register($data)) {
            ApiResponse::json(['success' => true, 'message' => 'User registered successfully.'], 201);
        } else {
            ApiResponse::json(['error' => 'Something went wrong during registration.'], 500);
        }
    }

    public function login() {
        $postData = json_decode(file_get_contents('php://input'), true);

        if (empty($postData['username']) || empty($postData['password'])) {
            ApiResponse::json(['error' => 'Username and password are required.'], 400);
        }

        $loggedInUser = $this->userModel->login($postData['username'], $postData['password']);

        if ($loggedInUser) {
            // Create Session
            $this->createUserSession($loggedInUser);

            // Unset password hash before sending user data
            unset($loggedInUser->password_hash);

            ApiResponse::json(['success' => true, 'user' => $loggedInUser]);
        } else {
            ApiResponse::json(['error' => 'Invalid credentials.'], 401);
        }
    }

    private function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_full_name'] = $user->full_name;
        $_SESSION['user_role'] = $user->role;
    }

    public function logout() {
        session_unset();
        session_destroy();
        ApiResponse::json(['success' => true, 'message' => 'Logged out successfully.']);
    }
}
