<?php

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if user is an admin
function isAdmin() {
    return (isLoggedIn() && $_SESSION['user_role'] == 'admin');
}
