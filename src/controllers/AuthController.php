<?php
require_once APP_ROOT . '/src/models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        // Process form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'full_name' => trim($_POST['full_name']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'full_name_err' => '',
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate data (basic validation)
            if (empty($data['full_name'])) {
                $data['full_name_err'] = 'Please enter your full name.';
            }
            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter a username.';
            } elseif ($this->userModel->findByUsername($data['username'])) {
                $data['username_err'] = 'Username is already taken.';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password.';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters.';
            }
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password.';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match.';
                }
            }

            // Make sure errors are empty
            if (empty($data['full_name_err']) && empty($data['username_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                if ($this->userModel->register($data)) {
                    // Redirect to login page with a success message
                    header('location: index.php?page=login&success=true');
                } else {
                    die('Something went wrong.');
                }
            } else {
                // Load view with errors (for now, we just die)
                die(json_encode($data)); // In a real app, you'd reload the view with error messages
            }

        } else {
            // If not a POST request, redirect to register page
            header('location: index.php?page=register');
        }
    }

    public function login() {
        // Process form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => '',
            ];

            // Validate username
            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter username.';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password.';
            }

            // Check for user/email
            if ($this->userModel->findByUsername($data['username'])) {
                // User found
            } else {
                // User not found
                $data['username_err'] = 'No user found';
            }

            // Make sure errors are empty
            if (empty($data['username_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    // For now, we just die
                    die(json_encode($data));
                }
            } else {
                // Load view with errors
                die(json_encode($data));
            }
        } else {
            // If not a POST request, redirect
            header('location: index.php?page=login');
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_full_name'] = $user->full_name;
        $_SESSION['user_role'] = $user->role; // Add role to session
        header('location: index.php?page=dashboard');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_full_name']);
        session_destroy();
        header('location: index.php?page=home');
    }
}
