<?php
session_start();
ob_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'real_madrid_fan_site');
define('DB_USER', 'root');
define('DB_PASS', '');

// Site configuration
define('SITE_URL', '/real-madrid-fan-site');
define('SITE_NAME', 'Real Madrid Fan Site');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Time zone
date_default_timezone_set('Europe/Madrid');

// Database connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Connection failed. Please try again later.");
}

// Helper functions
function sanitize($input) {
    return htmlspecialchars(strip_tags($input));
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

// Image paths
define('PLAYER_IMAGES', 'assets/images/players/');
define('LEGEND_IMAGES', 'assets/images/legends/');
define('COACH_IMAGES', 'assets/images/coaches/');
define('TROPHY_IMAGES', 'assets/images/trophies/');
define('EVENT_IMAGES', 'assets/images/events/');
define('SHOP_IMAGES', 'assets/images/shop/');
define('FAN_GALLERY_IMAGES', 'assets/images/fan-gallery/'); 