<?php
// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Require login for protected pages
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . SITE_URL . '/pages/login.php');
        exit;
    }
}

// Get current user's ID
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Get current user's username
function getCurrentUsername() {
    return $_SESSION['username'] ?? null;
}

// Get current user's email
function getCurrentUserEmail() {
    return $_SESSION['user_email'] ?? null;
} 