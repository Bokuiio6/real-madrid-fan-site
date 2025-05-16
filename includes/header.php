<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Alpine.js for interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-2">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="<?php echo SITE_URL; ?>">
                    <img src="<?php echo SITE_URL; ?>/assets/images/logo.png" alt="Real Madrid Logo" height="40">
                    <img src="<?php echo SITE_URL; ?>/assets/images/champions-league-15.png" alt="15 Champions League Titles" height="30" class="ms-2">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?php echo SITE_URL; ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?php echo SITE_URL; ?>/pages/players.php">Players</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?php echo SITE_URL; ?>/pages/legends.php">Legends</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?php echo SITE_URL; ?>/pages/honours.php">Honours</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?php echo SITE_URL; ?>/pages/shop.php">Shop</a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle px-3" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i>
                                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/profile.php">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="<?php echo SITE_URL; ?>/pages/logout.php">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link px-3" href="<?php echo SITE_URL; ?>/pages/login.php">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container"> 

<style>
/* Enhanced header styles */
.main-header {
    background: var(--white);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}

.header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo-container {
    display: flex;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    position: relative;
}

.logo img:first-child {
    height: 50px;
    width: auto;
}

.champions-badge {
    height: 30px;
    width: auto;
    margin-left: 10px;
    transition: transform 0.3s ease;
}

.champions-badge:hover {
    transform: scale(1.1);
}

.main-nav ul {
    display: flex;
    gap: 2rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

.main-nav a {
    color: var(--text-color);
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.main-nav a:hover {
    color: var(--primary-color);
    background: var(--light-gray);
}

@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        gap: 1rem;
    }

    .main-nav ul {
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
    }
}
</style> 

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 